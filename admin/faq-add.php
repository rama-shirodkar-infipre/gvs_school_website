<?php
require_once __DIR__ . '/include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $pdo->prepare("
        INSERT INTO faqs (question, answer, display_order, is_active)
        VALUES (?,?,?,?)
    ")->execute([
        $_POST['question'],
        $_POST['answer'],
        $_POST['display_order'],
        $_POST['is_active']
    ]);

    flash_set('success', 'FAQ added');
    header("Location: home-master.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <h5>Add FAQ</h5>

    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Question -->
        <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text"
                name="question"
                class="form-control"
                placeholder="Enter question"
                required>
        </div>

        <!-- Answer -->
        <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea name="answer"
                class="form-control"
                rows="4"
                placeholder="Enter answer"></textarea>
        </div>

        <div class="row">
            <!-- Display Order -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    class="form-control"
                    value="0">
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-3">
            <button class="btn btn-success px-4">
                <i class="bi bi-save"></i> Save
            </button>
            <a href="home-master.php" class="btn btn-secondary ms-2">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>