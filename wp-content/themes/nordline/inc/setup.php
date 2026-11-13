<?php

function nordline_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus(
		array(
			'primary' => 'Шапка',
			'mobile'  => 'Мобильное меню',
		)
	);
}
add_action( 'after_setup_theme', 'nordline_setup' );

function nordline_assets() {
	wp_enqueue_style(
		'nordline-fonts',
		'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'nordline', get_template_directory_uri() . '/assets/css/styles.css', array( 'nordline-fonts' ), filemtime( get_template_directory() . '/assets/css/styles.css' ) );
	wp_enqueue_script( 'nordline', get_template_directory_uri() . '/assets/js/theme.js', array(), filemtime( get_template_directory() . '/assets/js/theme.js' ), true );
	wp_localize_script(
		'nordline',
		'nordlineTheme',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'nordline_lead' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'nordline_assets' );

function nordline_pages() {
	return array(
		'glavnaya'    => array( 'Главная', '' ),
		'katalog'     => array( 'Каталог', 'page-templates/template-catalog.php' ),
		'podbor'      => array( 'Подбор', 'page-templates/template-quiz.php' ),
		'sravnenie'   => array( 'Сравнение', 'page-templates/template-compare.php' ),
		'servis'      => array( 'Сервис', 'page-templates/template-service.php' ),
		'kontakty'    => array( 'Контакты', 'page-templates/template-contacts.php' ),
		'zapchasti'   => array( 'Запчасти', 'page-templates/template-parts.php' ),
		'aksessuary'  => array( 'Аксессуары', 'page-templates/template-accessories.php' ),
		'rassrochka'  => array( 'Рассрочка', 'page-templates/template-finance.php' ),
		'treyd-in'    => array( 'Трейд-ин', 'page-templates/template-tradein.php' ),
		'test-drayv'  => array( 'Тест-драйв', 'page-templates/template-testdrive.php' ),
		'o-kompanii'  => array( 'О компании', 'page-templates/template-about.php' ),
		'garantiya'   => array( 'Гарантия', 'page-templates/template-warranty.php' ),
		'vladeltsu'   => array( 'Владельцу', 'page-templates/template-owner.php' ),
		'novosti'     => array( 'Новости', 'page-templates/template-news.php' ),
		'yurlicam'    => array( 'Корпоративным клиентам', 'page-templates/template-corporate.php' ),
		'politika'    => array( 'Политика конфиденциальности', 'page-templates/template-privacy.php' ),
		'karta-sayta' => array( 'Карта сайта', 'page-templates/template-sitemap.php' ),
	);
}

function nordline_install() {
	$ids = array();
	foreach ( nordline_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			if ( $page[1] ) {
				update_post_meta( $existing->ID, '_wp_page_template', $page[1] );
			}
			continue;
		}
		$ids[ $slug ] = wp_insert_post(
			array(
				'post_title'  => $page[0],
				'post_name'   => $slug,
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
		if ( $page[1] && $ids[ $slug ] ) {
			update_post_meta( $ids[ $slug ], '_wp_page_template', $page[1] );
		}
	}

	if ( ! empty( $ids['glavnaya'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['glavnaya'] );
	}

	$menu_name = 'Шапка NORDLINE';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu( $menu_name );
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		$locations['primary'] = $menu_id;
		$locations['mobile']  = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
		$existing_items = wp_get_nav_menu_items( $menu_id );
		if ( ! $existing_items ) {
			foreach ( array( 'katalog', 'podbor', 'sravnenie', 'servis', 'kontakty' ) as $slug ) {
				if ( empty( $ids[ $slug ] ) ) {
					continue;
				}
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => get_the_title( $ids[ $slug ] ),
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ids[ $slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					)
				);
			}
		}
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'nordline_install' );

function nordline_nav_items( $location ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $location ] ) ) {
		return array();
	}
	$items = wp_get_nav_menu_items( $locations[ $location ] );
	return is_array( $items ) ? $items : array();
}

function nordline_default_nav() {
	return array(
		array( 'title' => 'Каталог', 'url' => nordline_page_url( 'katalog' ), 'slug' => 'katalog' ),
		array( 'title' => 'Подбор', 'url' => nordline_page_url( 'podbor' ), 'slug' => 'podbor' ),
		array( 'title' => 'Сравнение', 'url' => nordline_page_url( 'sravnenie' ), 'slug' => 'sravnenie' ),
		array( 'title' => 'Сервис', 'url' => nordline_page_url( 'servis' ), 'slug' => 'servis' ),
		array( 'title' => 'Контакты', 'url' => nordline_page_url( 'kontakty' ), 'slug' => 'kontakty' ),
	);
}

function nordline_demo_model_route() {
	if ( ! is_404() ) {
		return;
	}
	$home = trim( (string) wp_parse_url( home_url(), PHP_URL_PATH ), '/' );
	$path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
	if ( $home && str_starts_with( $path, $home ) ) {
		$path = trim( substr( $path, strlen( $home ) ), '/' );
	}
	if ( ! preg_match( '#^snegohod/([^/]+)/?$#', $path, $matches ) ) {
		return;
	}
	$model = nordline_find_model( $matches[1] );
	if ( ! $model || ! empty( $model['post_id'] ) ) {
		return;
	}
	$GLOBALS['nordline_current_model'] = $model;
	global $wp_query;
	$wp_query->is_404 = false;
	status_header( 200 );
	nocache_headers();
	include get_template_directory() . '/single-snowmobile.php';
	exit;
}
add_action( 'template_redirect', 'nordline_demo_model_route' );
