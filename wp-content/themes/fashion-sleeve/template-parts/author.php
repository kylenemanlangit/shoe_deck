<?php
/**
 * The template part for displaying an Author Bio
 *
 * @package Fashion Sleeve
 */
?>

<div class="entry-author">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$fashion_sleeve_author_bio_avatar_size = apply_filters( 'fashion_sleeve_author_bio_avatar_size', 80 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $fashion_sleeve_author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-heading">
		<h2 class="author-title">
			<?php
				printf(
					/* translators: %1$s: post author */
					esc_html__( 'Published by %1$s', 'fashion-sleeve' ),
					'<span class="author-name">' . esc_html( get_the_author() ) . '</span>'
				);
			?>
		</h2>
	</div><!-- .author-heading -->

	<p class="author-bio">
		<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php
				printf(
					/* translators: %1$s: post author */
					esc_html__( 'View all posts by %1$s', 'fashion-sleeve' ),
					esc_html( get_the_author() )
				);
			?>
		</a>
	</p><!-- .author-bio -->
</div><!-- .entry-auhtor -->
