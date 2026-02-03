<?php
require_once 'helpers.php';
require_login($site_url);

$id = $_GET['id'] ?? 0;
$pdo->prepare("DELETE FROM home_sliders WHERE id=?")->execute([$id]);

flash_set('success', 'Slider deleted');
header("Location: home-master.php");
exit;
