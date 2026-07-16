<?php
/**
 * Front Page — Homepage
 *
 * @package luxury-spa-gulshan
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

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

$featured_service_pages = get_posts( array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => array(
        'menu_order' => 'ASC',
        'title'      => 'ASC',
    ),
    'meta_query'     => array(
        array(
            'key'     => 'service_popular',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) );

$featured_services = array();
foreach ( $featured_service_pages as $service_page ) {
    $template = get_page_template_slug( $service_page );
    $is_service_child = $services_page && (int) $service_page->post_parent === (int) $services_page->ID;
    $is_service_template = in_array( $template, $service_templates, true );

    if ( $is_service_child || $is_service_template ) {
        $featured_services[] = $service_page;
    }
}

get_header();
?>

<style>
/* Homepage-specific layout. Global header/footer assets load through header.php and footer.php. */
:root {
    --lsg-bg: #f6f1e8;
    --lsg-surface: #fffaf2;
    --lsg-accent: #b4915a;
    --lsg-accent-soft: rgba(180,145,90,.12);
    --lsg-contrast: #2d2823;
    --lsg-muted: #6f655d;
    --lsg-border: rgba(45,40,34,.12);
    --lsg-shadow-sm: 0 4px 16px rgba(45,40,34,.07);
    --lsg-shadow-md: 0 20px 40px rgba(45,40,34,.10);
    --lsg-shadow-lg: 0 32px 64px rgba(45,40,34,.13);
    --lsg-radius-sm: 12px;
    --lsg-radius-md: 20px;
    --lsg-radius-lg: 28px;
    --lsg-radius-xl: 40px;
    --lsg-max-width: 1240px;
    --lsg-transition: 0.28s ease;
}
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; font-size: 16px; }
body {
    margin: 0;
    font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
    background: var(--lsg-bg);
    color: var(--lsg-contrast);
    line-height: 1.72;
    -webkit-font-smoothing: antialiased;
}
a { color: inherit; text-decoration: none; }
a:hover { color: var(--lsg-accent); }
img { max-width: 100%; height: auto; display: block; }
button, input, select, textarea { font: inherit; }
.lsg-container {
    width: min(100%, var(--lsg-max-width));
    margin-inline: auto;
    padding-inline: clamp(1rem, 4vw, 2rem);
}
.skip-link {
    position: absolute;
    top: -9999px;
    left: 1rem;
    z-index: 9999;
    padding: .5rem 1rem;
    background: var(--lsg-accent);
    color: #fff;
    border-radius: var(--lsg-radius-sm);
}
.skip-link:focus { top: 1rem; }
.lsg-header {
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 200;
    background: rgba(255,250,242,.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--lsg-border);
    transition: box-shadow var(--lsg-transition);
}
.lsg-header.scrolled { box-shadow: var(--lsg-shadow-sm); }
.lsg-header__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    padding-block: 1.1rem;
}
.lsg-header__logo { flex-shrink: 0; }
.lsg-header__logo img { max-height: 58px; width: auto; }
.lsg-nav { display: flex; align-items: center; }
.lsg-nav__list {
    display: flex;
    align-items: center;
    gap: .25rem;
    list-style: none;
    margin: 0;
    padding: 0;
}
.lsg-nav__list li { position: relative; }
.lsg-nav__list > li > a {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .55rem .9rem;
    border-radius: var(--lsg-radius-sm);
    font-weight: 500;
    font-size: .95rem;
    transition: background var(--lsg-transition), color var(--lsg-transition);
}
.lsg-nav__list > li > a:hover,
.lsg-nav__list > li.current-menu-item > a,
.lsg-nav__list > li.current-menu-parent > a {
    background: var(--lsg-accent-soft);
    color: var(--lsg-accent);
}
.lsg-nav__list .menu-item-has-children > a::after {
    content: '';
    display: inline-block;
    width: 7px;
    height: 7px;
    border-right: 1.5px solid currentColor;
    border-bottom: 1.5px solid currentColor;
    transform: rotate(45deg) translateY(-2px);
    margin-left: .2rem;
    transition: transform var(--lsg-transition);
}
.lsg-nav__list .menu-item-has-children:hover > a::after {
    transform: rotate(225deg) translateY(-2px);
}
.lsg-nav__list .sub-menu {
    position: absolute;
    top: calc(100% + .5rem);
    left: 0;
    min-width: 230px;
    background: #fff;
    border: 1px solid var(--lsg-border);
    border-radius: var(--lsg-radius-md);
    box-shadow: var(--lsg-shadow-lg);
    padding: .5rem;
    list-style: none;
    margin: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: opacity var(--lsg-transition), transform var(--lsg-transition), visibility var(--lsg-transition);
    z-index: 300;
}
.lsg-nav__list li:hover > .sub-menu,
.lsg-nav__list li:focus-within > .sub-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.lsg-nav__list .sub-menu li a {
    display: block;
    padding: .65rem 1rem;
    border-radius: var(--lsg-radius-sm);
    font-size: .92rem;
    color: var(--lsg-muted);
    transition: background var(--lsg-transition), color var(--lsg-transition);
}
.lsg-nav__list .sub-menu li a:hover {
    background: var(--lsg-accent-soft);
    color: var(--lsg-contrast);
}
.lsg-nav__cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: .6rem 1.35rem;
    margin-left: .5rem;
    background: var(--lsg-contrast);
    color: #fff !important;
    border-radius: 999px;
    font-weight: 600;
    font-size: .9rem;
    transition: background var(--lsg-transition), transform var(--lsg-transition);
}
.lsg-nav__cta:hover {
    background: var(--lsg-accent) !important;
    transform: translateY(-1px);
    color: #fff !important;
}
.lsg-menu-toggle {
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    width: 42px;
    height: 42px;
    border: 1px solid var(--lsg-border);
    border-radius: var(--lsg-radius-sm);
    background: #fff;
    cursor: pointer;
    padding: 0;
}
.lsg-menu-toggle span {
    display: block;
    width: 20px;
    height: 2px;
    background: var(--lsg-contrast);
    border-radius: 2px;
    transition: transform .3s ease, opacity .3s ease;
}
.lsg-menu-toggle[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.lsg-menu-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
.lsg-menu-toggle[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.lsg-mobile-nav {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 190;
    background: var(--lsg-bg);
    padding: 5rem 1.5rem 2rem;
    overflow-y: auto;
    opacity: 0;
    transform: translateX(100%);
    transition: opacity .35s ease, transform .35s ease;
}
.lsg-mobile-nav.open {
    opacity: 1;
    transform: translateX(0);
}
.lsg-mobile-nav .lsg-nav__list {
    flex-direction: column;
    align-items: stretch;
    gap: .4rem;
}
.lsg-mobile-nav .lsg-nav__list > li > a {
    font-size: 1.05rem;
    padding: .9rem 1.1rem;
    background: #fff;
    border: 1px solid var(--lsg-border);
    border-radius: var(--lsg-radius-md);
}
.lsg-mobile-nav .sub-menu {
    position: static;
    opacity: 1;
    visibility: visible;
    transform: none;
    box-shadow: none;
    border: none;
    padding: .3rem 0 .3rem .8rem;
    display: none;
}
.lsg-mobile-nav .menu-item-has-children.open > .sub-menu { display: block; }
.lsg-mobile-nav .lsg-nav__cta {
    display: block;
    text-align: center;
    margin: 1rem 0 0;
    padding: .9rem;
    font-size: 1rem;
}
.lsg-section { padding-block: clamp(2.5rem, 5vw, 4.5rem); }
.lsg-section--flush-top { padding-top: 0; }
.lsg-section__header { margin-bottom: 2.5rem; }
.lsg-eyebrow {
    display: inline-block;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--lsg-accent);
    margin-bottom: .75rem;
}
.lsg-heading {
    margin: 0 0 .75rem;
    font-size: clamp(1.9rem, 3vw, 3rem);
    line-height: 1.08;
    letter-spacing: -.025em;
    color: var(--lsg-contrast);
}
.lsg-heading--hero {
    font-size: clamp(2.4rem, 4.5vw, 4.4rem);
    letter-spacing: -.04em;
    background: linear-gradient(135deg, var(--lsg-contrast) 0%, var(--lsg-accent) 50%, var(--lsg-contrast) 100%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 8s ease infinite, slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.25s both;
}
.lsg-heading--hero span {
    display: inline-block;
    background: inherit;
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: revealWord 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}
@keyframes gradientShift {
    0%, 100% { background-position: 0% center; }
    50% { background-position: 100% center; }
}
@keyframes revealWord {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.lsg-lead {
    font-size: clamp(.97rem, 1.4vw, 1.1rem);
    color: var(--lsg-muted);
    max-width: 640px;
    line-height: 1.75;
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
    filter: drop-shadow(0 2px 8px rgba(45,40,34,0.05));
}
.lsg-hero__content {
    position: relative;
    z-index: 1;
    max-width: 780px;
}
.lsg-hero__content .fp-hero__eyebrow {
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
}

/* Semi-transparent background image (replace URL with your own) */
.fp-hero::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background-image: url('https://luxuryspagulshan.com/wp-content/uploads/2026/04/Sensual-Massage-.jpg') !important; /* change */
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
    opacity: 0.12 !important;
    mix-blend-mode: overlay !important;
    pointer-events: none !important;
    z-index: 0 !important;
}

/* Existing gradient background moves to a separate pseudo */
.fp-hero .gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--lsg-bg) 0%, var(--lsg-surface) 100%);
    z-index: -2;
}

