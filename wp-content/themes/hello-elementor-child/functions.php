<?php
/**
 * Theme functions — Luxury Spa Gulshan Child Theme
 *
 * @package luxury-spa-gulshan
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
   THEME SETUP
   ============================================================ */
function lsg_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'luxury-spa-gulshan' ),
        'footer'  => __( 'Footer Menu', 'luxury-spa-gulshan' ),
    ) );
}
add_action( 'after_setup_theme', 'lsg_setup' );

/* ============================================================
   ENQUEUE STYLES & SCRIPTS
   ============================================================ */
function lsg_enqueue_assets() {
    $parent_ver = wp_get_theme( 'hello-elementor' )->get( 'Version' ) ?: '3.0';

    // Parent style
    wp_enqueue_style(
        'hello-elementor-parent',
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_ver
    );

    // Google Fonts — Inter
    wp_enqueue_style(
        'lsg-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'lsg-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'hello-elementor-parent' ),
        '3.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'lsg_enqueue_assets' );

/* ============================================================
   FALLBACK DEFAULT MENU (if no menu assigned)
   ============================================================ */
function lsg_default_menu( $args ) {
    $menu_id    = isset( $args['menu_id'] )    ? esc_attr( $args['menu_id'] )    : 'primary-menu';
    $menu_class = isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : 'lsg-nav__list';
    ?>
    <ul id="<?php echo $menu_id; ?>" class="<?php echo $menu_class; ?>">
        <li<?php echo is_front_page() ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxury-spa-gulshan' ); ?></a></li>
        <li<?php echo is_page( 'our-pricing' ) ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/our-pricing/' ) ); ?>"><?php esc_html_e( 'Pricing', 'luxury-spa-gulshan' ); ?></a></li>
        <li<?php echo is_page( 'services' ) ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'luxury-spa-gulshan' ); ?></a></li>
        <li<?php echo is_page( 'about' ) ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'luxury-spa-gulshan' ); ?></a></li>
        <li<?php echo ( is_home() || is_archive() || is_single() ) ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'luxury-spa-gulshan' ); ?></a></li>
        <li<?php echo is_page( 'contacts' ) ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="lsg-nav__cta"><?php esc_html_e( 'Book Now', 'luxury-spa-gulshan' ); ?></a></li>
    </ul>
    <?php
}

/* ============================================================
   SERVICE META BOX
   ============================================================ */
function lsg_register_service_meta() {
    add_meta_box(
        'lsg_service_meta',
        __( 'Service Details', 'luxury-spa-gulshan' ),
        'lsg_service_meta_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lsg_register_service_meta' );

function lsg_service_meta_callback( $post ) {
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

    $template       = get_page_template_slug( $post );
    $services_page  = get_page_by_path( 'services' );
    $is_service     = in_array( $template, $service_templates, true )
                      || ( $services_page && (int) $post->post_parent === (int) $services_page->ID );

    if ( ! $is_service ) {
        echo '<p>' . esc_html__( 'Service fields display only for service pages. Assign a service template or set this as a child of the Services page.', 'luxury-spa-gulshan' ) . '</p>';
        return;
    }

    wp_nonce_field( 'lsg_service_meta_save', 'lsg_service_meta_nonce' );

    $fields = array(
        'service_price'         => __( 'Starting price (e.g. 6000 tk)', 'luxury-spa-gulshan' ),
        'service_promo_price'   => __( 'Promo price (optional)', 'luxury-spa-gulshan' ),
        'service_duration'      => __( 'Duration (e.g. 60 min)', 'luxury-spa-gulshan' ),
        'service_short_benefit' => __( 'Short benefit tagline', 'luxury-spa-gulshan' ),
        'service_category'      => __( 'Category label (e.g. Relaxation)', 'luxury-spa-gulshan' ),
        'service_booking_cta'   => __( 'Booking button text', 'luxury-spa-gulshan' ),
        'service_booking_link'  => __( 'Booking link (tel: or URL)', 'luxury-spa-gulshan' ),
    );

    echo '<table class="form-table" role="presentation"><tbody>';
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, $key, true );
        printf(
            '<tr><th scope="row"><label for="%1$s">%2$s</label></th><td><input type="text" id="%1$s" name="%1$s" value="%3$s" class="regular-text"></td></tr>',
            esc_attr( $key ),
            esc_html( $label ),
            esc_attr( $val )
        );
    }

    $popular = get_post_meta( $post->ID, 'service_popular', true );
    echo '<tr><th scope="row">' . esc_html__( 'Featured / Popular', 'luxury-spa-gulshan' ) . '</th>';
    echo '<td><label><input type="checkbox" name="service_popular" value="1" ' . checked( '1', $popular, false ) . '> ';
    echo esc_html__( 'Mark as featured / popular service', 'luxury-spa-gulshan' ) . '</label></td></tr>';
    echo '</tbody></table>';
}

function lsg_service_meta_save( $post_id ) {
    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['lsg_service_meta_nonce'] )
         || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsg_service_meta_nonce'] ) ), 'lsg_service_meta_save' ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array(
        'service_price', 'service_promo_price', 'service_duration',
        'service_short_benefit', 'service_category', 'service_booking_cta', 'service_booking_link',
    );
    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }
    if ( isset( $_POST['service_popular'] ) ) {
        update_post_meta( $post_id, 'service_popular', '1' );
    } else {
        delete_post_meta( $post_id, 'service_popular' );
    }
}
add_action( 'save_post', 'lsg_service_meta_save' );

/* ============================================================
   HELLO ELEMENTOR — DISABLE DEFAULT HEADER/FOOTER
   so our custom header.php and footer.php take over fully.
   ============================================================ */
add_filter( 'hello_elementor_header_footer', '__return_false' );

/* ============================================================
   CONTACT FORM SUBMISSIONS
   ============================================================ */
function lsg_contact_default_settings() {
    return array(
        'company_name'       => get_bloginfo( 'name' ),
        'admin_email'        => 'luxuryspadacca@gmail.com',
        'reply_from_email'   => '',
        'reply_subject'      => __( 'Reply from Luxury Spa Gulshan', 'luxury-spa-gulshan' ),
        'enable_first_name'  => '1',
        'require_first_name' => '1',
        'enable_last_name'   => '1',
        'require_last_name'  => '0',
        'enable_phone'       => '1',
        'require_phone'      => '0',
        'enable_message'     => '1',
        'require_message'    => '1',
        'submit_button'      => __( 'Send Message', 'luxury-spa-gulshan' ),
    );
}

function lsg_contact_get_settings() {
    $settings = get_option( 'lsg_contact_form_settings', array() );
    if ( ! is_array( $settings ) ) {
        $settings = array();
    }

    return wp_parse_args( $settings, lsg_contact_default_settings() );
}

function lsg_contact_setting_enabled( $key ) {
    $settings = lsg_contact_get_settings();
    return ! empty( $settings[ $key ] );
}

function lsg_contact_settings_save_url() {
    return admin_url( 'admin-post.php' );
}

function lsg_contact_add_log( $entry_id, $type, $message, $data = array() ) {
    $entry_id = absint( $entry_id );
    if ( ! $entry_id || 'lsg_contact_entry' !== get_post_type( $entry_id ) ) {
        return;
    }

    $logs = get_post_meta( $entry_id, '_lsg_contact_event_log', true );
    if ( ! is_array( $logs ) ) {
        $logs = array();
    }

    $logs[] = array(
        'type'    => sanitize_key( $type ),
        'message' => sanitize_text_field( $message ),
        'time'    => current_time( 'mysql' ),
        'user_id' => get_current_user_id(),
        'data'    => is_array( $data ) ? array_map( 'sanitize_text_field', $data ) : array(),
    );

    update_post_meta( $entry_id, '_lsg_contact_event_log', $logs );
    update_post_meta( $entry_id, '_lsg_contact_last_activity', current_time( 'mysql' ) );
}

function lsg_contact_get_logs( $entry_id ) {
    $logs = get_post_meta( $entry_id, '_lsg_contact_event_log', true );
    return is_array( $logs ) ? $logs : array();
}

function lsg_contact_capture_mail_error( $wp_error ) {
    if ( is_wp_error( $wp_error ) ) {
        $GLOBALS['lsg_contact_last_mail_error'] = $wp_error->get_error_message();
    }
}
add_action( 'wp_mail_failed', 'lsg_contact_capture_mail_error' );

