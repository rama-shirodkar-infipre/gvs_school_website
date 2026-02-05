<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $img = $data['image'] ?? null;
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'courses');
    }

    if ($id) {
        $pdo->prepare("
            UPDATE courses SET
            title=?, slug=?, banner_title=?, banner_subtitle=?,
            short_description=?, image=?, is_active=?
            WHERE id=?
        ")->execute([
            $_POST['title'],
            $_POST['slug'],
            $_POST['banner_title'],
            $_POST['banner_subtitle'],
            $_POST['short_description'],
            $img,
            $_POST['is_active'],
            $id
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO courses
            (title,slug,banner_title,banner_subtitle,short_description,image,is_active)
            VALUES (?,?,?,?,?,?,?)
        ")->execute([
            $_POST['title'],
            $_POST['slug'],
            $_POST['banner_title'],
            $_POST['banner_subtitle'],
            $_POST['short_description'],
            $img,
            $_POST['is_active']
        ]);
    }

    header("Location: courses.php");
    exit;
}
?>

<div class="content">
    <form method="post" enctype="multipart/form-data" class="card p-4">
        <h5><?= $id ? 'Edit' : 'Add' ?> Course</h5>

        <label>Course Title</label>
        <input name="title" class="form-control mb-2" value="<?= $data['title'] ?? '' ?>" required>

        <label>Slug (pre-primary)</label>
        <input name="slug" class="form-control mb-2" value="<?= $data['slug'] ?? '' ?>" required>

        <label>Banner Title</label>
        <input name="banner_title" class="form-control mb-2" value="<?= $data['banner_title'] ?? '' ?>">

        <label>Banner Subtitle</label>
        <textarea name="banner_subtitle" class="form-control mb-2"><?= $data['banner_subtitle'] ?? '' ?></textarea>

        <label>Short Description</label>
        <textarea name="short_description" class="form-control mb-2"><?= $data['short_description'] ?? '' ?></textarea>

        <label>Image</label>
        <input type="file" name="image" class="form-control mb-2">

        <?php if (!empty($data['image'])): ?>
            <img src="<?= $site_url ?>uploads/<?= $data['image'] ?>" height="80">
        <?php endif; ?>

        <label>Status</label>
        <select name="is_active" class="form-control mb-3">
            <option value="1" <?= ($data['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= ($data['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Inactive</option>
        </select>

        <div class="mb-1">
            <button class="btn btn-primary">Save</button>
            <a href="courses.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>