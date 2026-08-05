<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('process');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = 'process.php';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="phead wrap">
  <span class="eyebrow reveal"><?= e($d['header']['eyebrow']) ?></span>
  <h1 class="h-xl phead__title reveal" data-d="1"><?= rich($d['header']['title']) ?></h1>
  <p class="phead__sub reveal" data-d="2"><?= e($d['header']['sub']) ?></p>
</section>

<section class="section">
  <div class="wrap acts">
    <?php foreach ($d['acts'] as $act): ?>
      <article class="pact reveal">
        <div class="pact__media"><img src="<?= e($act['image']) ?>" alt="<?= e($act['imageAlt']) ?>"></div>
        <div>
          <div class="pact__no"><?= e($act['number']) ?></div>
          <h2 class="h-lg pact__t"><?= e($act['title']) ?></h2>
          <p class="pact__d muted"><?= e($act['desc']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="section cta-band">
  <div class="cta-band__bg"><img src="<?= e($d['cta']['image']) ?>" alt=""></div>
  <div class="wrap center">
    <span class="eyebrow center reveal"><?= e($d['cta']['eyebrow']) ?></span>
    <h2 class="display reveal mt-s" style="font-size:clamp(2.2rem,5.5vw,4.4rem)"><?= rich($d['cta']['heading']) ?></h2>
    <div class="reveal mt-l" data-d="1"><a class="btn btn--solid" href="<?= e($d['cta']['buttonHref']) ?>"><span><?= e($d['cta']['buttonLabel']) ?></span></a></div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
