<?php
/**
 * 404 Not Found template.
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<section class="lsg-section">
  <div class="lsg-container lsg-404">
    <div>
      <div class="lsg-404__code" aria-hidden="true">404</div>
      <h1 class="lsg-heading" style="text-align:center;"><?php esc_html_e( 'Page Not Found', 'luxury-spa-gulshan' ); ?></h1>
      <p class="lsg-lead" style="text-align:center;margin-inline:auto;"><?php esc_html_e( 'The page you\'re looking for doesn\'t exist or has been moved. Let\'s get you back to the spa.', 'luxury-spa-gulshan' ); ?></p>
      <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-top:2rem;">
        <a class="lsg-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go Home', 'luxury-spa-gulshan' ); ?></a>
        <a class="lsg-btn-outline" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View Services', 'luxury-spa-gulshan' ); ?></a>
        <a class="lsg-btn-outline" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'luxury-spa-gulshan' ); ?></a>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
