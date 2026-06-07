#!/usr/bin/env python3
"""
Generate an importable Elementor template JSON for PitStop Apex RS.
Mirrors inc/elementor-build.php. Import via Elementor → Templates →
Saved Templates → Import Templates, then apply to a page.

Images use root-relative paths that resolve once the pitstop-apex theme
is installed (its assets live at /wp-content/themes/pitstop-apex/assets/images/).
"""
import json, secrets, os

IMG = "/wp-content/themes/pitstop-apex/assets/images/"
ACCENT, BG, BG2, PANEL = "#e5241b", "#0a0a0b", "#101012", "#16161a"
TEXT, MUTED, LINE = "#f4f4f5", "#9a9aa3", "rgba(255,255,255,0.10)"

def uid(): return secrets.token_hex(4)[:7]

def section(settings, cols):
    return {"id": uid(), "elType": "section", "settings": settings, "elements": cols, "isInner": False}
def col(size, widgets, extra=None):
    s = {"_column_size": size, "_inline_size": None}
    if extra: s.update(extra)
    return {"id": uid(), "elType": "column", "settings": s, "elements": widgets, "isInner": False}
def heading(title, tag="h2", size=48, color=TEXT, italic=True, align="left", family="Saira Condensed"):
    s = {"title": title, "header_size": tag, "title_color": color, "align": align,
         "typography_typography": "custom", "typography_font_family": family, "typography_font_weight": "800",
         "typography_font_size": {"unit": "px", "size": size, "sizes": []},
         "typography_text_transform": "uppercase",
         "typography_line_height": {"unit": "em", "size": 0.95, "sizes": []}}
    if italic: s["typography_font_style"] = "italic"
    return {"id": uid(), "elType": "widget", "widgetType": "heading", "settings": s, "elements": []}
def eyebrow(text, color=ACCENT, align="left"):
    return {"id": uid(), "elType": "widget", "widgetType": "heading", "settings": {
        "title": text, "header_size": "h6", "title_color": color, "align": align,
        "typography_typography": "custom", "typography_font_family": "Saira Semi Condensed", "typography_font_weight": "700",
        "typography_font_size": {"unit": "px", "size": 13, "sizes": []},
        "typography_text_transform": "uppercase", "typography_letter_spacing": {"unit": "px", "size": 3.5, "sizes": []},
    }, "elements": []}
def text(html, color=MUTED, size=18, align="left"):
    return {"id": uid(), "elType": "widget", "widgetType": "text-editor", "settings": {
        "editor": html, "text_color": color, "align": align,
        "typography_typography": "custom", "typography_font_family": "Saira",
        "typography_font_size": {"unit": "px", "size": size, "sizes": []},
        "typography_line_height": {"unit": "em", "size": 1.6, "sizes": []},
    }, "elements": []}
def image(url, width=100, align="center"):
    return {"id": uid(), "elType": "widget", "widgetType": "image", "settings": {
        "image": {"url": url, "id": "", "source": "url"},
        "image_size": "full", "align": align, "width": {"unit": "%", "size": width, "sizes": []},
    }, "elements": []}
def html(content):
    return {"id": uid(), "elType": "widget", "widgetType": "html", "settings": {"html": content}, "elements": []}
def pad(t, r, b, l):
    return {"padding": {"unit": "px", "top": str(t), "right": str(r), "bottom": str(b), "left": str(l), "isLinked": False}}

def benefit(ix, h):
    return (f'<li style="display:flex;gap:18px;padding:18px 0;border-top:1px solid {LINE};align-items:flex-start;">'
            f'<span style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;font-size:15px;color:{ACCENT};min-width:34px;padding-top:2px;">{ix}</span>'
            f'<p style="font-size:17px;color:#d7d7da;margin:0;">{h}</p></li>')

def feature_stage():
    left = [("Extra-Wide Shoulder Ribs", "Maximize the contact patch under load to hold the line through high-speed cornering."),
            ("Featherlight Construction", "A lightweight casing trims rotating mass for peak responsiveness and quicker turn-in."),
            ("Motorsport-Derived Compound", "A track-bred rubber formulation that reaches grip temperature fast and stays consistent.")]
    right = [("Optimized Center Rib", "A continuous center band stabilizes the tire under hard braking for shorter, surer stops."),
             ("RS-DNA Technology", "Decades of racing know-how distilled into a tread pattern tuned for the absolute limit."),
             ("Precision Sidewall", "A stiff, reinforced sidewall delivers crisp, communicative feedback at the wheel.")]
    def item(t, b, side):
        p = "padding-left:26px;" if side == "left" else "padding-right:26px;"
        d = "left:0;" if side == "left" else "right:0;"
        return (f'<div style="position:relative;{p}"><span style="position:absolute;top:6px;{d}width:9px;height:9px;border-radius:50%;background:{ACCENT};box-shadow:0 0 0 5px rgba(229,36,27,.18);"></span>'
                f'<h4 style="font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.04em;font-size:19px;line-height:1.15;margin:0;color:#f4f4f5;">{t}</h4>'
                f'<p style="color:#9a9aa3;font-size:15.5px;margin-top:8px;line-height:1.5;">{b}</p></div>')
    L = "".join(item(t, b, "left") for t, b in left)
    R = "".join(item(t, b, "right") for t, b in right)
    return (f'<div style="display:grid;grid-template-columns:1fr minmax(360px,520px) 1fr;gap:24px;align-items:center;margin-top:56px;">'
            f'<div style="display:flex;flex-direction:column;gap:48px;">{L}</div>'
            f'<div style="position:relative;"><div style="position:absolute;inset:-6%;border-radius:50%;border:1px solid {LINE};"></div><img src="{IMG}ph-feat.png" alt="" style="width:100%;height:480px;object-fit:cover;border-radius:50%;"></div>'
            f'<div style="display:flex;flex-direction:column;gap:48px;text-align:right;">{R}</div></div>')

