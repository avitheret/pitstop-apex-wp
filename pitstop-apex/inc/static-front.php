<?php
/**
 * Full static render of the PitStop Apex RS landing page.
 * Used as the front page when the homepage is NOT built with Elementor,
 * and as the visual reference for the auto-built Elementor sections.
 */
$img = get_template_directory_uri() . '/assets/images/';
?>

<!-- HERO -->
<section class="hero" id="top">
  <div class="hero-media" id="heroMedia"><img src="<?php echo esc_url($img); ?>ph-hero.png" alt=""></div>
  <div class="hero-inner">
    <div class="wrap">
      <p class="eyebrow reveal in">PitStop Apex RS &middot; Extreme Performance Summer</p>
      <h1 class="disp reveal in d1">Own.<br>Every.<br><span class="dim">Apex.</span></h1>
      <div class="hero-tags reveal in d2">
        <div class="hero-tag"><small>Ultimate</small><b>Track Day Weapon</b></div>
        <div class="hero-tag"><small>Extreme</small><b>Street Performance</b></div>
      </div>
    </div>
  </div>
  <div class="scrollcue"><span>Scroll</span><i></i></div>
</section>

<!-- INTRO / BENEFITS -->
<section class="intro pad" id="benefits">
  <div class="wrap intro-grid">
    <div>
      <p class="eyebrow reveal">Presented by PitStop</p>
      <h2 class="disp reveal d1">Apex RS<span class="sub">A street-legal track weapon, engineered to dominate.</span></h2>
      <p class="lead reveal d1">Born on the limit and built for the road, the Apex RS fuses motorsport-grade compounds with everyday composure &mdash; so the drive to the circuit hits as hard as the laps.</p>
      <ul class="benefits">
        <li class="reveal"><span class="ix">01</span><p><b>UTQG 200</b> rated Extreme Performance Summer compound</p></li>
        <li class="reveal" style="transition-delay:.06s"><span class="ix">02</span><p>Engineered for <b>track dominance</b> and <b>street performance</b> alike</p></li>
        <li class="reveal" style="transition-delay:.12s"><span class="ix">03</span><p>Addictive levels of <b>steering response</b> and <b>mid-corner handling</b></p></li>
        <li class="reveal" style="transition-delay:.18s"><span class="ix">04</span><p><b>Unrivaled grip</b> derived from a motorsports-proven tread</p></li>
        <li class="reveal" style="transition-delay:.24s"><span class="ix">05</span><p><b>Adrenaline-fueled acceleration</b> fused with <b>dynamic braking</b></p></li>
      </ul>
    </div>
    <div class="intro-media reveal d2">
      <span class="tire-badge">Apex RS</span>
      <img src="<?php echo esc_url($img); ?>ph-tire-hero.png" alt="">
    </div>
  </div>
</section>

<!-- STATEMENT -->
<section class="statement pad" id="performance">
  <div class="wrap">
    <span class="eyebrow reveal">For Drivers</span>
    <p class="reveal d1">&hellip;who live life on the edge. The Apex RS takes <span class="accent">track dominance</span> straight to the street.</p>
  </div>
</section>

