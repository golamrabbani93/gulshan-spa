<?php
/**
 * Template Name: Blog Archive
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

$featured_query = new WP_Query( array(
    'posts_per_page'      => 1,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => false,
) );

$featured_id = 0;
if ( $featured_query->have_posts() ) {
    $featured_query->the_post();
    $featured_id = get_the_ID();
    wp_reset_postdata();
}

$posts_query = new WP_Query( array(
    'posts_per_page'      => 9,
    'post_status'         => 'publish',
    'paged'               => $paged,
    'post__not_in'        => $featured_id ? array( $featured_id ) : array(),
    'ignore_sticky_posts' => true,
) );
?>

<section class="lsg-hero lsg-blog-hero">
  <div class="lsg-container">
    <div class="lsg-blog-hero__inner">
      <div>
        <span class="lsg-eyebrow"><?php esc_html_e( 'Spa Journal', 'luxury-spa-gulshan' ); ?></span>
        <h1 class="lsg-heading lsg-heading--hero"><?php the_title(); ?></h1>
        <p class="lsg-lead"><?php esc_html_e( 'Wellness tips, treatment guides, and spa care insights from Luxury Spa Gulshan.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <div class="lsg-blog-hero__meta">
        <span><?php echo esc_html( wp_count_posts()->publish ); ?></span>
        <span><?php esc_html_e( 'Published Articles', 'luxury-spa-gulshan' ); ?></span>
      </div>
    </div>
  </div>
</section>

<?php if ( $featured_id ) : ?>
<section class="lsg-section">
  <div class="lsg-container">
    <?php
    $featured_query = new WP_Query( array(
        'p'         => $featured_id,
        'post_type' => 'post',
    ) );
    while ( $featured_query->have_posts() ) :
        $featured_query->the_post();
        $cats = get_the_category();
    ?>
    <article class="lsg-blog-featured">
      <a class="lsg-blog-featured__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail( 'large' ); ?>
        <?php endif; ?>
      </a>
      <div class="lsg-blog-featured__body">
        <?php if ( $cats ) : ?>
        <span class="lsg-badge"><?php echo esc_html( $cats[0]->name ); ?></span>
        <?php endif; ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="lsg-post-meta">
          <span><?php echo esc_html( get_the_date() ); ?></span>
          <span><?php echo esc_html( get_the_author() ); ?></span>
        </div>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 34 ) ); ?></p>
        <a class="lsg-btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read Featured Article', 'luxury-spa-gulshan' ); ?></a>
      </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<section class="lsg-section" style="background:var(--lsg-surface);">
  <div class="lsg-container">
    <div class="lsg-section__header">
      <span class="lsg-eyebrow"><?php esc_html_e( 'Latest Articles', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading"><?php esc_html_e( 'Wellness Reads', 'luxury-spa-gulshan' ); ?></h2>
    </div>

    <?php if ( $posts_query->have_posts() ) : ?>
    <div class="lsg-blog-grid">
      <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
      <?php $cats = get_the_category(); ?>
      <article class="lsg-blog-card">
        <a class="lsg-blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
          <?php endif; ?>
        </a>
        <div class="lsg-blog-card__body">
          <?php if ( $cats ) : ?>
          <span class="lsg-badge lsg-blog-card__category"><?php echo esc_html( $cats[0]->name ); ?></span>
          <?php endif; ?>
          <h2 class="lsg-blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="lsg-post-meta">
            <span><?php echo esc_html( get_the_date() ); ?></span>
            <span><?php echo esc_html( get_the_author() ); ?></span>
          </div>
          <p class="lsg-blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 24 ) ); ?></p>
          <div class="lsg-blog-card__foot">
            <span class="lsg-card__meta"><?php echo esc_html( ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) ); ?> <?php esc_html_e( 'min read', 'luxury-spa-gulshan' ); ?></span>
            <a class="lsg-btn-outline lsg-btn--sm" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'luxury-spa-gulshan' ); ?></a>
          </div>
        </div>
      </article>
      <?php endwhile; ?>
    </div>

    <?php if ( $posts_query->max_num_pages > 1 ) : ?>
    <nav class="lsg-pagination" aria-label="<?php esc_attr_e( 'Blog pagination', 'luxury-spa-gulshan' ); ?>">
      <?php
      echo paginate_links( array(
          'current'   => $paged,
          'total'     => $posts_query->max_num_pages,
          'prev_text' => esc_html__( 'Prev', 'luxury-spa-gulshan' ),
          'next_text' => esc_html__( 'Next', 'luxury-spa-gulshan' ),
      ) );
      ?>
    </nav>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php else : ?>
    <article class="lsg-prose">
      <p><?php esc_html_e( 'No blog posts are published yet. Add posts from the WordPress dashboard to display them here.', 'luxury-spa-gulshan' ); ?></p>
    </article>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>