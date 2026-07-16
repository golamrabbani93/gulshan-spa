<?php
/**
 * Template Name: Privacy Policy
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<style>
.privpol-hero { background:var(--lsg-surface); border-bottom:1px solid var(--lsg-border); }
.privpol-layout { display:grid; grid-template-columns:220px 1fr; gap:3rem; align-items:start; }
.privpol-toc {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
    padding:1.5rem;
    position:sticky;
    top:90px;
}
.privpol-toc h3 { margin:0 0 1rem;font-size:.85rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--lsg-muted); }
.privpol-toc ol { margin:0;padding:0 0 0 1.1rem;display:grid;gap:.5rem; }
.privpol-toc a { font-size:.87rem;color:var(--lsg-muted);transition:color var(--lsg-transition); }
.privpol-toc a:hover { color:var(--lsg-accent); }
@media(max-width:860px){ .privpol-layout { grid-template-columns:1fr; } .privpol-toc { position:static; } }
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section privpol-hero">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Legal', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading"><?php the_title(); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'How we collect, use, and protect your personal data when you use our website and services.', 'luxury-spa-gulshan' ); ?></p>
  </div>
</section>

<section class="lsg-section">
  <div class="lsg-container">
    <div class="privpol-layout">

      <!-- TOC -->
      <aside class="privpol-toc">
        <h3><?php esc_html_e( 'Sections', 'luxury-spa-gulshan' ); ?></h3>
        <ol>
          <li><a href="#pp-1"><?php esc_html_e( '1. Introduction', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-2"><?php esc_html_e( '2. Data Collected', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-3"><?php esc_html_e( '3. Embedded Content', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-4"><?php esc_html_e( '4. Cookies', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-5"><?php esc_html_e( '5. Data Access', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-6"><?php esc_html_e( '6. Third Parties', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-7"><?php esc_html_e( '7. Retention', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-8"><?php esc_html_e( '8. Security', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-9"><?php esc_html_e( '9. Your Rights', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-10"><?php esc_html_e( '10. Third-Party Sites', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="#pp-11"><?php esc_html_e( '11. Legal Disclosure', 'luxury-spa-gulshan' ); ?></a></li>
        </ol>
      </aside>

      <!-- Content -->
      <article class="lsg-prose">
        <h2 id="pp-1"><?php esc_html_e( '1. Introduction', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Luxury Spa Gulshan ("we", "our", "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and protect personal information you provide when using our website (luxuryspagulshan.com) and related services. Please read this policy carefully before submitting any personal data.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-2"><?php esc_html_e( '2. Data Collected', 'luxury-spa-gulshan' ); ?></h2>
        <h3><?php esc_html_e( 'Registration Data', 'luxury-spa-gulshan' ); ?></h3>
        <p><?php esc_html_e( 'If you register on our website, we store your username, email address, and any profile information you provide. You can view, edit, or delete this information at any time.', 'luxury-spa-gulshan' ); ?></p>
        <h3><?php esc_html_e( 'Contact Form Data', 'luxury-spa-gulshan' ); ?></h3>
        <p><?php esc_html_e( 'Contact form submissions are sent to our company email. These are used only for customer service and booking responses, and are not used for marketing purposes.', 'luxury-spa-gulshan' ); ?></p>
        <h3><?php esc_html_e( 'Comments', 'luxury-spa-gulshan' ); ?></h3>
        <p><?php esc_html_e( 'When you leave a comment, we collect the data shown in the comment form plus your IP address and browser user agent string to help spam detection.', 'luxury-spa-gulshan' ); ?></p>
        <h3><?php esc_html_e( 'Analytics Data', 'luxury-spa-gulshan' ); ?></h3>
        <p><?php esc_html_e( 'We may use Google Analytics for anonymous reporting of website usage. You may opt out via Google Analytics Opt-out Browser Add-on at any time.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-3"><?php esc_html_e( '3. Embedded Content', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Embedded content from other websites (e.g., Google Maps, YouTube) behaves in the same way as if you visited those websites directly. These sites may collect data about you, use cookies, and track your interaction with the embedded content.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-4"><?php esc_html_e( '4. Cookies', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'We use cookies to improve your browsing experience and store session information.', 'luxury-spa-gulshan' ); ?></p>
        <ul>
          <li><strong>PHPSESSID:</strong> <?php esc_html_e( 'Used to identify your unique session on the website.', 'luxury-spa-gulshan' ); ?></li>
          <li><strong>wordpress_*:</strong> <?php esc_html_e( 'Used when you log in to WordPress. Cleared on browser close.', 'luxury-spa-gulshan' ); ?></li>
        </ul>

        <h2 id="pp-5"><?php esc_html_e( '5. Who Has Access To Your Data', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Registered users may have their personal information accessed by administrators when required to provide customer support. We do not sell or rent personal data to any third party.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-6"><?php esc_html_e( '6. Third Party Access to Your Data', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'We do not share your personal data with third parties except as required to deliver core website services such as payment processing and booking confirmation. All third-party processors are required to comply with applicable data protection laws.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-7"><?php esc_html_e( '7. How Long We Retain Your Data', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Comment metadata and contact form data are retained until you request removal. Registered account data remains stored until your account is deleted. You may request deletion at any time by contacting us.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-8"><?php esc_html_e( '8. Security Measures', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'We use SSL/HTTPS encryption for all data transmission. Our hosting environment maintains server-level security and regular updates. We take appropriate technical and organisational steps to protect your data.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-9"><?php esc_html_e( '9. Your Data Rights', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'You have the right to request a copy of the personal data we hold about you, to request correction of inaccurate data, and to request erasure of your data subject to legal retention requirements. To exercise any of these rights, contact us at luxuryspadacca@gmail.com.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-10"><?php esc_html_e( '10. Third-Party Websites', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Our website may contain links to external websites. This Privacy Policy does not apply to those sites. We encourage you to review the privacy policy of any third-party site you visit through links on our website.', 'luxury-spa-gulshan' ); ?></p>

        <h2 id="pp-11"><?php esc_html_e( '11. Release of Your Data for Legal Purposes', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'We may disclose your personal information where required by law, subpoena, or other legal process, or when we believe in good faith that disclosure is necessary to protect our rights, protect your safety or the safety of others, investigate fraud, or respond to a government request.', 'luxury-spa-gulshan' ); ?></p>

        <p style="border-top:1px solid var(--lsg-border);padding-top:1.25rem;margin-top:2rem;font-size:.87rem;color:var(--lsg-muted);">
          <?php printf( esc_html__( 'Last updated: %s', 'luxury-spa-gulshan' ), esc_html( gmdate( 'F j, Y' ) ) ); ?>
        </p>
      </article>
    </div>
  </div>
</section>

<?php get_footer(); ?>
