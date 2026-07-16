<?php
/**
 * Single post template.
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
$cats       = get_the_category();
$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
$read_time  = max( 1, (int) ceil( $word_count / 220 ) );
?>

<section class="lsg-hero lsg-single-hero">
  <div class="lsg-container">
    <div class="lsg-single-hero__inner">
      <?php if ( $cats ) : ?>
      <span class="lsg-eyebrow"><?php echo esc_html( $cats[0]->name ); ?></span>
      <?php endif; ?>
      <h1 class="lsg-heading lsg-heading--hero"><?php the_title(); ?></h1>
      <div class="lsg-single-meta">
        <span><?php echo esc_html( get_the_date() ); ?></span>
        <span><?php echo esc_html( get_the_author() ); ?></span>
        <span><?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min read', 'luxury-spa-gulshan' ); ?></span>
        <span><?php comments_number( esc_html__( 'No comments', 'luxury-spa-gulshan' ), esc_html__( '1 comment', 'luxury-spa-gulshan' ), esc_html__( '% comments', 'luxury-spa-gulshan' ) ); ?></span>
      </div>
    </div>
  </div>
</section>

<?php if ( has_post_thumbnail() ) : ?>
<div class="lsg-container">
  <figure class="lsg-single-image">
    <?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
  </figure>
</div>
<?php endif; ?>

<section class="lsg-section">
  <div class="lsg-container">
    <div class="lsg-single-layout">
      <article class="lsg-single-article">
        <div class="lsg-prose">
          <?php the_content(); ?>

          <?php
          wp_link_pages( array(
              'before' => '<div class="lsg-pagination">',
              'after'  => '</div>',
          ) );
          ?>

          <?php if ( has_tag() ) : ?>
          <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid var(--lsg-border);">
            <?php the_tags( '<span class="lsg-badge">' . esc_html__( 'Tags', 'luxury-spa-gulshan' ) . '</span><div style="margin-top:.8rem;">', ', ', '</div>' ); ?>
          </div>
          <?php endif; ?>

          <?php
          $prev = get_previous_post();
          $next = get_next_post();
          if ( $prev || $next ) :
          ?>
          <nav class="lsg-single-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'luxury-spa-gulshan' ); ?>">
            <?php if ( $prev ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
              <span><?php esc_html_e( 'Previous Article', 'luxury-spa-gulshan' ); ?></span>
              <?php echo esc_html( wp_trim_words( $prev->post_title, 8 ) ); ?>
            </a>
            <?php endif; ?>
            <?php if ( $next ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next ) ); ?>">
              <span><?php esc_html_e( 'Next Article', 'luxury-spa-gulshan' ); ?></span>
              <?php echo esc_html( wp_trim_words( $next->post_title, 8 ) ); ?>
            </a>
            <?php endif; ?>
          </nav>
          <?php endif; ?>
        </div>

        <?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="lsg-prose" style="border-top:1px solid var(--lsg-border);">
          <?php comments_template(); ?>
        </div>
        <?php endif; ?>
      </article>

      <aside class="lsg-single-sidebar">
        <div class="lsg-sidebar-card">
          <h3><?php esc_html_e( 'Written by', 'luxury-spa-gulshan' ); ?></h3>
          <p><?php echo esc_html( get_the_author() ); ?></p>
          <a class="lsg-btn-outline lsg-btn--sm" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php esc_html_e( 'View Author Posts', 'luxury-spa-gulshan' ); ?></a>
        </div>

        <div class="lsg-sidebar-card lsg-sidebar-card--dark">
          <h3><?php esc_html_e( 'Book a Spa Session', 'luxury-spa-gulshan' ); ?></h3>
          <p><?php esc_html_e( 'Ready to relax in Gulshan? Send us a message and our team will confirm your appointment.', 'luxury-spa-gulshan' ); ?></p>
          <a class="lsg-btn" style="width:100%;" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"><?php esc_html_e( 'Book Now', 'luxury-spa-gulshan' ); ?></a>
        </div>

        <div class="lsg-sidebar-card">
          <h3><?php esc_html_e( 'Popular Services', 'luxury-spa-gulshan' ); ?></h3>
          <ul class="lsg-sidebar-links">
            <li><a href="<?php echo esc_url( home_url( '/services/full-body-massage/' ) ); ?>"><span><?php esc_html_e( 'Full Body Massage', 'luxury-spa-gulshan' ); ?></span><span>View</span></a></li>
            <li><a href="<?php echo esc_url( home_url( '/services/deep-tissue-massage/' ) ); ?>"><span><?php esc_html_e( 'Deep Tissue Massage', 'luxury-spa-gulshan' ); ?></span><span>View</span></a></li>
            <li><a href="<?php echo esc_url( home_url( '/services/aroma-oil-massage/' ) ); ?>"><span><?php esc_html_e( 'Aroma Oil Massage', 'luxury-spa-gulshan' ); ?></span><span>View</span></a></li>
            <li><a href="<?php echo esc_url( home_url( '/services/thai-massage/' ) ); ?>"><span><?php esc_html_e( 'Thai Massage', 'luxury-spa-gulshan' ); ?></span><span>View</span></a></li>
          </ul>
        </div>

        <?php
        $related = new WP_Query( array(
            'posts_per_page'      => 3,
            'post_status'         => 'publish',
            'post__not_in'        => array( get_the_ID() ),
            'ignore_sticky_posts' => true,
            'category__in'        => $cats ? wp_list_pluck( $cats, 'term_id' ) : array(),
        ) );
        if ( $related->have_posts() ) :
        ?>
        <div class="lsg-sidebar-card">
          <h3><?php esc_html_e( 'Related Articles', 'luxury-spa-gulshan' ); ?></h3>
          <ul class="lsg-sidebar-links">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><span><?php echo esc_html( wp_trim_words( get_the_title(), 7 ) ); ?></span><span><?php echo esc_html( get_the_date( 'M j' ) ); ?></span></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </div>
        <?php endif; ?>
      </aside>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>