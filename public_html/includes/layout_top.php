<?php
declare(strict_types=1);
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/rich.php';

/**
 * Expects these variables set by the including page before require():
 *   $page_title, $page_description, $active (e.g. 'atelier.php'),
 *   $theme ('dark'|'light', optional), $nav_solid (bool, optional)
 */
$theme = $theme ?? 'dark';
$nav_solid = $nav_solid ?? false;
$site = load_json('site');

$body_class = $theme === 'light' ? 'theme-light' : '';
$nav_class = $nav_solid ? 'nav solid' : 'nav';
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_description) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/noir.css">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' fill='%230E0D0B'/%3E%3Ctext x='16' y='23' font-family='Georgia,serif' font-size='20' fill='%23C9A96A' text-anchor='middle'%3EN%3C/text%3E%3C/svg%3E">
</head>
<body class="<?= e($body_class) ?>">
<!-- Page-transition curtain -->
<div class="curtain" aria-hidden="true">
  <div class="curtain__in">
    <img class="curtain__fig" src="assets/img/silhouette-tailor.png" alt="">
    <span class="curtain__mark"><?= e($site['brand'] ?? 'NOIR') ?></span>
  </div>
</div>

<nav class="<?= e($nav_class) ?>" aria-label="Primary">
  <a class="nav__brand" href="index.php"><b><?= e(mb_substr($site['brand'] ?? 'NOIR', 0, 1)) ?></b><?= e(mb_substr($site['brand'] ?? 'NOIR', 1)) ?></a>
  <button class="nav__toggle" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
  <div class="nav__links">
    <?php foreach (($site['nav'] ?? []) as $item): ?>
      <a href="<?= e($item['href']) ?>"<?= (($active ?? '') === $item['href']) ? ' class="active"' : '' ?>><?= e($item['label']) ?></a>
    <?php endforeach; ?>
    <a class="btn nav__cta" href="<?= e($site['cta']['href'] ?? 'appointment.php') ?>"><span><?= e($site['cta']['label'] ?? 'Request an Appointment') ?></span></a>
  </div>
</nav>
