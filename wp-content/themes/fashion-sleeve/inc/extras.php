<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Fashion Sleeve
 */

/**
 * Theme Mod Defaults
 *
 * @param string $theme_mod - Theme modification name.
 * @return mixed
 */
function fashion_sleeve_default( $theme_mod = '' ) {

	$default = apply_filters( 'fashion_sleeve_default', array (
		'fashion_sleeve_sidebar_position'    => 'right',
		'fashion_sleeve_fullwidth_archive'   => false,
		'fashion_sleeve_layout_posts'        => 'sidebar',
		'fashion_sleeve_layout_pages'        => 'sidebar',
		'fashion_sleeve_class_alignfull_js'  => false,
		'fashion_sleeve_copyright'           => sprintf( '%1$s %2$s - <a href="%3$s">%4$s</a>', esc_html__( '&copy; Copyright', 'fashion-sleeve' ), esc_html( date_i18n( __( 'Y', 'fashion-sleeve' ) ) ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) ),
		'fashion_sleeve_credit'              => true,
	) );

	return ( isset ( $default[$theme_mod] ) ? $default[$theme_mod] : '' );

}

/**
 * Theme Mod Wrapper
 *
 * @param string $theme_mod - Name of the theme mod to retrieve.
 * @return mixed
 */
function fashion_sleeve_mod( $theme_mod = '' ) {
	return get_theme_mod( $theme_mod, fashion_sleeve_default( $theme_mod ) );
}

if ( ! function_exists( 'fashion_sleeve_fonts_url' ) ) :
/**
 * Register fonts for theme.
 *
 * @return string Fonts URL for the theme.
 */
function fashion_sleeve_fonts_url() {

    // Fonts and Other Variables
    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* Translators: If there are characters in your language that are not
    * supported by Nanum Gothic, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Nanum Gothic font: on or off', 'fashion-sleeve' ) ) {
		$fonts[] = 'Nanum Gothic:400,700';
	}

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'fashion-sleeve' ) ) {
		$fonts[] = 'Open Sans:400,400i,700,700i';
	}

	/* Translators: To add an additional character subset specific to your language,
	* translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'.
	* Do not translate into your own language.
	*/
	$subset = esc_html_x( 'no-subset', 'Add new subset (cyrillic, greek, devanagari, vietnamese)', 'fashion-sleeve' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	/**
	 * Filters the Google Fonts URL.
	 *
	 * @param string $fonts_url Google Fonts URL.
	 */
	return apply_filters( 'fashion_sleeve_fonts_url', $fonts_url );

}
endif;

/**
 * Filter 'fashion_sleeve_has_sidebar'
 * We will modify the filter only,
 * if the `fashion_sleeve_has_fullwidth_archive` OR `fashion_sleeve_has_fullwidth_post_global` OR `fashion_sleeve_has_fullwidth_page`
 *
 * @param bool $sidebar
 * @return bool
 */
function fashion_sleeve_has_sidebar_layout( $sidebar ) {

	if ( fashion_sleeve_has_fullwidth_layout() ) {
		return false; // Sidebar must be false if layout is fullwidth.
	}

	return (bool) $sidebar;

}
add_filter( 'fashion_sleeve_has_sidebar', 'fashion_sleeve_has_sidebar_layout', 12 );

/**
 * New wp_body_open Theme Hook - WordPress 5.2
 * Backward Compatibility
 * This can be removed at the launch of WordPress 5.4
 *
 * @see https://make.wordpress.org/core/2019/04/24/miscellaneous-developer-updates-in-5-2/
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
	function wp_body_open() {
		// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'wp_body_open' );
    }
}

/**
 * Filter 'get_custom_logo'
 *
 * @return string
 */
