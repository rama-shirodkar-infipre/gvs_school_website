<?php
require_once 'helpers.php';

$id = $_GET['id'];
$serviceId = $_GET['serviceId'];

$pdo->prepare("DELETE FROM service_features WHERE id=?")
    ->execute([$id]);

header("Location: service-feature.php?id=".$serviceId);
exit;
