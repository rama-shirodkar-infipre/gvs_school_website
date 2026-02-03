<?php
require_once 'helpers.php';

$id = $_GET['id'];
$pdo->prepare("DELETE FROM mi_vaishya_pdfs WHERE id=?")->execute([$id]);

header("Location: mi-vaishya.php");
exit;
