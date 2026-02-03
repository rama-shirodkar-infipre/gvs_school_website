<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM gallery_categories WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) die('Category not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('CSRF error');

    $pdo->prepare("
        UPDATE gallery_categories SET
            title=?, display_order=?, is_active=?
        WHERE id=?
    ")->execute([
        $_POST['title'],
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    header("Location: gallery-categories.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Edit Gallery Category</h5>

    <form method="post" class="card p-4">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Category Title</label>
        <input type="text" name="title"
            value="<?= htmlspecialchars($data['title']) ?>"
            class="form-control mb-3" required>

        <label class="form-label">Display Order</label>
        <input type="number" name="display_order"
            value="<?= $data['display_order'] ?>"
            class="form-control mb-3">

        <label class="form-label">Status</label>
        <select name="is_active" class="form-select mb-3">
            <option value="1" <?= $data['is_active'] ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= !$data['is_active'] ? 'selected' : '' ?>>Inactive</option>
        </select>
        <div class="mb-3">
            <button class="btn btn-primary">Update</button>
            <a href="gallery-categories.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>