<?php
require_once 'helpers.php';

$id = $_GET['id'] ?? 0;
$pdo->prepare("DELETE FROM contact_enquiries WHERE id=?")->execute([$id]);

header("Location: contact.php");
exit;
