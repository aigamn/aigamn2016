
<?php 
	$ctas = getCurrentCTAs();
	$upcomingEvents = getUpcomingEvents(20);
	//$events = query_posts( ['post_type' => 'event'] );
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

	<?php get_template_part('home', 'nongroupevents') ?>

	<?php get_template_part('home', 'groupevents') ?>

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
