<?php
require_once 'include/header.php';

$data = $pdo->query("SELECT * FROM admission_intro LIMIT 1")->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    if ($data) {
        $pdo->prepare("
            UPDATE admission_intro SET heading=?, subheading=?, description=?
        ")->execute([
            $_POST['heading'],
            $_POST['subheading'],
            $_POST['description']
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO admission_intro (heading,subheading,description)
            VALUES (?,?,?)
        ")->execute([
            $_POST['heading'],
            $_POST['subheading'],
            $_POST['description']
        ]);
    }

    flash_set('success', 'Updated successfully');
    header("Location: admission-intro.php");
    exit;
}

require_once 'include/navbar.php';
?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Heading</label>
        <input name="heading" class="form-control mb-2" value="<?= $data['heading'] ?? '' ?>">

        <label>Subheading</label>
        <input name="subheading" class="form-control mb-2" value="<?= $data['subheading'] ?? '' ?>">

        <label>Description</label>
        <textarea name="description" id="editor" class="form-control"><?= $data['description'] ?? '' ?></textarea>

        <div class="mb-1">
            <a href="admission-intro.php" class="btn btn-secondary mt-3">Back</a>
            <button class="btn btn-primary mt-3">Save</button>
        </div>
    </form>
</div>


<?php require_once 'include/footer.php'; ?>

<script>
    CKEDITOR.replace('editor', {
        height: 250
    });
</script>