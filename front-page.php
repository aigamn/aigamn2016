
<?php 
	$ctas = getCurrentCTAs();
?>

<?php include_once('header.php'); ?>

<div class='container' id='home'>
	<h1 class='text-center'>
		 AIGA Minnesota is the first place to turn for inspiration, professional development,<br class='hidden-xs'>
		 and excellence in design in Minnesota.
	</h1>

	<div class='social text-center'>
		<small class='text-uppercase'>Connect with AIGA Minnesota</small>
		<ul class='list-inline'>
			<li>
				<a href='https://www.facebook.com/aigaminnesota' target='_blank'>
					<span class='icon-facebook'></span>
				</a>
			</li>
			<li>
				<a href='https://twitter.com/aigamn' target='_blank'>
					<span class='icon-twitter'></span>

				</a>
			</li>
			<li>
				<a href='https://instagram.com/aigamn/' target='_blank'>
					<span class='icon-instagram'></span>
				</a>

			</li>
			<li>
				<a href='https://www.linkedin.com/groups/AIGA-Minnesota-1412157/about' target='_blank'>
					<span class='icon-linkedin'></span>
				</a>
			</li>
		</ul>
	</div> <!-- end .social -->

	<section>
		<header>
			<h2 class='pull-left'>
				Upcoming Events
			</h2>
			<a href="<?php echo bloginfo('url') ?>/event" class='pull-right'>All Upcoming Events</a>
			<div class='clearfix'></div>
		</header>

		<!--<div class='carousel slide hidden-sm hidden-xs' data-ride='carousel'>-->
		<div class='carousel slide hidden-sm hidden-xs'>

			<!-- Wrapper for slides -->
			<div class='carousel-inner col-md-8' role='listbox' >

				<?php $upcomingNonGroupEvents = getUpcomingNonGroupEvents(4);?>
				<?php $counter = 0; ?>
				<?php if($upcomingNonGroupEvents->have_posts()) : while($upcomingNonGroupEvents->have_posts()) : $upcomingNonGroupEvents->the_post(); ?>


				<?php
					if($counter == 0) {
						echo "<div class='item active'>";
					}
					else {
						echo "<div class='item'>";
					}
				?>

					<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>

					<div class='info'>
						<h3>
							<?php the_title(); ?>
						</h3>
						<p>
							<?php echo date("l, F jS, g:ia", $startTime); ?>
							<br>
							<?php echo get_field('location'); ?>
						</p>
					</div>

					<div class='actions'>
						<a href="<?php echo the_permalink(); ?>" class='btn btn-info'>
							Details
						</a>
						<a href="http://maps.google.com/?q=<?php echo get_field('location'); ?>" class='btn btn-info' target="_blank">
							Directions
						</a>
						<a href="<?php echo get_field('registration_link'); ?>" class='btn btn-info'>
							Register
						</a>
					</div>

				</div>

				<?php $counter++; ?>
				<?php endwhile; endif; ?>

			</div>

			<ul class='tiles col-md-4 list-unstyled carousel-indicators border-bottom'>
				<?php $counter = 0; ?>
				<?php if($upcomingNonGroupEvents->have_posts()) : while($upcomingNonGroupEvents->have_posts()) : $upcomingNonGroupEvents->the_post(); ?>
				<li data-target='.carousel' data-slide-to="<?php echo $counter; ?>" <?php if($counter == 0) { echo "class='active'"; } ?>>
					<span class='state-indicator'></span>
					<h3>
						 <?php the_title(); ?>
					</h3>
					<small>
						<?php echo date("l, F jS", get_field('start_time')); ?>
					</small>
				</li>
				<?php $counter++; ?>
				<?php endwhile; endif; ?>
			</ul>

			<div class='clearfix'></div>
		</div>

		<div class='visible-sm visible-xs'>
			<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>

			<div class='info'>
				<h3>
					<?php the_title(); ?>
				</h3>
				<p>
					<?php echo date("l, F jS, g:ia", $startTime); ?> until <?php echo date("g:ia", $endTime); ?>
					<br>
					<?php echo get_field('location'); ?>
				</p>
			</div>

			<div class='actions'>
				<a href="<?php echo the_permalink(); ?>" class='btn btn-info'>
					Details
				</a>
				<a href="http://maps.google.com/search/<?php echo get_field('location'); ?>" class='btn btn-info' target="_blank">
					Directions
				</a>
				<a href="<?php echo get_field('registration_link'); ?>" class='btn btn-info'>
					Register
				</a>
			</div>

		</div>
	</section>

	<section>
		<header>
			<h2 class='pull-left'>
				Groups
			</h2>
			<a href="<?php echo bloginfo('url') ?>/groups" class='pull-right'>All Groups</a>
			<div class='clearfix'></div>
		</header>
		<ul class='tiles list-unstyled border-right border-bottom clearfix'>

			<?php $upcomingGroupEvents = getUpcomingGroupEvents(3);?>
			<?php $counter = 0; ?>
			<?php if($upcomingGroupEvents->have_posts()) : while($upcomingGroupEvents->have_posts()) : $upcomingGroupEvents->the_post(); ?>

				<?php
					if($counter == 0) {
						echo "<li class='col-sm-4 active'>";
					}
					else {
						echo "<li class='col-sm-4'>";
					}
				?>
				<span class='state-indicator'></span>
				<h3>
					<?php $groups = getGroups($post->ID); ?>
					<?php echo $groups->post_title . ":"; ?>
					<br>
					<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<small>
					<?php echo date("l, F jS", $startTime); ?>
				</small>
			</li>

			<?php $counter++; ?>
			<?php endwhile; endif; ?>

		</ul>
	</section>

	<section class='col-sm-4 border-right'>
		<?php foreach ($ctas->posts as $cta): ?>
			<a href='<?php get_field('link', $cta->ID) ?>'>
				<?php echo get_the_post_thumbnail( $cta->ID, 'thumbnail', array('class'=>'img-responsive margin-auto') ); ?>
			</a>
		<?php endforeach ?>
	</section>

	<section class='padded-left col-sm-8'>
		<header>
			<h2 class='pull-left'>
				Blog
			</h2>
			<a href="<?php echo bloginfo('url') ?>/blog" class='pull-right'>All Blog Entries</a>
			<div class='clearfix'></div>
		</header>
		<ul class='tiles list-unstyled border-bottom'>
			<?php $blogPosts = getBlogPosts(3); ?>
			<?php if ( $blogPosts->have_posts() ) : while ( $blogPosts->have_posts() ) : $blogPosts->the_post(); ?>
			<li>
				<span class='state-indicator'></span>
				<h3>
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<small><?php the_time(); ?></small>
				<p>
					<?php the_excerpt(); ?>
				</p>
				<p>
					<a href="<?php echo the_permalink(); ?>" class='btn btn-info'>
						Read More
					</a>
				</p>
			</li>
			<?php endwhile; endif; ?>
		</ul>
	</section>

</div> <!-- end .container -->

<?php include_once('footer.php'); ?>
