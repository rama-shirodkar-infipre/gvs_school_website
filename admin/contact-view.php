<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM contact_enquiries WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) die('Enquiry not found');

// Mark as read
$pdo->prepare("UPDATE contact_enquiries SET is_read=1 WHERE id=?")
    ->execute([$id]);
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>View Enquiry</h5>

    <div class="card p-4">
        <p><strong>Name:</strong> <?= htmlspecialchars($data['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
        <p><strong>Service:</strong> <?= htmlspecialchars($data['service']) ?></p>
        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($data['message'])) ?></p>
        <p><strong>IP Address:</strong> <?= $data['ip_address'] ?></p>
        <p><strong>Date:</strong> <?= date('d M Y H:i', strtotime($data['created_at'])) ?></p>

        <a href="contact.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

<?php include 'include/footer.php'; ?>