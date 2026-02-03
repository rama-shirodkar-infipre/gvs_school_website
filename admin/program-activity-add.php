<?php
require_once 'include/header.php';

if ($_POST) {

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image = upload_image($_FILES['image'], 'programs');
    }

    $pdo->prepare("
        INSERT INTO programs_activities
        (title, short_description, description, program_date,to_date, image, is_active)
        VALUES (?,?,?,?,?,?,?)
    ")->execute([
        $_POST['title'],
        $_POST['short_description'],
        $_POST['description'],
        $_POST['program_date'],
        $_POST['to_date'],
        $image,
        $_POST['is_active']
    ]);

    header("Location: programs-activities.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5 class="mb-3">Add Program / Activity</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" id="editor"></textarea>
        </div>

        <div class="mb-3">
            <label>Program Date (From)</label>
            <input type="date" name="program_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Program Date (To)</label>
            <input type="date" name="to_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Save</button>
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