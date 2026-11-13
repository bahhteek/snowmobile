<?php

function nordline_img( $file ) {
	return get_template_directory_uri() . '/assets/images/' . ltrim( (string) $file, '/' );
}

function nordline_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . trim( $slug, '/' ) . '/' );
}

function nordline_phone() {
	$contacts = get_page_by_path( 'kontakty' );
	$post_id  = $contacts ? $contacts->ID : (int) get_option( 'page_on_front' );
	return nordline_field( 'phone', '+7 800 555-01-27', $post_id );
}

function nordline_has_posts( $post_type ) {
	$ids = get_posts(
		array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	return ! empty( $ids );
}

function nordline_first_term( $post_id, $taxonomy ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return null;
	}
	return $terms[0];
}

function nordline_equipment_term( $post_id ) {
	$terms = get_the_terms( $post_id, 'equipment' );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return null;
	}
	foreach ( $terms as $term ) {
		if ( (int) $term->parent ) {
			return $term;
		}
	}
	return $terms[0];
}

function nordline_gallery_urls( $value, $fallback ) {
	if ( ! is_array( $value ) || ! $value ) {
		return $fallback;
	}
	$urls = array();
	foreach ( $value as $image ) {
		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			$urls[] = $image['url'];
		} elseif ( is_numeric( $image ) ) {
			$src = wp_get_attachment_image_url( (int) $image, 'large' );
			if ( $src ) {
				$urls[] = $src;
			}
		}
	}
	return $urls ? $urls : $fallback;
}

function nordline_model_url( $model ) {
	if ( ! empty( $model['post_id'] ) ) {
		return get_permalink( $model['post_id'] );
	}
	return home_url( '/snegohod/' . $model['slug'] . '/' );
}

function nordline_hydrate_demo_model( $item ) {
	$gallery = array();
	foreach ( $item['gallery'] as $file ) {
		$gallery[] = nordline_img( $file );
	}
	$item['post_id'] = 0;
	$item['image']   = nordline_img( $item['image'] );
	$item['gallery'] = $gallery;
	$item['url']     = nordline_model_url( $item );
	return $item;
}

function nordline_format_price( $value ) {
	$raw = trim( (string) $value );
	if ( '' === $raw ) {
		return '';
	}
	$digits = preg_replace( '/[^\d]/', '', $raw );
	$plain  = str_replace( array( ' ', "\xc2\xa0" ), '', $raw );
	if ( '' !== $digits && preg_match( '/^\d+$/', $plain ) ) {
		return 'от ' . number_format( (float) $digits, 0, ',', ' ' ) . ' ₽';
	}
	return $raw;
}

