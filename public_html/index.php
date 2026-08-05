<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('home');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = '';
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

<!-- The Ritual -->
<section class="section" id="ritual">
  <div class="wrap">
    <div class="center" style="margin-bottom:clamp(2.5rem,6vh,4.5rem)">
      <span class="eyebrow center reveal"><?= e($d['ritual']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= e($d['ritual']['heading']) ?></h2>
    </div>
    <div class="ritual">
      <?php foreach ($d['ritual']['acts'] as $i => $act): ?>
        <a class="act reveal"<?= $i > 0 ? ' data-d="' . (int) $i . '"' : '' ?> href="<?= e($act['href'] ?? $d['ritual']['buttonHref']) ?>">
          <div class="act__media"><img src="<?= e($act['image']) ?>" alt="<?= e($act['imageAlt']) ?>"></div>
          <div class="act__no"><?= e($act['number']) ?></div>
          <div class="act__t"><?= e($act['title']) ?></div>
          <p class="act__d"><?= e($act['desc']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
    <div class="center mt-l reveal"><a class="btn" href="<?= e($d['ritual']['buttonHref']) ?>"><span><?= e($d['ritual']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<!-- The Atelier band -->
<section class="section band" id="atelier">
  <div class="wrap split">
    <div>
      <span class="eyebrow reveal"><?= e($d['atelierBand']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= rich($d['atelierBand']['heading']) ?></h2>
      <p class="muted reveal mt-m maxw" data-d="2"><?= e($d['atelierBand']['body']) ?></p>
      <div style="display:flex;gap:2.5rem;align-items:center;margin-top:2.5rem" class="reveal" data-d="3">
        <div class="seal"><?= rich($d['atelierBand']['sealText']) ?></div>
        <div>
          <p class="meta"><?= e($d['atelierBand']['locationLabel']) ?></p>
          <p class="lead" style="font-size:1.3rem;margin:.3rem 0"><?= e($d['atelierBand']['location']) ?></p>
          <a class="txtlink" href="<?= e($d['atelierBand']['linkHref']) ?>"><?= e($d['atelierBand']['linkLabel']) ?></a>
        </div>
      </div>
    </div>
    <div class="split__media split__media--tall reveal" data-d="1">
      <img src="<?= e($d['atelierBand']['image']) ?>" alt="<?= e($d['atelierBand']['imageAlt']) ?>">
    </div>
  </div>
</section>

<!-- For the boardroom (C-suite) -->
<section class="section" id="distinction">
  <div class="wrap split">
    <div class="split__media split__media--tall reveal">
      <img src="<?= e($d['distinction']['image']) ?>" alt="<?= e($d['distinction']['imageAlt']) ?>">
      <span class="figtag"><?= e($d['distinction']['figtag']) ?></span>
    </div>
    <div>
      <span class="eyebrow reveal"><?= e($d['distinction']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= rich($d['distinction']['heading']) ?></h2>
      <p class="muted reveal mt-m maxw" data-d="2"><?= e($d['distinction']['body']) ?></p>
      <ul class="reveal mt-m" data-d="2" style="list-style:none;padding:0;margin:1.6rem 0 0;color:var(--bone-2)">
        <?php $n = count($d['distinction']['bullets']); foreach ($d['distinction']['bullets'] as $i => $b): ?>
          <li style="padding:.7rem 0;border-top:1px solid var(--line)<?= $i === $n - 1 ? ';border-bottom:1px solid var(--line)' : '' ?>"><?= e($b) ?></li>
        <?php endforeach; ?>
      </ul>
      <a class="txtlink reveal mt-l" data-d="3" href="<?= e($d['distinction']['linkHref']) ?>"><?= e($d['distinction']['linkLabel']) ?></a>
    </div>
  </div>
</section>

<!-- Recent Commissions -->
<section class="section commissions" id="commissions">
  <div class="wrap" style="display:flex;justify-content:space-between;align-items:flex-end;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem">
    <div>
      <span class="eyebrow reveal"><?= e($d['commissions']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= rich($d['commissions']['heading']) ?></h2>
    </div>
    <a class="txtlink reveal" data-d="2" href="<?= e($d['commissions']['linkHref']) ?>"><?= e($d['commissions']['linkLabel']) ?></a>
  </div>
  <div class="hscroll">
    <?php foreach ($d['commissions']['cards'] as $i => $card): ?>
      <a class="card reveal"<?= $i > 0 ? ' data-d="' . (int) $i . '"' : '' ?> href="<?= e($card['href'] ?? $d['commissions']['linkHref']) ?>">
        <div class="card__media"><img class="<?= !empty($card['tone']) ? 'tone-noir' : '' ?>" src="<?= e($card['image']) ?>" alt="<?= e($card['imageAlt']) ?>"></div>
        <div class="card__body">
          <div class="card__occ"><?= e($card['occasion']) ?></div>
          <div class="card__t"><?= rich($card['title']) ?></div>
          <div class="card__cloth"><?= e($card['cloth']) ?></div>
        </div>
      </a>
    <?php endforeach; ?>
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

<!-- Closing CTA -->
<section class="section cta-band">
  <div class="cta-band__bg"><img src="<?= e($d['cta']['image']) ?>" alt=""></div>
  <div class="wrap center">
    <span class="eyebrow center reveal"><?= e($d['cta']['eyebrow']) ?></span>
    <h2 class="display reveal mt-s" data-d="1" style="font-size:clamp(2.4rem,6vw,5rem)"><?= rich($d['cta']['heading']) ?></h2>
    <p class="muted reveal mt-m" data-d="2" style="max-width:44ch;margin-inline:auto"><?= e($d['cta']['sub']) ?></p>
    <div class="reveal mt-l" data-d="3"><a class="btn btn--solid" href="<?= e($d['cta']['buttonHref']) ?>"><span><?= e($d['cta']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
