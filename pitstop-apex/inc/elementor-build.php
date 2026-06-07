<?php
/**
 * Builds the PitStop Apex RS homepage from NATIVE Elementor widgets so
 * every element is click-editable in the editor panel (Heading, Text,
 * Image, Button, Icon List). No HTML widgets for the showcase sections.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'PS_ACCENT' ) ) {
    define( 'PS_ACCENT', '#e5241b' );
    define( 'PS_BG',     '#0a0a0b' );
    define( 'PS_BG2',    '#101012' );
    define( 'PS_PANEL',  '#16161a' );
    define( 'PS_TEXT',   '#f4f4f5' );
    define( 'PS_MUTED',  '#9a9aa3' );
    define( 'PS_LINE',   'rgba(255,255,255,0.10)' );
}

function ps_uid() { return substr( md5( uniqid( '', true ) ), 0, 7 ); }
function ps_img_url( $f ) { return get_template_directory_uri() . '/assets/images/' . $f; }

/* ── structure ── */
function ps_section( $settings, $cols ) {
    return [ 'id' => ps_uid(), 'elType' => 'section', 'settings' => $settings, 'elements' => $cols, 'isInner' => false ];
}
function ps_inner( $settings, $cols ) {
    return [ 'id' => ps_uid(), 'elType' => 'section', 'settings' => $settings, 'elements' => $cols, 'isInner' => true ];
}
function ps_col( $size, $widgets, $extra = [] ) {
    return [ 'id' => ps_uid(), 'elType' => 'column', 'settings' => array_merge( [ '_column_size' => $size, '_inline_size' => null ], $extra ), 'elements' => $widgets, 'isInner' => false ];
}

/* ── widgets ── */
function ps_heading( $title, $tag = 'h2', $size = 48, $color = PS_TEXT, $italic = true, $align = 'left', $family = 'Saira Condensed', $weight = '800' ) {
    $s = [
        'title' => $title, 'header_size' => $tag, 'title_color' => $color, 'align' => $align,
        'typography_typography' => 'custom', 'typography_font_family' => $family, 'typography_font_weight' => $weight,
        'typography_font_size' => [ 'unit' => 'px', 'size' => $size, 'sizes' => [] ],
        'typography_text_transform' => 'uppercase',
        'typography_line_height' => [ 'unit' => 'em', 'size' => 1.0, 'sizes' => [] ],
    ];
    if ( $italic ) $s['typography_font_style'] = 'italic';
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'heading', 'settings' => $s, 'elements' => [] ];
}
function ps_eyebrow( $text, $color = PS_ACCENT, $align = 'left' ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'heading', 'settings' => [
        'title' => $text, 'header_size' => 'h6', 'title_color' => $color, 'align' => $align,
        'typography_typography' => 'custom', 'typography_font_family' => 'Saira Semi Condensed', 'typography_font_weight' => '700',
        'typography_font_size' => [ 'unit' => 'px', 'size' => 13, 'sizes' => [] ],
        'typography_text_transform' => 'uppercase', 'typography_letter_spacing' => [ 'unit' => 'px', 'size' => 3.5, 'sizes' => [] ],
        '_margin' => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '14', 'left' => '0', 'isLinked' => false ],
    ], 'elements' => [] ];
}
function ps_text( $html, $color = PS_MUTED, $size = 18, $align = 'left' ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'text-editor', 'settings' => [
        'editor' => $html, 'text_color' => $color, 'align' => $align,
        'typography_typography' => 'custom', 'typography_font_family' => 'Saira',
        'typography_font_size' => [ 'unit' => 'px', 'size' => $size, 'sizes' => [] ],
        'typography_line_height' => [ 'unit' => 'em', 'size' => 1.6, 'sizes' => [] ],
    ], 'elements' => [] ];
}
function ps_image( $url, $width = 100, $align = 'center', $radius = 0, $height = 0 ) {
    $s = [
        'image' => [ 'url' => $url, 'id' => '', 'source' => 'url' ],
        'image_size' => 'full', 'align' => $align, 'width' => [ 'unit' => '%', 'size' => $width, 'sizes' => [] ],
    ];
    if ( $radius ) $s['image_border_radius'] = [ 'unit' => '%', 'top' => "$radius", 'right' => "$radius", 'bottom' => "$radius", 'left' => "$radius", 'isLinked' => true ];
    if ( $height ) { $s['height'] = [ 'unit' => 'px', 'size' => $height, 'sizes' => [] ]; $s['object-fit'] = 'cover'; }
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'image', 'settings' => $s, 'elements' => [] ];
}
function ps_button( $text, $link = '#', $bg = PS_ACCENT, $color = '#ffffff', $align = 'left' ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'button', 'settings' => [
        'text' => $text, 'link' => [ 'url' => $link ], 'align' => $align,
        'button_background_color' => $bg, 'button_text_color' => $color,
        'typography_typography' => 'custom', 'typography_font_family' => 'Saira Semi Condensed', 'typography_font_weight' => '700',
        'typography_text_transform' => 'uppercase', 'typography_letter_spacing' => [ 'unit' => 'px', 'size' => 2, 'sizes' => [] ],
        'typography_font_size' => [ 'unit' => 'px', 'size' => 13, 'sizes' => [] ],
        'border_radius' => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
    ], 'elements' => [] ];
}
function ps_iconlist( $items, $icon_color = PS_ACCENT, $text_color = '#d7d7da' ) {
    $list = [];
    foreach ( $items as $t ) {
        $list[] = [ 'text' => $t, 'selected_icon' => [ 'value' => 'fas fa-chevron-right', 'library' => 'fa-solid' ], '_id' => ps_uid() ];
    }
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'icon-list', 'settings' => [
        'icon_list' => $list, 'view' => 'traditional',
        'icon_color' => $icon_color, 'icon_size' => [ 'unit' => 'px', 'size' => 13, 'sizes' => [] ],
        'space_between' => [ 'unit' => 'px', 'size' => 16, 'sizes' => [] ],
        'icon_typography_typography' => 'custom',
        'text_color' => $text_color,
        'icon_typography_font_family' => 'Saira', 'icon_typography_font_size' => [ 'unit' => 'px', 'size' => 17, 'sizes' => [] ],
        'icon_self_align' => 'left', 'text_indent' => [ 'unit' => 'px', 'size' => 14, 'sizes' => [] ],
        'divider' => 'yes', 'divider_color' => PS_LINE, 'divider_weight' => [ 'unit' => 'px', 'size' => 1, 'sizes' => [] ],
    ], 'elements' => [] ];
}
function ps_pad( $t, $r, $b, $l ) {
    return [ 'padding' => [ 'unit' => 'px', 'top' => "$t", 'right' => "$r", 'bottom' => "$b", 'left' => "$l", 'isLinked' => false ] ];
}

