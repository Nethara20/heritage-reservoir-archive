<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' — ' : '' ?>Heritage Reservoir Archive</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
  <a class="logo" href="index.php">HERITAGE<span>·</span>ARCHIVE</a>
  <nav>
    <a href="index.php">Reservoirs</a>
    <?php if (isLoggedIn()): ?>
      <a href="add.php">Add Reservoir</a>
      <a href="logout.php">Logout (<?= e($_SESSION['username'] ?? '') ?>)</a>
    <?php else: ?>
      <a href="login.php">Login</a>
    <?php endif; ?>
  </nav>
</header>

<main class="wrap">
