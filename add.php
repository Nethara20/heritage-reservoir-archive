<?php
require 'config.php';
requireLogin();

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
            'INSERT INTO reservoirs (name, sinhala_name, region, era, builder, description)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $sinhala_name, $region, $era, $builder, $description]);
        header('Location: view.php?id=' . $pdo->lastInsertId());
        exit;
    }
}

$pageTitle = 'Add Reservoir';
require 'includes/header.php';
?>

<h1 class="page-title">Add a Reservoir</h1>
<span class="page-sub">Add a new entry to the archive</span>

<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

<form class="stack" method="post" action="add.php">
  <div>
    <label for="name">Name *</label>
    <input type="text" id="name" name="name" required value="<?= e($_POST['name'] ?? '') ?>">
  </div>
  <div>
    <label for="sinhala_name">Sinhala Name</label>
    <input type="text" id="sinhala_name" name="sinhala_name" value="<?= e($_POST['sinhala_name'] ?? '') ?>">
  </div>
  <div>
    <label for="region">Region</label>
    <input type="text" id="region" name="region" value="<?= e($_POST['region'] ?? '') ?>">
  </div>
  <div>
    <label for="era">Era</label>
    <input type="text" id="era" name="era" placeholder="e.g. 5th century CE" value="<?= e($_POST['era'] ?? '') ?>">
  </div>
  <div>
    <label for="builder">Builder</label>
    <input type="text" id="builder" name="builder" value="<?= e($_POST['builder'] ?? '') ?>">
  </div>
  <div>
    <label for="description">Description</label>
    <textarea id="description" name="description"><?= e($_POST['description'] ?? '') ?></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Save Reservoir</button>
</form>

<?php require 'includes/footer.php'; ?>
