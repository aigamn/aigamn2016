<?php include_once('header.php'); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article class='container single'>

		<header class='cta-header'>

			<h1><?php the_title() ?></h1>

			<!-- <a href='mailto:<?php echo get_the_author_meta( 'user_email' ); ?>' class='btn btn-default cta'>
				Contact
				<br>
				<small>
					<?php echo get_the_author_meta( 'user_email' ); ?>
				</small>
			</a> -->

		</header>

		<div class='col-md-10 col-md-offset-1'>

			<div class='main-image'>
				<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
			</div>
		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>