if ( ! function_exists( 'lsg_render_native_contact_form' ) ) {
    function lsg_render_native_contact_form() {
        $settings           = lsg_contact_get_settings();
        $show_first_name    = ! empty( $settings['enable_first_name'] );
        $show_last_name     = ! empty( $settings['enable_last_name'] );
        $show_phone         = ! empty( $settings['enable_phone'] );
        $show_message       = ! empty( $settings['enable_message'] );
        $require_first_name = $show_first_name && ! empty( $settings['require_first_name'] );
        $require_last_name  = $show_last_name && ! empty( $settings['require_last_name'] );
        $require_phone      = $show_phone && ! empty( $settings['require_phone'] );
        $require_message    = $show_message && ! empty( $settings['require_message'] );
        $submit_button      = $settings['submit_button'] ?: __( 'Send Message', 'luxury-spa-gulshan' );
        ?>
        <form class="lsg-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
          <?php wp_nonce_field( 'lsg_contact_submit', 'lsg_contact_nonce' ); ?>
          <input type="hidden" name="action" value="lsg_contact">
          <input type="hidden" name="source_url" value="<?php echo esc_url( get_permalink() ); ?>">
          <div class="lsg-hidden-field" aria-hidden="true">
            <label for="lsg-website"><?php esc_html_e( 'Website', 'luxury-spa-gulshan' ); ?></label>
            <input type="text" id="lsg-website" name="website" tabindex="-1" autocomplete="off">
          </div>
          <?php if ( $show_first_name || $show_last_name ) : ?>
          <div class="lsg-form-row">
            <?php if ( $show_first_name ) : ?>
            <div>
              <label for="lsg-fname"><?php esc_html_e( 'First Name', 'luxury-spa-gulshan' ); ?><?php echo $require_first_name ? ' *' : ''; ?></label>
              <input type="text" id="lsg-fname" name="first_name" <?php echo $require_first_name ? 'required' : ''; ?> placeholder="<?php esc_attr_e( 'Your first name', 'luxury-spa-gulshan' ); ?>">
            </div>
            <?php endif; ?>
            <?php if ( $show_last_name ) : ?>
            <div>
              <label for="lsg-lname"><?php esc_html_e( 'Last Name', 'luxury-spa-gulshan' ); ?><?php echo $require_last_name ? ' *' : ''; ?></label>
              <input type="text" id="lsg-lname" name="last_name" <?php echo $require_last_name ? 'required' : ''; ?> placeholder="<?php esc_attr_e( 'Your last name', 'luxury-spa-gulshan' ); ?>">
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
          <div class="lsg-form-row">
            <div>
              <label for="lsg-email"><?php esc_html_e( 'Email Address', 'luxury-spa-gulshan' ); ?> *</label>
              <input type="email" id="lsg-email" name="email" required placeholder="<?php esc_attr_e( 'your@email.com', 'luxury-spa-gulshan' ); ?>">
            </div>
            <?php if ( $show_phone ) : ?>
            <div>
              <label for="lsg-phone"><?php esc_html_e( 'Phone / WhatsApp', 'luxury-spa-gulshan' ); ?><?php echo $require_phone ? ' *' : ''; ?></label>
              <input type="tel" id="lsg-phone" name="phone" <?php echo $require_phone ? 'required' : ''; ?> placeholder="+880 1xxx xxxxxx">
            </div>
            <?php endif; ?>
          </div>
          <?php if ( $show_message ) : ?>
          <div>
            <label for="lsg-message"><?php esc_html_e( 'Message', 'luxury-spa-gulshan' ); ?><?php echo $require_message ? ' *' : ''; ?></label>
            <textarea id="lsg-message" name="message" <?php echo $require_message ? 'required' : ''; ?> rows="5" placeholder="<?php esc_attr_e( 'Tell us which service you\'re interested in, your preferred time, and any questions you have.', 'luxury-spa-gulshan' ); ?>"></textarea>
          </div>
          <?php endif; ?>
          <button type="submit" class="lsg-btn" style="width:100%;justify-content:center;"><?php echo esc_html( $submit_button ); ?></button>
        </form>
        <?php
    }
}

function lsg_contact_recipient_email() {
    $settings = lsg_contact_get_settings();
    $email    = is_email( $settings['admin_email'] ) ? $settings['admin_email'] : 'luxuryspadacca@gmail.com';

    return apply_filters( 'lsg_contact_recipient_email', $email );
}

function lsg_register_contact_entries() {
    register_post_type( 'lsg_contact_entry', array(
        'labels' => array(
            'name'               => __( 'WPistic Contact Form', 'luxury-spa-gulshan' ),
            'singular_name'      => __( 'Contact Submission', 'luxury-spa-gulshan' ),
            'menu_name'          => __( 'WPistic Contact Form', 'luxury-spa-gulshan' ),
            'all_items'          => __( 'All Form Submissions', 'luxury-spa-gulshan' ),
            'view_item'          => __( 'View Submission', 'luxury-spa-gulshan' ),
            'search_items'       => __( 'Search Submissions', 'luxury-spa-gulshan' ),
            'not_found'          => __( 'No submissions found.', 'luxury-spa-gulshan' ),
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-email-alt2',
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'capabilities'        => array(
            'create_posts' => 'do_not_allow',
        ),
        'supports'            => array( 'title' ),
        'exclude_from_search' => true,
    ) );
}
add_action( 'init', 'lsg_register_contact_entries' );

function lsg_register_contact_settings_submenu() {
    add_submenu_page(
        'edit.php?post_type=lsg_contact_entry',
        __( 'Contact Form Settings', 'luxury-spa-gulshan' ),
        __( 'Settings', 'luxury-spa-gulshan' ),
        'manage_options',
        'lsg-contact-settings',
        'lsg_render_contact_settings_page'
    );
}
add_action( 'admin_menu', 'lsg_register_contact_settings_submenu', 20 );

function lsg_sanitize_contact_settings( $raw ) {
    $defaults = lsg_contact_default_settings();
    $raw      = is_array( $raw ) ? $raw : array();
    $settings = array();

    $settings['company_name']       = isset( $raw['company_name'] ) ? sanitize_text_field( wp_unslash( $raw['company_name'] ) ) : $defaults['company_name'];
    $settings['admin_email']        = isset( $raw['admin_email'] ) ? sanitize_email( wp_unslash( $raw['admin_email'] ) ) : $defaults['admin_email'];
    $settings['reply_from_email']   = isset( $raw['reply_from_email'] ) ? sanitize_email( wp_unslash( $raw['reply_from_email'] ) ) : '';
    $settings['reply_subject']      = isset( $raw['reply_subject'] ) ? sanitize_text_field( wp_unslash( $raw['reply_subject'] ) ) : $defaults['reply_subject'];
    $settings['submit_button']      = isset( $raw['submit_button'] ) ? sanitize_text_field( wp_unslash( $raw['submit_button'] ) ) : $defaults['submit_button'];
    $settings['enable_first_name']  = ! empty( $raw['enable_first_name'] ) ? '1' : '0';
    $settings['require_first_name'] = ! empty( $raw['require_first_name'] ) && ! empty( $raw['enable_first_name'] ) ? '1' : '0';
    $settings['enable_last_name']   = ! empty( $raw['enable_last_name'] ) ? '1' : '0';
    $settings['require_last_name']  = ! empty( $raw['require_last_name'] ) && ! empty( $raw['enable_last_name'] ) ? '1' : '0';
    $settings['enable_phone']       = ! empty( $raw['enable_phone'] ) ? '1' : '0';
    $settings['require_phone']      = ! empty( $raw['require_phone'] ) && ! empty( $raw['enable_phone'] ) ? '1' : '0';
    $settings['enable_message']     = ! empty( $raw['enable_message'] ) ? '1' : '0';
    $settings['require_message']    = ! empty( $raw['require_message'] ) && ! empty( $raw['enable_message'] ) ? '1' : '0';

    if ( ! is_email( $settings['admin_email'] ) ) {
        $settings['admin_email'] = $defaults['admin_email'];
    }
    if ( '' !== $settings['reply_from_email'] && ! is_email( $settings['reply_from_email'] ) ) {
        $settings['reply_from_email'] = '';
    }

    return $settings;
}

function lsg_handle_contact_settings_save() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'You do not have permission to update these settings.', 'luxury-spa-gulshan' ) );
    }
    if ( ! isset( $_POST['lsg_contact_settings_nonce'] )
         || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsg_contact_settings_nonce'] ) ), 'lsg_contact_settings_save' ) ) {
        wp_safe_redirect( add_query_arg( 'settings-updated', 'invalid', admin_url( 'edit.php?post_type=lsg_contact_entry&page=lsg-contact-settings' ) ) );
        exit;
    }

    $settings = isset( $_POST['lsg_contact_settings'] ) ? lsg_sanitize_contact_settings( wp_unslash( $_POST['lsg_contact_settings'] ) ) : lsg_contact_default_settings();
    update_option( 'lsg_contact_form_settings', $settings, false );

    wp_safe_redirect( add_query_arg( 'settings-updated', 'true', admin_url( 'edit.php?post_type=lsg_contact_entry&page=lsg-contact-settings' ) ) );
    exit;
}
add_action( 'admin_post_lsg_contact_settings_save', 'lsg_handle_contact_settings_save' );