<!-- FEATURE CALLOUTS -->
<section class="features pad" id="specs">
  <div class="wrap">
    <div class="feat-head">
      <span class="eyebrow reveal">Engineered to Attack</span>
      <h2 class="disp reveal d1">Every Rib Has a Job</h2>
      <p class="reveal d1">A purpose-built tread architecture that turns input into instant, repeatable grip &mdash; corner after corner.</p>
    </div>
    <div class="feat-stage">
      <div class="feat-col left">
        <div class="feat-item reveal"><span class="dot"></span><h4>Extra-Wide Shoulder Ribs</h4><p>Maximize the contact patch under load to hold the line through high-speed cornering.</p></div>
        <div class="feat-item reveal" style="transition-delay:.08s"><span class="dot"></span><h4>Featherlight Construction</h4><p>A lightweight casing trims rotating mass for peak responsiveness and quicker turn-in.</p></div>
        <div class="feat-item reveal" style="transition-delay:.16s"><span class="dot"></span><h4>Motorsport-Derived Compound</h4><p>A track-bred rubber formulation that reaches grip temperature fast and stays consistent.</p></div>
      </div>
      <div class="feat-media reveal d1">
        <div class="ring"></div>
        <img src="<?php echo esc_url($img); ?>ph-feat.png" alt="">
      </div>
      <div class="feat-col right">
        <div class="feat-item reveal"><span class="dot"></span><h4>Optimized Center Rib</h4><p>A continuous center band stabilizes the tire under hard braking for shorter, surer stops.</p></div>
        <div class="feat-item reveal" style="transition-delay:.08s"><span class="dot"></span><h4>RS-DNA Technology</h4><p>Decades of racing know-how distilled into a tread pattern tuned for the absolute limit.</p></div>
        <div class="feat-item reveal" style="transition-delay:.16s"><span class="dot"></span><h4>Precision Sidewall</h4><p>A stiff, reinforced sidewall delivers crisp, communicative feedback at the wheel.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- DNA -->
<section class="dna pad">
  <div class="dna-watermark disp" aria-hidden="true">RS-DNA</div>
  <div class="wrap">
    <div class="dna-grid">
      <div class="dna-card reveal">
        <h3>PitStop DNA</h3>
        <p>Pushing boundaries and defying limits. PitStop was forged from a legacy of relentless performance. Ignite your passion, empower your pride, and drive your success as you conquer life on and off the track.</p>
      </div>
      <div class="dna-card reveal d1">
        <h3>Total Dominance Plan</h3>
        <p>Experience unmatched performance with the Total Dominance Plan &mdash; high-performance tires that set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing, the Apex RS delivers on every drive.</p>
      </div>
    </div>
  </div>
</section>

<!-- AVAILABILITY -->
<section class="avail pad" id="availability">
  <div class="wrap avail-grid">
    <div>
      <span class="eyebrow reveal">Availability</span>
      <div class="bignum disp reveal d1">40<span class="plus">+</span></div>
      <h3 class="reveal d1">Sizes at Launch</h3>
      <p class="reveal d2">Over 40 sizes set to release, accommodating the most popular fitments for ultra-high-performance applications &mdash; from compact track toys to wide-body monsters.</p>
      <div class="legal reveal d2">Apex RS is USDOT street legal only</div>
    </div>
    <div class="avail-media reveal d1"><img src="<?php echo esc_url($img); ?>ph-avail.png" alt=""></div>
  </div>
</section>

<!-- RESOURCES -->
<section class="res pad" id="resources">
  <div class="wrap">
    <div class="res-head">
      <span class="eyebrow reveal">PitStop Apex RS Resources</span>
      <h2 class="disp reveal d1">Get the Details</h2>
    </div>
    <div class="res-grid">
      <div class="res-card reveal">
        <h4>Detailed Product Specifications</h4>
        <p>Full Apex RS product specifications, sizing and load ratings. Note: all measurements are subject to change upon official size release.</p>
        <a class="dl" href="#">Download <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 3v13M6 11l6 6 6-6M5 21h14"/></svg></a>
      </div>
      <div class="res-card reveal d1">
        <h4>Tire Care &amp; Safety Guidelines</h4>
        <p>Detailed tire care procedures, break-in best practices and safety guidelines for getting the most from your Apex RS.</p>
        <a class="dl" href="#">Download <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 3v13M6 11l6 6 6-6M5 21h14"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta pad-sm" id="cta">
  <div class="cta-stripes" aria-hidden="true"></div>
  <div class="wrap">
    <h2 class="reveal">Conquer the Corner</h2>
    <p class="reveal d1">Find your fitment &middot; Locate a dealer</p>
    <a class="btn reveal d1" href="#">Find a Dealer</a>
  </div>
</section>
