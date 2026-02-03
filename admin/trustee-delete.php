<?php
require_once 'helpers.php';
require_login($site_url);

$id = $_GET['id'] ?? 0;

$pdo->prepare("DELETE FROM trustees WHERE id=?")->execute([$id]);

flash_set('success', 'Trustee deleted');
header("Location: trustees.php");
exit;
