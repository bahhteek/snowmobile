<?php

function nordline_register_content_types() {
	register_post_type(
		'snowmobile',
		array(
			'labels' => array(
				'name'          => 'Техника',
				'singular_name' => 'Техника',
				'add_new_item'  => 'Добавить технику',
				'edit_item'     => 'Редактировать технику',
				'menu_name'     => 'Техника',
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
		'equipment',
		'snowmobile',
		array(
			'labels'       => array(
				'name'          => 'Категории',
				'singular_name' => 'Категория',
				'menu_name'     => 'Категории',
			),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'kategoriya' ),
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
