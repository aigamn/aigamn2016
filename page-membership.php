<?php include_once('header.php'); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class='background'>
		<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
	</div>


	<article class='container single'>

		<header class='cta-header'>

			<h1><?php the_title() ?></h1>

			<a href='mailto:<?php echo get_the_author_meta( 'user_email' ); ?>' class='btn btn-default cta'>
				Contact
				<br>
				<small>
					<?php echo get_the_author_meta( 'user_email' ); ?>
				</small>
			</a>

		</header>

		<div class='col-md-10 col-md-offset-1'>

			<div class='main-image'>
				<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
			</div>
			<?php the_content() ?>
			<div class='main-text'>
				<p>
					<a href='<?php echo get_field('join_url') ?>' class='btn btn-primary' target='_blank'>
						<?php echo get_field('join_cta_text') ?>
					</a>
					<small><?php echo get_field('join_note') ?></small>
				</p>
				<h3><?php echo get_field('current_member_headline') ?></h3>
				<p>
					<a href='<?php echo get_field('renew_url') ?>' class='btn btn-info'>
						<?php echo get_field('renew_cta_text') ?>
					</a><span class='hidden-xs'>  &nbsp; </span>
					<br class='visible-xs'>
					<a href='<?php echo get_field('update_profile_url') ?>' class='btn btn-info'>
						<?php echo get_field('update_profile_cta_text') ?>
					</a>
				</p>
				<h3><?php echo get_field('membership_benefits_headline') ?></h3>
				<?php echo get_field('membership_benefits') ?>
			</div> <!-- end .main-text -->
		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>