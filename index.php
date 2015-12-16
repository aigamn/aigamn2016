<?php include_once('header.php'); ?>

<div class='container list list-left blog'>
	<h1>Blog</h1>
	<p class='lead'>Now Viewing: All Posts</p>
	<ul class='list-unstyled'>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<div class='border'>

					<div class='col-sm-3'>
						<?php the_post_thumbnail( 'medium', array('class'=>'img-responsive') ); ?> 
					</div>
					<div class='copy col-sm-9'>
						<h3><?php the_title(); ?></h3>
						<small>Friday, February 13th, 2015</small>
						<p><?php the_excerpt() ?></p>
						<p class='text-right'>
							<a class='btn btn-primary' href='<?php the_permalink(); ?>'>Read More</a>
						</p>
					</div>
					<div class='clearfix'></div>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>
</div>

<?php include_once('footer.php'); ?>