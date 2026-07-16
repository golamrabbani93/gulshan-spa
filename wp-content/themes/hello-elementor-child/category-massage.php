<?php
/**
 * Category archive for Massage posts.
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<section class="lsg-hero lsg-blog-hero">
  <div class="lsg-container">
    <div class="lsg-blog-hero__inner">
      <div>
        <span class="lsg-eyebrow"><?php esc_html_e( 'Category', 'luxury-spa-gulshan' ); ?></span>
        <h1 class="lsg-heading lsg-heading--hero"><?php single_cat_title(); ?></h1>
        <?php if ( category_description() ) : ?>
        <p class="lsg-lead"><?php echo wp_kses_post( category_description() ); ?></p>
        <?php else : ?>
        <p class="lsg-lead"><?php esc_html_e( 'Massage guides, treatment benefits, and wellness advice from Luxury Spa Gulshan.', 'luxury-spa-gulshan' ); ?></p>
        <?php endif; ?>
      </div>
      <div class="lsg-blog-hero__meta">
        <span><?php echo esc_html( get_queried_object()->count ?? 0 ); ?></span>
        <span><?php esc_html_e( 'Category Posts', 'luxury-spa-gulshan' ); ?></span>
      </div>
    </div>
  </div>
</section>

<section class="lsg-section">
  <div class="lsg-container">
    <?php if ( have_posts() ) : ?>
    <div class="lsg-blog-grid">
      <?php while ( have_posts() ) : the_post(); ?>
      <article class="lsg-blog-card">
        <a class="lsg-blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
          <?php endif; ?>
        </a>
        <div class="lsg-blog-card__body">
          <span class="lsg-badge lsg-blog-card__category"><?php single_cat_title(); ?></span>
          <h2 class="lsg-blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="lsg-post-meta">
            <span><?php echo esc_html( get_the_date() ); ?></span>
            <span><?php echo esc_html( get_the_author() ); ?></span>
          </div>
          <p class="lsg-blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 24 ) ); ?></p>
          <div class="lsg-blog-card__foot">
            <span class="lsg-card__meta"><?php echo esc_html( max( 1, ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) ) ); ?> <?php esc_html_e( 'min read', 'luxury-spa-gulshan' ); ?></span>
            <a class="lsg-btn-outline lsg-btn--sm" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'luxury-spa-gulshan' ); ?></a>
          </div>
        </div>
      </article>
      <?php endwhile; ?>
    </div>

    <div class="lsg-pagination">
      <?php the_posts_pagination( array(
          'mid_size'  => 1,
          'prev_text' => esc_html__( 'Prev', 'luxury-spa-gulshan' ),
          'next_text' => esc_html__( 'Next', 'luxury-spa-gulshan' ),
      ) ); ?>
    </div>
    <?php else : ?>
    <article class="lsg-prose">
      <p><?php esc_html_e( 'No posts found in this category yet.', 'luxury-spa-gulshan' ); ?></p>
    </article>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>