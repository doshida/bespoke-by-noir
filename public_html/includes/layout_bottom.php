<?php
declare(strict_types=1);
/** Requires $site to already be in scope from layout_top.php. */
$nav_items = $site['nav'] ?? [];
$footer = $site['footer'] ?? [];
?>
<footer class="footer">
  <div class="wrap">
    <div class="footer__grid">
      <div>
        <div class="footer__brand"><b><?= e(mb_substr($site['brand'] ?? 'NOIR', 0, 1)) ?></b><?= e(mb_substr($site['brand'] ?? 'NOIR', 1)) ?></div>
        <p class="maxw"><?= nl2br(e($footer['blurb'] ?? ''), false) ?></p>
      </div>
      <div>
        <h5><?= e($footer['houseHeading'] ?? 'The House') ?></h5>
        <?php foreach ($nav_items as $i => $item): ?>
          <?= $i > 0 ? '<br>' : '' ?><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
        <?php endforeach; ?>
      </div>
      <div>
        <h5><?= e($footer['commissionHeading'] ?? 'Commission') ?></h5>
        <a href="<?= e($site['cta']['href'] ?? 'appointment.php') ?>"><?= e($site['cta']['label'] ?? 'Request an Appointment') ?></a><br>
        <a href="mailto:<?= e($footer['email'] ?? '') ?>"><?= e($footer['email'] ?? '') ?></a><br>
        <a href="<?= e($footer['instagram'] ?? '#') ?>" aria-label="Instagram">Instagram</a>
      </div>
    </div>
    <div class="footer__bottom">
      <span><?= e($footer['copyright'] ?? '') ?></span>
      <span><a href="#">Privacy</a> &nbsp;&middot;&nbsp; <a href="#">Terms</a></span>
    </div>
  </div>
</footer>

<script src="js/noir.js"></script>
</body>
</html>
