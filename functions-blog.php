<?php

function getBlogPosts($number = 0) {
  $args = array(
    'post_type' => 'post',
  );
  if ($number > 0) {
    $args['posts_per_page'] = $number;
  }
  $query = new WP_Query($args);
  return $query;
}

function getBlogPostsByGroup($group, $number = 0) {
  $args = array(
    'post-type' => 'post',
  );
  if($number > 0) {
    $args['posts_per_page'] = $number;
  }
  $query = new WP_Query($args);
  return $query;
}

?>