def resource_grid():
    def card(t, b):
        return (f'<div style="background:{PANEL};border:1px solid {LINE};padding:38px;display:flex;flex-direction:column;gap:16px;">'
                f'<h4 style="font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.03em;font-size:21px;margin:0;color:#f4f4f5;">{t}</h4>'
                f'<p style="color:#9a9aa3;font-size:16px;flex:1;margin:0;">{b}</p>'
                f'<a href="#" style="display:inline-flex;align-items:center;gap:10px;font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.14em;font-size:13px;color:{ACCENT};margin-top:6px;">Download <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 3v13M6 11l6 6 6-6M5 21h14"/></svg></a></div>')
    return (f'<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:48px;">'
            + card("Detailed Product Specifications", "Full Apex RS product specifications, sizing and load ratings. Note: all measurements are subject to change upon official size release.")
            + card("Tire Care &amp; Safety Guidelines", "Detailed tire care procedures, break-in best practices and safety guidelines for getting the most from your Apex RS.")
            + '</div>')

content = []

# HERO
content.append(section({
    "background_background": "classic",
    "background_image": {"url": IMG + "ph-hero.png", "id": ""},
    "background_size": "cover", "background_position": "center center",
    "background_overlay_background": "gradient",
    "background_overlay_color": "rgba(10,10,11,0)", "background_overlay_color_b": "#0a0a0b",
    "background_overlay_gradient_angle": {"unit": "deg", "size": 180},
    "background_overlay_gradient_position": {"unit": "%", "size": 55},
    "height": "min-height", "custom_height": {"unit": "vh", "size": 100},
    "content_position": "bottom", "layout": "full_width", **pad(0, 32, 70, 32),
}, [col(100, [
    eyebrow("PitStop Apex RS · Extreme Performance Summer"),
    heading('Own.<br>Every.<br><span style="color:rgba(255,255,255,.4)">Apex.</span>', "h1", 120, TEXT),
    html('<div style="display:flex;flex-wrap:wrap;gap:14px 46px;margin-top:30px;">'
         '<div style="display:flex;flex-direction:column;line-height:1;"><small style="font-family:\'Saira Semi Condensed\';font-weight:600;font-style:italic;text-transform:uppercase;letter-spacing:.2em;font-size:12px;color:' + ACCENT + ';">Ultimate</small><b style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:28px;margin-top:4px;color:#fff;">Track Day Weapon</b></div>'
         '<div style="display:flex;flex-direction:column;line-height:1;"><small style="font-family:\'Saira Semi Condensed\';font-weight:600;font-style:italic;text-transform:uppercase;letter-spacing:.2em;font-size:12px;color:' + ACCENT + ';">Extreme</small><b style="font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:28px;margin-top:4px;color:#fff;">Street Performance</b></div></div>'),
])]))

# INTRO / BENEFITS
benefits_html = ('<ul style="list-style:none;margin:34px 0 0;padding:0;">'
    + benefit("01", '<b style="color:#f4f4f5">UTQG 200</b> rated Extreme Performance Summer compound')
    + benefit("02", 'Engineered for <b style="color:#f4f4f5">track dominance</b> and <b style="color:#f4f4f5">street performance</b> alike')
    + benefit("03", 'Addictive levels of <b style="color:#f4f4f5">steering response</b> and <b style="color:#f4f4f5">mid-corner handling</b>')
    + benefit("04", '<b style="color:#f4f4f5">Unrivaled grip</b> derived from a motorsports-proven tread')
    + benefit("05", '<b style="color:#f4f4f5">Adrenaline-fueled acceleration</b> fused with <b style="color:#f4f4f5">dynamic braking</b>')
    + '</ul>')
