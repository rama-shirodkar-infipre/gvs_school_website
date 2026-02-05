<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$id = $_GET['id'] ?? null;
$course_id = $_GET['course_id'] ?? 0;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM course_methodology WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($id) {
        $pdo->prepare("
            UPDATE course_methodology SET
            icon=?, title=?, description=?, is_active=?
            WHERE id=?
        ")->execute([
            $_POST['icon'],
            $_POST['title'],
            $_POST['description'],
            $_POST['is_active'],
            $id
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO course_methodology
            (course_id, icon, title, description, is_active)
            VALUES (?,?,?,?,?)
        ")->execute([
            $course_id,
            $_POST['icon'],
            $_POST['title'],
            $_POST['description'],
            $_POST['is_active']
        ]);
    }

    header("Location: course-methodology.php?course_id=$course_id");
    exit;
}
?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <h5><?= $id ? 'Edit' : 'Add' ?> Methodology</h5>

        <label class="mt-2">Icon Class</label>
        <input name="icon" class="form-control mb-3"
            placeholder="e.g. icon-extension"
            value="<?= htmlspecialchars($data['icon'] ?? '') ?>">

        <label>Title</label>
        <input name="title" class="form-control mb-3"
            value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control mb-3" rows="4"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>

        <label>Status</label>
        <select name="is_active" class="form-control mb-4">
            <option value="1" <?= ($data['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= ($data['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Inactive</option>
        </select>

        <div class="mb-1">
            <a href="course-methodology.php?course_id=<?= $course_id ?>" class="btn btn-secondary ms-2">
                Back
            </a>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>