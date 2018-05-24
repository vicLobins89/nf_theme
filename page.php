<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post();
							$heroClass = (has_post_thumbnail() ? 'hero-image' : 'no-hero');
							$classes = array(
								'cf',
								$heroClass
							);
							?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php // HERO AREA ?>
								<?php if ( has_post_thumbnail()) : ?>
								<div class="featured-image">
									<?php the_post_thumbnail('full'); ?>
									<?php
									if( !get_field('hide_hero') ) {
										if( get_field('hero_text') ) {
											echo '<div class="page-title" itemprop="headline" style="background: '.get_field('page_colour').';">
													<h1>'.get_field('hero_text').'</h1>
													<span class="arrow-down" style="border-top-color: '.get_field('page_colour').';"</span>
												</div>';
										} else {
											echo '<div class="page-title" style="background: '.get_field('page_colour').';">
													<h1 itemprop="headline">'.get_the_title().'</h1>
													<span class="arrow-down" style="border-top-color: '.get_field('page_colour').';"></span>
												</div>';
										}
									}
									?>
								</div>
								<?php endif; ?>
								
								
								<?php // MAIN CONTENT ?>
								<?php if( !empty(get_the_content()) ) : ?>
										<section class="entry-content wrap cf" itemprop="articleBody">
											<?php
											if( !has_post_thumbnail() ) {
												echo '<h1 itemprop="headline"><strong>'.get_the_title().'</strong></h1>';
											}
											the_content();
											?>
										</section>
								<?php endif; ?>
								
								
								<?php // VACANCIES ?>
								<?php if( have_rows('vacancies') ): ?>

									<section class="entry-content job-vacancies wrap cf">

									<?php while( have_rows('vacancies') ): the_row();
										$date = get_sub_field('data_posted', false, false);
										$date = new DateTime($date);
									?>

										<div class="vacancies cf">
											<div class="col-4">
												<p><strong><?php the_sub_field('job_title'); ?></strong></p>
												<p>Date posted: <?php echo $date->format('j M Y'); ?></p>
												<p><a href="mailto:<?php the_sub_field('contact_email'); ?>"><?php the_sub_field('contact_email'); ?></a></p>
											</div>

											<div class="col-8">
												<?php the_sub_field('job_description'); ?>
											</div>
										</div>

									<?php endwhile; ?>

									</section>

								<?php endif; ?>
								
								
								<?php // EXTRA CONTENT ?>
								<?php if( have_rows('extra_images') ): ?>

									<ul class="extra-images">

									<?php while( have_rows('extra_images') ): the_row(); ?>

										<li <?php if( get_sub_field('full_width') ) echo 'class="full-width"'; ?>><img src="<?php the_sub_field('images'); ?>" alt="Extra photos"></li>

									<?php endwhile; ?>

									</ul>

								<?php endif; ?>

								<?php
								if(get_field('extra_text')) {
									echo '<section class="entry-content extra-content wrap cf">
											'.get_field('extra_text').'
										</section>';
								}
								?>
								
								
								<?php // ARROW CONTENT BOXES ?>
								<?php
								if(get_field('section_title')) {
									echo '<section class="entry-content arrow-content-title wrap cf">
											<h2><strong>'.get_field('section_title').'</strong></h2>
										</section>';
								}
								?>
								
								<?php $counter = 0; if( have_rows('image_page_link') ): ?>

									<?php while( have_rows('image_page_link') ): the_row(); ?>
								
										<?php if ($counter % 2 === 0) :?>
										<div class="row page-links <?php echo (get_sub_field('reverse') ? 'even reverse' : 'odd') ;?> cf" style="background: <?php the_sub_field('colour'); ?>">
										<?php else: ?>
										<div class="row page-links <?php echo (get_sub_field('reverse') ? 'odd reverse' : 'even') ;?> cf" style="background: <?php the_sub_field('colour'); ?>">
										<?php endif; ?>
											
											<div class="col-6">
												<?php if(get_sub_field('link')) :
												$attachment_id = get_sub_field('image');
												$size = "rect-crop-l";
												$image = wp_get_attachment_image_src( $attachment_id, $size );
												?>
													<a class="image-anchor" href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('title'); ?>">
														<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('title'); ?>" width="690" height="640">
													</a>
												<?php else: ?>
													<img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>">
												<?php endif; ?>
												
												<?php if(get_sub_field('reverse')) : ?>
													<div class="arrow-up reverse" style="border-bottom-color: <?php the_sub_field('arrow_colour'); ?>;"></div>
												<?php else: ?>
													<div class="arrow-up" style="border-bottom-color: <?php the_sub_field('colour'); ?>;"></div>
												<?php endif; ?>
											</div>

											<div class="col-6">
												<?php if(get_sub_field('title')) : ?>
													<h2><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('title'); ?>"><?php the_sub_field('title'); ?></a></h2>
												<?php endif; ?>
												
												<p>
													<?php if( get_sub_field('reverse') ) : ?>
														<?php the_sub_field('description'); ?>
													<?php else : ?>
														<a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('title'); ?>"><?php the_sub_field('description'); ?></a>
													<?php endif; ?>
												</p>
												
												<?php //if(get_sub_field('link')) : ?>
													<!--<a href="<?php //the_sub_field('link'); ?>" class="link-arrow" title="<?php the_sub_field('title'); ?>"><img src="<?php //echo get_template_directory_uri(); ?>/library/images/link-arrow.png" alt="<?php the_sub_field('title'); ?>"></a>-->
												<?php //endif; ?>
											</div>
										
										</div>

									<?php $counter++; endwhile; ?>

								<?php endif; ?>
											
								
								<?php // TEAM AREA ?>
								<?php if( have_rows('team') ): ?>

									<ul class="team wrap">

									<?php while( have_rows('team') ): the_row(); ?>

										<li>
											<img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name'); ?>">
											<p>
												<strong><?php the_sub_field('position'); ?></strong><br>
												<?php the_sub_field('name'); ?>
											</p>
										</li>

									<?php endwhile; ?>

									</ul>

								<?php endif; ?>
											
											
								<?php // CONTACT US ?>
								<?php if( is_page( 'contact-us' ) ) : ?>
									<section class="entry-content wrap cf">
										<h1><strong><?php echo get_the_title(); ?></strong></h1>
										
										<?php
										$location = get_field('map');

										if( !empty($location) ): ?>
											<div class="acf-map">
												<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
													<p class="address"><?php echo $location['address']; ?></p>
												</div>
											</div>
										<?php endif;
										
										if(get_field('address'))
											echo '<div class="col-4">'.get_field('address').'</div>';
										
										if( get_field('tel_num') || get_field('email_address') || get_field('twitter_handle') ) {
											
											echo '<div class="col-8 contact-details"><ul>';
												if( get_field('tel_num') )
												   echo '<li><a href="tel:" class="tel">'.get_field('tel_num').'</a></li>';
												if( get_field('email_address') )
												   echo '<li><a href="mailto:'.get_field('email_address').'" class="email">'.get_field('email_address').'</a></li>';
												if( get_field('twitter_handle') )
												   echo '<li><a href="https://twitter.com/'.get_field('twitter_handle').'" target="_blank" class="twitter">'.get_field('twitter_handle').'</a></li>';
											echo '</ul></div>';
										}
										
										echo '<div class="cf"></div>';
										
										if(get_field('contact_form'))
											the_field('contact_form');
										?>
									</section>
								<?php endif; ?>
								
							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
