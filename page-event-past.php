<?php include_once('header.php'); ?>

  <div class='container list groups gallery archives'>
    <h1>Events</h1>
    <br>
    <a href="<?php echo bloginfo('url'); ?>/event" class='btn btn-info'>Upcoming Events</a>
    <a href="<?php echo bloginfo('url'); ?>/event-past" class='btn btn-primary'>Past Events</a>
    <div class='masonry'>
      <section>
        <ul class='list-unstyled row'>
          <?php $the_query = getPastEvents(); ?>
          <?php if($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post(); ?>
          <li class='col-sm-4'>
            <div class='border'>
              <h3><?php echo the_title(); ?></h3>
              <?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
              <div class='copy'>
                <p><small><?php echo date("l, F jS, g:ia", get_field('start_time')); ?> until <?php echo date("g:ia", get_field('end_time'));?></small></p>
                <p><?php echo the_excerpt(); ?></p>
                <p class='text-right'>
                  <a href="<?php echo the_permalink(); ?>" class='btn btn-info'>More Info</a>
                </p>
              </div>
            </div>
          </li>
          <?php endwhile; endif; ?>
        </ul>
      </section>
    </div>
  </div>

  <script src='js/masonry.js'></script>
  <script src='js/imagesloaded.js'></script>
  <script src='js/gallery.js'></script>

<?php include_once('footer.php'); ?>
