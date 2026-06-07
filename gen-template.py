#!/usr/bin/env python3
"""
Importable Elementor template for PitStop Apex RS — native widgets only
(mirrors inc/elementor-build.php). Import via Elementor → Templates →
Saved Templates → Import. Images use root-relative theme paths.
"""
import json, secrets, os

IMG = "/wp-content/themes/pitstop-apex/assets/images/"
ACCENT, BG, BG2, PANEL = "#e5241b", "#0a0a0b", "#101012", "#16161a"
TEXT, MUTED, LINE = "#f4f4f5", "#9a9aa3", "rgba(255,255,255,0.10)"

def uid(): return secrets.token_hex(4)[:7]
def section(s, cols, inner=False): return {"id": uid(), "elType": "section", "settings": s, "elements": cols, "isInner": inner}
def inner(s, cols): return section(s, cols, True)
def col(size, widgets, extra=None):
    s = {"_column_size": size, "_inline_size": None}
    if extra: s.update(extra)
    return {"id": uid(), "elType": "column", "settings": s, "elements": widgets, "isInner": False}
def pad(t, r, b, l): return {"padding": {"unit": "px", "top": str(t), "right": str(r), "bottom": str(b), "left": str(l), "isLinked": False}}

def heading(title, tag="h2", size=48, color=TEXT, italic=True, align="left", family="Saira Condensed", weight="800"):
    s = {"title": title, "header_size": tag, "title_color": color, "align": align,
         "typography_typography": "custom", "typography_font_family": family, "typography_font_weight": weight,
         "typography_font_size": {"unit": "px", "size": size, "sizes": []},
         "typography_text_transform": "uppercase", "typography_line_height": {"unit": "em", "size": 1.0, "sizes": []}}
    if italic: s["typography_font_style"] = "italic"
    return {"id": uid(), "elType": "widget", "widgetType": "heading", "settings": s, "elements": []}
def eyebrow(text, color=ACCENT, align="left"):
    return {"id": uid(), "elType": "widget", "widgetType": "heading", "settings": {
        "title": text, "header_size": "h6", "title_color": color, "align": align,
        "typography_typography": "custom", "typography_font_family": "Saira Semi Condensed", "typography_font_weight": "700",
        "typography_font_size": {"unit": "px", "size": 13, "sizes": []},
        "typography_text_transform": "uppercase", "typography_letter_spacing": {"unit": "px", "size": 3.5, "sizes": []},
        "_margin": {"unit": "px", "top": "0", "right": "0", "bottom": "14", "left": "0", "isLinked": False}}, "elements": []}
def text(html, color=MUTED, size=18, align="left"):
    return {"id": uid(), "elType": "widget", "widgetType": "text-editor", "settings": {
        "editor": html, "text_color": color, "align": align,
        "typography_typography": "custom", "typography_font_family": "Saira",
        "typography_font_size": {"unit": "px", "size": size, "sizes": []},
        "typography_line_height": {"unit": "em", "size": 1.6, "sizes": []}}, "elements": []}
def image(url, width=100, align="center", radius=0, height=0):
    s = {"image": {"url": url, "id": "", "source": "url"}, "image_size": "full", "align": align,
         "width": {"unit": "%", "size": width, "sizes": []}}
    if radius: s["image_border_radius"] = {"unit": "%", "top": str(radius), "right": str(radius), "bottom": str(radius), "left": str(radius), "isLinked": True}
    if height: s["height"] = {"unit": "px", "size": height, "sizes": []}; s["object-fit"] = "cover"
    return {"id": uid(), "elType": "widget", "widgetType": "image", "settings": s, "elements": []}
def button(t, link="#", bg=ACCENT, color="#ffffff", align="left"):
    return {"id": uid(), "elType": "widget", "widgetType": "button", "settings": {
        "text": t, "link": {"url": link}, "align": align, "button_background_color": bg, "button_text_color": color,
        "typography_typography": "custom", "typography_font_family": "Saira Semi Condensed", "typography_font_weight": "700",
        "typography_text_transform": "uppercase", "typography_letter_spacing": {"unit": "px", "size": 2, "sizes": []},
        "typography_font_size": {"unit": "px", "size": 13, "sizes": []},
        "border_radius": {"unit": "px", "top": "0", "right": "0", "bottom": "0", "left": "0", "isLinked": True}}, "elements": []}
