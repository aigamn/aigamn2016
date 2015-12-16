<?php 
	$footer = get_field('post_footer');
?>

<?php include_once('header.php'); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class='background'>
		<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
	</div>


	<article class='container single'>

		<header class='cta-header'>

			<h1><?php the_title() ?></h1>

			<div class='reveal cta'>
				<button class='btn btn-info visible-xs' data-toggle-parent='.reveal' data-toggle-class='expanded'>
					<span class="glyphicon glyphicon-share icon"></span>
					Share It
				</button>

				<div class='reveal-content'>
					<ul class="right actions xs-fourths list-inline">
						<li class='hidden-xs'>
							<small class="text-uppercase">share it:</small>
						</li>
						<li class='xs-first'>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>" class='no-border'>
								<span class='icon-facebook icon'></span>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/home?status=<?php echo the_permalink(); ?>">
								<span class='icon-twitter icon'></span>
							</a>
						</li>
						<li>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo the_permalink(); ?>&title=AIGA%20Minnesota%20Event&summary=&source=">
								<span class='icon-linkedin icon'></span>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="clearfix"></div>

		</header>

		<div class='col-md-10 col-md-offset-1'>

			<div class="clearfix"></div>

			<div class="main-image hidden-xs">
				<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
				<span class='pin-it'>
					<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red">
						<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" />
					</a>
				</span>
			</div>
			<div class="main-text">
				<?php the_content(); ?>
				
				<?php if($footer): ?> 
					<p class='well'>
						<?php echo do_shortcode($footer->post_content) ?>
					</p>
				<?php endif ?>
				
			</div>
			<?php comments_template(); ?>

		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>