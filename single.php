<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

					<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
								
								<?php // HERO AREA ?>
								<?php if ( has_post_thumbnail()) : ?>
								<div class="featured-image">
									<?php the_post_thumbnail('full'); ?>
									<?php
									echo '<div class="page-title">
											<h1 itemprop="headline" rel="bookmark">'.get_the_title().'</h1>
											<span class="arrow-down"></span>
										</div>';
									?>
								</div>
								<?php endif; ?>

								<section class="entry-content cf col-8" itemprop="articleBody">
								  <?php the_content(); ?>
								</section> <?php // end article section ?>
								
								<div class="col-4 sidebar-wrapper"><?php get_sidebar(); ?></div>

							  </article> <?php // end article ?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>
