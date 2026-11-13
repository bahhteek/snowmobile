<?php

function nordline_register_content_types() {
	register_post_type(
		'snowmobile',
		array(
			'labels' => array(
				'name'          => 'Снегоходы',
				'singular_name' => 'Снегоход',
				'add_new_item'  => 'Добавить снегоход',
				'edit_item'     => 'Редактировать снегоход',
			),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-location',
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'snegohod' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		)
	);

	register_taxonomy(
		'brand',
		'snowmobile',
		array(
			'labels'       => array(
				'name'          => 'Бренды',
				'singular_name' => 'Бренд',
			),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'brend' ),
		)
	);

	register_taxonomy(
		'ride_type',
		'snowmobile',
		array(
			'labels'       => array(
				'name'          => 'Тип езды',
				'singular_name' => 'Тип езды',
			),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'tip' ),
		)
	);

	register_post_type(
		'accessory',
		array(
			'labels' => array(
				'name'          => 'Аксессуары',
				'singular_name' => 'Аксессуар',
			),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-cart',
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'aksessuar' ),
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
		)
	);

	register_post_type(
		'request',
		array(
			'labels' => array(
				'name'          => 'Заявки',
				'singular_name' => 'Заявка',
			),
			'public'       => false,
			'show_ui'      => true,
			'menu_icon'    => 'dashicons-email',
			'show_in_rest' => false,
			'supports'     => array( 'title', 'editor' ),
		)
	);
}
add_action( 'init', 'nordline_register_content_types' );