function lsg_render_contact_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $settings = lsg_contact_get_settings();
    $status   = isset( $_GET['settings-updated'] ) ? sanitize_key( wp_unslash( $_GET['settings-updated'] ) ) : '';
    ?>
    <div class="wrap wpistic-settings-wrap">
        <div class="wpistic-contact-admin-card wpistic-settings-hero">
            <h1><?php esc_html_e( 'WPistic Contact Form Settings', 'luxury-spa-gulshan' ); ?></h1>
            <p><?php esc_html_e( 'Build by', 'luxury-spa-gulshan' ); ?> <a href="https://www.wordpressistic.com/" target="_blank" rel="noopener noreferrer">Wordpressistic</a>. <?php esc_html_e( 'Configure recipient email, reply identity, and the public contact form fields.', 'luxury-spa-gulshan' ); ?></p>
        </div>

        <?php if ( 'true' === $status ) : ?>
        <div class="wpistic-settings-alert is-success"><?php esc_html_e( 'Settings saved successfully.', 'luxury-spa-gulshan' ); ?></div>
        <?php elseif ( 'invalid' === $status ) : ?>
        <div class="wpistic-settings-alert is-error"><?php esc_html_e( 'Settings could not be saved. Please refresh and try again.', 'luxury-spa-gulshan' ); ?></div>
        <?php endif; ?>

        <div class="wpistic-settings-alert is-warning">
            <strong><?php esc_html_e( 'SMTP Notice:', 'luxury-spa-gulshan' ); ?></strong>
            <?php esc_html_e( 'Configure SMTP with the client Gmail account for best inbox delivery. Replies will still send with the default WordPress mail server if SMTP is not configured, but SMTP is recommended for trust and deliverability.', 'luxury-spa-gulshan' ); ?>
        </div>

        <form method="post" action="<?php echo esc_url( lsg_contact_settings_save_url() ); ?>" class="wpistic-settings-grid">
            <?php wp_nonce_field( 'lsg_contact_settings_save', 'lsg_contact_settings_nonce' ); ?>
            <input type="hidden" name="action" value="lsg_contact_settings_save">

            <section class="wpistic-settings-card">
                <h2><?php esc_html_e( 'Company & Mail Settings', 'luxury-spa-gulshan' ); ?></h2>
                <label>
                    <span><?php esc_html_e( 'Company Name', 'luxury-spa-gulshan' ); ?></span>
                    <input type="text" name="lsg_contact_settings[company_name]" value="<?php echo esc_attr( $settings['company_name'] ); ?>" class="regular-text">
                </label>
                <label>
                    <span><?php esc_html_e( 'Admin Recipient Email', 'luxury-spa-gulshan' ); ?></span>
                    <input type="email" name="lsg_contact_settings[admin_email]" value="<?php echo esc_attr( $settings['admin_email'] ); ?>" class="regular-text">
                </label>
                <label>
                    <span><?php esc_html_e( 'Reply From Email', 'luxury-spa-gulshan' ); ?></span>
                    <input type="email" name="lsg_contact_settings[reply_from_email]" value="<?php echo esc_attr( $settings['reply_from_email'] ); ?>" class="regular-text" placeholder="client@gmail.com">
                    <small><?php esc_html_e( 'Reply button appears only after this email is configured.', 'luxury-spa-gulshan' ); ?></small>
                </label>
                <label>
                    <span><?php esc_html_e( 'Default Reply Subject', 'luxury-spa-gulshan' ); ?></span>
                    <input type="text" name="lsg_contact_settings[reply_subject]" value="<?php echo esc_attr( $settings['reply_subject'] ); ?>" class="regular-text">
                </label>
                <label>
                    <span><?php esc_html_e( 'Submit Button Text', 'luxury-spa-gulshan' ); ?></span>
                    <input type="text" name="lsg_contact_settings[submit_button]" value="<?php echo esc_attr( $settings['submit_button'] ); ?>" class="regular-text">
                </label>
            </section>

            <section class="wpistic-settings-card">
                <h2><?php esc_html_e( 'Contact Form Fields', 'luxury-spa-gulshan' ); ?></h2>
                <div class="wpistic-field-row">
                    <strong><?php esc_html_e( 'First Name', 'luxury-spa-gulshan' ); ?></strong>
                    <label><input type="checkbox" name="lsg_contact_settings[enable_first_name]" value="1" <?php checked( '1', $settings['enable_first_name'] ); ?>> <?php esc_html_e( 'Show', 'luxury-spa-gulshan' ); ?></label>
                    <label><input type="checkbox" name="lsg_contact_settings[require_first_name]" value="1" <?php checked( '1', $settings['require_first_name'] ); ?>> <?php esc_html_e( 'Required', 'luxury-spa-gulshan' ); ?></label>
                </div>
                <div class="wpistic-field-row">
                    <strong><?php esc_html_e( 'Last Name', 'luxury-spa-gulshan' ); ?></strong>
                    <label><input type="checkbox" name="lsg_contact_settings[enable_last_name]" value="1" <?php checked( '1', $settings['enable_last_name'] ); ?>> <?php esc_html_e( 'Show', 'luxury-spa-gulshan' ); ?></label>
                    <label><input type="checkbox" name="lsg_contact_settings[require_last_name]" value="1" <?php checked( '1', $settings['require_last_name'] ); ?>> <?php esc_html_e( 'Required', 'luxury-spa-gulshan' ); ?></label>
                </div>
                <div class="wpistic-field-row is-locked">
                    <strong><?php esc_html_e( 'Email Address', 'luxury-spa-gulshan' ); ?></strong>
                    <span><?php esc_html_e( 'Always shown and required for reply support.', 'luxury-spa-gulshan' ); ?></span>
                </div>
                <div class="wpistic-field-row">
                    <strong><?php esc_html_e( 'Phone / WhatsApp', 'luxury-spa-gulshan' ); ?></strong>
                    <label><input type="checkbox" name="lsg_contact_settings[enable_phone]" value="1" <?php checked( '1', $settings['enable_phone'] ); ?>> <?php esc_html_e( 'Show', 'luxury-spa-gulshan' ); ?></label>
                    <label><input type="checkbox" name="lsg_contact_settings[require_phone]" value="1" <?php checked( '1', $settings['require_phone'] ); ?>> <?php esc_html_e( 'Required', 'luxury-spa-gulshan' ); ?></label>
                </div>
                <div class="wpistic-field-row">
                    <strong><?php esc_html_e( 'Message', 'luxury-spa-gulshan' ); ?></strong>
                    <label><input type="checkbox" name="lsg_contact_settings[enable_message]" value="1" <?php checked( '1', $settings['enable_message'] ); ?>> <?php esc_html_e( 'Show', 'luxury-spa-gulshan' ); ?></label>
                    <label><input type="checkbox" name="lsg_contact_settings[require_message]" value="1" <?php checked( '1', $settings['require_message'] ); ?>> <?php esc_html_e( 'Required', 'luxury-spa-gulshan' ); ?></label>
                </div>
            </section>

            <div class="wpistic-settings-actions">
                <button type="submit" class="button button-primary"><?php esc_html_e( 'Save Settings', 'luxury-spa-gulshan' ); ?></button>
            </div>
        </form>
    </div>
    <?php
}

function lsg_contact_redirect_url( $status ) {
    $fallback = home_url( '/contacts/' );
    $referer  = wp_get_referer() ?: $fallback;
    return add_query_arg( 'lsg_contact_status', sanitize_key( $status ), remove_query_arg( 'lsg_contact_status', $referer ) );
}

function lsg_handle_contact_submission() {
    if ( ! isset( $_POST['lsg_contact_nonce'] )
         || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsg_contact_nonce'] ) ), 'lsg_contact_submit' ) ) {
        wp_safe_redirect( lsg_contact_redirect_url( 'invalid' ) );
        exit;
    }

    $honeypot = isset( $_POST['website'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['website'] ) ) ) : '';
    if ( '' !== $honeypot ) {
        wp_safe_redirect( lsg_contact_redirect_url( 'sent' ) );
        exit;
    }

    $first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
    $last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
    $email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone      = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
    $source_url = isset( $_POST['source_url'] ) ? esc_url_raw( wp_unslash( $_POST['source_url'] ) ) : home_url( '/contacts/' );
    $settings   = lsg_contact_get_settings();

    $missing_required_name  = ! empty( $settings['enable_first_name'] ) && ! empty( $settings['require_first_name'] ) && '' === $first_name;
    $missing_required_lname = ! empty( $settings['enable_last_name'] ) && ! empty( $settings['require_last_name'] ) && '' === $last_name;
    $missing_required_phone = ! empty( $settings['enable_phone'] ) && ! empty( $settings['require_phone'] ) && '' === $phone;
    $missing_required_msg   = ! empty( $settings['enable_message'] ) && ! empty( $settings['require_message'] ) && '' === $message;

    if ( $missing_required_name || $missing_required_lname || $missing_required_phone || $missing_required_msg || ! is_email( $email ) ) {
        wp_safe_redirect( lsg_contact_redirect_url( 'invalid' ) );
        exit;
    }

    $full_name = trim( $first_name . ' ' . $last_name );
    $sender_label = $full_name ?: $email;
    $entry_id = wp_insert_post( array(
        'post_type'   => 'lsg_contact_entry',
        'post_status' => 'private',
        'post_title'  => sprintf(
            /* translators: 1: customer name, 2: date */
            __( 'Contact from %1$s - %2$s', 'luxury-spa-gulshan' ),
            $sender_label,
            current_time( 'mysql' )
        ),
    ), true );

    if ( is_wp_error( $entry_id ) ) {
        wp_safe_redirect( lsg_contact_redirect_url( 'error' ) );
        exit;
    }

    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
    $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';

    update_post_meta( $entry_id, '_lsg_contact_first_name', $first_name );
    update_post_meta( $entry_id, '_lsg_contact_last_name', $last_name );
    update_post_meta( $entry_id, '_lsg_contact_email', $email );
    update_post_meta( $entry_id, '_lsg_contact_phone', $phone );
    update_post_meta( $entry_id, '_lsg_contact_message', $message );
    update_post_meta( $entry_id, '_lsg_contact_source_url', $source_url );
    update_post_meta( $entry_id, '_lsg_contact_ip', $ip_address );
    update_post_meta( $entry_id, '_lsg_contact_user_agent', $user_agent );
    update_post_meta( $entry_id, '_lsg_contact_status', 'unread' );
    update_post_meta( $entry_id, '_lsg_contact_reply_status', 'none' );
    update_post_meta( $entry_id, '_lsg_contact_last_activity', current_time( 'mysql' ) );
    lsg_contact_add_log( $entry_id, 'submitted', __( 'Contact form submitted.', 'luxury-spa-gulshan' ), array(
        'email' => $email,
        'page'  => $source_url,
    ) );

    $recipient = lsg_contact_recipient_email();
    $subject   = sprintf( __( 'New contact form message from %s', 'luxury-spa-gulshan' ), $sender_label );
    $body      = "New contact form submission\n\n";
    $body     .= "Name: {$sender_label}\n";
    $body     .= "Email: {$email}\n";
    $body     .= "Phone: {$phone}\n";
    $body     .= "Page: {$source_url}\n\n";
    $body     .= "Message:\n{$message}\n\n";
    $body     .= "Submitted: " . current_time( 'mysql' ) . "\n";
    $headers   = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $sender_label . ' <' . $email . '>',
    );

    unset( $GLOBALS['lsg_contact_last_mail_error'] );
    $mail_sent = wp_mail( $recipient, $subject, $body, $headers );
    update_post_meta( $entry_id, '_lsg_contact_mail_sent', $mail_sent ? '1' : '0' );
    if ( $mail_sent ) {
        lsg_contact_add_log( $entry_id, 'admin_email_sent', __( 'Admin notification email sent.', 'luxury-spa-gulshan' ), array(
            'to' => $recipient,
        ) );
    } else {
        $mail_error = isset( $GLOBALS['lsg_contact_last_mail_error'] ) ? $GLOBALS['lsg_contact_last_mail_error'] : __( 'WordPress mail returned false.', 'luxury-spa-gulshan' );
        update_post_meta( $entry_id, '_lsg_contact_last_mail_error', $mail_error );
        lsg_contact_add_log( $entry_id, 'admin_email_failed', __( 'Admin notification email failed.', 'luxury-spa-gulshan' ), array(
            'to'    => $recipient,
            'error' => $mail_error,
        ) );
    }

    wp_safe_redirect( lsg_contact_redirect_url( $mail_sent ? 'sent' : 'error' ) );
    exit;
}
add_action( 'admin_post_nopriv_lsg_contact', 'lsg_handle_contact_submission' );
add_action( 'admin_post_lsg_contact', 'lsg_handle_contact_submission' );

