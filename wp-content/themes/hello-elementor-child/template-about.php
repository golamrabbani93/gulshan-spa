<?php
/**
 * Template Name: About
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<style>
.about-hero { background:var(--lsg-surface); border-bottom:1px solid var(--lsg-border); }
.about-two-col {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:3.5rem;
    align-items:start;
}
.about-why {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:1.25rem;
    margin-top:2rem;
}
.about-why__item {
    display:flex;
    align-items:flex-start;
    gap:.9rem;
    padding:1.25rem;
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
}
.about-why__icon {
    width:38px;height:38px;flex-shrink:0;
    background:var(--lsg-accent-soft);
    border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:1.1rem;
}
.about-why__text h4 { margin:0 0 .25rem;font-size:.95rem; }
.about-why__text p  { margin:0;font-size:.88rem;color:var(--lsg-muted); }
.about-services-list {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:.75rem;
}
.about-services-list a {
    display:flex;
    align-items:center;
    gap:.75rem;
    padding:.9rem 1.1rem;
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-md);
    font-size:.92rem;font-weight:500;
    transition:background var(--lsg-transition),border-color var(--lsg-transition),color var(--lsg-transition);
}
.about-services-list a::before { content:'💆'; font-size:1.1rem; }
.about-services-list a:hover {
    background:var(--lsg-accent-soft);
    border-color:var(--lsg-accent);
    color:var(--lsg-accent);
}
@media(max-width:860px){
    .about-two-col { grid-template-columns:1fr; gap:2rem; }
}
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section about-hero">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'About Us', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading lsg-heading--hero"><?php esc_html_e( 'Why Are We the Best Spa in Dhaka?', 'luxury-spa-gulshan' ); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'Luxury Spa Gulshan combines skilled therapists, natural products, and a peaceful environment for the best spa experience in Dhaka.', 'luxury-spa-gulshan' ); ?></p>
    <div class="lsg-hero__actions">
      <a class="lsg-btn lsg-btn--lg" href="tel:+8801891450300"><?php esc_html_e( 'Call to Book', 'luxury-spa-gulshan' ); ?></a>
      <a class="lsg-btn-outline lsg-btn--lg" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View Services', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<!-- ABOUT BODY -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="about-two-col">
      <!-- Left: main text -->
      <div>
        <span class="lsg-eyebrow"><?php esc_html_e( 'Our Story', 'luxury-spa-gulshan' ); ?></span>
        <h2 class="lsg-heading"><?php esc_html_e( 'About Luxury Spa Gulshan', 'luxury-spa-gulshan' ); ?></h2>
        <div class="lsg-prose" style="background:transparent;border:none;padding:0;">
          <p><?php esc_html_e( 'Luxury Spa Gulshan is one of the best spas in Dhaka, located in the heart of Gulshan. We provide a calm, clean, and private space where you can relax, refresh, and restore balance to your body and mind.', 'luxury-spa-gulshan' ); ?></p>
          <p><?php esc_html_e( 'Life in Dhaka is stressful — traffic, work, and daily pressure take their toll. Our spa is your peaceful escape where stress melts away, muscles relax, and the mind finds calm.', 'luxury-spa-gulshan' ); ?></p>
          <h3><?php esc_html_e( 'Our Mission', 'luxury-spa-gulshan' ); ?></h3>
          <p><?php esc_html_e( 'Our mission is to deliver professional spa services in Gulshan with safety, care, and comfort. We use modern techniques, natural products, and personalized treatments to reduce stress, improve health, and nourish the skin. Every session is designed to refresh both body and mind.', 'luxury-spa-gulshan' ); ?></p>
          <h3><?php esc_html_e( 'Wellness & Care', 'luxury-spa-gulshan' ); ?></h3>
          <p><?php esc_html_e( 'We believe true wellness includes body, mind, and skin. Our treatments help reduce stress, improve blood circulation, boost energy, and support overall health. Guests leave feeling lighter, calmer, and more focused.', 'luxury-spa-gulshan' ); ?></p>
        </div>
      </div>

      <!-- Right: skills / progress -->
      <div>
        <div class="lsg-card" style="padding:2rem;">
          <div class="lsg-card__body" style="padding:0;">
            <span class="lsg-eyebrow"><?php esc_html_e( 'Our Expertise', 'luxury-spa-gulshan' ); ?></span>
            <h3 class="lsg-heading lsg-heading--sm" style="margin-bottom:1.75rem;"><?php esc_html_e( 'Skill & Specialisations', 'luxury-spa-gulshan' ); ?></h3>

            <?php
            $skills = array(
                array( 'label' => __( 'Relaxation Massage', 'luxury-spa-gulshan' ), 'pct' => 95 ),
                array( 'label' => __( 'Therapeutic Treatments', 'luxury-spa-gulshan' ), 'pct' => 93 ),
                array( 'label' => __( 'Deep Tissue Massage', 'luxury-spa-gulshan' ), 'pct' => 98 ),
                array( 'label' => __( 'Skin & Body Care', 'luxury-spa-gulshan' ), 'pct' => 90 ),
            );
            foreach ( $skills as $skill ) : ?>
            <div class="lsg-progress">
              <div class="lsg-progress__label">
                <span><?php echo esc_html( $skill['label'] ); ?></span>
                <span><?php echo absint( $skill['pct'] ); ?>%</span>
              </div>
              <div class="lsg-progress__bar">
                <div class="lsg-progress__fill" data-width="<?php echo absint( $skill['pct'] ); ?>"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Contact quick info -->
        <div class="lsg-card" style="margin-top:1.5rem;">
          <div class="lsg-card__body">
            <h3 style="margin:0 0 1rem;font-size:1rem;"><?php esc_html_e( 'Visit Us', 'luxury-spa-gulshan' ); ?></h3>
            <p class="lsg-card__meta">📍 <?php esc_html_e( 'House 91-B, Road 24, Gulshan-1, Dhaka 1212', 'luxury-spa-gulshan' ); ?></p>
            <p class="lsg-card__meta">📞 <a href="tel:+8801891450300">+880 1891 450300</a></p>
            <p class="lsg-card__meta">📧 <a href="mailto:luxuryspadacca@gmail.com">luxuryspadacca@gmail.com</a></p>
            <p class="lsg-card__meta">🕘 <?php esc_html_e( 'Sat – Fri · 9 AM – 11 PM', 'luxury-spa-gulshan' ); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="lsg-section" style="background:var(--lsg-surface);">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Why Choose Us', 'luxury-spa-gulshan' ); ?></span>
    <h2 class="lsg-heading"><?php esc_html_e( 'Why Choose Luxury Spa Gulshan?', 'luxury-spa-gulshan' ); ?></h2>
    <div class="about-why">
      <div class="about-why__item"><div class="about-why__icon">📍</div><div class="about-why__text"><h4><?php esc_html_e( 'Prime Location', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Easy to reach from anywhere in Dhaka.', 'luxury-spa-gulshan' ); ?></p></div></div>
      <div class="about-why__item"><div class="about-why__icon">🛡️</div><div class="about-why__text"><h4><?php esc_html_e( 'Private Rooms', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Full comfort and privacy in every session.', 'luxury-spa-gulshan' ); ?></p></div></div>
      <div class="about-why__item"><div class="about-why__icon">💆</div><div class="about-why__text"><h4><?php esc_html_e( 'Expert Therapists', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Trained and experienced professionals.', 'luxury-spa-gulshan' ); ?></p></div></div>
      <div class="about-why__item"><div class="about-why__icon">✅</div><div class="about-why__text"><h4><?php esc_html_e( 'High Standards', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Rigorous hygiene and safety protocols.', 'luxury-spa-gulshan' ); ?></p></div></div>
      <div class="about-why__item"><div class="about-why__icon">🌿</div><div class="about-why__text"><h4><?php esc_html_e( 'Natural Products', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Quality oils, masks, and treatments.', 'luxury-spa-gulshan' ); ?></p></div></div>
      <div class="about-why__item"><div class="about-why__icon">😌</div><div class="about-why__text"><h4><?php esc_html_e( 'Calm Atmosphere', 'luxury-spa-gulshan' ); ?></h4><p><?php esc_html_e( 'Soft music, scents, and relaxing spaces.', 'luxury-spa-gulshan' ); ?></p></div></div>
    </div>
  </div>
</section>

<!-- OUR SERVICES LIST -->
<section class="lsg-section">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'What We Offer', 'luxury-spa-gulshan' ); ?></span>
    <h2 class="lsg-heading"><?php esc_html_e( 'Our Spa Services', 'luxury-spa-gulshan' ); ?></h2>
    <p class="lsg-lead" style="margin-bottom:2rem;"><?php esc_html_e( 'A wide range of professional spa and massage services — each designed to relax the body, calm the mind, and improve overall wellness.', 'luxury-spa-gulshan' ); ?></p>
    <div class="about-services-list">
      <?php
      $services_map = array(
          '/services/aroma-oil-massage/'        => __( 'Aroma Oil Massage', 'luxury-spa-gulshan' ),
          '/services/nuru-massage/'             => __( 'Nuru Massage', 'luxury-spa-gulshan' ),
          '/services/body-scrub-with-facial/'   => __( 'Body Scrub with Facial', 'luxury-spa-gulshan' ),
          '/services/deep-tissue-massage/'      => __( 'Deep Tissue Massage', 'luxury-spa-gulshan' ),
          '/services/dry-massage/'              => __( 'Dry Massage', 'luxury-spa-gulshan' ),
          '/services/four-hand-massage/'        => __( 'Four Hand Massage', 'luxury-spa-gulshan' ),
          '/services/sensual-massage/'          => __( 'Sensual Massage', 'luxury-spa-gulshan' ),
          '/services/female-to-male-spa/'       => __( 'Female to Male Spa', 'luxury-spa-gulshan' ),
          '/services/body-to-body-massage/'     => __( 'Body to Body Massage', 'luxury-spa-gulshan' ),
          '/services/full-body-massage/'        => __( 'Full Body Massage', 'luxury-spa-gulshan' ),
          '/services/special-massage/'          => __( 'Special Massage', 'luxury-spa-gulshan' ),
          '/services/back-and-shoulder-massage/' => __( 'Back and Shoulder Massage', 'luxury-spa-gulshan' ),
          '/services/thai-massage/'             => __( 'Thai Massage', 'luxury-spa-gulshan' ),
      );
      foreach ( $services_map as $path => $label ) : ?>
      <a href="<?php echo esc_url( home_url( $path ) ); ?>"><?php echo esc_html( $label ); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Ready to Visit Us?', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Even one visit improves your stress levels, energy, and overall wellness. Book your session today.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
