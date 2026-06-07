/* PitStop Apex RS — interactions */
(function () {
  'use strict';

  // header scroll state + subtle hero parallax
  var hdr = document.getElementById('hdr');
  function onScroll() {
    if (hdr) hdr.classList.toggle('scrolled', window.scrollY > 40);
    var hm = document.getElementById('heroMedia');
    if (hm && window.scrollY < window.innerHeight) {
      hm.style.transform = 'translateY(' + (window.scrollY * 0.18) + 'px)';
    }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // reveal on scroll
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, { threshold: 0.16, rootMargin: '0px 0px -8% 0px' });
    document.querySelectorAll('.reveal:not(.in)').forEach(function (el) { io.observe(el); });
  } else {
    document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
  }

  // mobile menu
  var mm = document.getElementById('mobileMenu');
  var hamb = document.getElementById('hamb');
  var closeMenu = document.getElementById('closeMenu');
  if (hamb && mm) hamb.addEventListener('click', function () { mm.classList.add('open'); });
  if (closeMenu && mm) closeMenu.addEventListener('click', function () { mm.classList.remove('open'); });
  if (mm) mm.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', function () { mm.classList.remove('open'); }); });
})();