function lsg_contact_reply_redirect_url( $entry_id, $status ) {
    return add_query_arg(
        array(
            'post'             => absint( $entry_id ),
            'action'           => 'edit',
            'lsg_reply_status' => sanitize_key( $status ),
        ),
        admin_url( 'post.php' )
    );
}

function lsg_handle_contact_reply_send() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_die( esc_html__( 'You do not have permission to send replies.', 'luxury-spa-gulshan' ) );
    }

    $entry_id = isset( $_POST['entry_id'] ) ? absint( $_POST['entry_id'] ) : 0;
    if ( ! $entry_id || 'lsg_contact_entry' !== get_post_type( $entry_id ) ) {
        wp_die( esc_html__( 'Invalid submission.', 'luxury-spa-gulshan' ) );
    }
    if ( ! current_user_can( 'edit_post', $entry_id ) ) {
        wp_die( esc_html__( 'You do not have permission to reply to this submission.', 'luxury-spa-gulshan' ) );
    }

    if ( ! isset( $_POST['lsg_contact_reply_nonce'] )
         || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsg_contact_reply_nonce'] ) ), 'lsg_contact_reply_' . $entry_id ) ) {
        wp_safe_redirect( lsg_contact_reply_redirect_url( $entry_id, 'invalid' ) );
        exit;
    }

    $settings   = lsg_contact_get_settings();
    $from_email = is_email( $settings['reply_from_email'] ) ? $settings['reply_from_email'] : '';
    $to_email   = get_post_meta( $entry_id, '_lsg_contact_email', true );
    $subject    = isset( $_POST['reply_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['reply_subject'] ) ) : '';
    $message    = isset( $_POST['reply_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['reply_message'] ) ) : '';

    if ( ! $from_email || ! is_email( $to_email ) || '' === $subject || '' === $message ) {
        wp_safe_redirect( lsg_contact_reply_redirect_url( $entry_id, 'invalid' ) );
        exit;
    }

    $company = $settings['company_name'] ?: get_bloginfo( 'name' );
    $body    = $message . "\n\n";
    $body   .= "--\n" . $company . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $company . ' <' . $from_email . '>',
        'Reply-To: ' . $company . ' <' . $from_email . '>',
    );

    unset( $GLOBALS['lsg_contact_last_mail_error'] );
    $sent    = wp_mail( $to_email, $subject, $body, $headers );
    $mail_error = isset( $GLOBALS['lsg_contact_last_mail_error'] ) ? $GLOBALS['lsg_contact_last_mail_error'] : '';
    $history = get_post_meta( $entry_id, '_lsg_contact_reply_history', true );
    if ( ! is_array( $history ) ) {
        $history = array();
    }

    $history[] = array(
        'subject'    => $subject,
        'message'    => $message,
        'from_email' => $from_email,
        'to_email'   => $to_email,
        'sent'       => $sent ? '1' : '0',
        'sent_at'    => current_time( 'mysql' ),
        'user_id'    => get_current_user_id(),
        'error'      => $sent ? '' : ( $mail_error ?: __( 'WordPress mail returned false.', 'luxury-spa-gulshan' ) ),
    );

    update_post_meta( $entry_id, '_lsg_contact_reply_history', $history );
    update_post_meta( $entry_id, '_lsg_contact_last_reply_sent', $sent ? current_time( 'mysql' ) : '' );
    update_post_meta( $entry_id, '_lsg_contact_reply_status', $sent ? 'replied' : 'failed' );
    if ( ! $sent ) {
        update_post_meta( $entry_id, '_lsg_contact_last_mail_error', $mail_error ?: __( 'WordPress mail returned false.', 'luxury-spa-gulshan' ) );
    }
    lsg_contact_add_log( $entry_id, $sent ? 'reply_sent' : 'reply_failed', $sent ? __( 'Reply email sent to customer.', 'luxury-spa-gulshan' ) : __( 'Reply email failed.', 'luxury-spa-gulshan' ), array(
        'to'      => $to_email,
        'subject' => $subject,
        'error'   => $sent ? '' : ( $mail_error ?: __( 'WordPress mail returned false.', 'luxury-spa-gulshan' ) ),
    ) );

    wp_safe_redirect( lsg_contact_reply_redirect_url( $entry_id, $sent ? 'reply_sent' : 'reply_failed' ) );
    exit;
}
add_action( 'admin_post_lsg_contact_reply_send', 'lsg_handle_contact_reply_send' );

function lsg_contact_entry_columns( $columns ) {
    return array(
        'cb'          => $columns['cb'],
        'title'       => __( 'Submission', 'luxury-spa-gulshan' ),
        'status'      => __( 'Status', 'luxury-spa-gulshan' ),
        'reply_state' => __( 'Reply', 'luxury-spa-gulshan' ),
        'name'        => __( 'Name', 'luxury-spa-gulshan' ),
        'email'       => __( 'Email', 'luxury-spa-gulshan' ),
        'phone'       => __( 'Phone', 'luxury-spa-gulshan' ),
        'last_action' => __( 'Last Activity', 'luxury-spa-gulshan' ),
        'date'        => __( 'Date', 'luxury-spa-gulshan' ),
    );
}
add_filter( 'manage_lsg_contact_entry_posts_columns', 'lsg_contact_entry_columns' );

function lsg_contact_entry_column_content( $column, $post_id ) {
    if ( 'status' === $column ) {
        $status = get_post_meta( $post_id, '_lsg_contact_status', true ) ?: 'unread';
        echo '<span class="wpistic-status-pill is-' . esc_attr( $status ) . '">' . esc_html( ucfirst( $status ) ) . '</span>';
    } elseif ( 'reply_state' === $column ) {
        $reply_status = get_post_meta( $post_id, '_lsg_contact_reply_status', true ) ?: 'none';
        $labels = array(
            'none'    => __( 'No reply', 'luxury-spa-gulshan' ),
            'replied' => __( 'Replied', 'luxury-spa-gulshan' ),
            'failed'  => __( 'Failed', 'luxury-spa-gulshan' ),
        );
        echo '<span class="wpistic-status-pill is-' . esc_attr( $reply_status ) . '">' . esc_html( $labels[ $reply_status ] ?? ucfirst( $reply_status ) ) . '</span>';
    } elseif ( 'name' === $column ) {
        $name = trim( get_post_meta( $post_id, '_lsg_contact_first_name', true ) . ' ' . get_post_meta( $post_id, '_lsg_contact_last_name', true ) );
        echo esc_html( $name ?: get_post_meta( $post_id, '_lsg_contact_email', true ) );
    } elseif ( 'email' === $column ) {
        $email = get_post_meta( $post_id, '_lsg_contact_email', true );
        echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '';
    } elseif ( 'phone' === $column ) {
        $phone = get_post_meta( $post_id, '_lsg_contact_phone', true );
        echo $phone ? '<a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>' : '';
    } elseif ( 'last_action' === $column ) {
        $last_activity = get_post_meta( $post_id, '_lsg_contact_last_activity', true );
        echo $last_activity ? esc_html( mysql2date( 'M j, Y g:i A', $last_activity ) ) : '&mdash;';
    }
}
add_action( 'manage_lsg_contact_entry_posts_custom_column', 'lsg_contact_entry_column_content', 10, 2 );

function lsg_contact_entry_admin_views( $views ) {
    $base_url = admin_url( 'edit.php?post_type=lsg_contact_entry' );
    $current  = isset( $_GET['lsg_contact_view'] ) ? sanitize_key( wp_unslash( $_GET['lsg_contact_view'] ) ) : '';
    $items    = array(
        ''        => __( 'All', 'luxury-spa-gulshan' ),
        'unread'  => __( 'Unread', 'luxury-spa-gulshan' ),
        'read'    => __( 'Read', 'luxury-spa-gulshan' ),
        'replied' => __( 'Replied', 'luxury-spa-gulshan' ),
        'failed'  => __( 'Failed Replies', 'luxury-spa-gulshan' ),
    );
    $new_views = array();

    foreach ( $items as $key => $label ) {
        $url = $key ? add_query_arg( 'lsg_contact_view', $key, $base_url ) : $base_url;
        $class = $current === $key ? ' class="current"' : '';
        $new_views[ $key ?: 'all' ] = '<a href="' . esc_url( $url ) . '"' . $class . '>' . esc_html( $label ) . '</a>';
    }

    return $new_views;
}
add_filter( 'views_edit-lsg_contact_entry', 'lsg_contact_entry_admin_views' );

function lsg_filter_contact_entries_query( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() || 'lsg_contact_entry' !== $query->get( 'post_type' ) ) {
        return;
    }

    $view = isset( $_GET['lsg_contact_view'] ) ? sanitize_key( wp_unslash( $_GET['lsg_contact_view'] ) ) : '';
    if ( ! $view ) {
        return;
    }

    if ( 'unread' === $view ) {
        $query->set( 'meta_query', array(
            'relation' => 'OR',
            array(
                'key'   => '_lsg_contact_status',
                'value' => 'unread',
            ),
            array(
                'key'     => '_lsg_contact_status',
                'compare' => 'NOT EXISTS',
            ),
        ) );
    } elseif ( 'read' === $view ) {
        $query->set( 'meta_key', '_lsg_contact_status' );
        $query->set( 'meta_value', 'read' );
    } elseif ( in_array( $view, array( 'replied', 'failed' ), true ) ) {
        $query->set( 'meta_key', '_lsg_contact_reply_status' );
        $query->set( 'meta_value', $view );
    }
}
add_action( 'pre_get_posts', 'lsg_filter_contact_entries_query' );

function lsg_contact_entry_details_box() {
    add_meta_box(
        'lsg_contact_entry_details',
        __( 'Submitted Details', 'luxury-spa-gulshan' ),
        'lsg_render_contact_entry_details_box',
        'lsg_contact_entry',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes_lsg_contact_entry', 'lsg_contact_entry_details_box' );

function lsg_render_contact_entry_details_box( $post ) {
    $first_name = get_post_meta( $post->ID, '_lsg_contact_first_name', true );
    $last_name  = get_post_meta( $post->ID, '_lsg_contact_last_name', true );
    $name       = trim( $first_name . ' ' . $last_name );
    $email      = get_post_meta( $post->ID, '_lsg_contact_email', true );
    $phone      = get_post_meta( $post->ID, '_lsg_contact_phone', true );
    $source_url = get_post_meta( $post->ID, '_lsg_contact_source_url', true );
    $ip_address = get_post_meta( $post->ID, '_lsg_contact_ip', true );
    $mail_sent  = get_post_meta( $post->ID, '_lsg_contact_mail_sent', true );
    $message    = get_post_meta( $post->ID, '_lsg_contact_message', true );
    $settings   = lsg_contact_get_settings();
    $reply_from = is_email( $settings['reply_from_email'] ) ? $settings['reply_from_email'] : '';
    $reply_subject = $settings['reply_subject'] ?: __( 'Reply from Luxury Spa Gulshan', 'luxury-spa-gulshan' );
    $reply_enabled = $reply_from && is_email( $email );
    $reply_status  = isset( $_GET['lsg_reply_status'] ) ? sanitize_key( wp_unslash( $_GET['lsg_reply_status'] ) ) : '';
    $reply_history = get_post_meta( $post->ID, '_lsg_contact_reply_history', true );
    if ( ! is_array( $reply_history ) ) {
        $reply_history = array();
    }
    $current_status = get_post_meta( $post->ID, '_lsg_contact_status', true ) ?: 'unread';
    if ( 'unread' === $current_status ) {
        update_post_meta( $post->ID, '_lsg_contact_status', 'read' );
        lsg_contact_add_log( $post->ID, 'read', __( 'Submission opened and marked as read.', 'luxury-spa-gulshan' ) );
        $current_status = 'read';
    }
    $reply_state = get_post_meta( $post->ID, '_lsg_contact_reply_status', true ) ?: 'none';
    $logs        = lsg_contact_get_logs( $post->ID );
    ?>
    <div class="wpistic-submission-view">
        <div class="wpistic-submission-hero">
            <div>
                <span><?php esc_html_e( 'Contact Submission', 'luxury-spa-gulshan' ); ?></span>
                <h2><?php echo esc_html( $name ?: __( 'Unknown Sender', 'luxury-spa-gulshan' ) ); ?></h2>
                <p><?php echo esc_html( get_the_date( 'F j, Y g:i A', $post ) ); ?></p>
            </div>
            <div class="wpistic-submission-actions">
                <strong class="is-<?php echo esc_attr( $current_status ); ?>"><?php echo esc_html( ucfirst( $current_status ) ); ?></strong>
                <strong class="<?php echo '1' === $mail_sent ? 'is-sent' : 'is-error'; ?>">
                    <?php echo '1' === $mail_sent ? esc_html__( 'Email Sent', 'luxury-spa-gulshan' ) : esc_html__( 'Saved Only', 'luxury-spa-gulshan' ); ?>
                </strong>
                <?php if ( 'replied' === $reply_state ) : ?>
                <strong class="is-sent"><?php esc_html_e( 'Replied', 'luxury-spa-gulshan' ); ?></strong>
                <?php elseif ( 'failed' === $reply_state ) : ?>
                <strong class="is-error"><?php esc_html_e( 'Reply Failed', 'luxury-spa-gulshan' ); ?></strong>
                <?php endif; ?>
                <?php if ( $reply_enabled ) : ?>
                <button type="button" class="wpistic-reply-toggle"><?php esc_html_e( 'Reply', 'luxury-spa-gulshan' ); ?></button>
                <?php endif; ?>
            </div>
        </div>
        <?php if ( 'reply_sent' === $reply_status ) : ?>
        <div class="wpistic-reply-alert is-success"><?php esc_html_e( 'Reply sent successfully and saved in reply history.', 'luxury-spa-gulshan' ); ?></div>
        <?php elseif ( 'reply_failed' === $reply_status ) : ?>
        <div class="wpistic-reply-alert is-error"><?php esc_html_e( 'Reply was saved, but WordPress could not send the email. Please check SMTP/server mail settings.', 'luxury-spa-gulshan' ); ?></div>
        <?php elseif ( 'invalid' === $reply_status ) : ?>
        <div class="wpistic-reply-alert is-error"><?php esc_html_e( 'Reply could not be sent. Please complete the reply subject and message.', 'luxury-spa-gulshan' ); ?></div>
        <?php endif; ?>
        <div class="wpistic-submission-grid">
            <div class="wpistic-submission-item">
                <span><?php esc_html_e( 'Full Name', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo esc_html( $name ); ?></strong>
            </div>
            <div class="wpistic-submission-item">
                <span><?php esc_html_e( 'Email Address', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : ''; ?></strong>
            </div>
            <div class="wpistic-submission-item">
                <span><?php esc_html_e( 'Phone / WhatsApp', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo $phone ? '<a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>' : esc_html__( 'Not provided', 'luxury-spa-gulshan' ); ?></strong>
            </div>
            <div class="wpistic-submission-item">
                <span><?php esc_html_e( 'Submitted From', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo $source_url ? '<a href="' . esc_url( $source_url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $source_url ) . '</a>' : ''; ?></strong>
            </div>
            <div class="wpistic-submission-item">
                <span><?php esc_html_e( 'IP Address', 'luxury-spa-gulshan' ); ?></span>
                <strong><?php echo esc_html( $ip_address ); ?></strong>
            </div>
        </div>
        <div class="wpistic-submission-message">
            <span><?php esc_html_e( 'Message', 'luxury-spa-gulshan' ); ?></span>
            <p><?php echo nl2br( esc_html( $message ) ); ?></p>
        </div>
        <?php if ( $reply_history ) : ?>
        <div class="wpistic-reply-history">
            <span><?php esc_html_e( 'Reply History', 'luxury-spa-gulshan' ); ?></span>
            <?php foreach ( array_reverse( $reply_history ) as $reply ) : ?>
            <article>
                <strong><?php echo esc_html( $reply['subject'] ?? '' ); ?></strong>
                <small><?php echo esc_html( $reply['sent_at'] ?? '' ); ?> &middot; <?php echo ! empty( $reply['sent'] ) && '1' === $reply['sent'] ? esc_html__( 'Sent', 'luxury-spa-gulshan' ) : esc_html__( 'Failed', 'luxury-spa-gulshan' ); ?></small>
                <p><?php echo nl2br( esc_html( $reply['message'] ?? '' ) ); ?></p>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ( $logs ) : ?>
        <div class="wpistic-contact-log">
            <span><?php esc_html_e( 'Activity Log', 'luxury-spa-gulshan' ); ?></span>
            <?php foreach ( array_reverse( $logs ) as $log ) : ?>
            <article>
                <strong><?php echo esc_html( $log['message'] ?? '' ); ?></strong>
                <small><?php echo esc_html( $log['time'] ?? '' ); ?> &middot; <?php echo esc_html( $log['type'] ?? '' ); ?></small>
                <?php if ( ! empty( $log['data']['error'] ) ) : ?>
                <p><?php echo esc_html( $log['data']['error'] ); ?></p>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

function lsg_contact_entry_remove_default_boxes() {
    remove_meta_box( 'submitdiv', 'lsg_contact_entry', 'side' );
    remove_meta_box( 'slugdiv', 'lsg_contact_entry', 'normal' );
}
add_action( 'add_meta_boxes_lsg_contact_entry', 'lsg_contact_entry_remove_default_boxes', 99 );

function lsg_render_contact_reply_modal_footer() {
    $screen = get_current_screen();
    if ( ! $screen || 'lsg_contact_entry' !== $screen->post_type || 'post' !== $screen->base ) {
        return;
    }

    $entry_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
    if ( ! $entry_id || 'lsg_contact_entry' !== get_post_type( $entry_id ) || ! current_user_can( 'edit_post', $entry_id ) ) {
        return;
    }

    $settings = lsg_contact_get_settings();
    $email    = get_post_meta( $entry_id, '_lsg_contact_email', true );
    $reply_from = is_email( $settings['reply_from_email'] ) ? $settings['reply_from_email'] : '';
    if ( ! $reply_from || ! is_email( $email ) ) {
        return;
    }

    $reply_subject = $settings['reply_subject'] ?: __( 'Reply from Luxury Spa Gulshan', 'luxury-spa-gulshan' );
    ?>
    <div class="wpistic-reply-overlay" id="wpistic-reply-panel" hidden>
        <div class="wpistic-reply-panel" role="dialog" aria-modal="true" aria-labelledby="wpistic-reply-title">
            <div class="wpistic-reply-panel__head">
                <div>
                    <span><?php esc_html_e( 'Send Reply', 'luxury-spa-gulshan' ); ?></span>
                    <h3 id="wpistic-reply-title"><?php echo esc_html( sprintf( __( 'Reply to %s', 'luxury-spa-gulshan' ), $email ) ); ?></h3>
                </div>
                <button type="button" class="wpistic-reply-close" aria-label="<?php esc_attr_e( 'Close reply panel', 'luxury-spa-gulshan' ); ?>">&times;</button>
            </div>
            <div class="wpistic-reply-smtp-note">
                <strong><?php esc_html_e( 'SMTP Notice:', 'luxury-spa-gulshan' ); ?></strong>
                <?php esc_html_e( 'For better inbox delivery, configure SMTP with the client Gmail account. If SMTP is not configured, this reply will still send using the default WordPress mail server.', 'luxury-spa-gulshan' ); ?>
            </div>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <?php wp_nonce_field( 'lsg_contact_reply_' . $entry_id, 'lsg_contact_reply_nonce' ); ?>
                <input type="hidden" name="action" value="lsg_contact_reply_send">
                <input type="hidden" name="entry_id" value="<?php echo esc_attr( $entry_id ); ?>">
                <div class="wpistic-reply-meta">
                    <label>
                        <span><?php esc_html_e( 'From', 'luxury-spa-gulshan' ); ?></span>
                        <input type="email" value="<?php echo esc_attr( $reply_from ); ?>" disabled>
                    </label>
                    <label>
                        <span><?php esc_html_e( 'To', 'luxury-spa-gulshan' ); ?></span>
                        <input type="email" value="<?php echo esc_attr( $email ); ?>" disabled>
                    </label>
                </div>
                <label>
                    <span><?php esc_html_e( 'Subject', 'luxury-spa-gulshan' ); ?></span>
                    <input type="text" name="reply_subject" value="<?php echo esc_attr( $reply_subject ); ?>" required>
                </label>
                <label>
                    <span><?php esc_html_e( 'Reply Message', 'luxury-spa-gulshan' ); ?></span>
                    <textarea name="reply_message" rows="7" required></textarea>
                </label>
                <button type="submit" class="button button-primary"><?php esc_html_e( 'Send Reply', 'luxury-spa-gulshan' ); ?></button>
            </form>
        </div>
    </div>
    <?php
}
add_action( 'admin_footer', 'lsg_render_contact_reply_modal_footer' );

function lsg_cleanup_contact_entry_admin_menu() {
    remove_submenu_page( 'edit.php?post_type=lsg_contact_entry', 'post-new.php?post_type=lsg_contact_entry' );
}
add_action( 'admin_menu', 'lsg_cleanup_contact_entry_admin_menu', 999 );

function lsg_contact_entry_admin_branding() {
    $screen = get_current_screen();
    $is_contact_entry_screen = $screen && 'lsg_contact_entry' === $screen->post_type;
    $is_contact_settings     = $screen && false !== strpos( $screen->id, 'lsg-contact-settings' );
    if ( ! $is_contact_entry_screen && ! $is_contact_settings ) {
        return;
    }
    ?>
    <style>
        .post-type-lsg_contact_entry .wrap > h1.wp-heading-inline {
            display:none !important;
        }
        .post-type-lsg_contact_entry .page-title-action,
        .post-type-lsg_contact_entry #minor-publishing,
        .post-type-lsg_contact_entry #delete-action,
        .post-type-lsg_contact_entry #submitdiv,
        .post-type-lsg_contact_entry #slugdiv,
        .post-type-lsg_contact_entry #post-body-content,
        .post-type-lsg_contact_entry #screen-meta-links,
        .post-type-lsg_contact_entry .row-actions .inline,
        .post-type-lsg_contact_entry .row-actions .trash,
        .post-type-lsg_contact_entry .subsubsub .trash {
            display:none !important;
        }
        .post-type-lsg_contact_entry #post-body.columns-2 {
            margin-right:0 !important;
        }
        .post-type-lsg_contact_entry #postbox-container-1 {
            display:none !important;
        }
        .post-type-lsg_contact_entry #poststuff #post-body.columns-2 #postbox-container-2 {
            float:none;
            width:100%;
            margin-right:0;
        }
        .post-type-lsg_contact_entry #lsg_contact_entry_details {
            border:0;
            box-shadow:none;
            background:transparent;
        }
        .post-type-lsg_contact_entry #lsg_contact_entry_details .postbox-header {
            display:none;
        }
        .post-type-lsg_contact_entry #lsg_contact_entry_details .inside {
            margin:0;
            padding:0;
        }
        .wpistic-contact-admin-card {
            margin:12px 0 18px;
            padding:20px 22px;
            border:1px solid #dce3ee;
            border-left:5px solid #00C857;
            border-radius:10px;
            background:linear-gradient(135deg,#ffffff 0%,#f8fbff 100%);
            box-shadow:0 8px 28px rgba(15,32,68,.08);
        }
        .wpistic-contact-admin-card h2 {
            margin:0 0 6px;
            color:#0F2044;
            font-size:20px;
            line-height:1.25;
        }
        .wpistic-contact-admin-card p {
            margin:0;
            color:#536070;
            font-size:13px;
        }
        .wpistic-contact-admin-card a {
            color:#00a846;
            font-weight:700;
            text-decoration:none;
        }
        .wpistic-contact-admin-card a:hover {
            color:#0F2044;
        }
        .post-type-lsg_contact_entry .wp-list-table {
            border-radius:10px;
            overflow:hidden;
            border-color:#dce3ee;
            box-shadow:0 8px 24px rgba(15,32,68,.05);
        }
        .post-type-lsg_contact_entry .wp-list-table thead th {
            background:#0F2044;
            color:#fff;
        }
        .post-type-lsg_contact_entry .wp-list-table thead th a,
        .post-type-lsg_contact_entry .wp-list-table thead th span {
            color:#fff;
        }
        .wpistic-submission-view {
            display:grid;
            gap:18px;
        }
        .wpistic-submission-hero {
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:18px;
            padding:26px;
            border-radius:16px;
            background:linear-gradient(135deg,#0F2044 0%,#173866 100%);
            color:#fff;
            box-shadow:0 14px 36px rgba(15,32,68,.18);
        }
        .wpistic-submission-hero span {
            display:inline-block;
            margin-bottom:8px;
            color:#00C857;
            font-size:12px;
            font-weight:800;
            letter-spacing:.12em;
            text-transform:uppercase;
        }
        .wpistic-submission-hero h2 {
            margin:0 0 6px;
            color:#fff;
            font-size:28px;
            line-height:1.1;
        }
        .wpistic-submission-hero p {
            margin:0;
            color:rgba(255,255,255,.68);
        }
        .wpistic-submission-hero strong {
            padding:8px 13px;
            border-radius:999px;
            background:rgba(255,255,255,.12);
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.06em;
            white-space:nowrap;
        }
        .wpistic-submission-actions {
            display:flex;
            flex-wrap:wrap;
            justify-content:flex-end;
            gap:10px;
        }
        .wpistic-reply-toggle,
        .wpistic-reply-close {
            border:0;
            cursor:pointer;
        }
        .wpistic-reply-toggle {
            padding:9px 15px;
            border-radius:999px;
            background:#00C857;
            color:#0F2044;
            font-weight:800;
            letter-spacing:.03em;
            text-transform:uppercase;
        }
        .wpistic-reply-close {
            width:34px;
            height:34px;
            border-radius:50%;
            background:#eef3f8;
            color:#0F2044;
            font-size:22px;
            line-height:1;
        }
        .wpistic-status-pill {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-width:76px;
            padding:5px 9px;
            border-radius:999px;
            background:#eef3f8;
            color:#0F2044;
            font-size:11px;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:.04em;
        }
        .wpistic-status-pill.is-unread {
            background:rgba(0,200,87,.14);
            color:#008c3d;
        }
        .wpistic-status-pill.is-read,
        .wpistic-status-pill.is-none {
            background:#eef3f8;
            color:#687589;
        }
        .wpistic-status-pill.is-replied {
            background:rgba(0,200,87,.14);
            color:#008c3d;
        }
        .wpistic-status-pill.is-failed {
            background:rgba(198,40,40,.09);
            color:#a83232;
        }
        .wpistic-submission-hero strong.is-sent {
            background:rgba(0,200,87,.18);
            color:#8dffbd;
        }
        .wpistic-submission-hero strong.is-error {
            background:rgba(255,193,7,.18);
            color:#ffe08a;
        }
        .wpistic-submission-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
            gap:14px;
        }
        .wpistic-submission-item,
        .wpistic-submission-message {
            padding:18px;
            border:1px solid #dce3ee;
            border-radius:14px;
            background:#fff;
            box-shadow:0 8px 24px rgba(15,32,68,.06);
        }
        .wpistic-submission-item span,
        .wpistic-submission-message span {
            display:block;
            margin-bottom:7px;
            color:#687589;
            font-size:12px;
            font-weight:800;
            letter-spacing:.08em;
            text-transform:uppercase;
        }
        .wpistic-submission-item strong {
            color:#0F2044;
            font-size:15px;
            word-break:break-word;
        }
        .wpistic-submission-item a {
            color:#00a846;
            text-decoration:none;
        }
        .wpistic-submission-message {
            border-left:5px solid #00C857;
        }
        .wpistic-submission-message p {
            margin:0;
            color:#223047;
            font-size:16px;
            line-height:1.75;
            white-space:normal;
        }
        .wpistic-reply-alert,
        .wpistic-settings-alert {
            padding:14px 16px;
            border-radius:12px;
            border:1px solid #dce3ee;
            background:#fff;
            color:#223047;
            box-shadow:0 8px 24px rgba(15,32,68,.05);
        }
        .wpistic-reply-alert.is-success,
        .wpistic-settings-alert.is-success {
            border-color:rgba(0,200,87,.28);
            background:rgba(0,200,87,.08);
        }
        .wpistic-reply-alert.is-error,
        .wpistic-settings-alert.is-error {
            border-color:rgba(198,40,40,.22);
            background:rgba(198,40,40,.07);
        }
        .wpistic-settings-alert.is-warning,
        .wpistic-reply-smtp-note {
            border-color:rgba(255,193,7,.34);
            background:#fff8e5;
        }
        .wpistic-reply-panel,
        .wpistic-reply-history,
        .wpistic-contact-log,
        .wpistic-settings-card {
            padding:22px;
            border:1px solid #dce3ee;
            border-radius:16px;
            background:#fff;
            box-shadow:0 10px 28px rgba(15,32,68,.07);
        }
        .wpistic-reply-panel[hidden] {
            display:none !important;
        }
        .wpistic-reply-overlay {
            position:fixed;
            inset:0;
            z-index:100000;
            display:grid;
            place-items:center;
            padding:24px;
            background:rgba(15,32,68,.48);
            backdrop-filter:blur(5px);
        }
        .wpistic-reply-overlay[hidden] {
            display:none !important;
        }
        .wpistic-reply-overlay .wpistic-reply-panel {
            width:min(760px,100%);
            max-height:calc(100vh - 48px);
            overflow:auto;
        }
        .wpistic-reply-panel__head {
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:16px;
            margin-bottom:16px;
        }
        .wpistic-reply-panel__head span,
        .wpistic-reply-history > span,
        .wpistic-contact-log > span,
        .wpistic-settings-card h2 {
            display:block;
            margin:0 0 8px;
            color:#00a846;
            font-size:12px;
            font-weight:800;
            letter-spacing:.1em;
            text-transform:uppercase;
        }
        .wpistic-reply-panel__head h3 {
            margin:0;
            color:#0F2044;
            font-size:22px;
        }
        .wpistic-reply-panel label,
        .wpistic-settings-card label {
            display:grid;
            gap:7px;
            margin:0 0 16px;
            color:#0F2044;
            font-weight:700;
        }
        .wpistic-reply-panel input,
        .wpistic-reply-panel textarea,
        .wpistic-settings-card input[type="text"],
        .wpistic-settings-card input[type="email"] {
            width:100%;
            max-width:100%;
            border:1px solid #ccd6e3;
            border-radius:10px;
            padding:9px 11px;
        }
        .wpistic-reply-meta,
        .wpistic-settings-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:18px;
        }
        .wpistic-reply-smtp-note {
            margin-bottom:16px;
            padding:13px 14px;
            border:1px solid rgba(255,193,7,.34);
            border-radius:12px;
        }
        .wpistic-reply-history article {
            margin-top:12px;
            padding-top:12px;
            border-top:1px solid #edf1f6;
        }
        .wpistic-contact-log article {
            position:relative;
            margin-top:14px;
            padding:0 0 14px 22px;
            border-bottom:1px solid #edf1f6;
        }
        .wpistic-contact-log article::before {
            content:'';
            position:absolute;
            left:0;
            top:.35rem;
            width:10px;
            height:10px;
            border-radius:50%;
            background:#00C857;
            box-shadow:0 0 0 5px rgba(0,200,87,.12);
        }
        .wpistic-reply-history article strong,
        .wpistic-reply-history article small,
        .wpistic-contact-log article strong,
        .wpistic-contact-log article small {
            display:block;
        }
        .wpistic-reply-history article small,
        .wpistic-contact-log article small {
            margin:.25rem 0 .65rem;
            color:#687589;
        }
        .wpistic-contact-log article p {
            margin:.5rem 0 0;
            color:#a83232;
        }
        .wpistic-settings-wrap {
            max-width:1120px;
        }
        .wpistic-settings-hero h1 {
            margin:0 0 6px;
            color:#0F2044;
            font-size:24px;
            line-height:1.2;
        }
        .wpistic-settings-card h2 {
            font-size:13px;
        }
        .wpistic-settings-card small,
        .wpistic-field-row span {
            color:#687589;
            font-weight:500;
        }
        .wpistic-field-row {
            display:grid;
            grid-template-columns:minmax(130px,1fr) auto auto;
            align-items:center;
            gap:14px;
            padding:13px 0;
            border-bottom:1px solid #edf1f6;
        }
        .wpistic-field-row label {
            display:flex;
            align-items:center;
            gap:6px;
            margin:0;
            font-weight:600;
        }
        .wpistic-field-row.is-locked {
            grid-template-columns:minmax(130px,1fr) 2fr;
        }
        .wpistic-settings-actions {
            grid-column:1/-1;
        }
        .wpistic-settings-actions .button-primary,
        .wpistic-reply-panel .button-primary {
            border-color:#00C857;
            background:#00C857;
            color:#0F2044;
            font-weight:800;
        }
        @media(max-width:782px){
            .wpistic-submission-hero,
            .wpistic-submission-actions {
                display:grid;
                justify-content:stretch;
            }
            .wpistic-field-row {
                grid-template-columns:1fr;
            }
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var wrap = document.querySelector('.post-type-lsg_contact_entry .wrap');
        var title = wrap ? wrap.querySelector('h1.wp-heading-inline') : null;
        if (wrap && title && !document.querySelector('.wpistic-contact-admin-card')) {
            var card = document.createElement('div');
            card.className = 'wpistic-contact-admin-card';
            card.innerHTML = '<h2>WPistic Contact Form</h2><p>Build by <a href="https://www.wordpressistic.com/" target="_blank" rel="noopener noreferrer">Wordpressistic</a>. Review all submitted contact form details from this screen.</p>';
            title.insertAdjacentElement('afterend', card);
        }

        var replyToggle = document.querySelector('.wpistic-reply-toggle');
        var replyPanel = document.getElementById('wpistic-reply-panel');
        var replyClose = document.querySelector('.wpistic-reply-close');
        if (replyToggle && replyPanel) {
            replyToggle.addEventListener('click', function () {
                replyPanel.hidden = false;
                var field = replyPanel.querySelector('textarea');
                if (field) {
                    field.focus();
                }
            });
        }
        if (replyClose && replyPanel) {
            replyClose.addEventListener('click', function () {
                replyPanel.hidden = true;
            });
        }
        if (replyPanel) {
            replyPanel.addEventListener('click', function (event) {
                if (event.target === replyPanel) {
                    replyPanel.hidden = true;
                }
            });
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !replyPanel.hidden) {
                    replyPanel.hidden = true;
                }
            });
        }
    });
    </script>
    <?php
}
add_action( 'admin_head', 'lsg_contact_entry_admin_branding' );

