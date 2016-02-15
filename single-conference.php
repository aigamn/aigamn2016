
<?php include_once('header.php'); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<!-- Set all the needed variables and call all needed functions -->
	<?php
		$eventDate = get_field('start_time');
		$startTime = get_field('start_time');
		$endTime = get_field('end_time');
		$location = get_field('location');
		$eventTense = getEventTense($startTime, $endTime);
		$isRecurringEvent = isRecurringEvent($post->ID);

		$googleCalStart = date("Ymd\THis\Z", strtotime('+5 hours', $startTime));
		$googleCalEnd = ($endTime && $endTime != '') ? date("Ymd\THis\Z", strtotime('+5 hours', $endTime)) : $googleCalEnd;
		$googleCalLink = 'https://www.google.com/calendar/render?action=TEMPLATE&text=' . get_the_title() . '&dates=' . $googleCalStart .'/' . $googleCalEnd . '&details=' . get_the_excerpt() . '--%20More%20Info:' . get_permalink() . '&location=' . $location;

		$wrapUpLink = get_field('wrap_up_link');
		$registrationLink = get_field('registration_link');

		$showNextEventLink = ($eventTense == 'past' && $isRecurringEvent) ? true : false;
		if($showNextEventLink){
			$nextRecurringEventLink = getNextRecurringEventLink($post->ID, $eventDate);
			$name = getRecurringEventName($post->ID);
		}

		$showWrapUpLink = ($eventTense == 'past' && $wrapUpLink != "") ? true : false;
		$showRegistrationLink = ($eventTense != 'past' && $registrationLink != '') ? true : false;
		$sponsors = get_field('sponsors');
		$post_footer = get_field('post_footer');
		//die(var_dump($footer));
	?>
	<br>
	<article class="container single">

		<div class="main-image">
			<?php the_post_thumbnail('large', array('class'=>'img-responsive')) ?>
			<span class='pin-it hidden-xs'>
				<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red">
					<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" />
				</a>
			</span>
			<h1 class="title"><?php the_title(); ?></h1>
		</div>

		<div class='reveal'>
			<button class='btn btn-info visible-xs' data-toggle-parent='.reveal' data-toggle-class='expanded'>
				<span class'icon-calendar icon'></span>
				Add to Calendar
			</button>

			<div class='reveal-content'>
				<ul class="actions left xs-halves list-inline">
					<li class='hidden-xs'>
						<span class="icon-calendar icon"></span>
					</li>
					<li class='xs-first'>
						<a href="#">
							iCal
						</a>
					</li>
					<li>
						<a href='<?= $googleCalLink ?>' target='_blank'>
							Google Calendar
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="clearfix visible-xs"></div>

		<div class='reveal'>
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
						<a target='_blank' href="https://www.facebook.com/sharer/sharer.php?u=<?=the_permalink(); ?>" class='no-border'>
							<span class='icon-facebook icon'></span>
						</a>
					</li>
					<li>
						<a target='_blank' href="https://twitter.com/home?status=<?= the_permalink(); ?>">
							<span class='icon-twitter icon'></span>
						</a>
					</li>
					<li>
						<a target='_blank' href="https://www.linkedin.com/shareArticle?mini=true&url=<?= the_permalink(); ?>&title=AIGA%20Minnesota%20Event&summary=&source=">
							<span class='icon-linkedin icon'></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<header class="cta-header">

			<h2>
				<?= getFriendlyDateRange($startTime, $endTime) ?>
			</h2>

			<h3>
				<a target='_blank' href="https://www.google.com/maps?q=<?= $location; ?>">
					<?= $location; ?>
				</a>
			</h3>

			<div class='cta'>
				<?php if ($showWrapUpLink): ?>
					<a href='<?= $wrapUpLink ?>' class='btn btn-default' target='_blank'>Event Wrap up</a>
				<?php endif ?>

				<?php if ($showRegistrationLink): ?>
					<a href='<?= $registrationLink ?>' class='btn btn-default' target='_blank'>Register</a>
				<?php endif ?>

				<?php if($showNextEventLink): ?>
					<a href='<?= $nextRecurringEventLink ?>' class='btn btn-default'>
						Next <?= $name ?>
					</a>
				<?php endif; ?>
			</div>

		</header>

		<br>
		<br>

		<section class="col-md-12">

			<div class="clearfix"></div>

			<div class="main-text">
				<?php the_content(); ?>
				<?php if($showNextEventLink): ?>
					<a href='<?= $nextRecurringEventLink ?>' class='btn btn-default cta'>
						Next <?= $name ?>
					</a>
				<?php endif ?>
				<?php if($post_footer): ?>
					<p class='well'>
						<?= do_shortcode($post_footer->post_content) ?>
					</p>
				<?php endif ?>
			</div>

			
			<?php if ($sponsors): ?>
				<p>Thanks to our sponsors</p>
				<div class="sponsors col-md-12">
			
				<?php foreach($sponsors as $sponsor): ?>
					<?php
						$sponsor_thumbnail = get_the_post_thumbnail($sponsor->ID);
						$sponsor_post = get_post($sponsor->ID);
						$sponsor_url = $sponsor_post->website_url;
					?>
					<div class='sponsor col-md-4'>
						<a href='<?= $sponsor_url ?>' target='_blank'>
							<?= $sponsor_thumbnail ?>
						</a>
						<br>
						<p>
							<?= $sponsor_post->post_content ?>
						</p>
					</div>
				<?php endforeach ?>
				
				</div>
			<?php else: ?>
				<p>No sponsors</p>
				<small>Contact <a href='mailto:sponsorship@aigaminnesota.org'>sponsorship@aigaminnesota.org</a> if you are interested in sponsoring this event.</small>
			<?php endif ?>
			<?php if( get_field('flickr_album_id') ): ?>
				<div id='images'></div>
			<?php endif; ?>
			<br>
			<br>
			<br>
			<?php comments_template(); ?>
		</section>
	</article>

	<?php var_dump( getConferenceEvents($post->ID)->posts ) ?>

	<?php if( get_field('flickr_album_id') ): ?>
		<script>
			photos = shared.getFeaturedPhotos("<?= get_field('flickr_album_id') ?>");
		</script>
	<?php endif; ?>

	<?php endwhile; ?>

<?php include_once('footer.php'); ?>
