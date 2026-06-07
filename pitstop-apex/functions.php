<?php
/**
 * PitStop Apex RS — theme functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'PITSTOP_VER', '1.0.0' );

/* ─── Setup ─── */
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'elementor' );
} );

/* ─── Enqueue ─── */
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'pitstop-fonts',
        'https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,400;0,500;0,600;1,500&family=Saira+Condensed:ital,wght@0,600;0,700;0,800;1,700;1,800&family=Saira+Semi+Condensed:wght@600;700&display=swap',
        [], null
    );
    wp_enqueue_style( 'pitstop-style', get_stylesheet_uri(), [ 'pitstop-fonts' ], PITSTOP_VER );
    wp_enqueue_script( 'pitstop-app', get_template_directory_uri() . '/assets/js/app.js', [], PITSTOP_VER, true );
} );

/* ─── Elementor page builder ─── */
require_once get_template_directory() . '/inc/elementor-build.php';

/* Build the homepage once on activation */
add_action( 'after_switch_theme', function () {
    if ( get_option( 'pitstop_built' ) ) return;
    pitstop_build_home();
    update_option( 'pitstop_built', '1' );
} );

/* ─── Admin hint + manual rebuild link ─── */
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'dashboard' ) return;

    if ( ! did_action( 'elementor/loaded' ) && ! class_exists( '\Elementor\Plugin' ) ) {
        echo '<div class="notice notice-warning"><p><strong>PitStop Apex RS:</strong> Install &amp; activate the free '
           . '<a href="' . esc_url( admin_url( 'plugin-install.php?s=elementor&tab=search&type=term' ) ) . '">Elementor</a> plugin, '
           . 'then <a href="' . esc_url( admin_url( '?pitstop_rebuild=1' ) ) . '">click here to build the homepage</a>.</p></div>';
    } else {
        echo '<div class="notice notice-info"><p><strong>PitStop Apex RS:</strong> Edit the homepage in Elementor (Pages → PitStop Apex RS → Edit with Elementor). '
           . 'Need to regenerate it? <a href="' . esc_url( admin_url( '?pitstop_rebuild=1' ) ) . '">Rebuild homepage</a>.</p></div>';
    }
} );

add_action( 'admin_init', function () {
    if ( isset( $_GET['pitstop_rebuild'] ) && current_user_can( 'manage_options' ) ) {
        delete_option( 'pitstop_built' );
        pitstop_build_home();
        update_option( 'pitstop_built', '1' );
        wp_safe_redirect( admin_url() );
        exit;
    }
} );
