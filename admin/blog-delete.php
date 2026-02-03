<?php
require_once 'helpers.php';

$id = $_GET['id'] ?? 0;
$pdo->prepare("DELETE FROM blogs WHERE id=?")->execute([$id]);

header("Location: blogs.php");
exit;