def iconlist(items, icon_color=ACCENT, text_color="#d7d7da"):
    lst = [{"text": t, "selected_icon": {"value": "fas fa-chevron-right", "library": "fa-solid"}, "_id": uid()} for t in items]
    return {"id": uid(), "elType": "widget", "widgetType": "icon-list", "settings": {
        "icon_list": lst, "view": "traditional", "icon_color": icon_color,
        "icon_size": {"unit": "px", "size": 13, "sizes": []}, "space_between": {"unit": "px", "size": 16, "sizes": []},
        "text_color": text_color, "icon_typography_typography": "custom", "icon_typography_font_family": "Saira",
        "icon_typography_font_size": {"unit": "px", "size": 17, "sizes": []},
        "text_indent": {"unit": "px", "size": 14, "sizes": []},
        "divider": "yes", "divider_color": LINE, "divider_weight": {"unit": "px", "size": 1, "sizes": []}}, "elements": []}

def feat_item(title, body, align="left"):
    return [heading(title, "h4", 19, TEXT, False, align, "Saira Semi Condensed", "700"), text("<p>" + body + "</p>", MUTED, 15.5, align)]

C = []

# HERO
hero_tags = inner({"gap": "wide", "content_width": "full"}, [
    col(50, [heading("Ultimate", "h6", 12, ACCENT, True, "left", "Saira Semi Condensed", "600"), heading("Track Day Weapon", "div", 28, "#ffffff", True, "left")]),
    col(50, [heading("Extreme", "h6", 12, ACCENT, True, "left", "Saira Semi Condensed", "600"), heading("Street Performance", "div", 28, "#ffffff", True, "left")])])
C.append(section({"background_background": "classic", "background_image": {"url": IMG + "ph-hero.png", "id": ""},
    "background_size": "cover", "background_position": "center center",
    "background_overlay_background": "gradient", "background_overlay_color": "rgba(10,10,11,0)", "background_overlay_color_b": "#0a0a0b",
    "background_overlay_gradient_angle": {"unit": "deg", "size": 180}, "background_overlay_gradient_position": {"unit": "%", "size": 55},
    "height": "min-height", "custom_height": {"unit": "vh", "size": 100}, "content_position": "bottom", "layout": "full_width", **pad(0, 32, 70, 32)},
    [col(100, [eyebrow("PitStop Apex RS · Extreme Performance Summer"),
               heading('Own.<br>Every.<br><span style="color:rgba(255,255,255,.4)">Apex.</span>', "h1", 120, TEXT), hero_tags])]))

# INTRO / BENEFITS
benefits = iconlist(["UTQG 200 rated Extreme Performance Summer compound",
    "Engineered for track dominance and street performance alike",
    "Addictive levels of steering response and mid-corner handling",
    "Unrivaled grip derived from a motorsports-proven tread",
    "Adrenaline-fueled acceleration fused with dynamic braking"])
C.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed",
    "content_width": {"unit": "px", "size": 1280}, "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(55, [eyebrow("Presented by PitStop"), heading("Apex RS", "h2", 70, TEXT),
             text('<p style="font-weight:700;text-transform:uppercase;letter-spacing:.04em;">A street-legal track weapon, engineered to dominate.</p>', MUTED, 22),
             text('<p>Born on the limit and built for the road, the Apex RS fuses motorsport-grade compounds with everyday composure — so the drive to the circuit hits as hard as the laps.</p>', MUTED, 19),
             benefits]),
    col(45, [heading("Apex RS", "div", 14, "#ffffff", True, "right"), image(IMG + "ph-tire-hero.png", 100, "center", 0, 560)])]))

# STATEMENT
C.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "no", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("For Drivers", ACCENT, "center"),
              heading(f'…who live life on the edge. The Apex RS takes <span style="color:{ACCENT}">track dominance</span> straight to the street.', "h2", 60, TEXT, True, "center")], {"align": "center"})]))

# FEATURES
left = []
for t, b in [("Extra-Wide Shoulder Ribs", "Maximize the contact patch under load to hold the line through high-speed cornering."),
             ("Featherlight Construction", "A lightweight casing trims rotating mass for peak responsiveness and quicker turn-in."),
             ("Motorsport-Derived Compound", "A track-bred rubber formulation that reaches grip temperature fast and stays consistent.")]:
    left += feat_item(t, b, "left")
right = []
for t, b in [("Optimized Center Rib", "A continuous center band stabilizes the tire under hard braking for shorter, surer stops."),
             ("RS-DNA Technology", "Decades of racing know-how distilled into a tread pattern tuned for the absolute limit."),
             ("Precision Sidewall", "A stiff, reinforced sidewall delivers crisp, communicative feedback at the wheel.")]:
    right += feat_item(t, b, "right")
