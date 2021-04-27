<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fashion Sleeve
 */

get_header(); ?>

	<div class="page-header-wrapper page-header-wrapper-archive">
		<div class="container">

			<div class="row">
				<div class="col">

					<header class="page-header">
						<?php
						if ( have_posts() ) :
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						else :
							printf( '<h1 class="page-title"><span class="page-title-label">%1$s</span></h1>', esc_html__( 'Nothing Found', 'fashion-sleeve' ) );
						endif;
						?>
					</header><!-- .page-header -->

				</div><!-- .col -->
			</div><!-- .row -->

		</div><!-- .container -->
	</div><!-- .page-header-wrapper -->

	<div class="site-content-inside">
		<div class="container">
			<div class="row">

				<section id="primary" class="content-area <?php fashion_sleeve_layout_class( 'content' ); ?>">
					<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<div id="post-wrapper" class="post-wrapper post-wrapper-archive">
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );
							?>

						<?php endwhile; ?>
						</div><!-- .post-wrapper -->

						<?php fashion_sleeve_the_posts_pagination(); ?>

					<?php else : ?>

						<div class="post-wrapper post-wrapper-single post-wrapper-single-notfound">
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						</div><!-- .post-wrapper -->

					<?php endif; ?>

					</main><!-- #main -->
				</section><!-- #primary -->

				<?php get_sidebar(); ?>

			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .site-content-inside -->

<?php get_footer(); ?>
