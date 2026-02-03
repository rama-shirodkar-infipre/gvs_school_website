<?php
require_once 'helpers.php';
require_login($site_url);

$id = $_GET['id'] ?? 0;

$pdo->prepare("DELETE FROM about_us WHERE id=?")->execute([$id]);

flash_set('success', 'Deleted successfully');
header("Location: aboutus.php");
exit;
