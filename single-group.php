
<?php include_once('header.php'); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php 
		$footer = get_field('post_footer');
		$events = getUpcomingEventsByGroup($post->ID, 3);
		$blogposts = getPostsByGroup($post->ID, 5);
	?>

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

			<div class="main-image">
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

			<section class="col-sm-7 events">
					
                <h2>Upcoming Events</h2>

				<?php $isFirst = true; ?>
				<?php if($events): ?>
					<?php foreach($events->posts as $event): ?>
						<?php
							$eventLocation = get_field('location', $event->ID);
							$displayDate = date('D F jS, g:ia', get_field('start_time', $event->ID));
						?>
						<?php if($isFirst): ?>
			                <article class='main'>
								
			                    <div class="info">
			                        <h3>
			                            <?php echo $event->post_title ?>
			                        </h3>
			                        <p>
			                        	<?php echo $displayDate ?>
			                            <br>
			                            <?php echo $eventLocation ?>
			                        </p>
			                    </div>
								
								<?php echo get_the_post_thumbnail( $event->ID, 'medium', array('class'=>'img-responsive') ); ?>

			                    <div class="actions row">
			                        <div class="col-xs-4">
			                            <a href="<?php echo get_permalink($event->ID) ?>" class="btn btn-info">
			                                Details
			                            </a>
			                        </div>
			                        <div class="col-xs-4">
			                            <a target='_blank' href="https://www.google.com/maps?q=<?php echo $eventLocation ?>" class="btn btn-info">
			                                Directions
			                            </a>
			                        </div>
			                        <div class="col-xs-4">
			                            <a href="" class="btn btn-info">
			                                Register
			                            </a>
			                        </div>
			                    </div>
							
			                </article>
		                <?php else: ?>
							<article>

			                    <div class="col-xs-5">
			                        <img src="http://placehold.it/768x432/94deff/84CeEf" alt="" class="img-responsive">
			                    </div>

			                    <div class="info col-xs-7">
			                        <h3>
			                            <?php echo $event->post_title ?>
			                        </h3>
			                    </div>

			                    <div class="clearfix"></div>

			                    <p>
			                        <?php echo $displayDate ?>
			                        <br>
			                        <?php echo $eventLocation ?>
			                    </p>

			                    <div class="actions row">
			                        <div class="col-xs-4">
			                            <a href="<?php echo get_permalink($event->ID) ?>" class="btn btn-info">
			                                Details
			                            </a>
			                        </div>
			                        <div class="col-xs-4">
			                            <a href="https://www.google.com/maps?q=<?php echo $eventLocation ?>" class="btn btn-info" target='_blank'>
			                                Directions
			                            </a>
			                        </div>
			                        <div class="col-xs-4">
			                            <a href="#" class="btn btn-info">
			                                Register
			                            </a>
			                        </div>
			                    </div>

			                </article>
	                	<?php endif ?>
		                <?php $isFirst = false; ?>
	                <?php endforeach ?>
                <?php endif ?>

                <p>
                    <a href="events" class="btn btn-primary">All Upcoming Events</a>
                </p> 
            </section>

            <section class="padded-left col-sm-5 blog">
                <h2>
                    Blog
                </h2>
                <ul class="list-unstyled border-bottom">
                	<?php if($blogposts): ?>
            			<?php $isFirst = true; ?>
                		<?php foreach($blogposts->posts as $blogpost): ?>
							<?php $class = ($isFirst) ? 'class="active"' : '' ?>
		                    <li <?php echo $class ?>>
		                        <span class="state-indicator"></span>
		                        <h3>
		                            <?php echo $blogpost->post_title ?>
		                        </h3>
		                        <small>Thursday, October 16th</small>
		                        <p>
		                            <?php echo get_the_excerpt($blogpost->ID) ?>
		                        </p>
		                        <p>
		                            <a href='<?php echo get_permalink($blogpost->ID) ?>' class="btn btn-info">
		                                Read More
		                            </a>
		                        </p>
		                    </li>
		                    <?php $isFirst = false; ?>
	                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
                    
                <p>
                    <a href="blog" class="btn btn-primary">All Blog Entries</a>
                </p>
            </section>

		</div>

	</article>

<?php endwhile; ?>

<?php include_once('footer.php'); ?>