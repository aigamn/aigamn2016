<?php
	add_action( 'init', 'create_cta_post_type' );
	function create_cta_post_type() {
		register_post_type( 'cta',
			array(
					'labels' => array(
					'name' => __( 'CTAs' ),
					'singular_name' => __( 'CTA' )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => array(
					'title',
					'editor',
					'thumbnail'
				)
			)
		);
	}

	function getCurrentCTAs() {
		$today = date("Ymd");
		$args = array(
			'post_type'		=> 'cta',
			'meta_key'    	=> 'expiration_date',
			'meta_value'  	=> $today,
			'meta_compare'	=> '>',
		);
		$query = new WP_Query($args);
		return $query;
	}
?>