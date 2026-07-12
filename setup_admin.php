<?php
require 'config.php';

$count = (int)$pdo->query('SELECT COUNT(*) AS c FROM users')->fetch()['c'];
$error = '';
$done = false;

if ($count > 0) {
    // Someone already set up an admin account — don't allow another via this page.
    $pageTitle = 'Setup';
    require 'includes/header.php';
    echo '<h1 class="page-title">Setup already complete</h1>';
    echo '<p style="opacity:0.8;">An admin account already exists. Delete this file (setup_admin.php) for security, then <a href="login.php" style="color:var(--gold);">log in here</a>.</p>';
    require 'includes/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3 || strlen($password) < 6) {
        $error = 'Username must be 3+ characters and password 6+ characters.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
        $stmt->execute([$username, $hash]);
        $done = true;
    }
}

$pageTitle = 'Setup';
require 'includes/header.php';
?>

<h1 class="page-title">Create Admin Account</h1>
<span class="page-sub">One-time setup</span>

<?php if ($done): ?>
  <div class="alert">Admin account created. <a href="login.php" style="color:var(--gold);">Log in now</a> — then delete setup_admin.php for security.</div>
<?php else: ?>
  <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
  <form class="stack" method="post" action="setup_admin.php">
    <div>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required autofocus>
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button class="btn btn-primary" type="submit">Create Account</button>
  </form>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
