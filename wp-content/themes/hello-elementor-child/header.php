<?php
/**
 * Header — Luxury Spa Gulshan Child
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    
    <script defer src="https://app.chatbotistic.com/install-widget/bundle.js?key=ebb16d9a-0f0f-48bb-9fe4-5f2f6b4bc257"></script>
    
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#b4915a">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#lsg-main"><?php esc_html_e( 'Skip to content', 'luxury-spa-gulshan' ); ?></a>

<!-- ============================================================
     SITE HEADER
     ============================================================ -->
<header class="lsg-header" id="lsg-header" role="banner">
  <div class="lsg-container lsg-header__inner">

    <!-- Logo -->
    <div class="lsg-header__logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> — <?php esc_html_e( 'Home', 'luxury-spa-gulshan' ); ?>">
        <?php if ( has_custom_logo() ) :
            the_custom_logo();
        else : ?>
        <img
          src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Logo-luxury-spa-gulshan.png' ); ?>"
          alt="<?php bloginfo( 'name' ); ?>"
          width="220"
          height="80"
          loading="eager"
        >
        <?php endif; ?>
      </a>
    </div>

    <!-- Desktop primary nav -->
    <nav class="lsg-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'luxury-spa-gulshan' ); ?>">
      <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'lsg-nav__list',
          'menu_id'        => 'primary-menu',
          'fallback_cb'    => 'lsg_default_menu',
          'link_after'     => '',
          'depth'          => 2,
      ) ); ?>
    </nav>

    <!-- Hamburger -->
    <button
      class="lsg-menu-toggle"
      type="button"
      aria-controls="lsg-mobile-nav"
      aria-expanded="false"
      aria-label="<?php esc_attr_e( 'Toggle menu', 'luxury-spa-gulshan' ); ?>"
    >
      <span></span><span></span><span></span>
    </button>

  </div><!-- .lsg-header__inner -->
</header>

<!-- ============================================================
     MOBILE NAV DRAWER
     ============================================================ -->
<div class="lsg-mobile-nav" id="lsg-mobile-nav" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Mobile navigation', 'luxury-spa-gulshan' ); ?>">
  <?php wp_nav_menu( array(
      'theme_location' => 'primary',
      'container'      => false,
      'menu_class'     => 'lsg-nav__list',
      'menu_id'        => 'mobile-menu-links',
      'fallback_cb'    => 'lsg_default_menu',
      'depth'          => 2,
  ) ); ?>
  <a class="lsg-btn lsg-nav__cta" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Book Now', 'luxury-spa-gulshan' ); ?></a>
</div>

<!-- ============================================================
     MAIN CONTENT
     ============================================================ -->
<main id="lsg-main" class="lsg-site-main">