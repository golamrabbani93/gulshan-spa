<?php
/**
 * Template Name: Hand Spa
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$sections = array(
    array(
        'heading' => __( 'First Impressions Start With Soft Hands', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Soft hands feel calm. Smooth nails look neat. These details build confidence in both social and work settings. People notice hands during greetings, conversations, and exchanges of items. A clean and well-kept hand gives a warm impression. A hand spa helps maintain that impression with proper cleansing, massage, and moisture.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Skin Ages Fast Without Proper Care', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Hand skin ages fast. Sunlight, harsh soaps, and daily wear weaken the skin. Fine lines appear. Nails break easily. Dry patches form. A hand spa slows this process. Rich masks, soft scrubs, warm soaks, and nourishing oils refresh the skin. Hands stay young for longer.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Deep Moisture Strengthens the Skin', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Moisture forms the heart of hand care. A hand spa sends hydration deep into the skin. Many people use lotion at home, yet most of it stays on the surface. Spa treatments work deeper. Warm wraps open the skin. Oils reach deeper layers. Dry cracks soften. Skin feels balanced.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Hand Massage Reduces Stress', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Hand muscles carry hidden stress. Long hours of typing, cleaning, lifting, driving, and holding tools build tension. A massage melts this tension. Soft pressure around the fingers and palm increases blood flow. Warmth spreads through the hand. The grip feels lighter. Joints move with ease.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Clean Nails Improve Hygiene and Appearance', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Clean nails support hygiene and appearance. Dirt collects under nails during work and daily tasks. A hand spa clears this safely. Cuticles receive gentle care. Nails gain strength and shape. They break less. They look natural and neat. People in food service, beauty, health care, and retail feel more confident with clean nails.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Sensitive Skin Gains Relief', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Sensitive skin needs special care. Many people react to harsh soaps, chemicals, and heat. A hand spa uses gentle scrubs and calming oils. Redness fades. Itchiness reduces. The skin feels cool and balanced. People with eczema or allergy-prone skin find relief with simple, gentle treatments.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'A Hand Spa Creates a Peaceful Break', 'luxury-spa-gulshan' ),
        'copy'    => __( 'A hand spa creates a quiet break from a busy day. Warm water. Light scents. Calm touch. Simple moments like these bring peace. Stress drops. Breathing slows. Thoughts clear. People leave with better focus. A short hand spa can improve mood for the rest of the day.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Healthy Hands Improve Daily Work', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Daily work becomes easier with healthy hands. Moisturized skin bends without cracks. Strong nails handle tools better. Fingers move with comfort. People with office jobs type with ease. People who do outdoor work feel less pain from dry wind or rough materials.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Climate Shapes Hand Health', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Regional climate shapes hand health. Hot areas cause sweat buildup and irritation. Cold areas dry the skin and cause splits. Coastal areas add salt to the air which affects nails. A geo-optimized hand spa uses products that match these conditions. Hands stay balanced in every season.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Hydration Protects the Skin Barrier', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Hydration also protects the skin barrier. The outer layer of skin needs strength to block dust, dirt, and chemicals. A spa uses vitamins, oils, and masks that support this barrier. Strong skin stays smooth and less irritated. People feel more secure in public places, workplaces, and while traveling.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Routine Care Gives Long-Term Benefits', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Routine care gives long-term results. A hand spa schedule keeps hands stable. The skin stays soft from week to week. Nails remain clean and strong. Each session builds on the last. People feel proud of this small habit. It becomes a calm moment they look forward to.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Good Grooming Includes Hand Care', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Good grooming includes hands. Many people focus on hair, face, or clothes. Hands deserve equal care. A hand spa completes the entire look. Smooth skin and neat nails show attention to detail. This matters in job interviews, meetings, and social gatherings.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'A Hand Spa Benefits All Ages', 'luxury-spa-gulshan' ),
        'copy'    => __( 'A hand spa suits every age. Older adults gain relief from stiff joints and dryness. Students and young adults prevent early aging. Heavy labor eases tension in the fingers. Office workers reduce stress from tight grips and typing. A hand spa supports every life stage.', 'luxury-spa-gulshan' ),
    ),
    array(
        'heading' => __( 'Hands Deserve Attention and Care', 'luxury-spa-gulshan' ),
        'copy'    => __( 'Hands work non-stop. They grip, hold, type, carry, clean, and create. They show emotion. They offer support. They tell stories. A hand spa gives them the care they deserve. Soft skin. Strong nails. Relaxed muscles. Balanced moisture. These benefits improve daily life in small but powerful ways.', 'luxury-spa-gulshan' ),
    ),
);
?>

<style>
.handspa-hero { background:var(--lsg-surface); border-bottom:1px solid var(--lsg-border); }
.handspa-toc {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
    padding:1.5rem;
    position:sticky;
    top:90px;
    max-height:calc(100vh - 120px);
    overflow-y:auto;
}
.handspa-toc h3 { margin:0 0 1rem;font-size:.9rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--lsg-muted); }
.handspa-toc ol { margin:0;padding:0 0 0 1.2rem;display:grid;gap:.5rem; }
.handspa-toc ol li a { font-size:.88rem;color:var(--lsg-muted);transition:color var(--lsg-transition); }
.handspa-toc ol li a:hover { color:var(--lsg-accent); }
.handspa-layout { display:grid; grid-template-columns:240px 1fr; gap:3rem; align-items:start; }
@media(max-width:900px){ .handspa-layout { grid-template-columns:1fr; } .handspa-toc { position:static;max-height:none; } }
</style>

<!-- HERO -->
<section class="lsg-hero lsg-section handspa-hero">
  <div class="lsg-container">
    <span class="lsg-eyebrow"><?php esc_html_e( 'Specialist Service', 'luxury-spa-gulshan' ); ?></span>
    <h1 class="lsg-heading lsg-heading--hero"><?php esc_html_e( 'Hand Spa Treatment', 'luxury-spa-gulshan' ); ?></h1>
    <p class="lsg-lead"><?php esc_html_e( 'Healthy hands support daily tasks from morning to night. Our hand spa provides deep moisture, expert massage, and professional nail care for hands that feel refreshed and renewed.', 'luxury-spa-gulshan' ); ?></p>
    <div class="lsg-hero__actions">
      <a class="lsg-btn lsg-btn--lg" href="tel:+8801891450300"><?php esc_html_e( 'Book Hand Spa', 'luxury-spa-gulshan' ); ?></a>
      <a class="lsg-btn-outline lsg-btn--lg" href="<?php echo esc_url( home_url( '/our-pricing/' ) ); ?>"><?php esc_html_e( 'View Pricing', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<!-- CONTENT + TOC -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="handspa-layout">

      <!-- Table of contents -->
      <aside class="handspa-toc">
        <h3><?php esc_html_e( 'In This Guide', 'luxury-spa-gulshan' ); ?></h3>
        <ol>
          <?php foreach ( $sections as $i => $sec ) : ?>
          <li><a href="#handspa-<?php echo absint( $i + 1 ); ?>"><?php echo esc_html( $sec['heading'] ); ?></a></li>
          <?php endforeach; ?>
        </ol>
      </aside>

      <!-- Sections -->
      <div>
        <?php foreach ( $sections as $i => $sec ) : ?>
        <div class="lsg-content-block" id="handspa-<?php echo absint( $i + 1 ); ?>">
          <h2><?php echo esc_html( $sec['heading'] ); ?></h2>
          <p><?php echo esc_html( $sec['copy'] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- CTA -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Book a Hand Spa Session Today', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Experience the difference that expert hand care makes. Contact us to schedule your hand spa treatment.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
