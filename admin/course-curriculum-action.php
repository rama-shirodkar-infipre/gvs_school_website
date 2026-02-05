<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$id = $_GET['id'] ?? null;
$course_id = $_GET['course_id'] ?? 0;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM course_curriculum WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($id) {
        $pdo->prepare("
            UPDATE course_curriculum SET
            title=?, content=?, sort_order=?, is_active=?
            WHERE id=?
        ")->execute([
            $_POST['title'],
            $_POST['content'],
            $_POST['sort_order'],
            $_POST['is_active'],
            $id
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO course_curriculum
            (course_id, title, content, sort_order, is_active)
            VALUES (?,?,?,?,?)
        ")->execute([
            $course_id,
            $_POST['title'],
            $_POST['content'],
            $_POST['sort_order'],
            $_POST['is_active']
        ]);
    }

    header("Location: course-curriculum.php?course_id=$course_id");
    exit;
}
?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <h5><?= $id ? 'Edit' : 'Add' ?> Curriculum</h5>

        <label class="mt-2">Title</label>
        <input name="title" class="form-control mb-3"
            value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>

        <label>Curriculum Content</label>
        <textarea name="content" id="curriculum_editor" class="form-control mb-3">
            <?= $data['content'] ?? '' ?>
        </textarea>

        <label>Sort Order</label>
        <input type="number" name="sort_order" class="form-control mb-3"
            value="<?= $data['sort_order'] ?? 1 ?>">

        <label>Status</label>
        <select name="is_active" class="form-control mb-4">
            <option value="1" <?= ($data['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= ($data['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Inactive</option>
        </select>

        <div class="mb-1">
            <a href="course-curriculum.php?course_id=<?= $course_id ?>" class="btn btn-secondary ms-2">
                Back
            </a>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>



<?php require_once 'include/footer.php'; ?>

<script>
    CKEDITOR.replace('curriculum_editor', {
        height: 250,
        removeButtons: 'PasteFromWord'
    });
</script>