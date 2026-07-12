<?php
require 'config.php';
requireLogin();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM reservoirs WHERE id = ?');
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = trim($_POST['name'] ?? '');
    $sinhala_name = trim($_POST['sinhala_name'] ?? '');
    $region       = trim($_POST['region'] ?? '');
    $era          = trim($_POST['era'] ?? '');
    $builder      = trim($_POST['builder'] ?? '');
    $description  = trim($_POST['description'] ?? '');

    if ($name === '') {
        $error = 'Name is required.';
    } else {
        $stmt = $pdo->prepare(
            'UPDATE reservoirs SET name=?, sinhala_name=?, region=?, era=?, builder=?, description=?
             WHERE id=?'
        );
        $stmt->execute([$name, $sinhala_name, $region, $era, $builder, $description, $id]);
        header('Location: view.php?id=' . $id);
        exit;
    }
    $r = array_merge($r, $_POST);
}

$pageTitle = 'Edit ' . $r['name'];
require 'includes/header.php';
?>

<h1 class="page-title">Edit Reservoir</h1>
<span class="page-sub"><?= e($r['name']) ?></span>

<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

<form class="stack" method="post" action="edit.php?id=<?= (int)$id ?>">
  <input type="hidden" name="id" value="<?= (int)$id ?>">
  <div>
    <label for="name">Name *</label>
    <input type="text" id="name" name="name" required value="<?= e($r['name']) ?>">
  </div>
  <div>
    <label for="sinhala_name">Sinhala Name</label>
    <input type="text" id="sinhala_name" name="sinhala_name" value="<?= e($r['sinhala_name']) ?>">
  </div>
  <div>
    <label for="region">Region</label>
    <input type="text" id="region" name="region" value="<?= e($r['region']) ?>">
  </div>
  <div>
    <label for="era">Era</label>
    <input type="text" id="era" name="era" value="<?= e($r['era']) ?>">
  </div>
  <div>
    <label for="builder">Builder</label>
    <input type="text" id="builder" name="builder" value="<?= e($r['builder']) ?>">
  </div>
  <div>
    <label for="description">Description</label>
    <textarea id="description" name="description"><?= e($r['description']) ?></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Save Changes</button>
</form>

<?php require 'includes/footer.php'; ?>
