<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fashion Sleeve
 */

if ( ! function_exists( 'fashion_sleeve_the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function fashion_sleeve_the_posts_pagination() {

	// Previous/next posts navigation @since 4.1.0
	the_posts_pagination( array(
		'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous Page', 'fashion-sleeve' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next Page', 'fashion-sleeve' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'fashion-sleeve' ) . ' </span>',
	) );

}
endif;

if ( ! function_exists( 'fashion_sleeve_the_post_pagination' ) ) :
/**
 * Previous/next post navigation.
 *
 * @return void
 */
function fashion_sleeve_the_post_pagination() {

	// Previous/next post navigation @since 4.1.0.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav">' . esc_html__( 'Next', 'fashion-sleeve' ) . '</span> ' . '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev', 'fashion-sleeve' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );

}
endif;

if ( ! function_exists( 'fashion_sleeve_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fashion_sleeve_posted_on() {
	// No need to display date for sticky posts
	if ( fashion_sleeve_has_sticky_post() ) {
		return;
	}

	// Time String
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Posted On
	printf( '<span class="posted-on entry-meta-icon"><span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html_x( 'Posted on', 'post date', 'fashion-sleeve' ),
		esc_url( get_permalink() ),
		wp_kses( $time_string, array( 'time' => array( 'class' => array(), 'datetime' => array() ) ) )
	);
}
endif;

if ( ! function_exists( 'fashion_sleeve_posted_by' ) ) :
/**
 * Prints author.
 */
function fashion_sleeve_posted_by() {
	// Global Post
	global $post;

	// We need to get author meta data from both inside/outside the loop.
	$post_author_id = get_post_field( 'post_author', $post->ID );

	// Post Author
	printf( '<span class="byline entry-meta-icon">%1$s <span class="author vcard"><a class="entry-author-link url fn n" href="%2$s" rel="author"><span class="entry-author-name">%3$s</span></a></span></span>',
		/* translators: %s: post author */
		esc_html_x( 'by', 'post author', 'fashion-sleeve' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
		esc_html( get_the_author_meta( 'display_name', $post_author_id ) )
	);
}
endif;

if ( ! function_exists( 'fashion_sleeve_sticky_post' ) ) :
/**
 * Prints HTML label for the sticky post.
 */
function fashion_sleeve_sticky_post() {
	// Sticky Post Validation
	if ( ! fashion_sleeve_has_sticky_post() ) {
		return;
	}

	// Sticky Post HTML
	printf( '<span class="post-label post-label-sticky entry-meta-icon">%1$s</span>',
		/* translators: %s: sticky post label */
		esc_html_x( 'Featured', 'sticky post label', 'fashion-sleeve' )
	);
}
endif;

if ( ! function_exists( 'fashion_sleeve_post_edit_link' ) ) :
/**
 * Prints post edit link.
 *
 * @return void
*/
function fashion_sleeve_post_edit_link() {

	// Post edit link Validation
	if ( fashion_sleeve_has_post_edit_link() ) {
		// Post Edit Link
		printf( '<span class="post-edit-link-meta entry-meta-icon"><span class="screen-reader-text">%1$s</span><a class="post-edit-link" href="%2$s">%3$s</a></span>',
			esc_html( get_the_title() ),
			esc_url( get_edit_post_link() ),
			/* translators: %s: post edit link label */
			esc_html_x( 'Edit', 'post edit link label', 'fashion-sleeve' )
		);
	}
}
endif;

if ( ! function_exists( 'fashion_sleeve_post_first_category' ) ) :
/**
 * Prints first category for the current post.
 *
 * @return void
*/
function fashion_sleeve_post_first_category() {
	// An array of categories to return for the post.
	$categories = get_the_category();

	// Validation
	if ( ! empty( $categories ) && $categories[0] ) {
		// Post First Category HTML
		printf( '<span class="post-first-category cat-links entry-meta-icon"><a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ),
			esc_attr( $categories[0]->cat_name ),
			esc_html( $categories[0]->cat_name )
		);
	}
}
endif;

if ( ! function_exists( 'fashion_sleeve_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fashion_sleeve_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( _x(', ', 'Used between category, there is a space after the comma.', 'fashion-sleeve' ) );
		if ( $categories_list && fashion_sleeve_categorized_blog() ) {
			/* translators: %s: posted in categories */
			printf( '<span class="cat-links cat-links-single">' . esc_html__( 'Posted in %1$s', 'fashion-sleeve' ) . '</span>', wp_kses_post( $categories_list ) );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', _x(', ', 'Used between tag, there is a space after the comma.', 'fashion-sleeve' ) );
		if ( $tags_list ) {
			/* translators: %s: posted in tags */
			printf( '<span class="tags-links tags-links-single">' . esc_html__( 'Tagged %1$s', 'fashion-sleeve' ) . '</span>', wp_kses_post( $tags_list ) );
		}
	}

	/* translators: %s: post title */
	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'fashion-sleeve' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fashion_sleeve_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'fashion_sleeve_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array (
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'fashion_sleeve_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so fashion_sleeve_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so fashion_sleeve_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in fashion_sleeve_categorized_blog.
 */
function fashion_sleeve_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fashion_sleeve_categories' );
}
add_action( 'edit_category', 'fashion_sleeve_category_transient_flusher' );
add_action( 'save_post',     'fashion_sleeve_category_transient_flusher' );

if ( ! function_exists( 'fashion_sleeve_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @param array $args
 * @return void
*/
function fashion_sleeve_post_thumbnail( $args = array() ) {
	// Defaults
	$defaults = array (
 		'size'  => 'fashion-sleeve-featured',
 		'class' => 'entry-image-wrapper',
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Post Thumbnail HTML
	$html = '';

	// Post Thumbnail Validation
	if ( fashion_sleeve_has_post_thumbnail() ) {
		// Post Thumbnail HTML
		printf( '<div class="%1$s"><figure class="post-thumbnail"><a href="%2$s">%3$s</a></figure></div>',
			esc_attr( $args['class'] ),
			esc_attr( esc_url( get_the_permalink() ) ),
			get_the_post_thumbnail( null, $args['size'], array( 'class' => 'img-featured img-responsive' ) )
		);
	}
}
endif;

/**
 * A helper conditional function.
 * Whether there is a post thumbnail and post is not password protected.
 *
 * @return bool
 */
function fashion_sleeve_has_post_thumbnail() {

	/**
	 * Post Thumbnail Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_post_thumbnail', (bool) ( ! post_password_required() && has_post_thumbnail() ) );

}

/**
 * A helper conditional function.
 * Post is Sticky or Not
 *
 * @return bool
 */
function fashion_sleeve_has_sticky_post() {

	/**
	 * Sticky Post Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_sticky_post', (bool) ( is_sticky() && is_home() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Post has Edit link or Not
 *
 * @return bool
 */
function fashion_sleeve_has_post_edit_link() {

	/**
	 * Post Edit Link Filter
	 * @return bool
	 */
	$post_edit_link = get_edit_post_link();
	return apply_filters( 'fashion_sleeve_has_post_edit_link', (bool) ( ! empty( $post_edit_link ) ) );

}

/**
 * A helper conditional function.
 * Theme has Fullwidth Archive or not
 *
 * @return bool
 */
function fashion_sleeve_has_fullwidth_archive() {

	/**
	 * Fullwidth Archive Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_fullwidth_archive', (bool) ( is_archive() || is_home() ) && fashion_sleeve_mod( 'fashion_sleeve_fullwidth_archive' ) );

}

/**
 * A helper conditional function.
 * Theme has Fullwidth Post or not
 *
 * @return bool
 */
function fashion_sleeve_has_fullwidth_post_global() {

	// Posts Layout
	$posts_layout_fullwidth = ( 'fullwidth' === fashion_sleeve_mod( 'fashion_sleeve_layout_posts' ) ? true : false );

	/**
	 * Fullwidth Post Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_fullwidth_post_global', (bool) ( is_single() && $posts_layout_fullwidth ) );

}

/**
 * A helper conditional function.
 * Theme has Fullwidth Page or not
 *
 * @return bool
 */
function fashion_sleeve_has_fullwidth_page() {

	// Pages Layout
	$pages_layout_fullwidth = ( 'fullwidth' === fashion_sleeve_mod( 'fashion_sleeve_layout_pages' ) ? true : false );

	/**
	 * Fullwidth Page Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_fullwidth_page', (bool) ( is_singular( 'page' ) && ! fashion_sleeve_has_front_page() && $pages_layout_fullwidth ) );

}

/**
 * A helper conditional function.
 * Theme has Fullwidth or not
 *
 * @return bool
 */
function fashion_sleeve_has_fullwidth_layout() {

	/**
	 * Fullwidth Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_fullwidth_layout', (bool) ( fashion_sleeve_has_fullwidth_archive() || fashion_sleeve_has_fullwidth_post_global() || fashion_sleeve_has_fullwidth_page() ) );

}

/**
 * A helper conditional function.
 * Theme has class alignfull JS or Not
 *
 * @return bool
 */
function fashion_sleeve_has_class_alignfull_js() {

	/**
	 * Alignfull Class JS Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_class_alignfull_js', (bool) fashion_sleeve_mod( 'fashion_sleeve_class_alignfull_js' ) );

}

/**
 * A helper conditional function.
 * Theme has Excerpt or Not
 *
 * @return bool
 */
function fashion_sleeve_has_excerpt() {

	// Post Excerpt
	$post_excerpt = get_the_excerpt();

	/**
	 * Excerpt Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_excerpt', (bool) ! empty ( $post_excerpt ) );

}

/**
 * A helper conditional function.
 * Theme has Sidebar or Not
 *
 * @return bool
 */
function fashion_sleeve_has_sidebar() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_sidebar', (bool) is_active_sidebar( 'sidebar-1' ) );

}

/**
 * A helper conditional function.
 * Theme has Front Page or Not
 *
 * @see https://developer.wordpress.org/reference/functions/is_home/
 * @return bool
 */
function fashion_sleeve_has_front_page() {

	/**
	 * Featured Content Filter
	 * @return bool
	 */
	return apply_filters( 'fashion_sleeve_has_front_page', (bool) ( is_front_page() || is_home() ) );

}

/**
 * Display the layout classes.
 *
 * @param string $section - Name of the section to retrieve the classes
 * @return void
 */
function fashion_sleeve_layout_class( $section = 'content' ) {

	// Sidebar Position
	$sidebar_position = fashion_sleeve_mod( 'fashion_sleeve_sidebar_position' );
	if ( ! fashion_sleeve_has_sidebar() ) {
		$sidebar_position = 'no';
	}

	// Layout Skeleton
	$layout_skeleton = array(
		'content' => array(
			'content' => 'col',
		),

		'content-sidebar' => array(
			'content' => 'col-16 col-sm-16 col-md-16 col-lg-11 col-xl-11 col-xxl-11 col-xxxl-11',
			'sidebar' => 'col-16 col-sm-16 col-md-16 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5',
		),

		'sidebar-content' => array(
			'content' => 'col-16 col-sm-16 col-md-16 col-lg-11 col-xl-11 col-xxl-11 order-lg-2 order-xl-2 order-xxl-2 order-xxxl-2',
			'sidebar' => 'col-16 col-sm-16 col-md-16 col-lg-5 col-xl-5 col-xxl-5 order-lg-1 order-xl-1 order-xxl-1 order-xxxl-1',
		),
	);

	// Layout Classes
	switch( $sidebar_position ) {

		case 'no':
		$layout_classes = $layout_skeleton['content']['content'];
		break;

		case 'left':
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['sidebar-content']['sidebar'] : $layout_skeleton['sidebar-content']['content'];
		break;

		case 'right':
		default:
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['content-sidebar']['sidebar'] : $layout_skeleton['content-sidebar']['content'];

	}

	echo esc_attr( $layout_classes );

}
