<?php
/**
 * desa Theme Customizer
 *
 * @package desa
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function desa_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'desa_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'desa_customize_partial_blogdescription',
			)
		);
	}

	foreach ($GLOBALS['desa_customizable_color'] as $id => $val)
	{
		$wp_customize->add_setting( $id, array(
			'default' => $val['default'],
			'type'           => 'theme_mod',
			'transport'      => 'postMessage'
		) );
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			$id, 
			array(
				'label'      => $val['label'],
				'section'    => 'colors',
				'settings'   => $id,
			)
		));
	}
	if ( $wp_customize->is_preview() && ! is_admin() ){
		add_action( 'wp_head', 'desa_customizer_js', 21);
	}
}
add_action( 'customize_register', 'desa_customize_register' );

/**
 * Client-side helper for live preview
 * @return void
 */
function desa_customizer_js(){
	?> 
	<script type="text/javascript">
		// Customizer Script Variable
		var desa_customizable_color = <?php echo json_encode($GLOBALS['desa_customizable_color']) ?>;
	</script>
	<?php
}
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function desa_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function desa_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function desa_customize_preview_js() {
	wp_enqueue_script( 'desa-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'desa_customize_preview_js' );
