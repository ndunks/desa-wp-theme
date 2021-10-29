<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package desa
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses desa_header_style()
 */
function desa_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'desa_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'desa_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'desa_custom_header_setup' );

if ( ! function_exists( 'desa_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see desa_custom_header_setup().
	 */
	function desa_header_style() {
		echo '<style id="desa-custom-header" type="text/css">';
		$header_text_color = get_header_textcolor();
		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ){
			// If we get this far, we have custom styles. Let's do this.
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
					}
				<?php
				// If the user has set a custom color for the text use that.
			else :
				?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif;
		}

		/**
		 * Desa custom theme
		 */
		$_desa_tmp_styles = [];
		foreach ($GLOBALS['desa_customizable_color'] as $id => $val)
		{
			$color = get_theme_mod( $id );
			if ( '' != $color ) {
				$_desa_tmp_styles[] = sprintf($val['css'], $color);
			}
		}

		echo implode("\n", $_desa_tmp_styles);
		unset($_desa_tmp_styles);

		echo '</style>';
	}
endif;
