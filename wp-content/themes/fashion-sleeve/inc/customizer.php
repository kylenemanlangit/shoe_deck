<?php
/**
 * Fashion Sleeve Theme Customizer
 *
 * @package Fashion Sleeve
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fashion_sleeve_customize_register ( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Theme Options Panel
	 */
	$wp_customize->add_panel( 'fashion_sleeve_theme_options', array(
	    'title'     => esc_html__( 'Theme Options', 'fashion-sleeve' ),
	    'priority'  => 1,
	) );

	/**
	 * General Options Section
	 */
	$wp_customize->add_section( 'fashion_sleeve_general_options', array (
		'title'     => esc_html__( 'General Options', 'fashion-sleeve' ),
		'panel'     => 'fashion_sleeve_theme_options',
		'priority'  => 10,
		'description' => esc_html__( 'Personalize the settings of your theme.', 'fashion-sleeve' ),
	) );

	// Main Sidebar Position
	$wp_customize->add_setting ( 'fashion_sleeve_sidebar_position', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_sidebar_position' ),
		'sanitize_callback' => 'fashion_sleeve_sanitize_select',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_sidebar_position', array (
		'label'    => esc_html__( 'Main Sidebar Position (if active)', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_general_options',
		'priority' => 1,
		'type'     => 'select',
		'choices'  => array(
			'right' => esc_html__( 'Right', 'fashion-sleeve'),
			'left'  => esc_html__( 'Left',  'fashion-sleeve'),
		),
	) );

	/**
	 * Layout Options Section
	 */
	$wp_customize->add_section( 'fashion_sleeve_layout_options', array (
		'title'     => esc_html__( 'Layout Options', 'fashion-sleeve' ),
		'panel'     => 'fashion_sleeve_theme_options',
		'priority'  => 20,
		'description' => esc_html__( 'Personalize the layout settings of your theme.', 'fashion-sleeve' ),
	) );

	// Layout Archives Title
	$wp_customize->add_setting ( 'fashion_sleeve_layout_archives_title' );

	$wp_customize->add_control(
		new Fashion_Sleeve_Heading_Control(
			$wp_customize,
			'fashion_sleeve_layout_archives_title',
			array(
				'label'       => esc_html__( 'Archives Layout', 'fashion-sleeve' ),
				'section'     => 'fashion_sleeve_layout_options',
				'priority'    => 1,
				'type'        => 'fashion-sleeve-heading',
			)
		)
	);

	// Fullwidth Archive Control
	$wp_customize->add_setting ( 'fashion_sleeve_fullwidth_archive', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_fullwidth_archive' ),
		'sanitize_callback' => 'fashion_sleeve_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_fullwidth_archive', array (
		'label'    => esc_html__( 'Display Archives at Fullwidth (No Sidebar)', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_layout_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Layout Posts
	$wp_customize->add_setting ( 'fashion_sleeve_layout_posts', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_layout_posts' ),
		'sanitize_callback' => 'fashion_sleeve_sanitize_select',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_layout_posts', array (
		'label'    => esc_html__( 'Posts Layout', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_layout_options',
		'priority' => 3,
		'type'     => 'select',
		'choices'  => array(
			'sidebar'    => esc_html__( 'Display Posts with Sidebar', 'fashion-sleeve'),
			'fullwidth'  => esc_html__( 'Display Posts at Fullwidth (Gutenberg Blocks)', 'fashion-sleeve'),
		),
	) );

	// Layout Pages
	$wp_customize->add_setting ( 'fashion_sleeve_layout_pages', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_layout_pages' ),
		'sanitize_callback' => 'fashion_sleeve_sanitize_select',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_layout_pages', array (
		'label'    => esc_html__( 'Pages Layout', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_layout_options',
		'priority' => 4,
		'type'     => 'select',
		'choices'  => array(
			'sidebar'    => esc_html__( 'Display Pages with Sidebar', 'fashion-sleeve'),
			'fullwidth'  => esc_html__( 'Display Pages at Fullwidth (Gutenberg Blocks)', 'fashion-sleeve'),
		),
	) );

	// Layout Tweaks Title
	$wp_customize->add_setting ( 'fashion_sleeve_layout_tweaks_title' );

	$wp_customize->add_control(
		new Fashion_Sleeve_Heading_Control(
			$wp_customize,
			'fashion_sleeve_layout_tweaks_title',
			array(
				'label'       => esc_html__( 'Block Tweaks', 'fashion-sleeve' ),
				'section'     => 'fashion_sleeve_layout_options',
				'priority'    => 5,
				'type'        => 'fashion-sleeve-heading',
			)
		)
	);

	// Class Alignfull JS Control
	$wp_customize->add_setting ( 'fashion_sleeve_class_alignfull_js', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_class_alignfull_js' ),
		'sanitize_callback' => 'fashion_sleeve_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_class_alignfull_js', array (
		'label'    => esc_html__( 'Use JS for class alignfull blocks (If horizontal scrollbar appears)', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_layout_options',
		'priority' => 6,
		'type'     => 'checkbox',
	) );

	/**
	 * Footer Section
	 */
	$wp_customize->add_section( 'fashion_sleeve_footer_options', array (
		'title'       => esc_html__( 'Footer Options', 'fashion-sleeve' ),
		'panel'       => 'fashion_sleeve_theme_options',
		'priority'    => 30,
		'description' => esc_html__( 'Personalize the footer settings of your theme.', 'fashion-sleeve' ),
	) );

	// Copyright Control
	$wp_customize->add_setting ( 'fashion_sleeve_copyright', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_copyright' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_copyright', array (
		'label'    => esc_html__( 'Copyright', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_footer_options',
		'priority' => 1,
		'type'     => 'textarea',
	) );

	// Credit Control
	$wp_customize->add_setting ( 'fashion_sleeve_credit', array (
		'default'           => fashion_sleeve_default( 'fashion_sleeve_credit' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fashion_sleeve_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'fashion_sleeve_credit', array (
		'label'    => esc_html__( 'Display Designer Credit', 'fashion-sleeve' ),
		'section'  => 'fashion_sleeve_footer_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	/**
	 * Support Section
	 */
	$wp_customize->add_section( 'fashion_sleeve_support_options', array(
		'title'       => esc_html__( 'Support Options', 'fashion-sleeve' ),
		'description' => esc_html__( 'Thanks for your interest in Fashion Sleeve! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'fashion-sleeve' ),
		'panel'       => 'fashion_sleeve_theme_options',
		'priority'    => 40,
	) );

	// Theme Support
	$wp_customize->add_setting ( 'fashion_sleeve_theme_support', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Fashion_Sleeve_Button_Control(
			$wp_customize,
			'fashion_sleeve_theme_support',
			array(
				'label'         => esc_html__( 'Fashion Sleeve Support', 'fashion-sleeve' ),
				'section'       => 'fashion_sleeve_support_options',
				'priority'      => 1,
				'type'          => 'fashion-sleeve-button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://woolthemes.com/contact/',
				'button_target' => '_blank',
			)
		)
	);

	/**
	 * Review Section
	 */
	$wp_customize->add_section( 'fashion_sleeve_review_options', array(
		'title'       => esc_html__( 'Enjoying the theme?', 'fashion-sleeve' ),
		'description' => esc_html__( 'Why not leave us a review on WordPress.org? We\'d really appreciate it!', 'fashion-sleeve' ),
		'panel'       => 'fashion_sleeve_theme_options',
		'priority'    => 50,
	) );

	// Theme
	$wp_customize->add_setting ( 'fashion_sleeve_theme_review', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Fashion_Sleeve_Button_Control(
			$wp_customize,
			'fashion_sleeve_theme_review',
			array(
				'label'         => esc_html__( 'Review on WordPress.org', 'fashion-sleeve' ),
				'section'       => 'fashion_sleeve_review_options',
				'type'          => 'fashion-sleeve-button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://wordpress.org/support/theme/fashion-sleeve/reviews',
				'button_target' => '_blank',
			)
		)
	);
}
add_action( 'customize_register', 'fashion_sleeve_customize_register' );

/**
 * New Control Type: Heading
 * @see wp-includes/class-wp-customize-control.php
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Fashion_Sleeve_Heading_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'fashion-sleeve-heading';

		/**
		 * Label for the control.
		 */
		public $label = '';

		/**
		 * Description for the control.
		 */
		public $description = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
		<?php
		}
	}
}

/**
 * New Control Type: Button
 * @see wp-includes/class-wp-customize-control.php
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Fashion_Sleeve_Button_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'fashion-sleeve-button';

		/**
		 * HTML tag to render button object.
		 *
		 * @var  string
		 */
		protected $button_tag = 'button';

		/**
		 * Class to render button object.
		 *
		 * @var  string
		 */
		protected $button_class = 'button button-primary';

		/**
		 * Link for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_href = 'javascript:void(0)';

		/**
		 * Target for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_target = '';

		/**
		 * Click event handler.
		 *
		 * @var  string
		 */
		protected $button_onclick = '';

		/**
		 * ID attribute for HTML tab.
		 *
		 * @var  string
		 */
		protected $button_tag_id = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<span class="center">
				<?php
				// Print open tag
				echo '<' . $this->button_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				// button class
				if ( ! empty( $this->button_class ) ) {
					echo ' class="' . esc_attr( $this->button_class ) . '"';
				}

				// button or href
				if ( 'button' == $this->button_tag ) {
					echo ' type="button"';
				} else {
					echo ' href="' . esc_url( $this->button_href ) . '"' . ( empty( $this->button_tag ) ? '' : ' target="' . esc_attr( $this->button_target ) . '"' );
				}

				// onClick Event
				if ( ! empty( $this->button_onclick ) ) {
					echo ' onclick="' . esc_js( $this->button_onclick ) . '"';
				}

				// ID
				if ( ! empty( $this->button_tag_id ) ) {
					echo ' id="' . esc_attr( $this->button_tag_id ) . '"';
				}

				echo '>';

				// Print text inside tag
				echo esc_html( $this->label );

				// Print close tag
				echo '</' . $this->button_tag . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</span>
		<?php
		}
	}
}

/**
 * Sanitize Select.
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function fashion_sleeve_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize the checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function fashion_sleeve_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fashion_sleeve_customize_preview_js() {
	wp_enqueue_script( 'fashion_sleeve_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140120', true );
}
add_action( 'customize_preview_init', 'fashion_sleeve_customize_preview_js' );
