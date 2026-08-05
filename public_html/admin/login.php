<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/content.php';
require_once __DIR__ . '/../includes/rich.php';
require_once __DIR__ . '/../includes/auth.php';
noir_session_start();

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$users = load_users();
$isSetup = count($users) === 0;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $error = 'Your session expired. Please try again.';
    } elseif ($isSetup) {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $confirm = (string) ($_POST['confirm'] ?? '');
        if ($username === '' || strlen($password) < 8) {
            $error = 'Choose a username and a password of at least 8 characters.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            save_users([$username => ['passwordHash' => password_hash($password, PASSWORD_DEFAULT)]]);
            session_regenerate_id(true);
            $_SESSION['admin_user'] = $username;
            header('Location: index.php');
            exit;
        }
    } else {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $ok = isset($users[$username]) && password_verify($password, $users[$username]['passwordHash']);
        if ($ok) {
            session_regenerate_id(true);
            $_SESSION['admin_user'] = $username;
            header('Location: index.php');
            exit;
        }
        usleep(300000); // small delay against brute-force guessing
        $error = 'Incorrect username or password.';
    }
}

$page_title = 'Sign in — NOIR Admin';
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?></title>
<link rel="stylesheet" href="assets/admin.css">
</head>
<body class="admin-auth">
  <main class="auth-card">
    <div class="auth-brand">NOIR <span>Admin</span></div>
    <?php if ($isSetup): ?>
      <h1>Create the admin account</h1>
      <p class="auth-sub">No admin account exists yet. Set one up now — this is the only time you'll see this screen.</p>
    <?php else: ?>
      <h1>Sign in</h1>
    <?php endif; ?>

    <?php if ($error !== ''): ?><p class="auth-error"><?= e($error) ?></p><?php endif; ?>

    <form method="post" novalidate>
      <?= csrf_field() ?>
      <div class="f">
        <label>Username</label>
        <input type="text" name="username" autocomplete="username" required autofocus>
      </div>
      <div class="f">
        <label>Password</label>
        <input type="password" name="password" autocomplete="<?= $isSetup ? 'new-password' : 'current-password' ?>" required>
      </div>
      <?php if ($isSetup): ?>
        <div class="f">
          <label>Confirm Password</label>
          <input type="password" name="confirm" autocomplete="new-password" required>
        </div>
      <?php endif; ?>
      <button type="submit" class="btn-primary"><?= $isSetup ? 'Create Account &amp; Sign In' : 'Sign In' ?></button>
    </form>
  </main>
</body>
</html>
