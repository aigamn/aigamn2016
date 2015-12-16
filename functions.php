<?php

    add_theme_support( 'post-thumbnails');

    include 'functions-event.php';
    include 'functions-group.php';
    include 'functions-post-footer.php';
    include 'functions-sponsor.php';
    include 'functions-cta.php';
    include 'functions-blog.php';
    include 'functions-gallery.php';

    // [get_name login="username"]
    function get_name_func( $atts ) {
        $a = shortcode_atts( array(
            'login' => ''
        ), $atts );

        $username = $a['login'];
        //die($username);
        $user = get_user_by( 'login', $username );

        return $user->display_name;
    }
    add_shortcode( 'get_name', 'get_name_func' );

    // [bootstrap_button copy='Button Text' type='primary' link='http://google.com']
    function bootstrap_button_func( $atts ) {
        $a = shortcode_atts( array(
            'copy' => '',
            'type' => 'primary',
            'link' => ''
        ), $atts );

        // check to see if link is external, and set target appropriately

        $copy = $a['copy'];
        $type = $a['type'];
        $link = $a['link'];

        return '<a class="btn btn-' . $type . '" href="' . $link . '">' . $copy . '</a>';
    }
    add_shortcode( 'bootstrap_button', 'bootstrap_button_func' );

    function lead_paragraphs($content) {
        if( is_page() ){
            $content = preg_replace('/<p([^>]+)?>/m', '<p$1 class="lead">', $content);
        }

        return $content;
    }
    add_filter( 'the_content', 'lead_paragraphs' );

    /*
   * Function creates post duplicate as a draft and redirects then to the edit post screen
   */
  function rd_duplicate_post_as_draft(){
  	global $wpdb;
  	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
  		wp_die('No post to duplicate has been supplied!');
  	}

  	/*
  	 * get the original post id
  	 */
  	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
  	/*
  	 * and all the original post data then
  	 */
  	$post = get_post( $post_id );

  	/*
  	 * if you don't want current user to be the new post author,
  	 * then change next couple of lines to this: $new_post_author = $post->post_author;
  	 */
  	$current_user = wp_get_current_user();
  	$new_post_author = $current_user->ID;

  	/*
  	 * if post data exists, create the post duplicate
  	 */
  	if (isset( $post ) && $post != null) {

  		/*
  		 * new post data array
  		 */
  		$args = array(
  			'comment_status' => $post->comment_status,
  			'ping_status'    => $post->ping_status,
  			'post_author'    => $new_post_author,
  			'post_content'   => $post->post_content,
  			'post_excerpt'   => $post->post_excerpt,
  			'post_name'      => $post->post_name,
  			'post_parent'    => $post->post_parent,
  			'post_password'  => $post->post_password,
  			'post_status'    => 'draft',
  			'post_title'     => $post->post_title,
  			'post_type'      => $post->post_type,
  			'to_ping'        => $post->to_ping,
  			'menu_order'     => $post->menu_order
  		);

  		/*
  		 * insert the post by wp_insert_post() function
  		 */
  		$new_post_id = wp_insert_post( $args );

  		/*
  		 * get all current post terms ad set them to the new post draft
  		 */
  		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
  		foreach ($taxonomies as $taxonomy) {
  			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
  			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
  		}

  		/*
  		 * duplicate all post meta
  		 */
  		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
  		if (count($post_meta_infos)!=0) {
  			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
  			foreach ($post_meta_infos as $meta_info) {
  				$meta_key = $meta_info->meta_key;
  				$meta_value = addslashes($meta_info->meta_value);
  				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
  			}
  			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
  			$wpdb->query($sql_query);
  		}


  		/*
  		 * finally, redirect to the edit post screen for the new draft
  		 */
  		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
  		exit;
  	} else {
  		wp_die('Post creation failed, could not find original post: ' . $post_id);
  	}
  }
  add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

  /*
   * Add the duplicate link to action list for post_row_actions
   */
  function rd_duplicate_post_link( $actions, $post ) {
  	if (current_user_can('edit_posts')) {
  		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  	}
  	return $actions;
  }

  add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2 );
  add_filter('event_row_actions', 'rd_duplicate_post_link', 10, 2);
  add_filter('sponsor_row_actions', 'rd_duplicate_post_link', 10, 2);
  add_filter('group_row_action', 'rd_duplicate_post_link', 10, 2);
  add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);


    // Callback function to remove default bio field from user profile page
    function remove_plain_bio($buffer) {
        $titles = array('#<h3>About Yourself</h3>#','#<h3>About the user</h3>#');
        $buffer=preg_replace($titles,'<h3>Password</h3>',$buffer,1);
        $biotable='#<h3>Password</h3>.+?<table.+?/tr>#s';
        $buffer=preg_replace($biotable,'<h3>Password</h3> <table class="form-table">',$buffer,1);
        return $buffer;
    }

    function profile_admin_buffer_start() { ob_start("remove_plain_bio"); }

    function profile_admin_buffer_end() { ob_end_flush(); }

    add_action('admin_head', 'profile_admin_buffer_start');
    add_action('admin_footer', 'profile_admin_buffer_end');


?>
