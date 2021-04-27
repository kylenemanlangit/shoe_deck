/*!
 * Custom v1.0
 * Contains handlers for the different site functions
 *
 * Copyright (c) 2013-2020 Fashion Sleeve
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

/* global enquire:true */

( function( $ ) {
	var fashionSleeve = {

		// Responsive Menu Build
		responsiveMenuBuild: function () {
			// Site Header Menu Wrapper
			var $menuWrapper = $( '.site-header-menu-wrapper' );

			// Add dropdown toggle that display child menu items.
			$( '.site-header-menu .page_item_has_children > a, .site-header-menu .menu-item-has-children > a' ).append( '<button class="dropdown-toggle" aria-expanded="false"/>' );
			$( '.site-header-menu .dropdown-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );

			// Add Close Button Markup
			$menuWrapper.prepend( '<div class="site-header-menu-responsive-close-wrapper"><button class="site-header-menu-responsive-close">&times;</button></div>' );
		},

		// Responsive Menu Destroy
		responsiveMenuDestroy: function () {
			// Site Header Menu
			var $menuWrapper = $( '.site-header-menu-wrapper' );

			// Remove Dropdown Toggles
			$menuWrapper.find( '.dropdown-toggle' ).remove();

			// Remove Close Button
			$menuWrapper.find( '.site-header-menu-responsive-close-wrapper' ).remove();
		},

		// SF Menu Build
		sfMenuBuild: function () {
			// Superfish Menu
			$( 'ul.sf-menu' ).superfish( {
				delay: 1500,
				animation: { opacity: 'show', height: 'show' },
				speed: 'fast',
				autoArrows: false,
				cssArrows: true,
			} );
		},

		// SF Menu Destroy
		sfMenuDestroy: function () {
			// Superfish Menu Destroy
			$( 'ul.sf-menu' ).superfish( 'destroy' );
		},

		// Big Screen Match
		bigScreenMatch: function () {
			// Site Header Menu Wrapper
			var $menuWrapper = $( '.site-header-menu-wrapper' );
			$menuWrapper.removeClass( 'site-header-menu-responsive-wrapper' );

			// Site Header Menu
			var $menu = $( '.site-header-menu' );
			$menu.removeClass( 'site-header-menu-responsive' );
			$menu.addClass( 'sf-menu' );

			// Superfish Menu Build
			fashionSleeve.sfMenuBuild();
		},

		// Big Screen UnMatch
		bigScreenUnMatch: function () {
			// Superfish Menu Destroy
			fashionSleeve.sfMenuDestroy();

			// Site Header Menu
			var $menu = $( '.site-header-menu' );
			$menu.addClass( 'site-header-menu-responsive' );
			$menu.removeClass( 'sf-menu' );

			// Site Header Menu Wrapper
			var $menuWrapper = $( '.site-header-menu-wrapper' );
			$menuWrapper.addClass( 'site-header-menu-responsive-wrapper' );
		},

		// Small Screen Match
		smallScreenMatch: function () {
			// Responsive Menu Build
			fashionSleeve.responsiveMenuBuild();

			// Sliding Panels for Menu
			fashionSleeve.slidePanelInit();

			// Responsive Tables
			$( '.entry-content, .sidebar' ).find( 'table' ).wrap( '<div class="table-responsive"></div>' );
		},

		// Small Screen UnMatch
		smallScreenUnMatch: function () {
			// Responsive Menu Destroy
			fashionSleeve.responsiveMenuDestroy();

			// Responsive Menu Close
			fashionSleeve.slidePanelCloseInit();

			// Responsive Tables Undo
			$( '.entry-content, .sidebar' ).find( 'table' ).unwrap( '<div class="table-responsive"></div>' );
		},

		// Open Slide Panel - Responsive Mobile Menu
		slidePanelInit: function () {
			// Elements
			var $menuWrapper = $( '.site-header-menu-wrapper' );
			var $overlayEffect = $( '.overlay-effect' );
			var $menuClose = $( '.site-header-menu-responsive-close' );

			// Responsive Menu Slide
			$( '.toggle-menu-control' ).off( 'click' ).on( 'click', function( e ) {
				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// ToggleClass
				$menuWrapper.toggleClass( 'show' );
				$overlayEffect.toggleClass( 'open' );

				// Add Body Class
				if ( $overlayEffect.hasClass( 'open' ) ) {
					$( 'body' ).addClass( 'has-responsive-menu' );
				}
			} );

			// Responsive Menu Close
			$menuClose.off( 'click' ).on( 'click', function( e ) {
				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// Close Slide Panel
				fashionSleeve.slidePanelCloseInit();
			} );

			// Overlay Slide Close
			$overlayEffect.off( 'click' ).on( 'click', function() {
				fashionSleeve.slidePanelCloseInit();
			} );
		},

		// Close Slide Panel
		slidePanelCloseInit: function () {
			// Elements
			var $menuWrapper = $( '.site-header-menu-wrapper' );
			var $overlayEffect = $( '.overlay-effect' );

			// Slide Panel Close Logic
			if ( $overlayEffect.hasClass( 'open' ) ) {
				// Remove Body Class
				$( 'body' ).removeClass( 'has-responsive-menu' );

				// For Menu
				if ( $menuWrapper.hasClass( 'show' ) ) {
					$menuWrapper.toggleClass( 'show' );
				}

				// Toggle Overlay Slide
				$overlayEffect.toggleClass( 'open' );
			}
		},

		// Responsive Videos
		responsiveVideosInit: function () {
			$( '.entry-content, .sidebar' ).fitVids();
		},

		// Widget Logic
		widgetLogicInit: function () {
			// Social Menu Widget
			$( '.widget_nav_menu > div[class^="menu-social-"] > ul > li > a' ).wrapInner( '<span class="screen-reader-text"></span>' );

			// Custom Menu Widget
			$( '.widget_nav_menu .menu-item-has-children > a' ).append( '<span class="custom-menu-toggle" aria-expanded="false"></span>' );
			$( '.widget_nav_menu .custom-menu-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.sub-menu' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );

			// Pages Widget
			$( '.widget_pages .page_item_has_children > a' ).append( '<span class="page-toggle" aria-expanded="false"></span>' );
			$( '.widget_pages .page-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );

			// Categories Widget
			$( '.widget_categories' ).find( '.children' ).parent().addClass( 'category_item_has_children' );
			$( '.widget_categories .category_item_has_children > a' ).append( '<span class="category-toggle" aria-expanded="false"></span>' );
			$( '.widget_categories .category-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );
		},

		// Media Queries
		mqInit: function () {
			enquire
				.register( 'screen and ( min-width: 992px )', {
					match() {
						// Big Screen Match
						fashionSleeve.bigScreenMatch();
					},
					unmatch() {
						// Big Screen UnMatch
						fashionSleeve.bigScreenUnMatch();
					},
				} )
				.register( 'screen and ( max-width: 991px )', {
					match() {
						// Small Screen Match
						fashionSleeve.smallScreenMatch();
					},
					unmatch() {
						// Small Screen UnMatch
						fashionSleeve.smallScreenUnMatch();
					},
				} );
		},

		// Block Align Full
		blockAlignFull: function() {
			// Should we use JS Tweaks ?
			if ( $( 'body' ).hasClass( 'has-alignfull-js' ) ) {
				// Element
				var $el = $( '.has-full-width-block .alignfull' );

				// Element Width
				var el_width = parseInt( $el.width() );

				// Viewport Width
				var viewPortWidth = parseInt( $( window ).width() );

				// Element to Viewoport Width Difference
				var diff = 0;

				// Adjust Element Width
				if ( el_width > viewPortWidth ) {
					diff = el_width - viewPortWidth;
				}

				// CSS Strings
				var strWidth = '100vw - ' + diff + 'px';
				var strMargin = '(' + diff + 'px - 100vw ) / 2';

				// CSS
				$el.css({
					'width'       : 'calc(' + strWidth + ')',
					'margin-left' : 'calc(' + strMargin + ')',
					'margin-right' : 'calc(' + strMargin + ')'
				});
			}
		},
	};

	// Document Ready
	$( document ).ready( function() {
		// Responsive Videos
		fashionSleeve.responsiveVideosInit();

		// Widget Logic
		fashionSleeve.widgetLogicInit();

		// Block Align Full
		fashionSleeve.blockAlignFull();

	    // Media Queries
	    fashionSleeve.mqInit();
	} );

	// Document Keyup
	$( document ).keyup( function( e ) {
	    // Escape Key
	    if ( e.keyCode === 27 ) {
			// Make the escape key to close the slide panel
			fashionSleeve.slidePanelCloseInit();
	    }
	} );
} )( jQuery );
