<?php
require_once 'helpers.php';
require_login($site_url);

$id = $_GET['id'] ?? 0;
$pdo->prepare("DELETE FROM team WHERE id=?")->execute([$id]);

flash_set('success','Team member deleted');
header("Location: team.php");
exit;
