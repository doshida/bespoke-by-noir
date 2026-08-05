<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('weddings');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = 'weddings.php';
$theme = 'light';
require __DIR__ . '/includes/layout_top.php';
?>

<!-- Hero -->
<header class="hero">
  <div class="hero__bg"><img src="<?= e($d['hero']['image']) ?>" alt="<?= e($d['hero']['imageAlt']) ?>"></div>
  <div class="hero__inner wrap">
    <span class="eyebrow reveal"><?= e($d['hero']['eyebrow']) ?></span>
    <h1 class="display hero__title reveal" data-d="1"><?= rich($d['hero']['title']) ?></h1>
    <p class="hero__sub reveal" data-d="2"><?= e($d['hero']['sub']) ?></p>
    <div class="hero__cta reveal" data-d="3">
      <a class="btn btn--solid" href="<?= e($d['hero']['ctaPrimaryHref']) ?>"><span><?= e($d['hero']['ctaPrimaryLabel']) ?></span></a>
      <a class="txtlink" href="<?= e($d['hero']['ctaSecondaryHref']) ?>"><?= e($d['hero']['ctaSecondaryLabel']) ?></a>
    </div>
  </div>
  <div class="scrollcue">Scroll</div>
</header>

<!-- The Invitation -->
<section class="section" id="invitation">
  <div class="wrap split split--wideL">
    <div class="split__media split__media--tall reveal">
      <img src="<?= e($d['invitation']['image']) ?>" alt="<?= e($d['invitation']['imageAlt']) ?>">
      <span class="figtag"><?= e($d['invitation']['figtag']) ?></span>
    </div>
    <div>
      <span class="eyebrow reveal"><?= e($d['invitation']['eyebrow']) ?></span>
      <p class="lead reveal mt-m" data-d="1"><?= e($d['invitation']['lead']) ?></p>
      <p class="muted reveal mt-m" data-d="2"><?= e($d['invitation']['body']) ?></p>
      <a class="txtlink reveal mt-l" data-d="3" href="<?= e($d['invitation']['linkHref']) ?>"><?= e($d['invitation']['linkLabel']) ?></a>
    </div>
  </div>
</section>

<hr class="rule">

<!-- Offerings -->
<section class="section" id="offerings">
  <div class="wrap">
    <div class="center" style="margin-bottom:clamp(2.5rem,6vh,4.5rem)">
      <span class="eyebrow center reveal"><?= e($d['offerings']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= rich($d['offerings']['heading']) ?></h2>
    </div>
    <div class="ritual">
      <?php foreach ($d['offerings']['items'] as $i => $o): ?>
        <a class="act reveal"<?= $i > 0 ? ' data-d="' . (int) $i . '"' : '' ?> href="<?= e($o['href']) ?>">
          <div class="act__media"><img src="<?= e($o['image']) ?>" alt="<?= e($o['imageAlt']) ?>"></div>
          <div class="act__no"><?= e($o['number']) ?></div>
          <div class="act__t offer__t"><?= e($o['title']) ?></div>
          <p class="act__d"><?= e($o['desc']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- The Process -->
<section class="section band" id="process">
  <div class="wrap">
    <div class="center" style="margin-bottom:clamp(2.5rem,6vh,4rem)">
      <span class="eyebrow center reveal"><?= e($d['process']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= rich($d['process']['heading']) ?></h2>
      <p class="muted reveal mt-m" data-d="2" style="max-width:48ch;margin-inline:auto"><?= e($d['process']['sub']) ?></p>
    </div>
    <div class="steps reveal" data-d="1">
      <?php foreach ($d['process']['steps'] as $s): ?>
        <div class="step"><div class="step__no"><?= e($s['number']) ?></div><div><div class="step__t"><?= e($s['title']) ?></div><p class="step__d"><?= e($s['desc']) ?></p></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Gallery -->
<section class="section" id="gallery">
  <div class="wrap">
    <div class="center" style="margin-bottom:clamp(2rem,5vh,3.5rem)">
      <span class="eyebrow center reveal"><?= e($d['gallery']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= e($d['gallery']['heading']) ?></h2>
    </div>
    <div class="gallery reveal" data-d="1">
      <?php foreach ($d['gallery']['items'] as $g): ?>
        <figure><img src="<?= e($g['image']) ?>" alt="<?= e($g['imageAlt']) ?>"><figcaption><div class="g-occ"><?= e($g['occasionLabel']) ?></div><div class="g-t"><?= e($g['title']) ?></div></figcaption></figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<hr class="rule">

<!-- Testimonials -->
<section class="section" id="voices">
  <div class="wrap">
    <div class="quote" data-quotes='<?= e(json_encode(array_map(fn($t) => ['t' => $t['quote'], 'by' => $t['by']], $d['testimonials']), JSON_UNESCAPED_SLASHES)) ?>'>
      <span class="quote__mark">&ldquo;</span>
      <p class="quote__t reveal">&nbsp;</p>
      <p class="quote__by reveal" data-d="1"></p>
      <div class="quote__dots" role="tablist" aria-label="Testimonials"></div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section cta-band">
  <div class="cta-band__bg"><img src="<?= e($d['cta']['image']) ?>" alt=""></div>
  <div class="wrap center">
    <span class="eyebrow center reveal"><?= e($d['cta']['eyebrow']) ?></span>
    <h2 class="display reveal mt-s" data-d="1" style="font-size:clamp(2.4rem,6vw,5rem)"><?= rich($d['cta']['heading']) ?></h2>
    <p class="muted reveal mt-m" data-d="2" style="max-width:46ch;margin-inline:auto"><?= e($d['cta']['sub']) ?></p>
    <div class="reveal mt-l" data-d="3"><a class="btn btn--solid" href="<?= e($d['cta']['buttonHref']) ?>"><span><?= e($d['cta']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
