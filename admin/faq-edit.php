<?php
require_once __DIR__ . '/include/header.php';


$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM faqs WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
if (!$data) die('FAQ not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $pdo->prepare("
        UPDATE faqs SET
            question = ?,
            answer = ?,
            display_order = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['question'],
        $_POST['answer'],
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'FAQ updated successfully');
    header("Location: home-master.php");
    exit;
}

require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar mb-3">
        <h5>Edit FAQ</h5>
    </div>

    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Question -->
        <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text"
                name="question"
                class="form-control"
                value="<?= htmlspecialchars($data['question']) ?>"
                required>
        </div>

        <!-- Answer -->
        <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea name="answer"
                class="form-control"
                rows="4"><?= htmlspecialchars($data['answer']) ?></textarea>
        </div>

        <div class="row">
            <!-- Display Order -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    value="<?= $data['display_order'] ?>"
                    class="form-control">
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" <?= $data['is_active'] ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= !$data['is_active'] ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-4">
            <button class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="home-master.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>