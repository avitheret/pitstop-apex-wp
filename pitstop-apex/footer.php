<?php
$logo = get_template_directory_uri() . '/assets/images/pitstop-logo-white.png';
$fb = 'https://facebook.com/';
$ig = 'https://instagram.com/';
$yt = 'https://youtube.com/';
?>
<footer class="site-footer">
  <div class="wrap">
    <div class="foot-top">
      <img src="<?php echo esc_url($logo); ?>" alt="PitStop">
      <div class="foot-links">
        <a href="#benefits">Benefits</a>
        <a href="#performance">Performance</a>
        <a href="#specs">Technology</a>
        <a href="#availability">Availability</a>
        <a href="#resources">Resources</a>
      </div>
    </div>
    <div class="foot-bottom">
      <p>&copy; Copyright PitStop Performance Tire <?php echo date('Y'); ?></p>
      <div class="socials">
        <a href="<?php echo esc_url($fb); ?>" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-2 0-3 1.3-3 3.2V11H9v3h2v7h3v-7h2.4l.6-3H14V9.4c0-.3.2-.4.5-.4z"/></svg></a>
        <a href="<?php echo esc_url($ig); ?>" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a>
        <a href="<?php echo esc_url($yt); ?>" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12s0-3-.4-4.3c-.2-.8-.9-1.4-1.7-1.6C18.3 5.7 12 5.7 12 5.7s-6.3 0-7.9.4c-.8.2-1.5.8-1.7 1.6C2 9 2 12 2 12s0 3 .4 4.3c.2.8.9 1.4 1.7 1.6 1.6.4 7.9.4 7.9.4s6.3 0 7.9-.4c.8-.2 1.5-.8 1.7-1.6C22 15 22 12 22 12zm-12 2.6V9.4l5 2.6z"/></svg></a>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