feat_stage = inner({"gap": "wide", "content_width": "full"}, [
    col(33, left), col(34, [image(IMG + "ph-feat.png", 100, "center", 50, 480)]), col(33, right)])
C.append(section({"background_background": "classic", "background_color": BG2, "layout": "boxed", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("Engineered to Attack", ACCENT, "center"), heading("Every Rib Has a Job", "h2", 58, TEXT, True, "center"),
              text('<p style="text-align:center;max-width:720px;margin:0 auto;">A purpose-built tread architecture that turns input into instant, repeatable grip — corner after corner.</p>', MUTED, 18, "center"),
              feat_stage])]))

# DNA
C.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(50, [heading("PitStop DNA", "h3", 38, TEXT), text('<p>Pushing boundaries and defying limits. PitStop was forged from a legacy of relentless performance. Ignite your passion, empower your pride, and drive your success as you conquer life on and off the track.</p>', MUTED, 17)]),
    col(50, [heading("Total Dominance Plan", "h3", 38, TEXT), text('<p>Experience unmatched performance with the Total Dominance Plan — high-performance tires that set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing, the Apex RS delivers on every drive.</p>', MUTED, 17)])]))

# AVAILABILITY
C.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", "gap": "wide", **pad(120, 32, 120, 32)}, [
    col(45, [eyebrow("Availability"), heading(f'40<span style="color:{ACCENT}">+</span>', "div", 200, TEXT),
             heading("Sizes at Launch", "h3", 24, TEXT, False, "left", "Saira Semi Condensed"),
             text('<p>Over 40 sizes set to release, accommodating the most popular fitments for ultra-high-performance applications — from compact track toys to wide-body monsters.</p>', MUTED, 18),
             text('<p style="text-transform:uppercase;letter-spacing:.16em;font-weight:600;font-size:12px;">— Apex RS is USDOT street legal only</p>', MUTED, 12)]),
    col(55, [image(IMG + "ph-avail.png", 100)])]))

# RESOURCES
def card_col(title, body):
    return col(50, [heading(title, "h4", 21, TEXT, False, "left", "Saira Semi Condensed", "700"),
                    text("<p>" + body + "</p>", MUTED, 16), button("Download ↓", "#", ACCENT, "#ffffff", "left")], {
        "background_background": "classic", "background_color": PANEL, "border_border": "solid",
        "border_width": {"unit": "px", "top": "1", "right": "1", "bottom": "1", "left": "1", "isLinked": True}, "border_color": LINE,
        "padding": {"unit": "px", "top": "38", "right": "38", "bottom": "38", "left": "38", "isLinked": True}})
res_grid = inner({"gap": "wide", "content_width": "full"}, [
    card_col("Detailed Product Specifications", "Full Apex RS product specifications, sizing and load ratings. Note: all measurements are subject to change upon official size release."),
    card_col("Tire Care &amp; Safety Guidelines", "Detailed tire care procedures, break-in best practices and safety guidelines for getting the most from your Apex RS.")])
C.append(section({"background_background": "classic", "background_color": BG, "layout": "boxed", **pad(120, 32, 120, 32)}, [
    col(100, [eyebrow("PitStop Apex RS Resources"), heading("Get the Details", "h2", 54, TEXT), res_grid])]))

# CTA
C.append(section({"background_background": "classic", "background_color": ACCENT, "layout": "boxed", "gap": "no", **pad(88, 32, 88, 32)}, [
    col(100, [heading("Conquer the Corner", "h2", 80, "#ffffff", True, "center"),
              text('<p style="text-align:center;text-transform:uppercase;letter-spacing:.16em;font-weight:600;opacity:.85;color:#fff;">Find your fitment · Locate a dealer</p>', "#ffffff", 14, "center"),
              button("Find a Dealer", "#", "#0a0a0b", "#ffffff", "center")], {"align": "center"})]))

template = {"version": "0.4", "title": "PitStop Apex RS", "type": "page", "content": C,
            "page_settings": {"background_background": "classic", "background_color": BG}}
out = os.path.join(os.path.dirname(os.path.abspath(__file__)), "pitstop-apex-template.json")
with open(out, "w") as f:
    json.dump(template, f, ensure_ascii=False)
print("Wrote", out, "·", len(C), "sections ·", round(os.path.getsize(out)/1024, 1), "KB")
