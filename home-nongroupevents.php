<?php
	$upcomingNonGroupEvents = getUpcomingNonGroupEvents(4);
?>
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

					<?php the_post_thumbnail('full', ['class'=>'img-responsive'] ) ?>

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