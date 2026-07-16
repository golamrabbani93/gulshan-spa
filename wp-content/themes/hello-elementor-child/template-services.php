<?php
/**
 * Template Name: Services Archive
 *
 * Displays featured services first, then the complete service list.
 * Assign this template to the page with slug /services/.
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$services_page = get_page_by_path( 'services' );
$service_templates = array(
    'templates/aroma-oil-massage.php',
    'templates/back-and-shoulder-massage.php',
    'templates/body-scrub-with-facial.php',
    'templates/body-to-body-massage.php',
    'templates/deep-tissue-massage.php',
    'templates/dry-massage.php',
    'templates/female-to-male-spa.php',
    'templates/four-hand-massage.php',
    'templates/full-body-massage.php',
    'templates/nuru-massage.php',
    'templates/sensual-massage.php',
    'templates/special-massage.php',
    'templates/thai-massage.php',
    'template-service-detail.php',
);
$all_pages = get_posts( array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => array(
        'menu_order' => 'ASC',
        'title'      => 'ASC',
    ),
) );

$service_children = array();
foreach ( $all_pages as $page ) {
    $template = get_page_template_slug( $page );
    $is_services_archive = $services_page && (int) $page->ID === (int) $services_page->ID;
    $is_service_child = $services_page && (int) $page->post_parent === (int) $services_page->ID;
    $is_service_template = in_array( $template, $service_templates, true );
    $has_service_meta = get_post_meta( $page->ID, 'service_price', true )
        || get_post_meta( $page->ID, 'service_promo_price', true )
        || get_post_meta( $page->ID, 'service_duration', true )
        || get_post_meta( $page->ID, 'service_category', true );

    if ( ! $is_services_archive && ( $is_service_template || ( $is_service_child && $has_service_meta ) ) ) {
        $service_children[] = $page;
    }
}

$featured_services = array();
foreach ( $service_children as $service ) {
    if ( get_post_meta( $service->ID, 'service_popular', true ) ) {
        $featured_services[] = $service;
    }
}
$featured_services = array_slice( $featured_services, 0, 3 );
?>

<style>
.svcs-filter {
    display:flex;flex-wrap:wrap;gap:.6rem;
    margin-bottom:2.5rem;
}
.svcs-filter__btn {
    padding:.45rem 1.1rem;
    border-radius:999px;
    border:1.5px solid var(--lsg-border);
    background:#fff;
    font-size:.85rem;font-weight:600;
    cursor:pointer;
    transition:background var(--lsg-transition),border-color var(--lsg-transition),color var(--lsg-transition);
}
.svcs-filter__btn.active,
.svcs-filter__btn:hover {
    background:var(--lsg-accent);
    border-color:var(--lsg-accent);
    color:#fff;
}
.svcs-section-title {
    margin-bottom:2rem;
}
.svcs-section-title p {
    margin:.4rem 0 0;
    color:var(--lsg-muted);
    max-width:620px;
}
.svcs-featured {
    background:linear-gradient(135deg,var(--lsg-surface),#fff);
    border-bottom:1px solid var(--lsg-border);
}
.svcs-featured-grid .lsg-card {
    animation:svcsCardIn .7s ease both;
}
.svcs-featured-grid .lsg-card:nth-child(2) { animation-delay:.12s; }
.svcs-featured-grid .lsg-card:nth-child(3) { animation-delay:.24s; }
.svcs-featured-card {
    position:relative;
    overflow:hidden;
}
.svcs-featured-card::before {
    content:'';
    position:absolute;
    inset:0;
    border:1px solid rgba(180,145,90,.35);
    border-radius:inherit;
    pointer-events:none;
    z-index:2;
}
.svcs-featured-card .lsg-card__body {
    position:relative;
}
.svcs-featured-ribbon {
    position:absolute;
    top:1rem;
    right:1rem;
    z-index:3;
    background:var(--lsg-accent);
    color:#fff;
    border-radius:999px;
    padding:.35rem .85rem;
    font-size:.72rem;
    font-weight:800;
    letter-spacing:.08em;
    text-transform:uppercase;
    box-shadow:var(--lsg-shadow-sm);
}
@keyframes svcsCardIn {
    from { opacity:0; transform:translateY(22px); }
    to { opacity:1; transform:translateY(0); }
}
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section" style="background:var(--lsg-surface);border-bottom:1px solid var(--lsg-border);">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Premium Spa Treatments', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading lsg-heading--hero"><?php the_title(); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'Every therapy is designed for calm, clarity, and long-lasting relaxation. Choose your perfect treatment below.', 'luxury-spa-gulshan' ); ?></p>
  </div>
</section>

<?php if ( $featured_services ) : ?>
<!-- FEATURED SERVICES -->
<section class="lsg-section svcs-featured">
  <div class="lsg-container">
    <div class="svcs-section-title">
      <span class="lsg-eyebrow"><?php esc_html_e( 'Featured Services', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading"><?php esc_html_e( 'Most Requested Treatments', 'luxury-spa-gulshan' ); ?></h2>
      <p><?php esc_html_e( 'These selected services are highlighted for guests who want the most trusted spa experiences first.', 'luxury-spa-gulshan' ); ?></p>
    </div>
    <div class="lsg-grid lsg-grid--3 svcs-featured-grid">
      <?php foreach ( $featured_services as $service ) :
        $price      = get_post_meta( $service->ID, 'service_price', true );
        $promo      = get_post_meta( $service->ID, 'service_promo_price', true );
        $duration   = get_post_meta( $service->ID, 'service_duration', true );
        $excerpt    = $service->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $service->post_content ), 24 );
        $image      = get_the_post_thumbnail_url( $service->ID, 'large' );
        $display_price = $promo ?: ( $price ?: __( 'Contact for price', 'luxury-spa-gulshan' ) );
      ?>
      <article class="lsg-card svcs-featured-card">
        <span class="svcs-featured-ribbon"><?php esc_html_e( 'Featured', 'luxury-spa-gulshan' ); ?></span>
        <?php if ( $image ) : ?>
        <div class="lsg-card__img"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $service->post_title ); ?>" loading="lazy"></div>
        <?php endif; ?>
        <div class="lsg-card__body">
          <h2 class="lsg-card__title"><?php echo esc_html( $service->post_title ); ?></h2>
          <p class="lsg-card__desc"><?php echo esc_html( $excerpt ); ?></p>
          <p class="lsg-card__meta"><?php esc_html_e( 'Duration:', 'luxury-spa-gulshan' ); ?> <?php echo esc_html( $duration ?: '60 min' ); ?></p>
          <p class="lsg-card__meta"><?php esc_html_e( 'Price:', 'luxury-spa-gulshan' ); ?> <?php echo esc_html( $display_price ); ?></p>
          <a class="lsg-btn" href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php esc_html_e( 'View Service', 'luxury-spa-gulshan' ); ?></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ALL SERVICES GRID -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="svcs-section-title">
      <span class="lsg-eyebrow"><?php esc_html_e( 'All Services', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading"><?php esc_html_e( 'Explore Every Treatment', 'luxury-spa-gulshan' ); ?></h2>
      <p><?php esc_html_e( 'Browse the complete list of massage and spa services available at Luxury Spa Gulshan.', 'luxury-spa-gulshan' ); ?></p>
    </div>
    <?php if ( $service_children ) : ?>
    <div class="lsg-grid lsg-grid--3">
      <?php foreach ( $service_children as $service ) :
        $price      = get_post_meta( $service->ID, 'service_price', true );
        $promo      = get_post_meta( $service->ID, 'service_promo_price', true );
        $duration   = get_post_meta( $service->ID, 'service_duration', true );
        $popular    = get_post_meta( $service->ID, 'service_popular', true );
        $excerpt    = $service->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $service->post_content ), 24 );
        $image      = get_the_post_thumbnail_url( $service->ID, 'large' );
        $display_price = $promo ?: ( $price ?: __( 'Contact for price', 'luxury-spa-gulshan' ) );
      ?>
      <article class="lsg-card">
        <?php if ( $image ) : ?>
        <div class="lsg-card__img"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $service->post_title ); ?>" loading="lazy"></div>
        <?php endif; ?>
        <div class="lsg-card__body">
          <?php if ( $popular ) : ?><span class="lsg-badge"><?php esc_html_e( 'Popular', 'luxury-spa-gulshan' ); ?></span><?php endif; ?>
          <h2 class="lsg-card__title"><?php echo esc_html( $service->post_title ); ?></h2>
          <p class="lsg-card__desc"><?php echo esc_html( $excerpt ); ?></p>
          <p class="lsg-card__meta"><?php esc_html_e( 'Duration:', 'luxury-spa-gulshan' ); ?> <?php echo esc_html( $duration ?: '60 min' ); ?></p>
          <p class="lsg-card__meta"><?php esc_html_e( 'Price:', 'luxury-spa-gulshan' ); ?> <?php echo esc_html( $display_price ); ?></p>
          <a class="lsg-btn" href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php esc_html_e( 'View Service', 'luxury-spa-gulshan' ); ?></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
    <div class="lsg-prose">
      <p><?php esc_html_e( 'No service pages yet. Add child pages under the Services page in WordPress and assign the Service Detail template to each one.', 'luxury-spa-gulshan' ); ?></p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- CTA -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Not sure which service to choose?', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Call us or send a message. Our team will recommend the best treatment based on your needs and schedule.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Book Now', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>