<?php
/**
 * Template Name: Service Detail
 *
 * Shared layout for all individual service pages.
 * Each service template in /templates/ includes this file.
 *
 * Meta fields read from WP admin meta box (set in functions.php):
 *  - service_price
 *  - service_promo_price
 *  - service_duration
 *  - service_short_benefit
 *  - service_category
 *  - service_popular
 *  - service_booking_cta
 *  - service_booking_link
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) : the_post();

$price         = get_post_meta( get_the_ID(), 'service_price', true );
$promo         = get_post_meta( get_the_ID(), 'service_promo_price', true );
$duration      = get_post_meta( get_the_ID(), 'service_duration', true );
$short_benefit = get_post_meta( get_the_ID(), 'service_short_benefit', true );
$category      = get_post_meta( get_the_ID(), 'service_category', true );
$popular       = get_post_meta( get_the_ID(), 'service_popular', true );
$booking_cta   = get_post_meta( get_the_ID(), 'service_booking_cta', true ) ?: __( 'Book Now', 'luxury-spa-gulshan' );
$booking_link  = get_post_meta( get_the_ID(), 'service_booking_link', true ) ?: 'tel:+8801891450300';
$hero_image    = get_the_post_thumbnail_url( get_the_ID(), 'full' );

$display_price = $promo ?: ( $price ?: __( 'Contact for price', 'luxury-spa-gulshan' ) );
$hero_description = $short_benefit;
if ( '' === trim( $hero_description ) ) {
    $hero_description = get_the_excerpt();
}
if ( '' === trim( $hero_description ) ) {
    $hero_description = wp_trim_words( wp_strip_all_tags( get_the_content() ), 30, '...' );
}
$hero_bg_style = $hero_image
    ? 'background-image:url(' . esc_url( $hero_image ) . ');background-size:cover;background-position:center;'
    : '';
?>

<style>
.svc-hero {
    min-height:clamp(460px,62vw,680px);
    padding-block:clamp(5rem,10vw,7.5rem);
    position:relative;
    overflow:hidden;
    display:flex;
    align-items:center;
    background-color:#2f281f;
}
.svc-hero::after {
    content:'';position:absolute;inset:0;
    background:
        linear-gradient(90deg,rgba(37,31,24,.86) 0%,rgba(37,31,24,.52) 46%,rgba(37,31,24,.18) 100%),
        linear-gradient(180deg,rgba(37,31,24,.18) 0%,rgba(37,31,24,.34) 100%);
    z-index:0;
}
.svc-hero .lsg-container { position:relative;z-index:1; }
.svc-hero__content {
    max-width:760px;
    padding:clamp(1.5rem,3vw,2.5rem);
    border:1px solid rgba(255,255,255,.18);
    border-radius:var(--lsg-radius-xl);
    background:linear-gradient(135deg,rgba(38,31,25,.76),rgba(38,31,25,.48));
    box-shadow:0 24px 70px rgba(0,0,0,.24);
    backdrop-filter:blur(5px);
}
.svc-hero__content .lsg-heading {
    color:#fff;
    text-shadow:0 2px 18px rgba(0,0,0,.28);
}
.svc-hero__content .lsg-lead {
    max-width:620px;
    color:rgba(255,250,242,.86);
}
.svc-hero__content .lsg-eyebrow {
    color:#f3c978;
}
.svc-meta-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:1.25rem;
    margin:2rem 0;
}
.svc-meta-card {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
    padding:1.25rem 1.5rem;
    text-align:center;
}
.svc-meta-card__label {
    font-size:.78rem;
    font-weight:700;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:var(--lsg-muted);
    margin-bottom:.4rem;
}
.svc-meta-card__value {
    font-size:1.25rem;
    font-weight:700;
    color:var(--lsg-accent);
}
.svc-breadcrumb {
    width:max-content;
    max-width:100%;
    display:flex;
    align-items:center;
    flex-wrap:wrap;
    gap:.5rem;
    font-size:.85rem;
    color:rgba(255,250,242,.74);
    margin-bottom:1.5rem;
    padding:.55rem .85rem;
    border:1px solid rgba(255,255,255,.18);
    border-radius:999px;
    background:rgba(20,16,13,.36);
    backdrop-filter:blur(4px);
}
.svc-breadcrumb a { color:rgba(255,250,242,.82); }
.svc-breadcrumb a:hover { color:#f3c978; }
.svc-breadcrumb__sep { opacity:.55; }
.svc-action-list {
    display:grid;
    gap:.75rem;
}
.svc-action-list .lsg-btn,
.svc-action-list .lsg-btn-outline {
    width:100%;
    justify-content:center;
}
.svc-action-list__whatsapp {
    background:#25D366;
    color:#fff;
    border-color:#25D366;
}
.svc-action-list__whatsapp:hover {
    background:#1fb95a;
    border-color:#1fb95a;
    color:#fff;
}
.svc-action-list__telegram {
    background:#229ED9;
    color:#fff;
    border-color:#229ED9;
}
.svc-action-list__telegram:hover {
    background:#168ac1;
    border-color:#168ac1;
    color:#fff;
}
@media(max-width:720px){
    .svc-hero {
        min-height:auto;
        padding-block:4rem;
    }
    .svc-hero::after {
        background:linear-gradient(180deg,rgba(37,31,24,.82) 0%,rgba(37,31,24,.62) 100%);
    }
    .svc-hero__content {
        padding:1.35rem;
    }
}
</style>

<!-- HERO -->
<section class="svc-hero" style="<?php echo esc_attr( $hero_bg_style ); ?>">
  <div class="lsg-container">
    <!-- Breadcrumb -->
    <nav class="svc-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luxury-spa-gulshan' ); ?>">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxury-spa-gulshan' ); ?></a>
      <span class="svc-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
      <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'luxury-spa-gulshan' ); ?></a>
      <span class="svc-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
      <span aria-current="page"><?php the_title(); ?></span>
    </nav>

    <div class="svc-hero__content">
      <?php if ( $category ) : ?>
      <span class="lsg-eyebrow"><?php echo esc_html( $category ); ?></span>
      <?php endif; ?>
      <h1 class="lsg-heading lsg-heading--hero"><?php the_title(); ?></h1>
      <?php if ( $hero_description ) : ?>
      <p class="lsg-lead"><?php echo esc_html( $hero_description ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- META CARDS -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="svc-meta-grid">
      <div class="svc-meta-card">
        <div class="svc-meta-card__label"><?php esc_html_e( 'Duration', 'luxury-spa-gulshan' ); ?></div>
        <div class="svc-meta-card__value"><?php echo esc_html( $duration ?: '60 min' ); ?></div>
      </div>
      <div class="svc-meta-card">
        <div class="svc-meta-card__label"><?php echo $promo ? esc_html__( 'Promo Price', 'luxury-spa-gulshan' ) : esc_html__( 'Starting From', 'luxury-spa-gulshan' ); ?></div>
        <div class="svc-meta-card__value"><?php echo esc_html( $display_price ); ?></div>
      </div>
      <?php if ( $popular ) : ?>
      <div class="svc-meta-card">
        <div class="svc-meta-card__label"><?php esc_html_e( 'Status', 'luxury-spa-gulshan' ); ?></div>
        <div class="svc-meta-card__value"><span class="lsg-badge"><?php esc_html_e( 'Featured', 'luxury-spa-gulshan' ); ?></span></div>
      </div>
      <?php endif; ?>
      <div class="svc-meta-card">
        <div class="svc-meta-card__label"><?php esc_html_e( 'Booking', 'luxury-spa-gulshan' ); ?></div>
        <div class="svc-meta-card__value"><a class="lsg-btn lsg-btn--sm" href="<?php echo esc_url( $booking_link ); ?>"><?php echo esc_html( $booking_cta ); ?></a></div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-grid lsg-grid--2" style="align-items:start;">
      <article class="lsg-prose" style="max-width:none;">
        <?php the_content(); ?>
      </article>
      <aside style="display:grid;gap:1.25rem;position:sticky;top:90px;">
        <!-- Booking card -->
        <div class="lsg-card" style="border-radius:var(--lsg-radius-lg);overflow:visible;">
          <div class="lsg-card__body">
            <h3 style="margin:0 0 .75rem;"><?php esc_html_e( 'Book This Service', 'luxury-spa-gulshan' ); ?></h3>
            <p style="color:var(--lsg-muted);font-size:.92rem;margin:0 0 1.25rem;"><?php esc_html_e( 'Call us directly or send a message for availability and scheduling.', 'luxury-spa-gulshan' ); ?></p>
            <div class="svc-action-list">
              <a class="lsg-btn" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Send a Message', 'luxury-spa-gulshan' ); ?></a>
              <a class="lsg-btn-outline" href="tel:+8801891450300"><?php esc_html_e( 'Call Now', 'luxury-spa-gulshan' ); ?></a>
              <a class="lsg-btn-outline svc-action-list__whatsapp" href="https://wa.me/+8801891450300" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Message on WhatsApp', 'luxury-spa-gulshan' ); ?></a>
              <a class="lsg-btn-outline svc-action-list__telegram" href="https://t.me/+YzDcAo35iCFmMzhl" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Message on Telegram', 'luxury-spa-gulshan' ); ?></a>
            </div>
            <?php if ( $price || $promo ) : ?>
            <div style="border-top:1px solid var(--lsg-border);margin-top:1.25rem;padding-top:1.25rem;">
              <div style="display:flex;justify-content:space-between;font-size:.9rem;">
                <span style="color:var(--lsg-muted);"><?php esc_html_e( 'Starting from', 'luxury-spa-gulshan' ); ?></span>
                <strong style="color:var(--lsg-accent);"><?php echo esc_html( $display_price ); ?></strong>
              </div>
              <?php if ( $duration ) : ?>
              <div style="display:flex;justify-content:space-between;font-size:.9rem;margin-top:.5rem;">
                <span style="color:var(--lsg-muted);"><?php esc_html_e( 'Session length', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo esc_html( $duration ); ?></strong>
              </div>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <!-- Contact info card -->
        <div class="lsg-card">
          <div class="lsg-card__body">
            <h3 style="margin:0 0 .75rem;font-size:1rem;"><?php esc_html_e( 'Contact', 'luxury-spa-gulshan' ); ?></h3>
            <p style="color:var(--lsg-muted);font-size:.88rem;margin:.25rem 0;">📍 <?php esc_html_e( 'House 91-B, Road 24, Gulshan-1, Dhaka', 'luxury-spa-gulshan' ); ?></p>
            <p style="color:var(--lsg-muted);font-size:.88rem;margin:.25rem 0;">📞 <a href="tel:+8801891450300">+880 1891 450300</a></p>
            <p style="color:var(--lsg-muted);font-size:.88rem;margin:.25rem 0;">🕘 <?php esc_html_e( 'Sat – Fri · 9 AM – 11 PM', 'luxury-spa-gulshan' ); ?></p>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- RELATED SERVICES -->
<?php
$services_page    = get_page_by_path( 'services' );
$current_id       = get_the_ID();
$related_services = array();
if ( $services_page ) {
    $all_services = get_pages( array(
        'post_parent' => $services_page->ID,
        'sort_column' => 'menu_order',
        'sort_order'  => 'ASC',
        'number'      => 7,
    ) );
    foreach ( $all_services as $svc ) {
        if ( (int) $svc->ID !== (int) $current_id ) {
            $related_services[] = $svc;
        }
    }
    $related_services = array_slice( $related_services, 0, 3 );
}
if ( $related_services ) : ?>
<section class="lsg-section" style="background:var(--lsg-surface);">
  <div class="lsg-container">
    <div class="lsg-section__header">
      <span class="lsg-eyebrow"><?php esc_html_e( 'Explore More', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading lsg-heading--sm"><?php esc_html_e( 'You May Also Like', 'luxury-spa-gulshan' ); ?></h2>
    </div>
    <div class="lsg-grid lsg-grid--3">
      <?php foreach ( $related_services as $svc ) :
        $img = get_the_post_thumbnail_url( $svc->ID, 'medium' );
        $prc = get_post_meta( $svc->ID, 'service_promo_price', true ) ?: get_post_meta( $svc->ID, 'service_price', true );
        $dur = get_post_meta( $svc->ID, 'service_duration', true );
      ?>
      <article class="lsg-card">
        <?php if ( $img ) : ?>
        <div class="lsg-card__img"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $svc->post_title ); ?>" loading="lazy"></div>
        <?php endif; ?>
        <div class="lsg-card__body">
          <h3 class="lsg-card__title"><?php echo esc_html( $svc->post_title ); ?></h3>
          <?php if ( $dur ) : ?><p class="lsg-card__meta">⏱ <?php echo esc_html( $dur ); ?></p><?php endif; ?>
          <?php if ( $prc ) : ?><p class="lsg-card__meta">💰 <?php echo esc_html( $prc ); ?></p><?php endif; ?>
          <a class="lsg-btn-outline lsg-btn--sm" href="<?php echo esc_url( get_permalink( $svc ) ); ?>"><?php esc_html_e( 'View Service', 'luxury-spa-gulshan' ); ?></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endwhile; ?>
<?php get_footer(); ?>