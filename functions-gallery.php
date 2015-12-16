<?php
	add_action( 'init', 'create_gallery_post_type' );
	function create_gallery_post_type() {
		register_post_type( 'gallery',
			array(
					'labels' => array(
					'name' => __( 'Galleries' ),
					'singular_name' => __( 'Gallery' )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'author'
				),
			)
		);

		register_post_type( 'gallery_post',
			array(
					'labels' => array(
					'name' => __( 'Gallery Posts' ),
					'singular_name' => __( 'Gallery Post' )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'author',
					'comments'
				),
			)
		);
	}
?>