<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM admission_levels WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = $data['image'] ?? null;
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'admission');
    }

    if ($id) {
        $pdo->prepare("
            UPDATE admission_levels SET title=?, subtitle=?, description=?, image=?, is_active=?
            WHERE id=?
        ")->execute([
            $_POST['title'],
            $_POST['subtitle'],
            $_POST['description'],
            $img,
            isset($_POST['is_active']) ? 1 : 0,
            $id
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO admission_levels (title,subtitle,description,image)
            VALUES (?,?,?,?)
        ")->execute([
            $_POST['title'],
            $_POST['subtitle'],
            $_POST['description'],
            $img
        ]);
    }

    header("Location: admission-levels.php");
    exit;
}

require_once 'include/navbar.php';
?>

<div class="content">
    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Title</label>
        <input name="title" class="form-control mb-2" value="<?= $data['title'] ?? '' ?>">

        <label>Subtitle</label>
        <input name="subtitle" class="form-control mb-2" value="<?= $data['subtitle'] ?? '' ?>">

        <label>Description</label>
        <textarea name="description" class="form-control mb-2"><?= $data['description'] ?? '' ?></textarea>

        <label>Image</label>
        <input type="file" name="image" class="form-control mb-2">

        <?php if (!empty($data['image'])): ?>
            <img src="<?= $site_url ?>uploads/<?= $data['image'] ?>" height="120">
        <?php endif; ?>

        <div class="mb-1">

            <a href="admission-levels.php" class="btn btn-secondary mt-3">Back</a>
            <button class="btn btn-primary mt-3">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>