function fashion_sleeve_get_custom_logo( $html ) {
	return sprintf( '<div class="site-logo-wrapper">%1$s</div>', $html );
}
add_filter( 'get_custom_logo', 'fashion_sleeve_get_custom_logo' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function fashion_sleeve_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['menu_class'] = 'site-header-menu-wrapper site-header-menu-responsive-wrapper';
	return $args;
}
add_filter( 'wp_page_menu_args', 'fashion_sleeve_page_menu_args' );

/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
 */
function fashion_sleeve_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="header-menu sf-menu">', $class, 1 );
}
add_filter( 'wp_page_menu', 'fashion_sleeve_page_menu_class' );

/**
 * Filter 'excerpt_length'
 *
 * @param int $length
 * @return int
 */
function fashion_sleeve_excerpt_length( $length ) {
    if ( is_admin() ) {
		return $length;
	}

    // Custom Excerpt Length
    $length = 25;

	/**
	 * Filters the Excerpt length.
	 *
	 * @param int $length Excerpt Length.
	 */
	return apply_filters( 'fashion_sleeve_excerpt_length', $length );
}
add_filter( 'excerpt_length', 'fashion_sleeve_excerpt_length' );

/**
 * Filter 'excerpt_more'
 *
 * Remove [...] string
 * @param str $more
 * @return str
 */
function fashion_sleeve_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	// Custom Excerpt More
    $more = '&hellip;';

    /**
	 * Filters the Excerpt more string.
	 *
	 * @param string $excerpt_more Excerpt More.
	 */
	return apply_filters( 'fashion_sleeve_excerpt_more', $more );
}
add_filter( 'excerpt_more', 'fashion_sleeve_excerpt_more' );

/**
 * Filter 'the_content_more_link'
 * Prevent Page Scroll When Clicking the More Link.
 *
 * @param string $link
 * @return filtered $link
 */
function fashion_sleeve_the_content_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'fashion_sleeve_the_content_more_link_scroll' );

/**
 * Filter 'get_the_archive_title'
 *
 * Possible formats for $title
 * 1. Category: Fashion
 * 2. Asides
 *
 * @see get_the_archive_title
 * @param string $title
 * @return filtered $title
 */
function fashion_sleeve_the_archive_title( $title ) {
	// Explode on the basis of `:`
	$matches = explode( ':', $title, 2 );

	// Validation
	if ( count( $matches ) > 1 ) {
		$matches[0] = sprintf( '<span class="page-title-label">%1$s:</span>', trim( $matches[0] ) );
		$matches[1] = sprintf( '<span class="page-title-value">%1$s</span>',  trim( $matches[1] ) );
	} else {
		$matches[0] = sprintf( '<span class="page-title-label">%1$s</span>',  trim( $matches[0] ) );
	}

	// Implode
	$title = implode( ' ', $matches );

	return $title;
}
add_filter( 'get_the_archive_title', 'fashion_sleeve_the_archive_title' );

/**
 * Filter `body_class`
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fashion_sleeve_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Site Title & Tagline Class
	if ( display_header_text() ) {
		$classes[] = 'has-site-branding';
	}

	// Custom Header
	if ( get_header_image() ) {
		$classes[] = 'has-custom-header';
	}

	// Custom Background Image
	if ( get_background_image() ) {
		$classes[] = 'has-custom-background-image';
	}

	/**
	 * Fullwidth Layouts
	 *
	 * Full Width Standard Layouts
	 * 1. Full Width Archives
	 * 2. Full Width, No Sidebar Template
	 * 3. Full Width Attachment Image
	 *
	 * Full Width Legible Layouts
	 * 4. Full Width Post ( Gutenberg Support )
	 * 5. Full Width Page ( Gutenberg Support )
	 *
	 */
	if ( fashion_sleeve_has_fullwidth_layout() ) {

		// Order is very important.
		if ( fashion_sleeve_has_fullwidth_archive() ) {
			$classes[] = 'has-full-width-archive';
		} else if ( fashion_sleeve_has_fullwidth_post_global() ) {
			$classes[] = 'has-full-width-block has-full-width-post';
		} else if ( fashion_sleeve_has_fullwidth_page() ) {
			$classes[] = 'has-full-width-block has-full-width-page';
		}

	} else if ( fashion_sleeve_has_sidebar() ) {
		$classes[] = 'has-' . esc_attr( fashion_sleeve_mod( 'fashion_sleeve_sidebar_position' ) ) . '-sidebar';
	} else {
		$classes[] = 'has-no-sidebar';
	}

	// Class Alignfull JS Class
	if ( fashion_sleeve_has_class_alignfull_js() ) {
		$classes[] = 'has-alignfull-js';
	}

	return $classes;
}
add_filter( 'body_class', 'fashion_sleeve_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fashion_sleeve_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fashion_sleeve_pingback_header' );

