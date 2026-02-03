<?php
require_once 'include/header.php';

$id = $_GET['id'];
$data = $pdo->prepare("SELECT * FROM programs_activities WHERE id=?");
$data->execute([$id]);
$row = $data->fetch();

if (!$row) die('Not found');

if ($_POST) {

    $image = $row['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = upload_image($_FILES['image'], 'programs');
    }

    $pdo->prepare("
        UPDATE programs_activities SET
        title=?, short_description=?, description=?,
        program_date=?,to_date=?, image=?, is_active=?
        WHERE id=?
    ")->execute([
        $_POST['title'],
        $_POST['short_description'],
        $_POST['description'],
        $_POST['program_date'],
        $_POST['to_date'],
        $image,
        $_POST['is_active'],
        $id
    ]);

    header("Location: programs-activities.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Edit Program / Activity</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title"
                value="<?= htmlspecialchars($row['title']) ?>"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description"
                class="form-control"><?= $row['short_description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" id="editor"><?= $row['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>Program Date (From)</label>
            <input type="date" name="program_date"
                value="<?= $row['program_date'] ?>"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Program Date (To)</label>
            <input type="date" name="to_date" value="<?= $row['to_date'] ?>" class="form-control" >
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            <?php if ($row['image']): ?>
                <img src="<?= $site_url ?>uploads/<?= $row['image'] ?>" height="80"><br><br>
            <?php endif; ?>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-select">
                <option value="1" <?= $row['is_active'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$row['is_active'] ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Update</button>
            <a href="programs-activities.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<!-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> -->

<?php include 'include/footer.php'; ?>
<script>
    CKEDITOR.replace('editor', {
        height: 300
    });
</script>