tire_html = ('<div style="position:relative;">'
    + f'<span style="position:absolute;right:-6px;top:-22px;background:{ACCENT};color:#fff;font-family:\'Saira Condensed\';font-style:italic;font-weight:800;text-transform:uppercase;font-size:14px;letter-spacing:.04em;padding:10px 16px;z-index:3;clip-path:polygon(8px 0,100% 0,100% calc(100% - 8px),calc(100% - 8px) 100%,0 100%,0 8px);">Apex RS</span>'
    + f'<img src="{IMG}ph-tire-hero.png" alt="" style="width:100%;height:560px;object-fit:cover;border-radius:4px;"></div>')
content.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed",
    "content_width": {"unit": "px", "size": 1280}, "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(55, [eyebrow("Presented by PitStop"), heading("Apex RS", "h2", 70, TEXT),
             text('<p style="color:#9a9aa3;font-weight:700;text-transform:uppercase;letter-spacing:.04em;">A street-legal track weapon, engineered to dominate.</p>', MUTED, 22),
             text('<p>Born on the limit and built for the road, the Apex RS fuses motorsport-grade compounds with everyday composure — so the drive to the circuit hits as hard as the laps.</p>', MUTED, 19),
             html(benefits_html)]),
    col(45, [html(tire_html)])]))

# STATEMENT
content.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "no", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("For Drivers", ACCENT, "center"),
              heading(f'…who live life on the edge. The Apex RS takes <span style="color:{ACCENT}">track dominance</span> straight to the street.', "h2", 60, TEXT, True, "center")],
        {"align": "center"})]))

# FEATURES
content.append(section({"background_background": "classic", "background_color": BG2, "layout": "boxed", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("Engineered to Attack", ACCENT, "center"),
              heading("Every Rib Has a Job", "h2", 58, TEXT, True, "center"),
              text('<p style="text-align:center;max-width:720px;margin:0 auto;">A purpose-built tread architecture that turns input into instant, repeatable grip — corner after corner.</p>', MUTED, 18, "center"),
              html(feature_stage())])]))

# DNA
content.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(50, [heading("PitStop DNA", "h3", 38, TEXT),
             text('<p>Pushing boundaries and defying limits. PitStop was forged from a legacy of relentless performance. Ignite your passion, empower your pride, and drive your success as you conquer life on and off the track.</p>', MUTED, 17)]),
    col(50, [heading("Total Dominance Plan", "h3", 38, TEXT),
             text('<p>Experience unmatched performance with the Total Dominance Plan — high-performance tires that set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing, the Apex RS delivers on every drive.</p>', MUTED, 17)])]))

# AVAILABILITY
content.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(45, [eyebrow("Availability"),
             heading(f'40<span style="color:{ACCENT}">+</span>', "div", 200, TEXT),
             heading("Sizes at Launch", "h3", 24, TEXT, False, "left", "Saira Semi Condensed"),
             text('<p>Over 40 sizes set to release, accommodating the most popular fitments for ultra-high-performance applications — from compact track toys to wide-body monsters.</p>', MUTED, 18),
             html('<div style="display:flex;align-items:center;gap:14px;margin-top:34px;color:#6e6e77;font-family:\'Saira Semi Condensed\';font-weight:600;text-transform:uppercase;letter-spacing:.16em;font-size:12px;"><span style="width:34px;height:1px;background:#6e6e77;"></span>Apex RS is USDOT street legal only</div>')]),
    col(55, [image(IMG + "ph-avail.png", 100)])]))

# RESOURCES
content.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("PitStop Apex RS Resources"), heading("Get the Details", "h2", 54, TEXT), html(resource_grid())])]))

# CTA
content.append(section({"background_background": "classic", "background_color": ACCENT, "layout": "boxed", "gap": "no", **pad(88, 32, 88, 32)}, [
    col(100, [heading("Conquer the Corner", "h2", 80, "#ffffff", True, "center"),
              text('<p style="text-align:center;text-transform:uppercase;letter-spacing:.16em;font-weight:600;opacity:.85;color:#fff;">Find your fitment · Locate a dealer</p>', "#ffffff", 14, "center"),
              html('<div style="text-align:center;margin-top:30px;"><a href="#" style="display:inline-flex;align-items:center;gap:10px;font-family:\'Saira Semi Condensed\';font-weight:700;text-transform:uppercase;letter-spacing:.14em;font-size:13px;background:#0a0a0b;color:#fff;padding:14px 26px;clip-path:polygon(10px 0,100% 0,100% calc(100% - 10px),calc(100% - 10px) 100%,0 100%,0 10px);">Find a Dealer</a></div>')],
        {"align": "center"})]))

template = {"version": "0.4", "title": "PitStop Apex RS", "type": "page",
            "content": content, "page_settings": {"background_background": "classic", "background_color": BG}}

out = os.path.join(os.path.dirname(os.path.abspath(__file__)), "pitstop-apex-template.json")
with open(out, "w") as f:
    json.dump(template, f, ensure_ascii=False)
print("Wrote", out)
print("Sections:", len(content), "| Size:", round(os.path.getsize(out)/1024, 1), "KB")
