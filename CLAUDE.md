# PitStop Apex RS — Project Rules

WordPress theme that auto-builds an Elementor-editable homepage.
Theme dir: `pitstop-apex/`. Local test: `cd pitstop-apex && npx @wp-now/wp-now start` (http://localhost:8881, admin/password).

## Rules (apply on EVERY change to the Elementor page)

1. **Always delete autosaves + re-inject.** When the Elementor page is regenerated,
   delete all post revisions/autosaves first, then write fresh `_elementor_data`.
   This is built into `pitstop_build_home()` (in `inc/elementor-build.php`) — keep it
   there. Without it, the Elementor editor loads a stale autosave instead of the new build.

2. **Always bump the version / sub-version after every task.**
   - Edit `PITSTOP_VER` and `PITSTOP_DISPLAY_VER` in `pitstop-apex/functions.php`.
   - Minor task (fix/tweak): bump sub-version (v1.1 → v1.2).
   - Major task (new section/redesign): bump major (v1.x → v2.0).

3. **The version is displayed visibly in the top menu bar** — the `.ver-badge` span in
   `header.php`, fed by `PITSTOP_DISPLAY_VER`. Keep it visible.

## Other conventions
- **Elementor sections must use NATIVE widgets** (Heading, Text, Image, Button, Icon List,
  inner sections) — not HTML widgets — so everything is click-editable.
- `_elementor_data` must be `wp_slash()`'d before `update_post_meta` or Elementor renders blank.
- Keep `inc/static-front.php` as the fallback render (front-page.php is hybrid).
- Keep the importable template (`gen-template.py` → `pitstop-apex-template.json`) in sync
  with `inc/elementor-build.php`.

## Current version: v1.1
