<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package desa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
wp_body_open();
$_has_logo = get_theme_mod( 'custom_logo', false  ) != false;
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'desa' ); ?></a>

	<header id="masthead" class="text-center">
		<div class="container py-3 <?php echo $_has_logo ? 'has-logo' : '' ?>">
			
			<?php the_custom_logo(); ?>

			<div class="site-branding flex-grow-1">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title h2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$desa_description = get_bloginfo( 'description', 'display' );
				if ( $desa_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $desa_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

		</div>
	</header><!-- #masthead -->
	<div id="site-nav" class="mb-5 border-bottom shadow-sm">
		<nav id="site-navigation" class="main-navigation navbar navbar-expand-md navbar-light bg-light" role="navigation">
			<div class="container">
				<a class="navbar-brand text-green" href="/">
					<i class="bi bi-house-door-fill"></i>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#desa-menu-1" aria-controls="desa-menu-1" aria-expanded="false" aria-label="<?php esc_html_e( 'Menu', 'desa' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'desa-menu-1',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
		</div>
			</nav><!-- #site-navigation -->
	</div>
	<div class="container">
		<div class="row">