/* Make blobs larger and more organic */
.shape-blob-1 {
    width: 550px;
    height: 550px;
    background: radial-gradient(ellipse at 30% 30%, rgba(180,145,90,0.12), transparent 70%);
}

.shape-blob-2 {
    width: 480px;
    height: 480px;
    background: radial-gradient(ellipse at 60% 60%, rgba(180,145,90,0.08), transparent 75%);
}


.lsg-hero__content .lsg-heading--hero {
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.25s both;
}
.lsg-hero__content .lsg-lead {
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
}
.lsg-hero__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1.75rem;
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.55s both;
}
.lsg-btn,
.lsg-btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: .85rem 1.7rem;
    border-radius: 999px;
    border: 1.5px solid transparent;
    font-weight: 600;
    font-size: .95rem;
    cursor: pointer;
    transition: transform var(--lsg-transition), background var(--lsg-transition), color var(--lsg-transition), border-color var(--lsg-transition), box-shadow var(--lsg-transition);
    white-space: nowrap;
    position: relative;
    overflow: hidden;
}
.lsg-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
    pointer-events: none;
}
.lsg-btn:active::before {
    width: 300px;
    height: 300px;
}
.lsg-btn { 
    background: var(--lsg-contrast); 
    color: #fff;
    box-shadow: 0 4px 15px rgba(45,40,34,0.15);
}
.lsg-btn:hover {
    background: var(--lsg-accent);
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(180,145,90,.4), inset 0 1px 0 rgba(255,255,255,0.2);
}
.lsg-btn-outline {
    background: rgba(255,255,255,0.5);
    color: var(--lsg-contrast);
    border-color: var(--lsg-accent);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(45,40,34,0.08);
}
.lsg-btn-outline:hover {
    background: var(--lsg-accent-soft);
    border-color: var(--lsg-accent);
    color: var(--lsg-accent);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(180,145,90,0.25);
}
.lsg-btn--sm { padding: .55rem 1.1rem; font-size: .87rem; }
.lsg-btn--lg { padding: 1rem 2.2rem; font-size: 1.05rem; }
.lsg-grid {
    display: grid;
    gap: 1.75rem;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}
