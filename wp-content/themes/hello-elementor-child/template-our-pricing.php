<?php
/**
 * Template Name: Our Pricing
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$services = array(
    array(
        'title' => __( 'Dry Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/dry-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '6,000 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '9,000 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '11,000 tk',
        ),
    ),
    array(
        'title' => __( 'Four Hand Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/four-hand-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '14,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '18,500 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '25,000 tk',
        ),
    ),
    array(
        'title' => __( 'Special Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/special-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '7,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '10,500 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '14,000 tk',
        ),
    ),
    array(
        'title' => __( 'Sensual Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/sensual-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '6,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '9,500 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '10,500 tk',
        ),
    ),
    array(
        'title' => __( 'Aroma Oil Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/aroma-oil-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '6,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '9,500 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '11,999 tk',
        ),
    ),
    array(
        'title' => __( 'Nuru Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/nuru-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '8,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '12,000 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '15,000 tk',
        ),
    ),
    array(
        'title' => __( 'Back and Shoulder Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/back-and-shoulder-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '5,500 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '8,500 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '10,500 tk',
        ),
    ),
    array(
        'title' => __( 'Body to Body Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/body-to-body-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '9,000 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '13,000 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '17,000 tk',
        ),
    ),
    array(
        'title' => __( 'Full Body Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/full-body-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '7,000 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '9,999 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '11,500 tk',
        ),
    ),
    array(
        'title' => __( 'Deep Tissue Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/deep-tissue-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '8,000 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '11,000 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '15,000 tk',
        ),
    ),
    array(
        'title' => __( 'Thai Massage', 'luxury-spa-gulshan' ),
        'slug'  => '/services/thai-massage/',
        'items' => array(
            __( '60 Minutes Session', 'luxury-spa-gulshan' ) => '7,000 tk',
            __( '90 Minutes Session', 'luxury-spa-gulshan' ) => '10,000 tk',
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '14,000 tk',
        ),
    ),
    array(
        'title' => __( 'Body Scrub with Facial', 'luxury-spa-gulshan' ),
        'slug'  => '/services/body-scrub-with-facial/',
        'items' => array(
            __( '120 Minutes Session', 'luxury-spa-gulshan' ) => '15,000 tk',
        ),
    ),
);
?>

<style>
.pricing-hero { background:var(--lsg-surface); border-bottom:1px solid var(--lsg-border); }
.pricing-card {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
    box-shadow:var(--lsg-shadow-sm);
    overflow:hidden;
    display:flex;flex-direction:column;
    transition:transform var(--lsg-transition), box-shadow var(--lsg-transition);
}
.pricing-card:hover { transform:translateY(-4px); box-shadow:var(--lsg-shadow-md); }
.pricing-card__head {
    padding:1.25rem 1.5rem;
    background:var(--lsg-contrast);
    display:flex;
    align-items:center;
    justify-content:space-between;
}
.pricing-card__head h2 { margin:0;font-size:1.05rem;color:#fff; }
.pricing-card__head a {
    font-size:.78rem;
    color:rgba(255,250,242,.7);
    text-decoration:underline;
    white-space:nowrap;
}
.pricing-card__head a:hover { color:var(--lsg-accent); }
.pricing-card__body { padding:1.25rem 1.5rem;flex:1; }
.pricing-note {
    display:flex;
    align-items:flex-start;
    gap:1rem;
    padding:1.5rem;
    background:var(--lsg-accent-soft);
    border:1px solid rgba(180,145,90,.25);
    border-radius:var(--lsg-radius-lg);
    margin-bottom:2.5rem;
}
.pricing-note__icon { font-size:1.5rem; flex-shrink:0; }
.pricing-note p { margin:0; font-size:.93rem; color:var(--lsg-contrast); line-height:1.6; }
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section pricing-hero">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Best Deals', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading lsg-heading--hero"><?php esc_html_e( 'Our Pricing', 'luxury-spa-gulshan' ); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'Transparent, clear pricing for every service and session length. No hidden fees. No surprises.', 'luxury-spa-gulshan' ); ?></p>
    <div class="lsg-hero__actions">
      <a class="lsg-btn lsg-btn--lg" href="tel:+8801891450300"><?php esc_html_e( 'Call to Book', 'luxury-spa-gulshan' ); ?></a>
      <a class="lsg-btn-outline lsg-btn--lg" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Browse Services', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<!-- PRICING GRID -->
<section class="lsg-section">
  <div class="lsg-container">

    <div class="pricing-note">
      <div class="pricing-note__icon">💬</div>
      <p><?php esc_html_e( 'All prices are session packages in Bangladeshi Taka (tk). For special packages, group bookings, or custom treatments, contact us directly.', 'luxury-spa-gulshan' ); ?></p>
    </div>

    <div class="lsg-grid lsg-grid--3" style="align-items:stretch;">
      <?php foreach ( $services as $service ) : ?>
      <div class="pricing-card">
        <div class="pricing-card__head">
          <h2><?php echo esc_html( $service['title'] ); ?></h2>
          <a href="<?php echo esc_url( home_url( $service['slug'] ) ); ?>"><?php esc_html_e( 'Details →', 'luxury-spa-gulshan' ); ?></a>
        </div>
        <div class="pricing-card__body">
          <?php foreach ( $service['items'] as $label => $price ) : ?>
          <div class="lsg-price-row">
            <span><?php echo esc_html( $label ); ?></span>
            <strong><?php echo esc_html( $price ); ?></strong>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Stress relief starts here', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'All packages are designed to help you relax, recover, and feel refreshed with expert care and premium service.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Book Your Session', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
