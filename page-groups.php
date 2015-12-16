<?php include_once('header.php'); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class='container list groups'>
		<h1><?php the_title() ?></h1>
		<p class='lead'>
			<?php the_content() ?>
		</p>

		<?php
			$groups = new WP_Query(
	            array(
	                'post_type' => 'group'
	            )
	        );
        ?>

		<section>
			<ul class='list-unstyled row'>
				<?php foreach($groups->posts as $group): ?>
				<li class='col-sm-4'>
					<?php echo get_the_post_thumbnail( $group->ID, 'medium', array('class'=>'img-responsive') ); ?>
					<br>
					<span class='group-title'><?php echo $group->post_title ?></span>
					<a class="pull-right" href='<?php echo get_permalink($group->ID) ?>'><span class="icon-circle-right more-info"></span></a>
				</li>
				<?php endforeach ?>
			</ul>
		</section>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>