function nordline_image_url( $image, $fallback = '' ) {
	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return $image['url'];
	}
	if ( is_numeric( $image ) ) {
		$url = wp_get_attachment_image_url( (int) $image, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}

function nordline_model_from_post( $post ) {
	$id    = $post->ID;
	$brand           = nordline_first_term( $id, 'brand' );
	$category        = nordline_equipment_term( $id );
	$category_parent = '';
	if ( $category && $category->parent ) {
		$parent_term = get_term( (int) $category->parent, 'equipment' );
		if ( $parent_term && ! is_wp_error( $parent_term ) ) {
			$category_parent = $parent_term->slug;
		}
	}
	$image = nordline_image_url( nordline_raw_field( 'картинка', $id ) );
	if ( ! $image ) {
		$image = get_the_post_thumbnail_url( $id, 'large' );
	}
	if ( ! $image ) {
		$image = nordline_img( 'hero-sled.png' );
	}

	$specs = array();
	$rows  = nordline_raw_field( 'характеристики', $id );
	if ( is_array( $rows ) ) {
		foreach ( $rows as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}
			$label = isset( $row['характеристика'] ) ? trim( (string) $row['характеристика'] ) : '';
			$value = isset( $row['значение'] ) ? trim( (string) $row['значение'] ) : '';
			if ( '' === $label && '' === $value ) {
				continue;
			}
			$specs[] = array(
				'label' => $label,
				'value' => $value,
			);
		}
	}

	$known = array(
		'двигатель' => 'engine',
		'мощность'  => 'hp',
		'гусеница'  => 'track',
		'сценарий'  => 'use',
		'посадка'   => 'seats',
		'груз'      => 'payload',
	);
	$mapped = array(
		'engine'  => '',
		'hp'      => '',
		'track'   => '',
		'use'     => '',
		'seats'   => '',
		'payload' => '',
	);
	foreach ( $specs as $spec ) {
		$key = mb_strtolower( $spec['label'] );
		if ( isset( $known[ $key ] ) ) {
			$mapped[ $known[ $key ] ] = $spec['value'];
		}
	}

	$mark_labels = array(
		'hit'           => array( 'class' => 'hit', 'label' => 'Хит' ),
		'in_stock'      => array( 'class' => 'in', 'label' => 'В наличии' ),
		'en_route'      => array( 'class' => 'soon', 'label' => 'В пути' ),
		'made_to_order' => array( 'class' => 'soon', 'label' => 'Под заказ' ),
	);
	$marks  = nordline_raw_field( 'метка', $id );
	$marks  = is_array( $marks ) ? $marks : array();
	$badges = array();
	$status = array();
	foreach ( $mark_labels as $key => $badge ) {
		if ( ! in_array( $key, $marks, true ) ) {
			continue;
		}
		$badges[] = $badge;
		if ( 'hit' !== $key ) {
			$status[] = $badge['label'];
		}
	}

	$content = trim( (string) $post->post_content );
	$model   = array(
		'post_id'     => $id,
		'slug'        => $post->post_name,
		'name'        => get_the_title( $post ),
		'brand'       => $brand ? $brand->name : '',
		'brand_slug'  => $brand ? $brand->slug : '',
		'year'        => nordline_field( 'год', '', $id ),
		'type'           => ( $category && $category_parent ) ? $category->slug : '',
		'type_label'     => ( $category && $category_parent ) ? $category->name : '',
		'category'        => $category ? $category->slug : '',
		'category_label'  => $category ? $category->name : '',
		'category_parent' => $category_parent,
		'price'       => 0,
		'price_label' => nordline_format_price( nordline_field( 'цена', '', $id ) ),
		'stock'       => in_array( 'in_stock', $marks, true ) ? 'in' : 'soon',
		'stock_label' => implode( ' · ', $status ),
		'hit'         => in_array( 'hit', $marks, true ),
		'badges'      => $badges,
		'image'       => $image,
		'gallery'     => array( $image ),
		'engine'      => $mapped['engine'],
		'hp'          => $mapped['hp'],
		'track'       => $mapped['track'],
		'payload'     => $mapped['payload'],
		'seats'       => $mapped['seats'],
		'desc'        => $content ? apply_filters( 'the_content', $content ) : '',
		'configs'     => array(),
		'specs'       => $specs,
		'use'         => $mapped['use'],
	);
	$model['url'] = nordline_model_url( $model );
	return $model;
}

function nordline_get_models( $args = array() ) {
	$type     = isset( $args['type'] ) ? $args['type'] : '';
	$brand    = isset( $args['brand'] ) ? $args['brand'] : '';
	$category = isset( $args['category'] ) ? $args['category'] : '';
	$models = array();

	if ( nordline_has_posts( 'snowmobile' ) ) {
		$query = array(
			'post_type'      => 'snowmobile',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		);
		$tax = array();
		if ( $type ) {
			$tax[] = array(
				'taxonomy' => 'equipment',
				'field'    => 'slug',
				'terms'    => $type,
			);
		}
		if ( $brand ) {
			$tax[] = array(
				'taxonomy' => 'brand',
				'field'    => 'slug',
				'terms'    => $brand,
			);
		}
		if ( $category ) {
			$tax[] = array(
				'taxonomy' => 'equipment',
				'field'    => 'slug',
				'terms'    => $category,
			);
		}
		if ( $tax ) {
			$query['tax_query'] = $tax;
		}
		foreach ( get_posts( $query ) as $post ) {
			$models[] = nordline_model_from_post( $post );
		}
		return $models;
	}

	foreach ( nordline_demo_models_raw() as $item ) {
		if ( $type && $item['type'] !== $type ) {
			continue;
		}
		if ( $brand && $item['brand_slug'] !== $brand ) {
			continue;
		}
		$models[] = nordline_hydrate_demo_model( $item );
	}
	return $models;
}

