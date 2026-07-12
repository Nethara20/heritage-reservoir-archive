<?php
require 'config.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $pdo->prepare('DELETE FROM reservoirs WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
