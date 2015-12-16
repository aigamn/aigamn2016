<?php
	$chapter_sponsors = new WP_Query( 
        array(
            'numberposts'	=> -1,
			'post_type'		=> 'sponsor',
			'meta_key'		=> 'chapter_sponsor',
			'meta_value'	=> '1'
		)
    );
    $featured_sponsors = new WP_Query( 
        array(
            'numberposts'	=> -1,
			'post_type'		=> 'sponsor',
			'meta_key'		=> 'featured_sponsor',
			'meta_value'	=> '1'
		)
    );
?>

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
				<h2><?php echo get_field('sponsorship_methods_headline') ?></h2>
				<?php echo get_field('sponsorship_methods') ?>

				<h2><?php echo get_field('chapter_sponsors_heading') ?></h2>
				<div class='row'>
					<?php foreach($chapter_sponsors->posts as $chapter_sponsor): ?>
						<?php
							$sponsor_thumbnail = get_the_post_thumbnail($chapter_sponsor->ID);
							$sponsor_post = get_post($chapter_sponsor->ID);
							$sponsor_url = $sponsor_post->website_url;
						?>
						<div class='sponsor col-md-6'>
							<a href='<?php echo $sponsor_url ?>' target='_blank'>
								<?php echo $sponsor_thumbnail ?>
							</a>
							<br>
							<p>
								<?php echo $sponsor_post->post_content ?>
							</p>
						</div>
					<?php endforeach ?> 
				</div>
				<h2><?php echo get_field('featured_sponsors_heading') ?></h2>
				<div class='row'>
					<?php foreach($featured_sponsors->posts as $featured_sponsor): ?>
						<?php
							$sponsor_thumbnail = get_the_post_thumbnail($featured_sponsor->ID);
							$sponsor_post = get_post($featured_sponsor->ID);
							$sponsor_url = $sponsor_post->website_url;
						?>
						<div class='sponsor col-md-4'>
							<a href='<?php echo $sponsor_url ?>' target='_blank'>
								<?php echo $sponsor_thumbnail ?>
							</a>
							<br>
							<p>
								<?php echo $sponsor_post->post_content ?>
							</p>
						</div>
					<?php endforeach ?> 
				</div>
			</div> <!-- end .main-text -->
		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>