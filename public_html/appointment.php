<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/rich.php';

$d = load_json('appointment');
$page_title = $d['seo']['title'] ?? 'NOIR';
$page_description = $d['seo']['description'] ?? '';
$active = 'appointment.php';
$nav_solid = true;
require __DIR__ . '/includes/layout_top.php';
?>

<main class="apply">
  <aside class="apply__aside">
    <img src="<?= e($d['aside']['image']) ?>" alt="<?= e($d['aside']['imageAlt']) ?>">
    <div class="apply__aside-in">
      <span class="eyebrow"><?= e($d['aside']['eyebrow']) ?></span>
      <p class="lead mt-s" style="max-width:22ch"><?= e($d['aside']['lead']) ?></p>
    </div>
  </aside>

  <section class="apply__form">
    <form class="form" novalidate>
      <div class="form__body">
        <span class="eyebrow reveal"><?= e($d['form']['eyebrow']) ?></span>
        <h1 class="h-xl reveal mt-s" data-d="1"><?= rich($d['form']['title']) ?></h1>
        <p class="reassure reveal" data-d="2"><?= e($d['form']['reassurance']) ?></p>

        <div class="field reveal">
          <label for="name">Your Name</label>
          <input id="name" name="name" type="text" autocomplete="name" required>
        </div>

        <div class="field2">
          <div class="field reveal">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required>
          </div>
          <div class="field reveal">
            <label for="phone">Preferred Contact / Phone</label>
            <input id="phone" name="phone" type="tel" autocomplete="tel">
          </div>
        </div>

        <div class="field2">
          <div class="field reveal">
            <label for="occasion">The Occasion</label>
            <select id="occasion" name="occasion" required>
              <option value="" selected disabled>Select an occasion</option>
              <?php foreach ($d['form']['occasions'] as $o): ?>
                <option><?= e($o) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field reveal">
            <label for="date">Preferred Date</label>
            <input id="date" name="date" type="date">
          </div>
        </div>

        <div class="field reveal">
          <label for="story">Tell Us About the Occasion</label>
          <textarea id="story" name="story" placeholder="A few words on what you have in mind…"></textarea>
        </div>

        <button class="btn btn--solid reveal" type="submit" style="margin-top:.6rem"><span><?= e($d['form']['submitLabel']) ?></span></button>
        <p class="meta reveal" style="margin-top:1.6rem"><?= e($d['form']['disclaimer']) ?></p>
      </div>

      <div class="confirm">
        <span class="quote__mark" style="font-size:3rem">&#10003;</span>
        <h2 class="h-lg" style="margin-top:1rem"><?= e($d['confirm']['heading']) ?></h2>
        <p class="muted mt-m" style="max-width:40ch"><?= e($d['confirm']['body']) ?></p>
        <a class="txtlink mt-l" href="index.php" style="display:inline-block"><?= e($d['confirm']['linkLabel']) ?></a>
      </div>
    </form>
  </section>
</main>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
