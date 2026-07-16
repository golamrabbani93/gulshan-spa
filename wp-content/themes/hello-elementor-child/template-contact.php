<?php
/**
 * Template Name: Contact
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<style>
.contact-hero { background:var(--lsg-surface); border-bottom:1px solid var(--lsg-border); }
.contact-layout {
    display:grid;
    grid-template-columns:1fr 1.4fr;
    gap:3rem;
    align-items:start;
}
.contact-info-cards { display:grid; gap:1.1rem; }
.contact-info-card {
    display:flex;
    align-items:flex-start;
    gap:1rem;
    padding:1.4rem;
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
}
.contact-info-card__icon {
    width:44px;height:44px;flex-shrink:0;
    background:var(--lsg-accent-soft);
    border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:1.2rem;
}
.contact-info-card__body h4 { margin:0 0 .3rem;font-size:.95rem; }
.contact-info-card__body p,
.contact-info-card__body a {
    margin:0;
    font-size:.9rem;
    color:var(--lsg-muted);
}
.contact-info-card__body a:hover { color:var(--lsg-accent); }
.contact-form-card {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-xl);
    padding:2.25rem;
    box-shadow:var(--lsg-shadow-md);
}
.contact-form-card h2 { margin:0 0 .5rem; }
.contact-form-card > p { color:var(--lsg-muted);font-size:.95rem;margin:0 0 1.75rem; }
.lsg-contact-notice {
    margin:0 0 1.25rem;
    padding:.9rem 1rem;
    border-radius:var(--lsg-radius-md);
    font-size:.92rem;
    font-weight:600;
}
.lsg-contact-notice--success {
    background:rgba(46,125,50,.1);
    border:1px solid rgba(46,125,50,.24);
    color:#2e7d32;
}
.lsg-contact-notice--error {
    background:rgba(198,40,40,.08);
    border:1px solid rgba(198,40,40,.22);
    color:#9f2f2f;
}
.lsg-hidden-field {
    position:absolute;
    left:-9999px;
    width:1px;
    height:1px;
    overflow:hidden;
}
@media(max-width:860px){
    .contact-layout { grid-template-columns:1fr; }
    .contact-form-card { padding:1.5rem; }
}
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section contact-hero">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Get in Touch', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading lsg-heading--hero"><?php esc_html_e( 'Contact Luxury Spa Gulshan', 'luxury-spa-gulshan' ); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'Have questions or want to book a session? Reach out and our team will get back to you with availability, recommendations, and booking support.', 'luxury-spa-gulshan' ); ?></p>
  </div>
</section>

<!-- MAIN CONTACT SECTION -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="contact-layout">

      <!-- Left: info cards -->
      <div class="contact-info-cards">
        <div class="contact-info-card">
          <div class="contact-info-card__icon">📍</div>
          <div class="contact-info-card__body">
            <h4><?php esc_html_e( 'Our Location', 'luxury-spa-gulshan' ); ?></h4>
            <p><?php esc_html_e( 'House 91-B, Road 24, Gulshan-1', 'luxury-spa-gulshan' ); ?></p>
            <p><?php esc_html_e( 'Dhaka 1212, Bangladesh', 'luxury-spa-gulshan' ); ?></p>
          </div>
        </div>
        <div class="contact-info-card">
          <div class="contact-info-card__icon">📞</div>
          <div class="contact-info-card__body">
            <h4><?php esc_html_e( 'Phone / WhatsApp', 'luxury-spa-gulshan' ); ?></h4>
            <a href="tel:+8801891450300">+880 1891 450300</a>
          </div>
        </div>
        <div class="contact-info-card">
          <div class="contact-info-card__icon">📧</div>
          <div class="contact-info-card__body">
            <h4><?php esc_html_e( 'Email', 'luxury-spa-gulshan' ); ?></h4>
            <a href="mailto:luxuryspadacca@gmail.com">luxuryspadacca@gmail.com</a>
          </div>
        </div>
        <div class="contact-info-card">
          <div class="contact-info-card__icon">🕘</div>
          <div class="contact-info-card__body">
            <h4><?php esc_html_e( 'Opening Hours', 'luxury-spa-gulshan' ); ?></h4>
            <p><?php esc_html_e( 'Saturday – Friday', 'luxury-spa-gulshan' ); ?></p>
            <p><?php esc_html_e( '9:00 AM – 11:00 PM', 'luxury-spa-gulshan' ); ?></p>
          </div>
        </div>

        <!-- Map embed -->
        <div class="lsg-map-wrap">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1825.5414347308824!2d90.4167573!3d23.7800632!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7ca6c3dd587%3A0xa97f652ca8e5e42!2sLuxury%20spa%20Gulshan!5e0!3m2!1sen!2sbd!4v1690442893477!5m2!1sen!2sbd"
            width="100%"
            height="260"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="<?php esc_attr_e( 'Luxury Spa Gulshan on Google Maps', 'luxury-spa-gulshan' ); ?>"
          ></iframe>
        </div>
      </div>

      <!-- Right: contact form -->
      <div class="contact-form-card">
        <h2><?php esc_html_e( 'Send Us a Message', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Fill in the form below and we will respond with availability and booking details.', 'luxury-spa-gulshan' ); ?></p>

        <?php
        $contact_status = isset( $_GET['lsg_contact_status'] ) ? sanitize_key( wp_unslash( $_GET['lsg_contact_status'] ) ) : '';
        if ( 'sent' === $contact_status ) :
            ?>
            <div class="lsg-contact-notice lsg-contact-notice--success"><?php esc_html_e( 'Thank you. Your message has been sent and our team will contact you soon.', 'luxury-spa-gulshan' ); ?></div>
            <?php
        elseif ( 'invalid' === $contact_status ) :
            ?>
            <div class="lsg-contact-notice lsg-contact-notice--error"><?php esc_html_e( 'Please complete the required fields with a valid email address.', 'luxury-spa-gulshan' ); ?></div>
            <?php
        elseif ( 'error' === $contact_status ) :
            ?>
            <div class="lsg-contact-notice lsg-contact-notice--error"><?php esc_html_e( 'Sorry, your message could not be submitted. Please call us directly or try again.', 'luxury-spa-gulshan' ); ?></div>
            <?php
        endif;

        lsg_render_native_contact_form();
        ?>
      </div>

    </div>
  </div>
</section>

<!-- CTA STRIP -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Prefer to call?', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Reach us directly on phone or WhatsApp for fastest booking confirmation.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="tel:+8801891450300">+880 1891 450300</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>