<?php
	$officers = new WP_User_Query(
		array(
			'meta_key' => 'position_type',
			'meta_value' => 'officer'
		)
	);

	$directors = new WP_User_Query(
		array(
			'meta_key' => 'position_type',
			'meta_value' => 'director'
		)
	);

	$associate_directors = new WP_User_Query(
		array(
			'meta_key' => 'position_type',
			'meta_value' => 'associate_director'
		)
	);
?>
<?php include_once('header.php'); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<!-- <div class='background'>
		<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
	</div> -->


	<article class='container about'>

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
				<h1><?php the_title() ?></h1>
			</div>
			<br>
			<br>
			<?php the_content() ?>
			<br>
			<br>
			<div class='main-text'>
				<h2>Board of Directors</h2>

				<h3><?php echo get_field('officers_heading') ?></h3>
				<div class='row'>
					<?php foreach($officers->results as $officer): ?>
						<div class='col-sm-4'>
							<?php echo get_field('position_title', 'user_' . $officer->data->ID) ?>
							<br>
							<?php
								$image = get_field('bio_picture', 'user_' . $officer->data->ID);
								$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)

								if( $image ) {
									echo wp_get_attachment_image( $image, $size, false, array('class'=>'img-responsive') ) . '<br>';
								}
							?>
							<?php echo $officer->data->display_name ?>
							<br>
							<a href='mailto:<?php echo $officer->data->user_email ?>'>
								<?php echo $officer->data->user_email ?>
							</a>
						</div>
					<?php endforeach ?>
				</div>

				<h3><?php echo get_field('directors_heading') ?></h3>
				<div class='row'>
					<?php foreach($directors->results as $director): ?>
						<div class='col-sm-4'>
							<?php echo get_field('position_title', 'user_' . $director->data->ID) ?>
							<br>
							<?php
								$image = get_field('bio_picture', 'user_' . $director->data->ID);
								$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)

								if( $image ) {
									echo wp_get_attachment_image( $image, $size, false, array('class'=>'img-responsive') ) . '<br>';
								}
							?>
							<?php echo $director->data->display_name ?>
							<br>
							<a href='mailto:<?php echo $officer->data->user_email ?>'>
								<?php echo $director->data->user_email ?>
							</a>
						</div>
					<?php endforeach ?>
				</div>

				<h3><?php echo get_field('associate_directors_heading') ?></h3>
				<div class='row'>
					<?php foreach($associate_directors->results as $associate_director): ?>
						<?php $usermeta = get_user_meta($associate_director->data->ID) ?>
						<div class='col-sm-4'>
							<?php echo get_field('position_title', 'user_' . $associate_director->data->ID) ?>
							<?php
								$image = get_field('bio_picture', 'user_' . $associate_director->data->ID);
								$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)

								if( $image ) {
									echo wp_get_attachment_image( $image, $size, false, array('class'=>'img-responsive') );
								}
							?>
							<?php echo $usermeta['first_name'][0] ?> <?php echo $usermeta['last_name'][0] ?>
							<a href='mailto:<?php echo $officer->data->user_email ?>'>
								<?php echo $associate_director->data->user_email ?>
							</a>
						</div>
					<?php endforeach ?>
				</div>

				<h3><?php echo get_field('past_presidents_heading') ?></h3>
				<h3><?php echo get_field('past_presidents') ?></h3>

			</div> <!-- end .main-text -->
		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>
