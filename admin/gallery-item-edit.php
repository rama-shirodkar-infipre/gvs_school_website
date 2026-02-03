<?php
require_once 'include/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM gallery_items WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) die('Item not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('CSRF error');

    $img = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'gallery');
    }

    $pdo->prepare("
        UPDATE gallery_items SET
            title=?, subtitle=?, image=?, display_order=?, is_active=?
        WHERE id=?
    ")->execute([
        $_POST['title'],
        $_POST['subtitle'],
        $img,
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    header("Location: gallery-items.php?cat=" . $data['category_id']);
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Edit Gallery Item</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label class="form-label">Title</label>
        <input type="text" name="title"
            value="<?= htmlspecialchars($data['title']) ?>"
            class="form-control mb-3">

        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle"
            value="<?= htmlspecialchars($data['subtitle']) ?>"
            class="form-control mb-3">

        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control mb-2">
        <img src="<?= $site_url.'uploads/' . $data['image'] ?>" height="80" class="mb-3">

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
            <a href="gallery-items.php?cat=<?= $data['category_id'] ?>" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>