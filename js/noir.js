/* NOIR — interactions. Vanilla, dependency-free. */
(function () {
  "use strict";
  var reduce = window.matchMedia("(prefers-reduced-motion:reduce)").matches;
  var SHOT = /[?&]shot/.test(location.search);
  if (SHOT) {
    var st = document.createElement("style");
    st.textContent = ".hero{min-height:760px!important}.apply{min-height:auto!important}" +
      ".apply__aside{min-height:680px}.reveal{opacity:1!important;transform:none!important}" +
      ".cursor{display:none!important}.hero__bg img{animation:none!important}" +
      ".curtain{display:none!important}";
    document.head.appendChild(st);
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".reveal").forEach(function (r) { r.classList.add("in"); });
      var c = document.querySelector(".curtain"); if (c) c.remove();
    });
  }

  /* ---------- Page-transition curtain ---------- */
  var curtain = document.querySelector(".curtain");
  if (curtain && !SHOT) {
    var firstVisit = !sessionStorage.getItem("noir_seen");
    // Reveal (lift the curtain) once the page is ready.
    window.addEventListener("load", function () {
      var hold = reduce ? 0 : (firstVisit ? 1000 : 300);
      setTimeout(function () {
        curtain.classList.add("curtain--hidden");
        sessionStorage.setItem("noir_seen", "1");
      }, hold);
    });
    // Cover with the curtain before navigating to another page in the site.
    document.addEventListener("click", function (e) {
      var a = e.target.closest("a");
      if (!a) return;
      var href = a.getAttribute("href");
      if (!href || href.charAt(0) === "#" || a.target === "_blank" ||
          /^(https?:|mailto:|tel:)/i.test(href) || a.hasAttribute("download")) return;
      if (a.origin && a.origin !== location.origin) return;
      e.preventDefault();
      curtain.classList.remove("curtain--hidden");
      var go = function () { window.location.href = href; };
      reduce ? go() : setTimeout(go, 640);
    });
    // Restore on back/forward from bfcache (curtain would otherwise stay covering).
    window.addEventListener("pageshow", function (ev) {
      if (ev.persisted) curtain.classList.add("curtain--hidden");
    });
  }

  /* ---------- Custom cursor ---------- */
  if (window.matchMedia("(hover:hover) and (pointer:fine)").matches) {
    var dot = document.createElement("div");
    dot.className = "cursor cursor--ring";
    document.body.appendChild(dot);
    var x = innerWidth / 2, y = innerHeight / 2, tx = x, ty = y;
    document.addEventListener("mousemove", function (e) { tx = e.clientX; ty = e.clientY; });
    (function loop() {
      x += (tx - x) * 0.18; y += (ty - y) * 0.18;
      dot.style.left = x + "px"; dot.style.top = y + "px";
      requestAnimationFrame(loop);
    })();
    var hoverSel = "a,button,input,select,textarea,.card,.act,label,[data-cursor]";
    document.addEventListener("mouseover", function (e) {
      if (e.target.closest(hoverSel)) dot.classList.add("cursor--hover");
    });
    document.addEventListener("mouseout", function (e) {
      if (e.target.closest(hoverSel)) dot.classList.remove("cursor--hover");
    });
    document.addEventListener("mouseleave", function () { dot.style.opacity = 0; });
    document.addEventListener("mouseenter", function () { dot.style.opacity = 1; });
  }

  /* ---------- Nav: solidify on scroll + mobile toggle ---------- */
  var nav = document.querySelector(".nav");
  function onScroll() { if (nav) nav.classList.toggle("solid", window.scrollY > 60); }
  onScroll(); window.addEventListener("scroll", onScroll, { passive: true });

  var toggle = document.querySelector(".nav__toggle");
  var links = document.querySelector(".nav__links");
  if (toggle && links) {
    toggle.addEventListener("click", function () {
      var open = links.classList.toggle("open");
      nav.classList.toggle("menu-open", open);
      toggle.setAttribute("aria-expanded", open);
      document.body.style.overflow = open ? "hidden" : "";
    });
    links.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        links.classList.remove("open"); nav.classList.remove("menu-open");
        document.body.style.overflow = "";
      });
    });
  }

  /* ---------- Scroll reveal ---------- */
  var revs = document.querySelectorAll(".reveal");
  if (reduce || !("IntersectionObserver" in window)) {
    revs.forEach(function (r) { r.classList.add("in"); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add("in"); io.unobserve(en.target); }
      });
    }, { threshold: 0.14, rootMargin: "0px 0px -8% 0px" });
    revs.forEach(function (r) { io.observe(r); });
  }

  /* ---------- Testimonial rotator ---------- */
  var q = document.querySelector("[data-quotes]");
  if (q) {
    var data = JSON.parse(q.getAttribute("data-quotes"));
    var tEl = q.querySelector(".quote__t"), byEl = q.querySelector(".quote__by"),
        dotsWrap = q.querySelector(".quote__dots"), i = 0, timer;
    data.forEach(function (_, n) {
      var b = document.createElement("button");
      b.setAttribute("aria-label", "Testimonial " + (n + 1));
      b.addEventListener("click", function () { show(n); rest(); });
      dotsWrap.appendChild(b);
    });
    var dots = dotsWrap.querySelectorAll("button");
    function show(n) {
      i = n;
      tEl.style.opacity = 0; byEl.style.opacity = 0;
      setTimeout(function () {
        tEl.textContent = data[n].t; byEl.textContent = data[n].by;
        tEl.style.opacity = 1; byEl.style.opacity = 1;
      }, 420);
      dots.forEach(function (d, k) { d.setAttribute("aria-selected", k === n); });
    }
    function next() { show((i + 1) % data.length); }
    function rest() { clearInterval(timer); if (!reduce) timer = setInterval(next, 7000); }
    tEl.style.transition = byEl.style.transition = "opacity .42s ease";
    show(0); rest();
  }

  /* ---------- Commissions gallery filter ---------- */
  var filterWrap = document.querySelector(".filters");
  if (filterWrap) {
    var figs = document.querySelectorAll(".gallery figure");
    filterWrap.addEventListener("click", function (e) {
      var btn = e.target.closest("button"); if (!btn) return;
      filterWrap.querySelectorAll("button").forEach(function (b) { b.setAttribute("aria-pressed", b === btn); });
      var f = btn.getAttribute("data-filter");
      figs.forEach(function (fg) {
        var show = f === "all" || fg.getAttribute("data-occ") === f;
        fg.style.display = show ? "" : "none";
      });
    });
  }

  /* ---------- Appointment form (front-end only) ---------- */
  var form = document.querySelector(".form");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (!form.checkValidity()) { form.reportValidity(); return; }
      form.classList.add("sent");
      form.scrollIntoView({ behavior: reduce ? "auto" : "smooth", block: "center" });
    });
  }
})();