.lsg-grid--3 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
.lsg-card {
    background: #fff;
    border: 1px solid var(--lsg-border);
    border-radius: var(--lsg-radius-lg);
    box-shadow: var(--lsg-shadow-md);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform var(--lsg-transition), box-shadow var(--lsg-transition);
}
.lsg-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--lsg-shadow-lg);
}
.lsg-card__img { overflow: hidden; aspect-ratio: 16/10; }
.lsg-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .55s ease;
}
.lsg-card:hover .lsg-card__img img { transform: scale(1.04); }
.lsg-card__body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.lsg-card__title {
    margin: .5rem 0 .6rem;
    font-size: 1.2rem;
    color: var(--lsg-contrast);
    line-height: 1.3;
}
.lsg-card__desc { color: var(--lsg-muted); font-size: .92rem; flex: 1; margin: 0 0 1rem; }
.lsg-card__meta { color: var(--lsg-muted); font-size: .88rem; margin: .3rem 0; }
.lsg-badge {
    display: inline-flex;
    align-items: center;
    padding: .3rem .85rem;
    border-radius: 999px;
    background: var(--lsg-accent-soft);
    color: var(--lsg-accent);
    font-size: .76rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
}
.lsg-cta-banner {
    background: var(--lsg-surface);
    border: 1px solid var(--lsg-border);
    border-radius: var(--lsg-radius-xl);
    padding: 2.25rem 2rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: center;
    justify-content: space-between;
}
.lsg-cta-banner__text h2 { margin: 0 0 .4rem; font-size: 1.4rem; }
.lsg-cta-banner__text p {
    margin: 0;
    color: var(--lsg-muted);
    max-width: 560px;
    font-size: .95rem;
}
.lsg-footer {
    background: var(--lsg-contrast);
    color: rgba(255,250,242,.82);
    margin-top: 4rem;
}
.lsg-footer__widgets {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2.5rem;
    padding-block: 3.5rem 2rem;
}
.lsg-footer__logo img {
    max-height: 52px;
    filter: brightness(0) invert(1);
    opacity: .9;
}
.lsg-footer__tagline {
    margin-top: .75rem;
    font-size: .9rem;
    line-height: 1.6;
}
.lsg-footer__col h4 {
    color: #fff;
    font-size: .88rem;
    letter-spacing: .12em;
    text-transform: uppercase;
    margin: 0 0 1.1rem;
}
.lsg-footer__links,
.lsg-footer__contact {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: .6rem;
}
.lsg-footer__links a,
.lsg-footer__contact a {
    color: rgba(255,250,242,.7);
    font-size: .92rem;
    transition: color var(--lsg-transition);
}
.lsg-footer__links a:hover,
.lsg-footer__contact a:hover { color: var(--lsg-accent); }
.lsg-footer__contact li { font-size: .92rem; }
.lsg-footer__bottom {
    border-top: 1px solid rgba(255,255,255,.08);
    padding-block: 1.35rem;
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    justify-content: space-between;
    font-size: .85rem;
    color: rgba(255,250,242,.5);
}
.lsg-footer__bottom a {
    color: rgba(255,250,242,.6);
    transition: color var(--lsg-transition);
}
.lsg-footer__bottom a:hover { color: var(--lsg-accent); }
/* ---- Front page specific overrides ---- */
.fp-hero {
    min-height: 85vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--lsg-bg) 0%, var(--lsg-surface) 100%);
    position: relative;
    overflow: hidden;
    padding-block: clamp(4rem,10vw,7rem);
    z-index: 1;
}
.fp-hero::before {
    content:'';
    position:absolute;
    inset:0;
    background: 
        radial-gradient(ellipse 70% 80% at 85% 20%, rgba(180,145,90,.15), transparent 55%),
        radial-gradient(ellipse 50% 40% at 10% 80%, rgba(180,145,90,.08), transparent 50%);
    pointer-events:none;
    animation: heroBackgroundShift 20s ease-in-out infinite;
    z-index: 0;
}
@keyframes heroBackgroundShift {
    0%, 100% { transform: translateZ(0) scale(1); opacity: 1; }
    50% { transform: translateZ(0) scale(1.03); opacity: 0.95; }
}
/* Floating particles */
.fp-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 15% 30%, rgba(180,145,90,0.12) 0%, transparent 8%),
        radial-gradient(circle at 85% 20%, rgba(180,145,90,0.08) 0%, transparent 10%),
        radial-gradient(circle at 25% 75%, rgba(180,145,90,0.09) 0%, transparent 9%),
        radial-gradient(circle at 90% 70%, rgba(180,145,90,0.07) 0%, transparent 11%),
        radial-gradient(circle at 50% 50%, rgba(180,145,90,0.05) 0%, transparent 12%);
    background-size: 200% 200%;
    pointer-events: none;
    animation: floatParticles 25s ease-in-out infinite;
    z-index: 0;
}
@keyframes floatParticles {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

.fp-hero__eyebrow {
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    margin-bottom:1.25rem;
    padding:.35rem .95rem;
    border-radius:999px;
    background:var(--lsg-accent-soft);
    font-size:.78rem;
    font-weight:700;
    letter-spacing:.2em;
    text-transform:uppercase;
    color:var(--lsg-accent);
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
    border: 1px solid rgba(180,145,90,0.3);
    box-shadow: 0 4px 12px rgba(180,145,90,0.08);
    transition: all 0.3s ease;
}
.fp-hero__eyebrow:hover {
    background: var(--lsg-accent);
    color: #fff;
    box-shadow: 0 8px 24px rgba(180,145,90,0.2);
    transform: translateY(-2px);
}
.fp-hero__eyebrow::before {
    content:'';
    width:6px;height:6px;
    border-radius:50%;
    background:var(--lsg-accent);
    flex-shrink:0;
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.2); }
}
.fp-stats {
    display:flex;
    flex-wrap:wrap;
    gap:1.5rem;
    margin-top:2.25rem;
    padding-top:2.25rem;
    border-top:1px solid var(--lsg-border);
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.75s both;
}
.fp-stats__item {
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.fp-stats__item:hover {
    transform: translateY(-5px);
}
.fp-stats__item strong {
    display:block;
    font-size:1.8rem;
    font-weight:800;
    color:var(--lsg-accent);
    line-height:1;
    animation: countUp 2s ease-out 0.75s forwards;
    opacity: 0;
}
.fp-stats__item span {
    font-size:.83rem;
    color:var(--lsg-muted);
    margin-top:.25rem;
    display:block;
}
@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
/* Scroll Indicator */
.fp-hero__scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 1.2s both;
    cursor: pointer;
    z-index: 10;
}
.fp-hero__scroll-indicator span {
    display: block;
    width: 6px;
    height: 10px;
    border: 2px solid var(--lsg-accent);
    border-radius: 3px;
    position: relative;
}
.fp-hero__scroll-indicator span::after {
    content: '';
    display: block;
    width: 2px;
    height: 4px;
    background: var(--lsg-accent);
    border-radius: 1px;
    position: absolute;
    top: 2px;
    left: 50%;
    transform: translateX(-50%);
    animation: scrollBounce 2s infinite;
}
@keyframes scrollBounce {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 1; }
    50% { transform: translateX(-50%) translateY(4px); opacity: 0.3; }
}
.fp-why { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; }
.fp-why__card {
    background:#fff;
    border:1px solid var(--lsg-border);
    border-radius:var(--lsg-radius-lg);
    padding:1.75rem 1.5rem;
    text-align:center;
}
.fp-why__icon {
    width:52px;height:52px;
    margin:0 auto 1rem;
    border-radius:50%;
    background:var(--lsg-accent-soft);
    display:flex;align-items:center;justify-content:center;
    font-size:1.4rem;
}
.fp-why__card h3 { margin:0 0 .5rem; font-size:1rem; }
.fp-why__card p  { margin:0; font-size:.9rem; color:var(--lsg-muted); }
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(32px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@media (max-width:640px) {
    .fp-stats { gap:1rem; }
    .fp-stats__item strong { font-size:1.5rem; }
    .fp-hero__scroll-indicator { bottom: 1rem; }
}
@media (max-width:900px) {
    .lsg-nav { display: none; }
    .lsg-menu-toggle { display: flex; }
    .lsg-mobile-nav { display: block; }
}
@media (max-width:640px) {
    .lsg-hero__actions { flex-direction: column; }
    .lsg-hero__actions .lsg-btn,
    .lsg-hero__actions .lsg-btn-outline { width: 100%; justify-content: center; }
    .lsg-cta-banner { text-align: center; }
    .lsg-cta-banner .lsg-btn { width: 100%; }
    .lsg-footer__widgets { grid-template-columns: 1fr; }
    .lsg-footer__bottom { flex-direction: column; text-align: center; }
    .lsg-heading--hero {
        -webkit-text-fill-color: unset;
        background: unset;
        background-clip: unset;
        color: var(--lsg-contrast);
    }
}
</style>

<!-- HERO -->
<section class="fp-hero lsg-section" id="heroSection">
  <div class="lsg-container">
    <div class="lsg-hero__content">
      <div class="fp-hero__eyebrow"><?php esc_html_e( 'Luxury Spa Gulshan', 'luxury-spa-gulshan' ); ?></div>
      <h1 class="lsg-heading lsg-heading--hero">
        <?php esc_html_e( 'Relax, Renew &amp; Restore in Dhaka\'s Premier Spa', 'luxury-spa-gulshan' ); ?>
      </h1>
      <p class="lsg-lead"><?php esc_html_e( 'Carefully crafted body treatments, expert massages, and premium spa services in the heart of Gulshan. Your peaceful escape from the city.', 'luxury-spa-gulshan' ); ?></p>
      <div class="lsg-hero__actions">
        <a class="lsg-btn lsg-btn--lg" href="<?php echo esc_url( home_url( '/our-pricing/' ) ); ?>"><?php esc_html_e( 'View Pricing', 'luxury-spa-gulshan' ); ?></a>
        <a class="lsg-btn-outline lsg-btn--lg" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'See All Services', 'luxury-spa-gulshan' ); ?></a>
      </div>
      <div class="fp-stats">
        <div class="fp-stats__item"><strong>10+</strong><span><?php esc_html_e( 'Signature Services', 'luxury-spa-gulshan' ); ?></span></div>
        <div class="fp-stats__item"><strong>5000+</strong><span><?php esc_html_e( 'Happy Guests', 'luxury-spa-gulshan' ); ?></span></div>
        <div class="fp-stats__item"><strong>9AM–11PM</strong><span><?php esc_html_e( 'Open Daily', 'luxury-spa-gulshan' ); ?></span></div>
      </div>
    </div>
  </div>
  <div class="fp-hero__scroll-indicator">
    <span></span>
  </div>