// /* ============================================================
//    CLIENT ADMIN CLEANUP
//    ============================================================ */
// function lsg_hide_update_notices_for_all_users() {
//     remove_action( 'admin_notices', 'update_nag', 3 );
//     remove_action( 'network_admin_notices', 'update_nag', 3 );
//     remove_action( 'admin_notices', 'maintenance_nag' );
//     remove_action( 'network_admin_notices', 'maintenance_nag' );
//     remove_action( 'admin_notices', 'site_admin_notice' );
//     remove_all_actions( 'admin_notices' );
//     remove_all_actions( 'all_admin_notices' );
//     remove_all_actions( 'network_admin_notices' );
// }
// add_action( 'admin_init', 'lsg_hide_update_notices_for_all_users', 99 );

// function lsg_remove_update_admin_menu_items() {
//     remove_submenu_page( 'index.php', 'update-core.php' );
// }
// add_action( 'admin_menu', 'lsg_remove_update_admin_menu_items', 999 );

// function lsg_hide_update_admin_bar_items( $wp_admin_bar ) {
//     $wp_admin_bar->remove_node( 'updates' );
// }
// add_action( 'admin_bar_menu', 'lsg_hide_update_admin_bar_items', 999 );

function lsg_hide_update_ui_css() {
    ?>
    <style>
        .update-nag,
        .updated,
        .notice,
        .notice-alt,
        .error,
        .is-dismissible,
        .plugin-update-tr,
        .theme-update,
        .update-message,
        .update-plugins,
        .awaiting-mod,
        #wp-admin-bar-updates,
        #dashboard_plugins,
        #dashboard_primary,
        #dashboard_secondary,
        .plugins .notice,
        .plugins .update,
        .plugins .plugin-update,
        .wrap .notice,
        .wrap div.updated,
        .wrap div.error {
            display:none !important;
        }
    </style>
    <?php
}
//add_action( 'admin_head', 'lsg_hide_update_ui_css', 999 );

