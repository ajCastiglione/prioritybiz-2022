<?php
/**
 * The header for our theme.
 *
 * @package pbz
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>
		<?php wp_title( '' ); ?>
	</title>

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="Minerva Web Development, Antonio Castiglione" />

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( site_url() ); ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( site_url() ); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( site_url() ); ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo esc_url( site_url() ); ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo esc_url( site_url() ); ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php
	// Preload hero image, if it exists.
	$options = get_field( 'hero' );
	if ( ! empty( $options['image'] ) ) {
		$hero_image = $options['image'];
		// Preload image for desktop.
		echo '<link rel="preload" href="' . esc_url( $hero_image['url'] ) . '" as="image" media="(min-width: 768px)">';
		// Preload image for mobile.
		echo '<link rel="preload" href="' . esc_url( $hero_image['sizes']['large'] ) . '" as="image" media="(max-width: 767px)">';
	}

	wp_head();
	?>

	<?php
	// Load tracking scripts.
	require get_template_directory() . '/theme/tracking-scripts.php';
	?>

	<?php
	// ACF Variables.
	$options = get_field( 'header', 'options' );
	$logo    = $options['logo']['url'];
	?>

</head>

<body <?php body_class(); ?>>

	<div id="container">

		<header class="header">

			<div id="inner-header">

				<div class="header__split large-wrapper">
					<div class="header__item">
						<a href="<?php echo esc_url( home_url() ); ?>" rel="nofollow">
							<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" id="logo" class="h1">
						</a>
					</div>

					<div class="header__item main-nav-container">
						<nav role="navigation">
							<?php
							wp_nav_menu(
								array(
									'container'       => false,
									'container_class' => 'menu',
									'menu'            => __( 'The Main Menu', 'pbltheme' ),
									'menu_class'      => 'nav top-nav',
									'theme_location'  => 'main-nav',
									'depth'           => 2,
								)
							);
							?>
						</nav>
					</div>

					<div class="header__item mobile-nav-container">
						<i tabindex="2" class="nav-toggle fas fa-bars"></i>
						<nav role="navigation">
							<?php
							wp_nav_menu(
								array(
									'container'       => false,
									'container_class' => 'menu',
									'menu'            => __( 'Mobile Menu', 'pbltheme' ),
									'menu_class'      => 'nav mobile-nav',
									'theme_location'  => 'main-nav',
									'depth'           => 2,
								)
							);
							?>
						</nav>
					</div>
				</div>

			</div>

		</header>

		<?php
		if ( get_field( 'show_banner', 'options' ) ) :
			$banner = get_field( 'banner_fields', 'options' );
			?>
			<div class="banner">
				<div class="banner__content"><?php echo wp_kses_post( $banner['message'] ); ?></div>
			</div>
		<?php endif; ?>
