<?php

add_action( 'init', 'create_post_footers' );
function create_post_footers() {
	register_post_type( 'post_footer',
		array(
				'labels' => array(
				'name' => __( 'Post Footers' ),
				'singular_name' => __( 'Post Footer' )
			),
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'supports' => array( 
				'title', 
				'editor'
			),
		)
	);
}

?>