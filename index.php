<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php
							$counter = 0;
							if (have_posts()) :
							while (have_posts()) : the_post();
								if( $counter == 0 ) :
							?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf featured col-12' ); ?> role="article">

									<?php if ( has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image">
											<?php the_post_thumbnail('full'); ?>
										</a>
									<?php endif; ?>

									<div class="post-data cf">
										<?php echo get_the_category_list(); ?>
										<?php echo '<h2>'.get_the_title().'</h2>'; ?>
										<a href="<?php the_permalink(); ?>" class="read-more" title="<?php the_title(); ?>">Read more ></a>
										<span class="arrow-up"></span>
									</div>

								</article>
							
							<div class="post-wrapper col-9">

							<?php else : ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf main col-6' ); ?> role="article">

									<?php if ( has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image">
											<?php the_post_thumbnail('rect-crop'); ?>
										</a>
									<?php endif; ?>

									<div class="post-data cf">
										<?php echo get_the_category_list(); ?>
										<?php echo '<h2>'.get_the_title().'</h2>'; ?>
										<a href="<?php the_permalink(); ?>" class="read-more" title="<?php the_title(); ?>">Read more ></a>
										<span class="arrow-up"></span>
									</div>

								</article>
							<?php
								endif;
							$counter++;
							endwhile;
							?>
							</div>
							
							<div class="col-3 sidebar-wrapper"><?php get_sidebar(); ?></div>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</div>

				</div>

			</div>


<?php get_footer(); ?>