// function lsg_hide_plugin_update_counts( $menu ) {
//     foreach ( $menu as $index => $item ) {
//         if ( isset( $item[0] ) ) {
//             $menu[ $index ][0] = preg_replace( '/<span class="update-plugins.*?<\/span>/s', '', $item[0] );
//         }
//     }
//     return $menu;
// }
// add_filter( 'add_menu_classes', 'lsg_hide_plugin_update_counts', 999 );

/* ============================================================
   VISIT / MAP SECTION
   ============================================================ */
function lsg_render_visit_map_section() {
    static $assets_printed = false;

    $map_embed_url = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1825.5414347308824!2d90.4167573!3d23.7800632!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7ca6c3dd587%3A0xa97f652ca8e5e42!2sLuxury%20spa%20Gulshan!5e0!3m2!1sen!2sbd!4v1690442893477!5m2!1sen!2sbd';
    $directions_url = 'https://www.google.com/maps/dir/?api=1&destination=Luxury%20Spa%20Gulshan%2C%20House%2091-B%2C%20Road%2024%2C%20Gulshan-1%2C%20Dhaka%201212%2C%20Bangladesh';
    $profile_url = 'https://share.google/FxFedX5Q1d432vyPN';

    if ( ! $assets_printed ) :
        $assets_printed = true;
        ?>
        <style>
            .lsg-visit-map {
                position:relative;
                overflow:hidden;
                padding-block:clamp(3rem,6vw,5rem);
                background:
                    radial-gradient(circle at 18% 18%, rgba(180,145,90,.12), transparent 32%),
                    linear-gradient(135deg,#fffaf2 0%,#f6f1e8 100%);
                border-top:1px solid var(--lsg-border);
            }
            .lsg-visit-map::before {
                content:'';
                position:absolute;
                inset:auto -10% -42% auto;
                width:420px;
                height:420px;
                border-radius:50%;
                background:rgba(180,145,90,.1);
                filter:blur(10px);
                pointer-events:none;
            }
            .lsg-visit-map__grid {
                position:relative;
                display:grid;
                grid-template-columns:minmax(280px,.86fr) minmax(320px,1.14fr);
                gap:clamp(1.5rem,4vw,3rem);
                align-items:center;
            }
            .lsg-visit-map__content,
            .lsg-visit-map__frame {
                opacity:0;
                transform:translateY(24px);
                transition:opacity .7s ease, transform .7s ease;
            }
            .lsg-visit-map.is-visible .lsg-visit-map__content,
            .lsg-visit-map.is-visible .lsg-visit-map__frame {
                opacity:1;
                transform:translateY(0);
            }
            .lsg-visit-map.is-visible .lsg-visit-map__frame {
                transition-delay:.14s;
            }
            .lsg-visit-map__content {
                padding:clamp(1.6rem,3vw,2.2rem);
                border:1px solid var(--lsg-border);
                border-radius:var(--lsg-radius-xl);
                background:rgba(255,255,255,.82);
                box-shadow:var(--lsg-shadow-md);
                backdrop-filter:blur(14px);
            }
            .lsg-visit-map__eyebrow {
                display:inline-flex;
                gap:.45rem;
                align-items:center;
                margin-bottom:.8rem;
                color:var(--lsg-accent);
                font-size:.76rem;
                font-weight:800;
                letter-spacing:.18em;
                text-transform:uppercase;
            }
            .lsg-visit-map__eyebrow::before {
                content:'';
                width:7px;
                height:7px;
                border-radius:50%;
                background:var(--lsg-accent);
                box-shadow:0 0 0 6px rgba(180,145,90,.13);
            }
            .lsg-visit-map__content h2 {
                margin:0 0 .85rem;
                color:var(--lsg-contrast);
                font-size:clamp(2rem,4vw,3.35rem);
                line-height:1.02;
                letter-spacing:-.035em;
            }
            .lsg-visit-map__content p {
                margin:0 0 1.4rem;
                color:var(--lsg-muted);
                max-width:560px;
            }
            .lsg-visit-map__address {
                display:grid;
                gap:.45rem;
                margin:0 0 1.55rem;
                padding:1rem 1.1rem;
                border-radius:var(--lsg-radius-lg);
                background:var(--lsg-surface);
                border:1px solid var(--lsg-border);
                color:var(--lsg-contrast);
                font-weight:700;
            }
            .lsg-visit-map__address span {
                color:var(--lsg-muted);
                font-size:.92rem;
                font-weight:500;
            }
            .lsg-visit-map__actions {
                display:flex;
                flex-wrap:wrap;
                gap:.85rem;
                align-items:center;
            }
            .lsg-visit-map__profile {
                color:var(--lsg-muted);
                font-size:.9rem;
                font-weight:700;
                border-bottom:1px dashed rgba(180,145,90,.55);
            }
            .lsg-visit-map__profile:hover {
                color:var(--lsg-accent);
            }
            .lsg-visit-map__frame {
                position:relative;
                min-height:430px;
                border-radius:var(--lsg-radius-xl);
                overflow:hidden;
                border:1px solid rgba(45,40,34,.14);
                background:#fff;
                box-shadow:0 28px 70px rgba(45,40,34,.16);
            }
            .lsg-visit-map__frame::before {
                content:'';
                position:absolute;
                inset:16px;
                border:1px solid rgba(255,255,255,.75);
                border-radius:calc(var(--lsg-radius-xl) - 10px);
                z-index:2;
                pointer-events:none;
            }
            .lsg-visit-map__frame iframe {
                width:100%;
                height:100%;
                min-height:430px;
                border:0;
                filter:saturate(.9) contrast(.96);
            }
            .lsg-visit-map__pin {
                position:absolute;
                left:50%;
                top:50%;
                z-index:3;
                width:18px;
                height:18px;
                border-radius:50%;
                background:var(--lsg-accent);
                border:3px solid #fff;
                box-shadow:0 0 0 0 rgba(180,145,90,.35);
                animation:lsgMapPulse 2.2s infinite;
                pointer-events:none;
            }
            @keyframes lsgMapPulse {
                0% { box-shadow:0 0 0 0 rgba(180,145,90,.36); }
                70% { box-shadow:0 0 0 22px rgba(180,145,90,0); }
                100% { box-shadow:0 0 0 0 rgba(180,145,90,0); }
            }
            @media (max-width:860px) {
                .lsg-visit-map__grid { grid-template-columns:1fr; }
                .lsg-visit-map__frame,
                .lsg-visit-map__frame iframe { min-height:340px; }
                .lsg-visit-map__actions .lsg-btn { width:100%; }
            }
        </style>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sections = document.querySelectorAll('.lsg-visit-map');
            if (!sections.length) return;
            if (!('IntersectionObserver' in window)) {
                sections.forEach(function (section) { section.classList.add('is-visible'); });
                return;
            }
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.22 });
            sections.forEach(function (section) { observer.observe(section); });
        });
        </script>
        <?php
    endif;
    ?>
    <section class="lsg-visit-map" aria-labelledby="lsg-visit-map-title">
        <div class="lsg-container">
            <div class="lsg-visit-map__grid">
                <div class="lsg-visit-map__content">
                    <span class="lsg-visit-map__eyebrow"><?php esc_html_e( 'Visit Our Spa', 'luxury-spa-gulshan' ); ?></span>
                    <h2 id="lsg-visit-map-title"><?php esc_html_e( 'Visit Luxury Spa In Gulshan', 'luxury-spa-gulshan' ); ?></h2>
                    <p><?php esc_html_e( 'Find us in the heart of Gulshan-1 and plan your visit with one tap directions.', 'luxury-spa-gulshan' ); ?></p>
                    <div class="lsg-visit-map__address">
                        <?php esc_html_e( 'House 91-B, Road 24, Gulshan-1', 'luxury-spa-gulshan' ); ?>
                        <span><?php esc_html_e( 'Dhaka 1212, Bangladesh', 'luxury-spa-gulshan' ); ?></span>
                    </div>
                    <div class="lsg-visit-map__actions">
                        <a class="lsg-btn lsg-btn--lg" href="<?php echo esc_url( $directions_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Directions', 'luxury-spa-gulshan' ); ?></a>
                        <a class="lsg-visit-map__profile" href="<?php echo esc_url( $profile_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View Google Profile', 'luxury-spa-gulshan' ); ?></a>
                    </div>
                </div>
                <div class="lsg-visit-map__frame">
                    <span class="lsg-visit-map__pin" aria-hidden="true"></span>
                    <iframe src="<?php echo esc_url( $map_embed_url ); ?>" loading="lazy" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade" title="<?php esc_attr_e( 'Luxury Spa Gulshan Google Map', 'luxury-spa-gulshan' ); ?>"></iframe>
                </div>
            </div>
        </div>
    </section>
    <?php
}