function nordline_find_model( $slug ) {
	if ( nordline_has_posts( 'snowmobile' ) ) {
		$posts = get_posts(
			array(
				'name'           => $slug,
				'post_type'      => 'snowmobile',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
			)
		);
		return $posts ? nordline_model_from_post( $posts[0] ) : null;
	}
	foreach ( nordline_demo_models_raw() as $item ) {
		if ( $item['slug'] === $slug ) {
			return nordline_hydrate_demo_model( $item );
		}
	}
	return null;
}

function nordline_term_key( $term ) {
	return $term->taxonomy . '_' . $term->term_id;
}

function nordline_term_image_url( $term, $fallback = '' ) {
	$image = nordline_raw_field( 'картинка', nordline_term_key( $term ) );
	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return $image['url'];
	}
	if ( is_numeric( $image ) ) {
		$url = wp_get_attachment_image_url( (int) $image, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}

function nordline_terms_list( $taxonomy ) {
	$terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'term_id',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $terms ) || ! $terms ) {
		return array();
	}
	return $terms;
}

function nordline_get_brands() {
	$terms = nordline_terms_list( 'brand' );
	if ( $terms ) {
		$list = array();
		foreach ( $terms as $term ) {
			$link = get_term_link( $term );
			$list[ $term->slug ] = array(
				'name' => $term->name,
				'text' => $term->description ? $term->description : '',
				'url'  => is_wp_error( $link ) ? nordline_page_url( 'katalog' ) : $link,
			);
		}
		return $list;
	}
	$list = array();
	foreach ( nordline_demo_brands() as $slug => $brand ) {
		$brand['url']    = add_query_arg( 'brand', $slug, nordline_page_url( 'katalog' ) );
		$list[ $slug ] = $brand;
	}
	return $list;
}

function nordline_equipment_terms( $parent = 0 ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'equipment',
			'hide_empty' => false,
			'parent'     => $parent,
			'orderby'    => 'term_id',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $terms ) || ! $terms ) {
		return array();
	}
	$list = array();
	foreach ( $terms as $term ) {
		$link = get_term_link( $term );
		$list[ $term->slug ] = array(
			'name' => $term->name,
			'text' => $term->description ? $term->description : '',
			'url'  => is_wp_error( $link ) ? add_query_arg( 'category', $term->slug, nordline_page_url( 'katalog' ) ) : $link,
		);
	}
	return $list;
}

function nordline_get_categories() {
	return nordline_equipment_terms( 0 );
}

function nordline_get_category_children( $parent_slug ) {
	$parent = get_term_by( 'slug', $parent_slug, 'equipment' );
	if ( ! $parent || is_wp_error( $parent ) ) {
		return array();
	}
	return nordline_equipment_terms( (int) $parent->term_id );
}

function nordline_snowmobile_category() {
	$by_slug = get_term_by( 'slug', 'snegohody', 'equipment' );
	if ( $by_slug && ! is_wp_error( $by_slug ) ) {
		return $by_slug;
	}
	$terms = get_terms(
		array(
			'taxonomy'   => 'equipment',
			'hide_empty' => false,
			'parent'     => 0,
		)
	);
	if ( is_wp_error( $terms ) || ! $terms ) {
		return null;
	}
	foreach ( $terms as $term ) {
		if ( false !== mb_stripos( $term->name, 'снегоход' ) ) {
			return $term;
		}
	}
	return null;
}

function nordline_legacy_ride_type( $name ) {
	global $wpdb;
	return $wpdb->get_row(
		$wpdb->prepare(
			"SELECT t.term_id, tt.description
			FROM {$wpdb->terms} t
			INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_id = t.term_id
			WHERE tt.taxonomy = 'ride_type' AND t.name = %s
			LIMIT 1",
			$name
		)
	);
}

