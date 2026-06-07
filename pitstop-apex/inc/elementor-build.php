<?php
/**
 * Builds the PitStop Apex RS homepage as Elementor sections/widgets.
 * Native Heading / Text / Image / Button widgets are used for editable
 * copy; HTML widgets are used only for visually-complex pieces.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* palette */
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

/* ── widget/section helpers ── */
function ps_section( $settings, $cols ) {
    return [ 'id' => ps_uid(), 'elType' => 'section', 'settings' => $settings, 'elements' => $cols, 'isInner' => false ];
}
function ps_col( $size, $widgets, $extra = [] ) {
    return [ 'id' => ps_uid(), 'elType' => 'column', 'settings' => array_merge( [ '_column_size' => $size, '_inline_size' => null ], $extra ), 'elements' => $widgets, 'isInner' => false ];
}
function ps_heading( $title, $tag = 'h2', $size = 48, $color = PS_TEXT, $italic = true, $align = 'left', $family = 'Saira Condensed' ) {
    $s = [
        'title' => $title, 'header_size' => $tag, 'title_color' => $color, 'align' => $align,
        'typography_typography' => 'custom', 'typography_font_family' => $family, 'typography_font_weight' => '800',
        'typography_font_size' => [ 'unit' => 'px', 'size' => $size, 'sizes' => [] ],
        'typography_text_transform' => 'uppercase',
        'typography_line_height' => [ 'unit' => 'em', 'size' => 0.95, 'sizes' => [] ],
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
function ps_image( $url, $width = 100, $align = 'center' ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'image', 'settings' => [
        'image' => [ 'url' => $url, 'id' => '', 'source' => 'url' ],
        'image_size' => 'full', 'align' => $align, 'width' => [ 'unit' => '%', 'size' => $width, 'sizes' => [] ],
    ], 'elements' => [] ];
}
function ps_button( $text, $link = '#', $bg = PS_ACCENT, $color = '#ffffff' ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'button', 'settings' => [
        'text' => $text, 'link' => [ 'url' => $link ],
        'button_background_color' => $bg, 'button_text_color' => $color,
        'typography_typography' => 'custom', 'typography_font_family' => 'Saira Semi Condensed', 'typography_font_weight' => '700',
        'typography_text_transform' => 'uppercase', 'typography_letter_spacing' => [ 'unit' => 'px', 'size' => 2, 'sizes' => [] ],
        'typography_font_size' => [ 'unit' => 'px', 'size' => 13, 'sizes' => [] ],
        'border_radius' => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
    ], 'elements' => [] ];
}
function ps_html( $content ) {
    return [ 'id' => ps_uid(), 'elType' => 'widget', 'widgetType' => 'html', 'settings' => [ 'html' => $content ], 'elements' => [] ];
}
function ps_pad( $t, $r, $b, $l ) {
    return [ 'padding' => [ 'unit' => 'px', 'top' => "$t", 'right' => "$r", 'bottom' => "$b", 'left' => "$l", 'isLinked' => false ] ];
}