/* A single feature callout (Heading + Text), reused left/right */
function ps_feature_item( $title, $body, $align = 'left' ) {
    return [
        ps_heading( $title, 'h4', 19, PS_TEXT, false, $align, 'Saira Semi Condensed', '700' ),
        ps_text( '<p>' . $body . '</p>', PS_MUTED, 15.5, $align ),
    ];
}

/* ── the section tree ── */
function pitstop_elementor_sections() {
    $S = [];

    /* ───── HERO ───── */
    $hero_tags = ps_inner(
        array_merge( [ 'gap' => 'wide', 'content_width' => 'full' ], [ '_element_custom_width' => null ] ),
        [
            ps_col( 50, [
                ps_heading( 'Ultimate', 'h6', 12, PS_ACCENT, true, 'left', 'Saira Semi Condensed', '600' ),
                ps_heading( 'Track Day Weapon', 'div', 28, '#ffffff', true, 'left' ),
            ] ),
            ps_col( 50, [
                ps_heading( 'Extreme', 'h6', 12, PS_ACCENT, true, 'left', 'Saira Semi Condensed', '600' ),
                ps_heading( 'Street Performance', 'div', 28, '#ffffff', true, 'left' ),
            ] ),
        ]
    );
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic',
        'background_image' => [ 'url' => ps_img_url('ph-hero.png'), 'id' => '' ],
        'background_size' => 'cover', 'background_position' => 'center center',
        'background_overlay_background' => 'gradient',
        'background_overlay_color' => 'rgba(10,10,11,0)', 'background_overlay_color_b' => '#0a0a0b',
        'background_overlay_gradient_angle' => [ 'unit' => 'deg', 'size' => 180 ],
        'background_overlay_gradient_position' => [ 'unit' => '%', 'size' => 55 ],
        'height' => 'min-height', 'custom_height' => [ 'unit' => 'vh', 'size' => 100 ],
        'content_position' => 'bottom', 'layout' => 'full_width',
    ], ps_pad( 0, 32, 70, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'PitStop Apex RS · Extreme Performance Summer' ),
            ps_heading( 'Own.<br>Every.<br><span style="color:rgba(255,255,255,.4)">Apex.</span>', 'h1', 120, PS_TEXT ),
            $hero_tags,
        ] ),
    ] );

    /* ───── INTRO / BENEFITS ───── */
    $benefits = ps_iconlist( [
        'UTQG 200 rated Extreme Performance Summer compound',
        'Engineered for track dominance and street performance alike',
        'Addictive levels of steering response and mid-corner handling',
        'Unrivaled grip derived from a motorsports-proven tread',
        'Adrenaline-fueled acceleration fused with dynamic braking',
    ] );
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed',
        'content_width' => [ 'unit' => 'px', 'size' => 1280 ], 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 55, [
            ps_eyebrow( 'Presented by PitStop' ),
            ps_heading( 'Apex RS', 'h2', 70, PS_TEXT ),
            ps_text( '<p style="font-weight:700;text-transform:uppercase;letter-spacing:.04em;">A street-legal track weapon, engineered to dominate.</p>', PS_MUTED, 22 ),
            ps_text( '<p>Born on the limit and built for the road, the Apex RS fuses motorsport-grade compounds with everyday composure — so the drive to the circuit hits as hard as the laps.</p>', PS_MUTED, 19 ),
            $benefits,
        ] ),
        ps_col( 45, [
            ps_heading( 'Apex RS', 'div', 14, '#ffffff', true, 'right' ),
            ps_image( ps_img_url('ph-tire-hero.png'), 100, 'center', 0, 560 ),
        ] ),
    ] );

    /* ───── STATEMENT ───── */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'no',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'For Drivers', PS_ACCENT, 'center' ),
            ps_heading( '…who live life on the edge. The Apex RS takes <span style="color:'.PS_ACCENT.'">track dominance</span> straight to the street.', 'h2', 60, PS_TEXT, true, 'center' ),
        ], [ 'align' => 'center' ] ),
    ] );

    /* ───── FEATURE CALLOUTS (native: 3-col inner, Heading+Text each) ───── */
    $left_items = [];
    foreach ( [
        [ 'Extra-Wide Shoulder Ribs', 'Maximize the contact patch under load to hold the line through high-speed cornering.' ],
        [ 'Featherlight Construction', 'A lightweight casing trims rotating mass for peak responsiveness and quicker turn-in.' ],
        [ 'Motorsport-Derived Compound', 'A track-bred rubber formulation that reaches grip temperature fast and stays consistent.' ],
    ] as $it ) { $left_items = array_merge( $left_items, ps_feature_item( $it[0], $it[1], 'left' ) ); }

    $right_items = [];
    foreach ( [
        [ 'Optimized Center Rib', 'A continuous center band stabilizes the tire under hard braking for shorter, surer stops.' ],
        [ 'RS-DNA Technology', 'Decades of racing know-how distilled into a tread pattern tuned for the absolute limit.' ],
        [ 'Precision Sidewall', 'A stiff, reinforced sidewall delivers crisp, communicative feedback at the wheel.' ],
    ] as $it ) { $right_items = array_merge( $right_items, ps_feature_item( $it[0], $it[1], 'right' ) ); }

    $feat_stage = ps_inner( [ 'gap' => 'wide', 'content_width' => 'full' ], [
        ps_col( 33, $left_items ),
        ps_col( 34, [ ps_image( ps_img_url('ph-feat.png'), 100, 'center', 50, 480 ) ] ),
        ps_col( 33, $right_items ),
    ] );
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG2, 'layout' => 'boxed',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'Engineered to Attack', PS_ACCENT, 'center' ),
            ps_heading( 'Every Rib Has a Job', 'h2', 58, PS_TEXT, true, 'center' ),
            ps_text( '<p style="text-align:center;max-width:720px;margin:0 auto;">A purpose-built tread architecture that turns input into instant, repeatable grip — corner after corner.</p>', PS_MUTED, 18, 'center' ),
            $feat_stage,
        ] ),
    ] );

    /* ───── DNA ───── */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 50, [
            ps_heading( 'PitStop DNA', 'h3', 38, PS_TEXT ),
            ps_text( '<p>Pushing boundaries and defying limits. PitStop was forged from a legacy of relentless performance. Ignite your passion, empower your pride, and drive your success as you conquer life on and off the track.</p>', PS_MUTED, 17 ),
        ] ),
        ps_col( 50, [
            ps_heading( 'Total Dominance Plan', 'h3', 38, PS_TEXT ),
            ps_text( '<p>Experience unmatched performance with the Total Dominance Plan — high-performance tires that set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing, the Apex RS delivers on every drive.</p>', PS_MUTED, 17 ),
        ] ),
    ] );

    /* ───── AVAILABILITY ───── */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 45, [
            ps_eyebrow( 'Availability' ),
            ps_heading( '40<span style="color:'.PS_ACCENT.'">+</span>', 'div', 200, PS_TEXT ),
            ps_heading( 'Sizes at Launch', 'h3', 24, PS_TEXT, false, 'left', 'Saira Semi Condensed' ),
            ps_text( '<p>Over 40 sizes set to release, accommodating the most popular fitments for ultra-high-performance applications — from compact track toys to wide-body monsters.</p>', PS_MUTED, 18 ),
            ps_text( '<p style="text-transform:uppercase;letter-spacing:.16em;font-weight:600;font-size:12px;">— Apex RS is USDOT street legal only</p>', PS_MUTED, 12 ),
        ] ),
        ps_col( 55, [ ps_image( ps_img_url('ph-avail.png'), 100 ) ] ),
    ] );

    /* ───── RESOURCES (native: 2-col inner, styled card columns) ───── */
    $card_col = function ( $title, $body ) {
        return ps_col( 50, [
            ps_heading( $title, 'h4', 21, PS_TEXT, false, 'left', 'Saira Semi Condensed', '700' ),
            ps_text( '<p>' . $body . '</p>', PS_MUTED, 16 ),
            ps_button( 'Download ↓', '#', PS_ACCENT, '#ffffff', 'left' ),
        ], [
            'background_background' => 'classic', 'background_color' => PS_PANEL,
            'border_border' => 'solid', 'border_width' => [ 'unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true ], 'border_color' => PS_LINE,
            'padding' => [ 'unit' => 'px', 'top' => '38', 'right' => '38', 'bottom' => '38', 'left' => '38', 'isLinked' => true ],
        ] );
    };
    $res_grid = ps_inner( [ 'gap' => 'wide', 'content_width' => 'full' ], [
        $card_col( 'Detailed Product Specifications', 'Full Apex RS product specifications, sizing and load ratings. Note: all measurements are subject to change upon official size release.' ),
        $card_col( 'Tire Care &amp; Safety Guidelines', 'Detailed tire care procedures, break-in best practices and safety guidelines for getting the most from your Apex RS.' ),
    ] );
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'PitStop Apex RS Resources' ),
            ps_heading( 'Get the Details', 'h2', 54, PS_TEXT ),
            $res_grid,
        ] ),
    ] );

    /* ───── CTA (native Button) ───── */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_ACCENT, 'layout' => 'boxed', 'gap' => 'no',
    ], ps_pad( 88, 32, 88, 32 ) ), [
        ps_col( 100, [
            ps_heading( 'Conquer the Corner', 'h2', 80, '#ffffff', true, 'center' ),
            ps_text( '<p style="text-align:center;text-transform:uppercase;letter-spacing:.16em;font-weight:600;opacity:.85;color:#fff;">Find your fitment · Locate a dealer</p>', '#ffffff', 14, 'center' ),
            ps_button( 'Find a Dealer', '#', '#0a0a0b', '#ffffff', 'center' ),
        ], [ 'align' => 'center' ] ),
    ] );

    return $S;
}

/* ── create / update the page & set as homepage ── */
function pitstop_build_home() {
    $data = pitstop_elementor_sections();

    $existing = get_posts( [ 'post_type' => 'page', 'post_status' => 'publish', 'meta_key' => '_pitstop_home', 'meta_value' => '1', 'numberposts' => 1 ] );
    if ( $existing ) {
        $pid = $existing[0]->ID;
    } else {
        $pid = wp_insert_post( [ 'post_title' => 'PitStop Apex RS', 'post_status' => 'publish', 'post_type' => 'page' ] );
        if ( ! $pid || is_wp_error( $pid ) ) return;
        update_post_meta( $pid, '_pitstop_home', '1' );
    }

    // CRITICAL: wp_slash so WordPress doesn't strip the JSON escaping
    update_post_meta( $pid, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
    update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
    update_post_meta( $pid, '_elementor_template_type', 'wp-page' );
    update_post_meta( $pid, '_elementor_version', '3.0.0' );
    delete_post_meta( $pid, '_elementor_css' );

    if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $pid );
    return $pid;
}