function nordline_get_types() {
	$parent = nordline_snowmobile_category();
	if ( ! $parent ) {
		return array();
	}
	$terms = get_terms(
		array(
			'taxonomy'   => 'equipment',
			'hide_empty' => false,
			'parent'     => (int) $parent->term_id,
			'orderby'    => 'term_id',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $terms ) || ! $terms ) {
		return array();
	}
	$list = array();
	foreach ( $terms as $term ) {
		$link  = get_term_link( $term );
		$label = nordline_field( 'тег', '', nordline_term_key( $term ) );
		$text  = $term->description ? $term->description : '';
		$image = nordline_term_image_url( $term, '' );
		if ( ! $label || ! $text || ! $image ) {
			$legacy = nordline_legacy_ride_type( $term->name );
			if ( $legacy ) {
				if ( ! $label ) {
					$label = (string) get_term_meta( (int) $legacy->term_id, 'тег', true );
				}
				if ( ! $text ) {
					$text = (string) $legacy->description;
				}
				if ( ! $image ) {
					$image = nordline_image_url( get_term_meta( (int) $legacy->term_id, 'картинка', true ) );
				}
			}
		}
		$list[ $term->slug ] = array(
			'name'  => $term->name,
			'label' => $label,
			'text'  => $text,
			'image' => $image ? $image : nordline_img( 'hero.jpg' ),
			'url'   => is_wp_error( $link ) ? add_query_arg( 'category', $term->slug, nordline_page_url( 'katalog' ) ) : $link,
		);
	}
	return $list;
}

function nordline_type_url( $slug ) {
	$term = get_term_by( 'slug', $slug, 'equipment' );
	if ( $term && ! is_wp_error( $term ) ) {
		$link = get_term_link( $term );
		if ( ! is_wp_error( $link ) ) {
			return $link;
		}
	}
	return add_query_arg( 'category', $slug, nordline_page_url( 'katalog' ) );
}

function nordline_brand_url( $slug ) {
	$brands = nordline_get_brands();
	return isset( $brands[ $slug ]['url'] ) ? $brands[ $slug ]['url'] : nordline_page_url( 'katalog' );
}

function nordline_get_parts() {
	return nordline_demo_parts();
}

function nordline_get_accessories() {
	if ( nordline_has_posts( 'accessory' ) ) {
		$items = array();
		foreach ( get_posts( array( 'post_type' => 'accessory', 'posts_per_page' => -1 ) ) as $post ) {
			$image = get_the_post_thumbnail_url( $post, 'large' );
			$items[] = array(
				'name'        => get_the_title( $post ),
				'price_label' => nordline_field( 'price_label', '', $post->ID ),
				'image'       => $image ? $image : nordline_img( 'parts.jpg' ),
			);
		}
		return $items;
	}
	$items = array();
	foreach ( nordline_demo_accessories() as $item ) {
		$item['image'] = nordline_img( $item['image'] );
		$items[]       = $item;
	}
	return $items;
}

function nordline_get_news() {
	$posts = get_posts( array( 'post_type' => 'post', 'posts_per_page' => 12 ) );
	if ( $posts ) {
		$items = array();
		foreach ( $posts as $post ) {
			$image = get_the_post_thumbnail_url( $post, 'large' );
			$items[] = array(
				'slug'  => $post->post_name,
				'title' => get_the_title( $post ),
				'date'  => get_the_date( 'j F Y', $post ),
				'image' => $image ? $image : nordline_img( 'hero-sled.png' ),
				'lead'  => has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 24 ),
				'url'   => get_permalink( $post ),
				'html'  => apply_filters( 'the_content', $post->post_content ),
			);
		}
		return $items;
	}
	$items = array();
	foreach ( nordline_demo_news() as $item ) {
		$item['image'] = nordline_img( $item['image'] );
		$item['url']   = add_query_arg( 'article', $item['slug'], nordline_page_url( 'novosti' ) );
		$item['html']  = '<p>' . esc_html( $item['lead'] ) . '</p><p>Это демо-текст статьи. Когда новость создана как запись WordPress, здесь будет её содержимое.</p>';
		$items[]       = $item;
	}
	return $items;
}

function nordline_find_news( $slug ) {
	foreach ( nordline_get_news() as $item ) {
		if ( $item['slug'] === $slug ) {
			return $item;
		}
	}
	return null;
}
