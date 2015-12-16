<?php include_once('header.php'); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article class='container single'>

		<header class='cta-header'>

			<!-- <a href='mailto:<?php echo get_the_author_meta( 'user_email' ); ?>' class='btn btn-default cta'>
				Contact
				<br>
				<small>
					<?php echo get_the_author_meta( 'user_email' ); ?>
				</small>
			</a> -->

		</header>

		<div class='col-md-12'>

			<div class='main-image'>
				<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
				<h1 class="title"><?php the_title() ?></h1>
			</div>
			<br>
			<?php the_content() ?>
			<div class='main-text'>
				<h2><?php echo get_field('committee_opportunities_headline') ?></h2>
				<?php echo get_field('committee_opportunities') ?>
				<h2><?php echo get_field('board_opportunities_headline') ?></h2>
				<?php echo get_field('board_opportunities') ?>
			</div> <!-- end .main-text -->
		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>
