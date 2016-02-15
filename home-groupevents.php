<?php 
	$upcomingGroupEvents = getUpcomingGroupEvents(3);
?>

<section>
	<header>
		<h2 class='pull-left'>
			Groups
		</h2>
		<a href="<?php echo bloginfo('url') ?>/groups" class='pull-right'>All Groups</a>
		<div class='clearfix'></div>
	</header>
	<ul class='tiles list-unstyled border-right border-bottom clearfix'>

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