</section>

<script>
(function() {
    // ==================== PARALLAX SCROLLING ====================
    const heroSection = document.getElementById('heroSection');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxBg = heroSection.querySelector('.fp-hero::before');
            if (scrolled < window.innerHeight) {
                heroSection.style.backgroundPosition = '0% ' + (scrolled * 0.5) + 'px';
                const pseudoElement = heroSection.style;
                pseudoElement.setProperty('--parallax-offset', scrolled * 0.3 + 'px');
            }
        });
    }




    // ==================== SCROLL INDICATOR SMOOTH SCROLL ====================
    const scrollIndicator = document.querySelector('.fp-hero__scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const nextSection = document.querySelector('.dynamic-faq-section');
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    // ==================== ENHANCED TEXT REVEAL (Word by Word) ====================
    const heroHeading = document.querySelector('.lsg-heading--hero');
    if (heroHeading) {
        const text = heroHeading.textContent.trim();
        const words = text.split(/\s+/);
        heroHeading.innerHTML = '';
        
        words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word;
            span.style.animationDelay = (0.25 + index * 0.08) + 's';
            heroHeading.appendChild(span);
            
            // Add space between words (except last)
            if (index < words.length - 1) {
                heroHeading.appendChild(document.createTextNode(' '));
            }
        });
    }

    // ==================== FLOATING FEATURE CARD ====================
    const featureCard = document.createElement('div');
    featureCard.className = 'fp-hero__floating-card';
    featureCard.innerHTML = `
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="font-size: 24px;">✨</div>
            <div style="font-size: 12px; font-weight: 600; color: var(--lsg-accent);">Premium Award</div>
        </div>
        <div style="font-size: 11px; color: var(--lsg-muted); margin-top: 4px;">Voted Best Spa 2024</div>
    `;
    
    if (heroSection && !document.querySelector('.fp-hero__floating-card')) {
        heroSection.appendChild(featureCard);
        
        const style = document.createElement('style');
        style.textContent = `
            .fp-hero__floating-card {
                position: absolute;
                bottom: 8%;
                right: 5%;
                background: white;
                padding: 16px 20px;
                border-radius: 16px;
                box-shadow: 0 12px 40px rgba(45,40,34,0.15);
                border: 1px solid rgba(180,145,90,0.2);
                z-index: 5;
                animation: floatCard 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
                backdrop-filter: blur(10px);
            }
            @keyframes floatCard {
                0%, 100% { transform: translateY(0px) rotateZ(0deg); }
                50% { transform: translateY(-15px) rotateZ(1deg); }
            }
            @media (max-width: 768px) {
                .fp-hero__floating-card {
                    bottom: 5%;
                    right: 2%;
                    padding: 12px 16px;
                    font-size: 11px;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // ==================== MOUSE FOLLOWER EFFECT ====================
    if (heroSection) {
        heroSection.addEventListener('mousemove', function(e) {
            const rect = heroSection.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;
            
            heroSection.style.setProperty('--mouse-x', xPercent + '%');
            heroSection.style.setProperty('--mouse-y', yPercent + '%');
        });
    }
})();
</script>



<!-- ========== DYNAMIC FAQ SECTION: MOST POPULAR SPA PACKAGES ========== -->
    <section class="dynamic-faq-section">
        <div class="faq-header">
            <div class="faq-subtitle">Ultimate Relaxation</div>
            <h2 class="faq-title">Most Popular Spa Packages</h2>
            <div style="height: 10px;"></div>
            <p style="max-width: 650px; margin: 12px auto 0; font-style: italic;">Explore our exclusive massage experiences — tailor-made for your body & soul.</p>
        </div>

        <!-- Dynamic Tabs (filter by category) -->
        <div class="package-tabs" id="packageTabs">
            <button class="tab-btn active" data-category="all">All Packages</button>
            <button class="tab-btn" data-category="signature">Signature Therapies</button>
            <button class="tab-btn" data-category="intensive">Deep & Intensive</button>
            <button class="tab-btn" data-category="couple">Luxury Duo</button>
        </div>

        <!-- FAQ Accordion Container: dynamically populated with JS -->
        <div class="faq-accordion-container" id="faqContainer">
            <!-- JS will inject FAQs here with beautiful animation -->
        </div>

        <div class="booking-hint">
             Ready to indulge? <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Book your session now →</a> — limited slots available.
        </div>
    </section>

    <script>
        (function() {
            // ========================
            // FAQ DATA (based on your original content + enriched with dynamic pricing)
            // ========================
            const faqData = [
                {
                    id: 1,
                    category: "signature",
                    question: " Dry Massage – Traditional Healing",
                    answer: "Experience ultimate relaxation with our Dry Massage focusing on pressure points and stretching to release deep tension.<br><br> <strong class='price-highlight'>60 min – 6,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 9,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 11,000 Tk</strong><br> Increases flexibility & blood flow.  Best for office stress."
                },
                {
                    id: 2,
                    category: "couple",
                    question: " Four Hand Massage – Synchronized Harmony",
                    answer: "Two expert therapists work in perfect sync to deliver a deeply soothing and immersive treatment.<br><br> <strong class='price-highlight'>60 min – 14,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 18,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 25,000 Tk</strong><br> Perfect for complete mind-body renewal."
                },
                {
                    id: 3,
                    category: "intensive",
                    question: " Deep Tissue Massage – Targeted Muscle Relief",
                    answer: "Ease chronic muscle tension and accelerate recovery with focused deep tissue techniques.<br><br> <strong class='price-highlight'>60 min – 8,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 11,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 15,000 Tk</strong><br>Ideal for athletes and those with stiff shoulders."
                },
                {
                    id: 4,
                    category: "signature",
                    question: " Sensual Massage – Awaken The Senses",
                    answer: "Gentle, flowing strokes combined with aromatic ambience to release emotional stress and awaken vitality.<br><br><strong class='price-highlight'>60 min – 6,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 9,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 10,500 Tk</strong><br>✨ Private & serene environment."
                },
                {
                    id: 5,
                    category: "signature",
                    question: " Aroma Oil Massage – Relax & Revive",
                    answer: "Essential oils melt away stress while improving mood and skin texture.<br><br> <strong class='price-highlight'>60 min – 6,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 9,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 11,999 Tk</strong><br>Calming fragrance + expert hands."
                },
                {
                    id: 6,
                    category: "intensive",
                    question: " Nuru Massage – Body-to-Body Bliss",
                    answer: "Luxurious Japanese Nuru gel massage enhances intimacy and total muscle relaxation.<br><br><strong class='price-highlight'>60 min – 8,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 12,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 15,000 Tk</strong><br>Exotic & deeply revitalizing."
                },
                {
                    id: 7,
                    category: "signature",
                    question: "Body Scrub with Facial – Complete Glow",
                    answer: "Reveal fresh, radiant skin with exfoliating scrub followed by a hydrating facial.<br><br> <strong class='price-highlight'>100 min – 15,000 Tk</strong><br>Removes dead cells, boosts collagen."
                },
                {
                    id: 8,
                    category: "intensive",
                    question: " Back & Shoulder Massage – Instant Tension Release",
                    answer: "Focus on upper back, neck and shoulders to correct posture and relieve daily strain.<br><br> <strong class='price-highlight'>60 min – 5,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 8,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 10,500 Tk</strong><br>Perfect for desk workers."
                },
                {
                    id: 9,
                    category: "signature",
                    question: " Special Massage – Tailored Just For You",
                    answer: "Personalized treatment mixing techniques to match your unique body needs.<br><br> <strong class='price-highlight'>60 min – 7,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 10,500 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 14,000 Tk</strong><br>Consult with therapist for bespoke experience."
                },
                {
                    id: 10,
                    category: "intensive",
                    question: " Full Body Massage – Total Harmony",
                    answer: "Head-to-toe relaxation, improved circulation, and deep stress relief.<br><br> <strong class='price-highlight'>60 min – 7,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 9,999 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 11,500 Tk</strong><br>Recharge your body & mind."
                },
                {
                    id: 11,
                    category: "couple",
                    question: " Body to Body Massage – Ultimate Connection",
                    answer: "Luxurious skin-to-skin relaxation that reduces cortisol and boosts intimacy.<br><br><strong class='price-highlight'>60 min – 9,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>90 min – 13,000 Tk</strong> &nbsp;|&nbsp; <strong class='price-highlight'>120 min – 17,000 Tk</strong><br>Private suite with premium oils."
                }
            ];

            // Additional data to enrich the FAQ: we can map with icon but content already rich
            const container = document.getElementById('faqContainer');
            const tabBtns = document.querySelectorAll('.tab-btn');
            let activeCategory = 'all';
            let activeFaqItem = null; // for current open item (single open at a time)

            // Function to render FAQs based on selected category with smooth transition
            function renderFAQs(category) {
                if (!container) return;
                // Filter data
                const filtered = faqData.filter(item => category === 'all' || item.category === category);
                if (filtered.length === 0) {
                    container.innerHTML = `<div style="text-align:center; padding: 60px 20px; background: #fafafa; border-radius: 28px;"><span style="font-size: 20px;">✨ No packages in this category yet <br>Explore our signature collection!</span></div>`;
                    return;
                }

                // Build accordion HTML with data attributes
                let html = '';
                filtered.forEach((faq, idx) => {
                    html += `
                        <div class="faq-item" data-id="${faq.id}" data-category="${faq.category}">
                            <div class="faq-question">
                                <span class="question-text">${faq.question}</span>
                                <span class="faq-icon"></span>
                            </div>
                            <div class="faq-answer">
                                ${faq.answer}
                            </div>
                        </div>
                    `;
                });
                
                // Apply fade-out/in effect for smoother transition (optional)
                container.style.opacity = '0';
                setTimeout(() => {
                    container.innerHTML = html;
                    container.style.opacity = '1';
                    // After new DOM, attach event listeners to each accordion
                    attachAccordionEvents();
                    // if any active previously - reset (we close all on category switch)
                }, 120);
            }

            // attach click events to each .faq-question
            function attachAccordionEvents() {
                const allFaqItems = document.querySelectorAll('.faq-item');
                allFaqItems.forEach(item => {
                    const questionDiv = item.querySelector('.faq-question');
                    if (!questionDiv) return;
                    // remove previous listener to avoid duplication
                    questionDiv.removeEventListener('click', handleQuestionClick);
                    questionDiv.addEventListener('click', handleQuestionClick);
                });
            }

            // handle single active accordion (clean behavior)
            function handleQuestionClick(event) {
                const currentItem = event.currentTarget.closest('.faq-item');
                if (!currentItem) return;
                
                const isActive = currentItem.classList.contains('active');
                
                // Close all other open items first (nice UI)
                const allItems = document.querySelectorAll('.faq-item');
                allItems.forEach(item => {
                    if (item !== currentItem && item.classList.contains('active')) {
                        item.classList.remove('active');
                    }
                });
                
                // Toggle current
                if (!isActive) {
                    currentItem.classList.add('active');
                    // Smooth scroll into view if needed (but optional)
                    setTimeout(() => {
                        currentItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 100);
                } else {
                    currentItem.classList.remove('active');
                }
            }

            // Add click handlers for tabs with animation
            function initTabs() {
                tabBtns.forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        const category = this.getAttribute('data-category');
                        if (!category) return;
                        // update active class on buttons
                        tabBtns.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        activeCategory = category;
                        // animate container fade then render
                        if (container) {
                            container.classList.add('fade-slide');
                            renderFAQs(category);
                            setTimeout(() => {
                                container.classList.remove('fade-slide');
                            }, 500);
                        } else {
                            renderFAQs(category);
                        }
                    });
                });
            }

            // initial load: render all
            renderFAQs('all');
            initTabs();

            // Adding extra subtle hover / price highlight enhancements (no extra libs)
            const styleEnhance = document.createElement('style');
            styleEnhance.textContent = `
                .faq-answer strong, .faq-answer .price-highlight {
                    font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
                }
                .faq-question .question-text {
                    transition: color 0.2s;
                }
                .faq-question:hover .question-text {
                    color: var(--theme-color-text_link);
                }
                .faq-item.active .faq-question {
                    background: #fff8f6;
                    border-radius: 16px 16px 0 0;
                }
                .faq-answer p {
                    margin-bottom: 10px;
                }
                .faq-answer {
                    font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
                }
            `;
            document.head.appendChild(styleEnhance);
        })();
    </script>
    <style>
	   /* ---------- ROOT DESIGN STYLES (matching the template) ---------- */
        .dynamic-faq-section {
            --theme-color-bg_color: #fff;
            --theme-color-text: #757575;
            --theme-color-text_dark: #323232;
            --theme-color-text_link: #f9a392;
            --theme-color-text_link_02: rgba(249, 163, 146, .45);
            --theme-color-text_light: #8d8580;
            --theme-color-text_hover: #8ed4cc;
            --theme-color-alter_bg_color: #f8f8f8;
            --theme-color-alter_bg_color_04: #fbfbfb;
            --theme-color-alter_text: #757575;
            --theme-color-alter_dark: #323232;
            --theme-color-alter_link: #f9a392;
            --theme-color-bd_color: #eaeaea;
            --theme-font-h4_font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            --theme-font-p_font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            --theme-font-button_font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            --container-padding: 30px;
            --spacer-small: 20px;
            --spacer-medium: 40px;
            --border-radius-sm: 4px;
            --transition-default: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* FAQ Section Container - matches the "Most Popular Spa Packages" vibe */
        .dynamic-faq-section {
            max-width: 1320px;
            margin: 0 auto;
            padding: 80px 30px 100px;
            background: linear-gradient(135deg, rgba(246,241,232,0.5) 0%, rgba(255,250,242,0.8) 100%);
            border-radius: 0;
            position: relative;
        }

        /* Section header styles (aligned with elementor headings) */
        .faq-header {
            text-align: center;
            margin-bottom: 55px;
            animation: fadeInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        .faq-subtitle {
            font-family: var(--theme-font-h4_font-family);
            font-size: clamp(0.85rem, 2vw, 1rem);
            font-weight: 700;
            color: var(--lsg-accent);
            margin-bottom: 8px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .faq-title {
            font-family: var(--theme-font-h4_font-family);
            font-size: clamp(2rem, 3vw, 2.8rem);
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: -0.02em;
            color: var(--lsg-contrast);
            position: relative;
            display: inline-block;
            padding-bottom: 20px;
            margin: 0;
        }

        .faq-title:after {
            content: "";
            display: block;
            width: 60px;
            height: 3px;
            background: var(--lsg-accent);
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* Package Tabs - clean & interactive */
        .package-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-bottom: 55px;
            border: none;
            padding-bottom: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }

        .tab-btn {
            background: #fff;
            border: 2px solid var(--lsg-border);
            font-family: var(--theme-font-button_font-family);
            font-size: 14px;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            padding: 12px 28px;
            border-radius: 999px;
            cursor: pointer;
            color: var(--lsg-muted);
            background-color: #fff;
            transition: var(--transition-default);
            box-shadow: 0 2px 8px rgba(45,40,34,0.05);
        }

        .tab-btn:hover {
            color: var(--lsg-accent);
            border-color: var(--lsg-accent);
            background-color: var(--lsg-accent-soft);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(180,145,90,0.15);
        }

        .tab-btn.active {
            background-color: var(--lsg-accent);
            color: #fff;
            border-color: var(--lsg-accent);
            box-shadow: 0 8px 20px rgba(180,145,90,0.3);
        }

        /* FAQ Accordion Container - modern & smooth */
        .faq-accordion-container {
            max-width: 900px;
            margin: 0 auto;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .faq-accordion-container.fade-slide {
            opacity: 0;
        }

        .faq-item {
            background: #fff;
            border: 1px solid var(--lsg-border);
            border-radius: var(--lsg-radius-lg);
            margin-bottom: 18px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 12px rgba(45,40,34,0.06);
            animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        .faq-item:nth-child(1) { animation-delay: 0.3s; }
        .faq-item:nth-child(2) { animation-delay: 0.35s; }
        .faq-item:nth-child(3) { animation-delay: 0.4s; }
        .faq-item:nth-child(n+4) { animation-delay: 0.45s; }

        .faq-item:hover {
            border-color: var(--lsg-accent);
            box-shadow: 0 12px 32px rgba(180,145,90,0.12);
            transform: translateY(-3px);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 28px;
            cursor: pointer;
            font-family: var(--theme-font-h4_font-family);
            font-size: 16px;
            font-weight: 600;
            color: var(--lsg-contrast);
            background: #fff;
            transition: background 0.25s, color 0.25s;
            letter-spacing: -0.2px;
            user-select: none;
        }

        .faq-question:hover {
            background: var(--lsg-accent-soft);
            color: var(--lsg-accent);
        }

        .faq-question .question-text {
            flex: 1;
            padding-right: 20px;
        }

        .faq-icon {
            font-size: 22px;
            font-weight: 600;
            color: var(--lsg-accent);
            transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1), background 0.25s;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: transparent;
            flex-shrink: 0;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            background: var(--lsg-accent-soft);
        }

        .faq-answer {
            max-height: 0;
            padding: 0 28px;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.33, 1, 0.68, 1), padding 0.3s ease, border-top 0.3s ease;
            background: #fff;
            border-top: 0px solid transparent;
            font-size: 15px;
            line-height: 1.7;
            color: var(--lsg-muted);
        }

        .faq-item.active .faq-answer {
            max-height: 400px;
            padding: 0 28px 24px 28px;
            border-top-width: 1px;
            border-top-color: var(--lsg-border);
        }

        /* price highlight inside answers */
        .price-highlight {
            font-weight: 700;
            color: var(--lsg-accent);
            background: var(--lsg-accent-soft);
            display: inline-block;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
        }

        .package-badge {
            display: inline-block;
            background: var(--lsg-accent);
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 30px;
            letter-spacing: 0.5px;
            margin-right: 14px;
            vertical-align: middle;
            font-family: var(--theme-font-button_font-family);
        }

        /* booking hint */
        .booking-hint {
            margin-top: 35px;
            text-align: center;
            font-size: 15px;
            background: #fff;
            padding: 20px 24px;
            border-radius: 999px;
            border: 2px solid var(--lsg-border);
            animation: fadeInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
            transition: all 0.3s ease;
        }

        .booking-hint:hover {
            border-color: var(--lsg-accent);
            box-shadow: 0 8px 24px rgba(180,145,90,0.15);
        }

        .booking-hint a {
            color: var(--lsg-accent);
            font-weight: 600;
            text-decoration: none;
            border: none;
            transition: color 0.2s;
        }

        .booking-hint a:hover {
            color: var(--lsg-contrast);
        }

        /* Animation on load / tab switch */
        .fade-slide {
            animation: fadeSlideUp 0.45s ease forwards;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dynamic-faq-section {
                padding: 50px 20px 70px;
            }
            .faq-question {
                padding: 18px 20px;
                font-size: 15px;
            }
            .faq-item.active .faq-answer {
                padding: 0 20px 20px 20px;
            }
            .tab-btn {
                padding: 10px 20px;
                font-size: 13px;
            }
            .faq-subtitle {
                font-size: 14px;
            }
            .faq-title {
                font-size: 24px;
            }
        }

        /* inline icon if needed — using utf8 symbols, but clean */
        .faq-icon::before {
            content: "+";
            font-size: 20px;
            font-weight: 600;
            line-height: 1;
            transition: inherit;
        }
        .faq-item.active .faq-icon::before {
            content: "−";
        }

    </style>








<!-- FEATURED SERVICES -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="lsg-section__header">
      <span class="lsg-eyebrow"><?php esc_html_e( 'Signature Treatments', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading"><?php esc_html_e( 'Our Most Loved Services', 'luxury-spa-gulshan' ); ?></h2>
      <p class="lsg-lead"><?php esc_html_e( 'Each service is designed to unwind, relieve tension, and leave you feeling refreshed.', 'luxury-spa-gulshan' ); ?></p>
    </div>
    <?php if ( $featured_services ) : ?>
    <div class="lsg-grid lsg-grid--3">
      <?php foreach ( $featured_services as $service ) :
        $price      = get_post_meta( $service->ID, 'service_price', true );
        $promo      = get_post_meta( $service->ID, 'service_promo_price', true );
        $duration   = get_post_meta( $service->ID, 'service_duration', true );
        $popular    = get_post_meta( $service->ID, 'service_popular', true );
        $excerpt    = $service->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $service->post_content ), 22 );
        $image      = get_the_post_thumbnail_url( $service->ID, 'large' );
        $display_price = $promo ?: ( $price ?: __( 'Contact for price', 'luxury-spa-gulshan' ) );
      ?>
      <article class="lsg-card">
        <?php if ( $image ) : ?>
        <div class="lsg-card__img"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $service->post_title ); ?>" loading="lazy"></div>
        <?php endif; ?>
        <div class="lsg-card__body">
          <?php if ( $popular ) : ?><span class="lsg-badge"><?php esc_html_e( 'Popular', 'luxury-spa-gulshan' ); ?></span><?php endif; ?>
          <h3 class="lsg-card__title"><?php echo esc_html( $service->post_title ); ?></h3>
          <p class="lsg-card__desc"><?php echo esc_html( $excerpt ); ?></p>
          <p class="lsg-card__meta">⏱ <?php echo esc_html( $duration ?: '60 min' ); ?></p>
          <p class="lsg-card__meta">💰 <?php echo esc_html( $display_price ); ?></p>
          <a class="lsg-btn-outline lsg-btn--sm" href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php esc_html_e( 'Learn More', 'luxury-spa-gulshan' ); ?></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:2.5rem;">
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View All Services', 'luxury-spa-gulshan' ); ?></a>
    </div>
    <?php else : ?>
    <p><?php esc_html_e( 'No featured services selected yet. Mark service pages as Featured / Popular to display them here.', 'luxury-spa-gulshan' ); ?></p>
    <?php endif; ?>
  </div>
</section>

<!-- WHY US -->
<section class="lsg-section" style="background:var(--lsg-surface);">
  <div class="lsg-container">
    <div class="lsg-section__header">
      <span class="lsg-eyebrow"><?php esc_html_e( 'Why Choose Us', 'luxury-spa-gulshan' ); ?></span>
      <h2 class="lsg-heading"><?php esc_html_e( 'The Luxury Spa Gulshan Difference', 'luxury-spa-gulshan' ); ?></h2>
    </div>
    <div class="fp-why">
      <div class="fp-why__card"><div class="fp-why__icon">📍</div><h3><?php esc_html_e( 'Prime Location', 'luxury-spa-gulshan' ); ?></h3><p><?php esc_html_e( 'Conveniently located in Gulshan-1, easy to reach from anywhere in Dhaka.', 'luxury-spa-gulshan' ); ?></p></div>
      <div class="fp-why__card"><div class="fp-why__icon">🛡️</div><h3><?php esc_html_e( 'Private Rooms', 'luxury-spa-gulshan' ); ?></h3><p><?php esc_html_e( 'Dedicated private rooms for full comfort and complete privacy during every session.', 'luxury-spa-gulshan' ); ?></p></div>
      <div class="fp-why__card"><div class="fp-why__icon">💆</div><h3><?php esc_html_e( 'Expert Therapists', 'luxury-spa-gulshan' ); ?></h3><p><?php esc_html_e( 'Trained professional therapists with years of experience in premium spa treatments.', 'luxury-spa-gulshan' ); ?></p></div>
      <div class="fp-why__card"><div class="fp-why__icon">✨</div><h3><?php esc_html_e( 'Natural Products', 'luxury-spa-gulshan' ); ?></h3><p><?php esc_html_e( 'High-quality natural oils and products that nourish, soothe, and restore the skin.', 'luxury-spa-gulshan' ); ?></p></div>
    </div>
  </div>
</section>

<!-- PRICING CTA -->
<section class="lsg-section">
  <div class="lsg-container">
    <div class="lsg-cta-banner">
      <div class="lsg-cta-banner__text">
        <h2><?php esc_html_e( 'Transparent, Simple Pricing', 'luxury-spa-gulshan' ); ?></h2>
        <p><?php esc_html_e( 'Every package, every duration, and every service clearly listed in one place. No surprises.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn" href="<?php echo esc_url( home_url( '/our-pricing/' ) ); ?>"><?php esc_html_e( 'View Full Pricing', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<!-- CONTACT CTA -->
<section class="lsg-section lsg-section--flush-top">
  <div class="lsg-container">
    <div class="lsg-cta-banner" style="background:var(--lsg-contrast);border-color:transparent;">
      <div class="lsg-cta-banner__text" style="color:#fff;">
        <h2 style="color:#fff;"><?php esc_html_e( 'Ready to Book Your Session?', 'luxury-spa-gulshan' ); ?></h2>
        <p style="color:rgba(255,250,242,.75);"><?php esc_html_e( 'Call us directly or send a message. Our team will confirm availability and guide you to the perfect treatment.', 'luxury-spa-gulshan' ); ?></p>
      </div>
      <a class="lsg-btn-outline" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" style="color:#fff;border-color:rgba(255,255,255,.4);"><?php esc_html_e( 'Contact Us', 'luxury-spa-gulshan' ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>