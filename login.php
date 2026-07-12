<?php
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}

$pageTitle = 'Login';
require 'includes/header.php';
?>

<h1 class="page-title">Login</h1>
<span class="page-sub">Manage the archive</span>

<?php if ($error): ?>
  <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<form class="stack" method="post" action="login.php">
  <div>
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required autofocus>
  </div>
  <div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
  </div>
  <button class="btn btn-primary" type="submit">Log In</button>
</form>

<p style="margin-top:20px; font-family:var(--mono); font-size:0.78rem; opacity:0.6;">
  No admin account yet? Run <a href="setup_admin.php" style="color:var(--gold);">setup_admin.php</a> once to create the first one.
</p>

<?php require 'includes/footer.php'; ?>
