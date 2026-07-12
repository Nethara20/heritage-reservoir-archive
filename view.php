<?php
require 'config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM reservoirs WHERE id = ?');
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    header('Location: index.php');
    exit;
}

$pageTitle = $r['name'];
require 'includes/header.php';
?>

<a class="btn" href="index.php" style="margin-bottom:24px; display:inline-flex;">← Back to Archive</a>

<div class="detail-block">
  <span class="page-sub"><?= e($r['era']) ?></span>
  <h1 class="page-title"><?= e($r['name']) ?><?= $r['sinhala_name'] ? ' · ' . e($r['sinhala_name']) : '' ?></h1>

  <div class="detail-meta">
    <span><span class="k">Region:</span> <?= e($r['region']) ?></span>
    <span><span class="k">Builder:</span> <?= e($r['builder']) ?></span>
  </div>

  <p class="desc"><?= nl2br(e($r['description'])) ?></p>

  <?php if (isLoggedIn()): ?>
    <div class="action-row">
      <a class="btn" href="edit.php?id=<?= (int)$r['id'] ?>">Edit</a>
      <form method="post" action="delete.php" onsubmit="return confirm('Delete this reservoir permanently?');">
        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
        <button class="btn btn-danger" type="submit">Delete</button>
      </form>
    </div>
  <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>
