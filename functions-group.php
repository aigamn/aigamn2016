<?php

	add_action( 'init', 'create_group_post_type' );
	function create_group_post_type() {
		register_post_type( 'group',
			array(
					'labels' => array(
					'name' => __( 'Groups' ),
					'singular_name' => __( 'Group' )
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
	}

	function getPostsByGroup($groupPostId, $number = 0) {
		$args = array(
			'post_type'			=>'post',
			'meta_query'		=> array(
				array(
					'key'    	=> 'group',
					'value'		=> $groupPostId,
					'compare'	=> '=',
				)
			)
		);
		if($number > 0) {
			$args['posts_per_page'] = $number;
		}
		$query = new WP_Query($args);
		return $query;
	}

?>