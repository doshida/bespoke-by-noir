<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('commissions');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = 'commissions.php';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="phead wrap">
  <span class="eyebrow reveal"><?= e($d['header']['eyebrow']) ?></span>
  <h1 class="h-xl phead__title reveal" data-d="1"><?= rich($d['header']['title']) ?></h1>
  <p class="phead__sub reveal" data-d="2"><?= e($d['header']['sub']) ?></p>
</section>

<section class="section" style="padding-top:0">
  <div class="wrap">
    <div class="filters reveal" role="group" aria-label="Filter commissions">
      <?php foreach ($d['filters'] as $i => $f): ?>
        <button data-filter="<?= e($f['key']) ?>" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>"><?= e($f['label']) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="gallery reveal" data-d="1">
      <?php foreach ($d['items'] as $it): ?>
        <figure data-occ="<?= e($it['occasionKey']) ?>">
          <img class="<?= !empty($it['tone']) ? 'tone-noir' : '' ?>" src="<?= e($it['image']) ?>" alt="<?= e($it['imageAlt']) ?>">
          <figcaption><div class="g-occ"><?= e($it['occasionLabel']) ?></div><div class="g-t"><?= rich($it['title']) ?></div></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section cta-band" style="padding-top:0">
  <div class="wrap center">
    <span class="eyebrow center reveal"><?= e($d['cta']['eyebrow']) ?></span>
    <h2 class="display reveal mt-s" style="font-size:clamp(2.2rem,5.5vw,4.4rem)"><?= rich($d['cta']['heading']) ?></h2>
    <div class="reveal mt-l" data-d="1"><a class="btn btn--solid" href="<?= e($d['cta']['buttonHref']) ?>"><span><?= e($d['cta']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