/* ── the section tree ── */
function pitstop_elementor_sections() {
    $S = [];

    /* HERO */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic',
        'background_image' => [ 'url' => ps_img_url('ph-hero.png'), 'id' => '' ],
        'background_size' => 'cover', 'background_position' => 'center center',
        'background_overlay_background' => 'gradient',
        'background_overlay_color' => 'rgba(10,10,11,0)',
        'background_overlay_color_b' => '#0a0a0b',
        'background_overlay_gradient_angle' => [ 'unit' => 'deg', 'size' => 180 ],
        'background_overlay_gradient_position' => [ 'unit' => '%', 'size' => 55 ],
        'height' => 'min-height', 'custom_height' => [ 'unit' => 'vh', 'size' => 100 ],
        'content_position' => 'bottom', 'layout' => 'full_width',
    ], ps_pad( 0, 32, 70, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'PitStop Apex RS · Extreme Performance Summer' ),
            ps_heading( 'Own.<br>Every.<br><span style="color:rgba(255,255,255,.4)">Apex.</span>', 'h1', 120, PS_TEXT ),
            ps_html(
              '<div style="display:flex;flex-wrap:wrap;gap:14px 46px;margin-top:30px;">'
              .'<div style="display:flex;flex-direction:column;line-height:1;"><small style="font-family:\'Saira Semi Condensed\';font-weight:600;font-style:italic;text-transform:uppercase;letter-spacing:.2em;font-size:12px;color:'.PS_ACCENT.';">Ultimate</small><b style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:28px;margin-top:4px;color:#fff;">Track Day Weapon</b></div>'
              .'<div style="display:flex;flex-direction:column;line-height:1;"><small style="font-family:\'Saira Semi Condensed\';font-weight:600;font-style:italic;text-transform:uppercase;letter-spacing:.2em;font-size:12px;color:'.PS_ACCENT.';">Extreme</small><b style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:28px;margin-top:4px;color:#fff;">Street Performance</b></div>'
              .'</div>'
            ),
        ] ),
    ] );

    /* INTRO / BENEFITS */
    $benefits_html = '<ul style="list-style:none;margin:34px 0 0;padding:0;">'
      . ps_benefit('01','<b style="color:#f4f4f5">UTQG 200</b> rated Extreme Performance Summer compound')
      . ps_benefit('02','Engineered for <b style="color:#f4f4f5">track dominance</b> and <b style="color:#f4f4f5">street performance</b> alike')
      . ps_benefit('03','Addictive levels of <b style="color:#f4f4f5">steering response</b> and <b style="color:#f4f4f5">mid-corner handling</b>')
      . ps_benefit('04','<b style="color:#f4f4f5">Unrivaled grip</b> derived from a motorsports-proven tread')
      . ps_benefit('05','<b style="color:#f4f4f5">Adrenaline-fueled acceleration</b> fused with <b style="color:#f4f4f5">dynamic braking</b>')
      . '</ul>';
    $tire_html = '<div style="position:relative;">'
      . '<span style="position:absolute;right:-6px;top:-22px;background:'.PS_ACCENT.';color:#fff;font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:14px;letter-spacing:.04em;padding:10px 16px;z-index:3;clip-path:polygon(8px 0,100% 0,100% calc(100% - 8px),calc(100% - 8px) 100%,0 100%,0 8px);">Apex RS</span>'
      . '<img src="'.ps_img_url('ph-tire-hero.png').'" alt="" style="width:100%;height:560px;object-fit:cover;border-radius:4px;">'
      . '</div>';
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed',
        'content_width' => [ 'unit' => 'px', 'size' => 1280 ], 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 55, [
            ps_eyebrow( 'Presented by PitStop' ),
            ps_heading( 'Apex RS', 'h2', 70, PS_TEXT ),
            ps_text( '<p style="color:#9a9aa3;font-weight:700;text-transform:uppercase;letter-spacing:.04em;">A street-legal track weapon, engineered to dominate.</p>', PS_MUTED, 22 ),
            ps_text( '<p>Born on the limit and built for the road, the Apex RS fuses motorsport-grade compounds with everyday composure — so the drive to the circuit hits as hard as the laps.</p>', PS_MUTED, 19 ),
            ps_html( $benefits_html ),
        ] ),
        ps_col( 45, [ ps_html( $tire_html ) ] ),
    ] );

    /* STATEMENT */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'no',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'For Drivers', PS_ACCENT, 'center' ),
            ps_heading( '…who live life on the edge. The Apex RS takes <span style="color:'.PS_ACCENT.'">track dominance</span> straight to the street.', 'h2', 60, PS_TEXT, true, 'center' ),
        ], [ 'align' => 'center' ] ),
    ] );

    /* FEATURES (head native + stage HTML) */
    $stage = ps_feature_stage();
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG2, 'layout' => 'boxed',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'Engineered to Attack', PS_ACCENT, 'center' ),
            ps_heading( 'Every Rib Has a Job', 'h2', 58, PS_TEXT, true, 'center' ),
            ps_text( '<p style="text-align:center;max-width:720px;margin:0 auto;">A purpose-built tread architecture that turns input into instant, repeatable grip — corner after corner.</p>', PS_MUTED, 18, 'center' ),
            ps_html( $stage ),
        ] ),
    ] );

    /* DNA */
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

    /* AVAILABILITY */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 45, [
            ps_eyebrow( 'Availability' ),
            ps_heading( '40<span style="color:'.PS_ACCENT.'">+</span>', 'div', 200, PS_TEXT ),
            ps_heading( 'Sizes at Launch', 'h3', 24, PS_TEXT, false, 'left', 'Saira Semi Condensed' ),
            ps_text( '<p>Over 40 sizes set to release, accommodating the most popular fitments for ultra-high-performance applications — from compact track toys to wide-body monsters.</p>', PS_MUTED, 18 ),
            ps_html( '<div style="display:flex;align-items:center;gap:14px;margin-top:34px;color:#6e6e77;font-family:\'Saira Semi Condensed\';font-weight:600;text-transform:uppercase;letter-spacing:.16em;font-size:12px;"><span style="width:34px;height:1px;background:#6e6e77;"></span>Apex RS is USDOT street legal only</div>' ),
        ] ),
        ps_col( 55, [ ps_image( ps_img_url('ph-avail.png'), 100 ) ] ),
    ] );

    /* RESOURCES */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_BG, 'layout' => 'boxed', 'gap' => 'wide',
    ], ps_pad( 120, 32, 120, 32 ) ), [
        ps_col( 100, [
            ps_eyebrow( 'PitStop Apex RS Resources' ),
            ps_heading( 'Get the Details', 'h2', 54, PS_TEXT ),
            ps_html( ps_resource_grid() ),
        ] ),
    ] );

    /* CTA */
    $S[] = ps_section( array_merge( [
        'background_background' => 'classic', 'background_color' => PS_ACCENT, 'layout' => 'boxed', 'gap' => 'no',
    ], ps_pad( 88, 32, 88, 32 ) ), [
        ps_col( 100, [
            ps_heading( 'Conquer the Corner', 'h2', 80, '#ffffff', true, 'center' ),
            ps_text( '<p style="text-align:center;text-transform:uppercase;letter-spacing:.16em;font-weight:600;opacity:.85;color:#fff;">Find your fitment · Locate a dealer</p>', '#ffffff', 14, 'center' ),
            ps_html( '<div style="text-align:center;margin-top:30px;"><a href="#" style="display:inline-flex;align-items:center;gap:10px;font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.14em;font-size:13px;background:#0a0a0b;color:#fff;padding:14px 26px;clip-path:polygon(10px 0,100% 0,100% calc(100% - 10px),calc(100% - 10px) 100%,0 100%,0 10px);">Find a Dealer</a></div>' ),
        ], [ 'align' => 'center' ] ),
    ] );

    return $S;
}

