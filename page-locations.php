<?php
/*
 Template Name: Locations
 */
?>

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
									if(get_field('hero_text')) {
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
								
								
								<?php // LOCATIONS ?>
								<section class="entry-content wrap cf">
									<?php echo file_get_contents(get_template_directory_uri() . '/library/images/uk-map-code.svg'); ?>
								</section>
								
								
								<?php // EXTRA CONTENT ?>
								<?php if( have_rows('extra_images') ): ?>

									<ul class="extra-images">

									<?php while( have_rows('extra_images') ): the_row(); ?>

										<li><img src="<?php the_sub_field('images'); ?>" alt="Extra photos"></li>

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
								
							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
