<?php
/**
 * The template for displaying site navigation
 * @package Fashion Sleeve
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="main-navigation-inside">
		<div class="toggle-menu-wrapper">
			<a href="#header-menu-responsive" title="<?php esc_attr_e( 'Menu', 'fashion-sleeve' ); ?>" class="toggle-menu-control">
				<span class="toggle-menu-label"><?php esc_html_e( 'Menu', 'fashion-sleeve' ); ?></span>
			</a>
		</div>

		<?php
		// Header Menu
		wp_nav_menu( apply_filters( 'fashion_sleeve_header_menu_args', array(
			'container'       => 'div',
			'container_class' => 'site-header-menu-wrapper site-header-menu-responsive-wrapper',
			'theme_location'  => 'header-menu',
			'menu_class'      => 'site-header-menu site-header-menu-responsive',
			'menu_id'         => 'menu-1',
			'depth'           => 3,
		) ) );
		?>
	</div><!-- .main-navigation-inside -->
</nav><!-- .main-navigation -->