/**
 * Blog Credits.
 *
 * @return void
 */
function fashion_sleeve_credits_blog() {
	// Blog Credits HTML
	$html = '<div class="credits credits-blog">'. fashion_sleeve_mod( 'fashion_sleeve_copyright' ) .'</div>';

	// Convert Chars
	$html = convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $html ) ) ) ) ) );

	// Sanitization
	echo wp_kses_post( $html );
}
add_action( 'fashion_sleeve_credits', 'fashion_sleeve_credits_blog' );

/**
 * Designer Credits.
 *
 * @return void
 */
function fashion_sleeve_credits_designer() {
	printf( '<div class="credits credits-designer">%1$s <a href="%2$s" title="WoolThemes">WoolThemes</a> <span>&sdot;</span> %3$s <a href="%4$s" title="WordPress">WordPress</a></div>',
		esc_html__( 'Fashion Sleeve Theme by', 'fashion-sleeve' ),
		esc_url( 'https://woolthemes.com' ),
		esc_html__( 'Powered by', 'fashion-sleeve' ),
		esc_url( __( 'https://wordpress.org', 'fashion-sleeve' ) )
	);
}
add_action( 'fashion_sleeve_credits', 'fashion_sleeve_credits_designer' );

/**
 * Enqueues front-end CSS to hide elements.
 *
 * @see wp_add_inline_style()
 */
function fashion_sleeve_hide_elements() {
	// Elements
	$elements = array();

	// Credit
	if ( false === fashion_sleeve_mod( 'fashion_sleeve_credit' ) ) {
		$elements[] = '.credits-designer';
	}

	// Bail if their are no elements to process
	if ( 0 === count( $elements ) ) {
		return;
	}

	// Build Elements
	$elements = implode( ',', $elements );

	// Build CSS
	$css = sprintf( '%1$s { clip: rect(1px, 1px, 1px, 1px); position: absolute; }', $elements );

	// Add Inline Style
	wp_add_inline_style( 'fashion-sleeve-style', $css );
}
add_action( 'wp_enqueue_scripts', 'fashion_sleeve_hide_elements', 11 );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function fashion_sleeve_attachment_link( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
		return $url;
	}

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id ) {
		$url .= '#main';
	}

	return $url;
}
add_filter( 'attachment_link', 'fashion_sleeve_attachment_link', 10, 2 );

if ( ! function_exists( 'fashion_sleeve_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @return void
 */
function fashion_sleeve_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Fashion Sleeve attachment size.
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 1140.
	 *     @type int $width  Width of the image in pixels. Default 1140.
	 * }
	 */
	$attachment_size     = apply_filters( 'fashion_sleeve_attachment_size', 'full' );
	$next_attachment_url = wp_get_attachment_url();

	if ( $post->post_parent ) { // Only look for attachments if this attachment has a parent object.

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 100,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {

			foreach ( $attachment_ids as $key => $attachment_id ) {
				if ( $attachment_id === $post->ID ) {
					break;
				}
			}

			// For next attachment
			$key++;

			if ( isset( $attachment_ids[ $key ] ) ) {
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[$key] );
			} else {
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[0] );
			}

		}

	} // end post->post_parent check

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		esc_attr( get_the_title() ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);

}
endif;
