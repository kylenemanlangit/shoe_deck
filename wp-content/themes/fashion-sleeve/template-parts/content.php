<?php
/**
 * The default template for displaying content
 *
 * @package Fashion Sleeve
 */
?>

<div class="post-wrapper-hentry">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-content-wrapper post-content-wrapper-archive">

			<?php fashion_sleeve_post_thumbnail(); ?>

			<div class="entry-header-wrapper">
				<?php if ( 'post' === get_post_type() ) : // For Posts ?>
				<div class="entry-meta entry-meta-header-before">
					<?php
					//fashion_sleeve_posted_by();
					fashion_sleeve_posted_on();
					fashion_sleeve_sticky_post();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( sprintf( '<h1 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
				</header><!-- .entry-header -->
			</div><!-- .entry-header-wrapper -->

			<div class="entry-data-wrapper">
				<?php if ( fashion_sleeve_has_excerpt() ) : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<?php endif; ?>

				<div class="more-link-wrapper">
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Read More', 'fashion-sleeve' ); ?></a>
				</div><!-- .more-link-wrapper -->
			</div><!-- .entry-data-wrapper -->

		</div><!-- .post-content-wrapper -->
	</article><!-- #post-## -->
</div><!-- .post-wrapper-hentry -->
