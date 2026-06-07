<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
wp_body_open();
$logo = get_template_directory_uri() . '/assets/images/pitstop-logo-white.png';
?>

<header class="site-header" id="hdr">
  <nav class="nav">
    <a class="brand" href="<?php echo esc_url( home_url('/') ); ?>" aria-label="PitStop home">
      <img src="<?php echo esc_url($logo); ?>" alt="PitStop">
    </a>
    <div class="nav-links">
      <a href="#benefits">Benefits</a>
      <a href="#performance">Performance</a>
      <a href="#specs">Technology</a>
      <a href="#availability">Availability</a>
      <a href="#resources">Resources</a>
    </div>
    <div style="display:flex;align-items:center;gap:14px">
      <a class="btn ghost" href="#cta">Find a Dealer</a>
      <button class="hamb" id="hamb" aria-label="Open menu"><span></span><span></span><span></span></button>
    </div>
  </nav>
</header>

<div class="mobile-menu" id="mobileMenu">
  <button class="close" id="closeMenu" aria-label="Close menu">&times;</button>
  <a href="#benefits">Benefits</a>
  <a href="#performance">Performance</a>
  <a href="#specs">Technology</a>
  <a href="#availability">Availability</a>
  <a href="#resources">Resources</a>
</div>