function ps_benefit( $ix, $html ) {
    return '<li style="display:flex;gap:18px;padding:18px 0;border-top:1px solid '.PS_LINE.';align-items:flex-start;">'
        . '<span style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;font-size:15px;color:'.PS_ACCENT.';min-width:34px;padding-top:2px;">'.$ix.'</span>'
        . '<p style="font-size:17px;color:#d7d7da;margin:0;">'.$html.'</p></li>';
}

function ps_feature_stage() {
    $left = [
        [ 'Extra-Wide Shoulder Ribs', 'Maximize the contact patch under load to hold the line through high-speed cornering.' ],
        [ 'Featherlight Construction', 'A lightweight casing trims rotating mass for peak responsiveness and quicker turn-in.' ],
        [ 'Motorsport-Derived Compound', 'A track-bred rubber formulation that reaches grip temperature fast and stays consistent.' ],
    ];
    $right = [
        [ 'Optimized Center Rib', 'A continuous center band stabilizes the tire under hard braking for shorter, surer stops.' ],
        [ 'RS-DNA Technology', 'Decades of racing know-how distilled into a tread pattern tuned for the absolute limit.' ],
        [ 'Precision Sidewall', 'A stiff, reinforced sidewall delivers crisp, communicative feedback at the wheel.' ],
    ];
    $item = function ( $t, $b, $side ) {
        $pad = $side === 'left' ? 'padding-left:26px;' : 'padding-right:26px;';
        $dot = $side === 'left' ? 'left:0;' : 'right:0;';
        return '<div style="position:relative;'.$pad.'"><span style="position:absolute;top:6px;'.$dot.'width:9px;height:9px;border-radius:50%;background:'.PS_ACCENT.';box-shadow:0 0 0 5px rgba(229,36,27,.18);"></span>'
            . '<h4 style="font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.04em;font-size:19px;line-height:1.15;margin:0;color:#f4f4f5;">'.$t.'</h4>'
            . '<p style="color:#9a9aa3;font-size:15.5px;margin-top:8px;line-height:1.5;">'.$b.'</p></div>';
    };
    $L = ''; foreach ( $left as $i ) $L .= $item( $i[0], $i[1], 'left' );
    $R = ''; foreach ( $right as $i ) $R .= $item( $i[0], $i[1], 'right' );
    return '<div class="feat-stage" style="display:grid;grid-template-columns:1fr minmax(360px,520px) 1fr;gap:24px;align-items:center;margin-top:56px;">'
        . '<div style="display:flex;flex-direction:column;gap:48px;">'.$L.'</div>'
        . '<div style="position:relative;"><div style="position:absolute;inset:-6%;border-radius:50%;border:1px solid '.PS_LINE.';"></div><img src="'.ps_img_url('ph-feat.png').'" alt="" style="width:100%;height:480px;object-fit:cover;border-radius:50%;"></div>'
        . '<div style="display:flex;flex-direction:column;gap:48px;text-align:right;">'.$R.'</div>'
        . '</div>';
}

function ps_resource_grid() {
    $card = function ( $title, $body ) {
        return '<div style="background:'.PS_PANEL.';border:1px solid '.PS_LINE.';padding:38px;display:flex;flex-direction:column;gap:16px;">'
            . '<h4 style="font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.03em;font-size:21px;margin:0;color:#f4f4f5;">'.$title.'</h4>'
            . '<p style="color:#9a9aa3;font-size:16px;flex:1;margin:0;">'.$body.'</p>'
            . '<a href="#" style="display:inline-flex;align-items:center;gap:10px;font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.14em;font-size:13px;color:'.PS_ACCENT.';margin-top:6px;">Download <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 3v13M6 11l6 6 6-6M5 21h14"/></svg></a></div>';
    };
    return '<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:48px;">'
        . $card( 'Detailed Product Specifications', 'Full Apex RS product specifications, sizing and load ratings. Note: all measurements are subject to change upon official size release.' )
        . $card( 'Tire Care &amp; Safety Guidelines', 'Detailed tire care procedures, break-in best practices and safety guidelines for getting the most from your Apex RS.' )
        . '</div>';
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
