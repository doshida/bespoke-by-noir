<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/content.php';
require_once __DIR__ . '/../includes/rich.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/upload.php';
require_once __DIR__ . '/../includes/formrender.php';
require_once __DIR__ . '/../includes/save.php';
require_once __DIR__ . '/schema.php';
noir_session_start();
require_login();

$schema = noir_schema();
$page = (string) ($_GET['page'] ?? '');

if (!isset($schema[$page])) {
    header('Location: index.php');
    exit;
}

$collection = $schema[$page];
$error = '';
$saved = isset($_GET['saved']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $error = 'Your session expired. Please reload the page and try again.';
    } else {
        $postData = $_POST['data'] ?? [];
        $filesData = isset($_FILES['data']) ? normalize_files($_FILES)['data'] ?? [] : [];
        try {
            $result = build_save_data($collection['fields'], is_array($postData) ? $postData : [], $filesData);
            if (!save_json($page, $result)) {
                $error = 'Could not save — check the data folder is writable.';
            } else {
                header('Location: edit.php?page=' . urlencode($page) . '&saved=1');
                exit;
            }
        } catch (UploadException $e) {
            $error = $e->getMessage();
        }
    }
}

$data = load_json($page);
$page_title = $collection['label'] . ' — NOIR Admin';
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

<main class="admin-main admin-main--edit">
  <p class="breadcrumb"><a href="index.php">&larr; All sections</a></p>
  <h1><?= e($collection['label']) ?></h1>

  <?php if ($saved): ?><p class="flash flash--ok">Saved. The live site is updated.</p><?php endif; ?>
  <?php if ($error !== ''): ?><p class="flash flash--error"><?= e($error) ?></p><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="edit-form" novalidate>
    <?= csrf_field() ?>
    <?= render_fields($collection['fields'], $data, 'data') ?>
    <div class="edit-form__actions">
      <button type="submit" class="btn-primary">Save</button>
    </div>
  </form>
</main>

<script src="assets/admin.js"></script>
</body>
</html>
