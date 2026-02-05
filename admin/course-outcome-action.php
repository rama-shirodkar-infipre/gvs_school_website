<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$id = $_GET['id'] ?? null;
$course_id = $_GET['course_id'];
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM course_outcomes WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_POST) {
    if ($id) {
        $pdo->prepare("
      UPDATE course_outcomes SET
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
      INSERT INTO course_outcomes
      (course_id,icon,title,description,is_active)
      VALUES (?,?,?,?,?)
    ")->execute([
            $course_id,
            $_POST['icon'],
            $_POST['title'],
            $_POST['description'],
            $_POST['is_active']
        ]);
    }
    header("Location: course-outcomes.php?course_id=$course_id");
    exit;
}
?>

<div class="content">
    <form method="post" class="card p-4">
        <h5><?= $id ? 'Edit' : 'Add' ?> Outcome</h5>

        <label>Icon Class</label>
        <input name="icon" class="form-control mb-2" value="<?= $data['icon'] ?? '' ?>">

        <label>Title</label>
        <input name="title" class="form-control mb-2" value="<?= $data['title'] ?? '' ?>">

        <label>Description</label>
        <textarea name="description" class="form-control mb-2"><?= $data['description'] ?? '' ?></textarea>

        <label>Status</label>
        <select name="is_active" class="form-control mb-3">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <div class="mb-1">
            <button class="btn btn-primary">Save</button>
            <a href="course-outcomes.php?course_id=<?= $course_id ?>" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>