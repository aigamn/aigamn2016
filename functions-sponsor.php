<?php
	add_action( 'init', 'create_sponsor_post_type' );
	function create_sponsor_post_type() {
		register_post_type( 'sponsor',
			array(
					'labels' => array(
					'name' => __( 'Sponsors' ),
					'singular_name' => __( 'Sponsor' )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => array( 
					'title', 
					'editor',
					'thumbnail'
				),
			)
		);
	}
?>