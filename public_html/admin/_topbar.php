<nav class="admin-topbar">
  <a class="admin-topbar__brand" href="index.php">NOIR <span>Admin</span></a>
  <div class="admin-topbar__right">
    <span class="admin-topbar__user">Signed in as <?= e($_SESSION['admin_user'] ?? '') ?></span>
    <a class="admin-topbar__logout" href="logout.php">Sign out</a>
  </div>
</nav>
