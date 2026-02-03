<?php
require_once 'helpers.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT category_id FROM gallery_items WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch();

$pdo->prepare("DELETE FROM gallery_items WHERE id=?")->execute([$id]);

header("Location: gallery-items.php?cat=".$row['category_id']);
exit;
