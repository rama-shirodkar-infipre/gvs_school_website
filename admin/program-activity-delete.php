<?php
require_once 'helpers.php';

$id = $_GET['id'];

$pdo->prepare("DELETE FROM programs_activities WHERE id=?")
    ->execute([$id]);

header("Location: programs-activities.php");
exit;
