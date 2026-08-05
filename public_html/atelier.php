<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('atelier');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = 'atelier.php';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="phead wrap">
  <span class="eyebrow reveal"><?= e($d['header']['eyebrow']) ?></span>
  <h1 class="h-xl phead__title reveal" data-d="1"><?= rich($d['header']['title']) ?></h1>
  <p class="phead__sub reveal" data-d="2"><?= e($d['header']['sub']) ?></p>
</section>

<!-- Founder -->
<section class="section">
  <div class="wrap split split--wideL">
    <div class="split__media split__media--tall reveal">
      <img src="<?= e($d['founder']['image']) ?>" alt="<?= e($d['founder']['imageAlt']) ?>">
      <span class="figtag"><?= e($d['founder']['figtag']) ?></span>
    </div>
    <div>
      <span class="eyebrow reveal"><?= e($d['founder']['eyebrow']) ?></span>
      <h2 class="h-lg reveal mt-s" data-d="1"><?= e($d['founder']['heading']) ?></h2>
      <?php foreach ($d['founder']['body'] as $p): ?>
        <p class="muted reveal mt-m" data-d="2"><?= e($p) ?></p>
      <?php endforeach; ?>
      <p class="lead reveal mt-l" data-d="3" style="font-size:1.4rem">&ldquo;<?= e($d['founder']['pullQuote']) ?>&rdquo;</p>
    </div>
  </div>
</section>

<hr class="rule">

<!-- House codes -->
<section class="section">
  <div class="wrap">
    <div class="center" style="margin-bottom:clamp(2.5rem,6vh,4rem)">
      <span class="eyebrow center reveal"><?= e($d['codes']['eyebrow']) ?></span>
      <h2 class="h-xl reveal mt-s" data-d="1"><?= e($d['codes']['heading']) ?></h2>
    </div>
    <div class="codes">
      <?php foreach ($d['codes']['items'] as $i => $c): $dd = $i % 3; ?>
        <div class="code reveal"<?= $dd > 0 ? ' data-d="' . (int) $dd . '"' : '' ?>>
          <div class="code__no"><?= e($c['number']) ?></div>
          <div class="code__t"><?= e($c['title']) ?></div>
          <p class="code__d"><?= e($c['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- The space -->
<section class="section band">
  <div class="wrap">
    <span class="eyebrow center reveal" style="display:flex;justify-content:center"><?= e($d['space']['eyebrow']) ?></span>
    <h2 class="h-xl center reveal mt-s" data-d="1" style="margin-bottom:clamp(2.5rem,6vh,4rem)"><?= e($d['space']['heading']) ?></h2>
    <div class="ritual">
      <?php foreach ($d['space']['items'] as $i => $s): ?>
        <div class="act reveal"<?= $i > 0 ? ' data-d="' . (int) $i . '"' : '' ?>>
          <div class="act__media" style="aspect-ratio:3/4"><img src="<?= e($s['image']) ?>" alt="<?= e($s['imageAlt']) ?>"></div>
          <div class="act__t" style="font-size:1.3rem"><?= e($s['title']) ?></div>
          <p class="act__d"><?= e($s['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section cta-band">
  <div class="cta-band__bg"><img src="<?= e($d['cta']['image']) ?>" alt=""></div>
  <div class="wrap center">
    <h2 class="display reveal" style="font-size:clamp(2.2rem,5.5vw,4.4rem)"><?= rich($d['cta']['heading']) ?></h2>
    <div class="reveal mt-l" data-d="1"><a class="btn btn--solid" href="<?= e($d['cta']['buttonHref']) ?>"><span><?= e($d['cta']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
