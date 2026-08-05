<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
noir_session_start();
$_SESSION = [];
session_destroy();
header('Location: login.php');
