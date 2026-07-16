<?php
/**
 * Footer — Luxury Spa Gulshan Child
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
</main><!-- #lsg-main -->

<?php
if ( function_exists( 'lsg_render_visit_map_section' ) && ! is_page( 'contacts' ) ) {
    lsg_render_visit_map_section();
}
?>

<!-- ============================================================
     SITE FOOTER
     ============================================================ -->
<footer class="lsg-footer" role="contentinfo">
  <div class="lsg-container">
    <div class="lsg-footer__widgets">

      <!-- Brand column -->
      <div class="lsg-footer__col">
        <div class="lsg-footer__logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> — <?php esc_html_e( 'Home', 'luxury-spa-gulshan' ); ?>">
            <img
              src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Logo-luxury-spa-gulshan.png' ); ?>"
              alt="<?php bloginfo( 'name' ); ?>"
              width="180"
              height="65"
              loading="lazy"
            >
          </a>
        </div>
        <p class="lsg-footer__tagline"><?php esc_html_e( 'Premium spa experiences in the heart of Gulshan, Dhaka. Skilled therapists, natural products, and calm private spaces for total relaxation.', 'luxury-spa-gulshan' ); ?></p>
      </div>

      <!-- Quick Links -->
      <div class="lsg-footer__col">
        <h4><?php esc_html_e( 'Quick Links', 'luxury-spa-gulshan' ); ?></h4>
        <ul class="lsg-footer__links">
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Our Services', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/our-pricing/' ) ); ?>"><?php esc_html_e( 'Pricing', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Contact', 'luxury-spa-gulshan' ); ?></a></li>
        </ul>
      </div>

      <!-- Services -->
      <div class="lsg-footer__col">
        <h4><?php esc_html_e( 'Our Services', 'luxury-spa-gulshan' ); ?></h4>
        <ul class="lsg-footer__links">
          <li><a href="<?php echo esc_url( home_url( '/services/aroma-oil-massage/' ) ); ?>"><?php esc_html_e( 'Aroma Oil Massage', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/deep-tissue-massage/' ) ); ?>"><?php esc_html_e( 'Deep Tissue Massage', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/full-body-massage/' ) ); ?>"><?php esc_html_e( 'Full Body Massage', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/four-hand-massage/' ) ); ?>"><?php esc_html_e( 'Four Hand Massage', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/thai-massage/' ) ); ?>"><?php esc_html_e( 'Thai Massage', 'luxury-spa-gulshan' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/nuru-massage/' ) ); ?>"><?php esc_html_e( 'Nuru Massage', 'luxury-spa-gulshan' ); ?></a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="lsg-footer__col">
        <h4><?php esc_html_e( 'Contact Us', 'luxury-spa-gulshan' ); ?></h4>
        <ul class="lsg-footer__contact">
          <li><?php esc_html_e( 'House 91-B, Road 24, Gulshan-1', 'luxury-spa-gulshan' ); ?></li>
          <li><?php esc_html_e( 'Dhaka 1212, Bangladesh', 'luxury-spa-gulshan' ); ?></li>
          <li><a href="tel:+8801891450300">+880 1891 450300</a></li>
          <li><a href="mailto:luxuryspadacca@gmail.com">luxuryspadacca@gmail.com</a></li>
          <li style="margin-top:.5rem;color:rgba(255,250,242,.6);font-size:.85rem;"><?php esc_html_e( 'Sat – Fri · 9 AM – 11 PM', 'luxury-spa-gulshan' ); ?></li>
        </ul>
      </div>

    </div><!-- .lsg-footer__widgets -->

    <div class="lsg-footer__bottom">
      <p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'All rights reserved.', 'luxury-spa-gulshan' ); ?></p>
      <p>
        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'luxury-spa-gulshan' ); ?></a>
      </p>
    </div>

  </div><!-- .lsg-container -->
</footer>

<?php wp_footer(); ?>

<!-- ============================================================
     JAVASCRIPT — loaded last for fastest render
     ============================================================ -->
<script>
(function () {
    'use strict';

    /* --- Sticky header shadow on scroll --- */
    var header = document.getElementById('lsg-header');
    if (header) {
        var onScroll = function () {
            header.classList.toggle('scrolled', window.scrollY > 10);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* --- Mobile menu toggle --- */
    var toggle    = document.querySelector('.lsg-menu-toggle');
    var mobileNav = document.getElementById('lsg-mobile-nav');

    if (toggle && mobileNav) {
        toggle.addEventListener('click', function () {
            var open = mobileNav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            mobileNav.setAttribute('aria-hidden', open ? 'false' : 'true');
            document.body.style.overflow = open ? 'hidden' : '';
        });

        /* Close on Escape key */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
                mobileNav.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                mobileNav.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                toggle.focus();
            }
        });

        /* Close when clicking outside */
        document.addEventListener('click', function (e) {
            if (mobileNav.classList.contains('open')
                && !mobileNav.contains(e.target)
                && !toggle.contains(e.target)) {
                mobileNav.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                mobileNav.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        });

        /* Mobile sub-menu accordion */
        var subItems = mobileNav.querySelectorAll('.menu-item-has-children > a');
        subItems.forEach(function (link) {
            link.addEventListener('click', function (e) {
                var parent = this.parentElement;
                if (parent.querySelector('.sub-menu')) {
                    e.preventDefault();
                    parent.classList.toggle('open');
                }
            });
        });
    }

    /* --- Progress bar animation (About page) --- */
    var fills = document.querySelectorAll('.lsg-progress__fill[data-width]');
    if (fills.length) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.width = entry.target.getAttribute('data-width') + '%';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        fills.forEach(function (el) { observer.observe(el); });
    }

})();
</script>
</body>
</html>