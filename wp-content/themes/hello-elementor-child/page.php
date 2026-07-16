<?php
/**
 * Default page fallback template.
 * Used for pages that have no custom template assigned.
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<section class="lsg-section" style="background:var(--lsg-surface);border-bottom:1px solid var(--lsg-border);">
  <div class="lsg-container">
    <h1 class="lsg-heading lsg-heading--hero"><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?>
    <p class="lsg-lead"><?php the_excerpt(); ?></p>
    <?php endif; ?>
  </div>
</section>
<section class="lsg-section">
  <div class="lsg-container">
    <article class="lsg-prose">
      <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
    </article>
  </div>
</section>
<?php get_footer(); ?>
