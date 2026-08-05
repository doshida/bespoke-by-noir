<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/content.php';
require_once __DIR__ . '/../includes/rich.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/schema.php';
noir_session_start();
require_login();

$schema = noir_schema();
$page_title = 'NOIR Admin — Dashboard';
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?></title>
<link rel="stylesheet" href="assets/admin.css">
</head>
<body class="admin-app">
<?php require __DIR__ . '/_topbar.php'; ?>

<main class="admin-main">
  <h1>What would you like to edit?</h1>
  <div class="collection-grid">
    <?php foreach ($schema as $key => $col): ?>
      <a class="collection-card" href="edit.php?page=<?= e($key) ?>">
        <span class="collection-card__label"><?= e($col['label']) ?></span>
        <span class="collection-card__go">Edit &rarr;</span>
      </a>
    <?php endforeach; ?>
  </div>
  <p class="admin-note">See the live site: <a href="../index.php" target="_blank" rel="noopener">open in a new tab &rarr;</a></p>
</main>
</body>
</html>
