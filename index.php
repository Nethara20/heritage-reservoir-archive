<?php
require 'config.php';

$q = trim($_GET['q'] ?? '');

if ($q !== '') {
    $stmt = $pdo->prepare(
        'SELECT * FROM reservoirs
         WHERE name LIKE :q OR region LIKE :q OR builder LIKE :q OR era LIKE :q
         ORDER BY name ASC'
    );
    $stmt->execute(['q' => '%' . $q . '%']);
} else {
    $stmt = $pdo->query('SELECT * FROM reservoirs ORDER BY name ASC');
}
$reservoirs = $stmt->fetchAll();

$pageTitle = 'Reservoirs';
require 'includes/header.php';
?>

<h1 class="page-title">Heritage Reservoir Archive</h1>
<span class="page-sub">Ele. 067 — A catalog of Sri Lanka's ancient tank engineering</span>

<form class="search-bar" method="get" action="index.php">
  <input type="text" name="q" placeholder="Search by name, region, era, or builder…" value="<?= e($q) ?>">
  <button class="btn btn-primary" type="submit">Search</button>
  <?php if ($q !== ''): ?>
    <a class="btn" href="index.php">Clear</a>
  <?php endif; ?>
</form>

<?php if (empty($reservoirs)): ?>
  <p class="empty-state">No reservoirs found<?= $q !== '' ? ' for "' . e($q) . '"' : '' ?>.</p>
<?php else: ?>
  <div class="card-grid">
    <?php foreach ($reservoirs as $r): ?>
      <div class="res-card">
        <span class="era"><?= e($r['era']) ?></span>
        <h3><?= e($r['name']) ?></h3>
        <span class="region"><?= e($r['region']) ?></span>
        <p><?= e(mb_strimwidth($r['description'] ?? '', 0, 120, '…')) ?></p>
        <a class="view-link" href="view.php?id=<?= (int)$r['id'] ?>">View Details →</a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
