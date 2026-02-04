<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM admission_steps WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    if ($id) {
        $pdo->prepare("
            UPDATE admission_steps SET step_no=?, title=?, description=?, is_active=?
            WHERE id=?
        ")->execute([
            $_POST['step_no'],
            $_POST['title'],
            $_POST['description'],
            isset($_POST['is_active']) ? 1 : 0,
            $id
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO admission_steps (step_no,title,description)
            VALUES (?,?,?)
        ")->execute([
            $_POST['step_no'],
            $_POST['title'],
            $_POST['description']
        ]);
    }

    flash_set('success', 'Saved');
    header("Location: admission-steps.php");
    exit;
}

require_once 'include/navbar.php';
?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Step Number</label>
        <input name="step_no" class="form-control mb-2" value="<?= $data['step_no'] ?? '' ?>">

        <label>Title</label>
        <input name="title" class="form-control mb-2" value="<?= $data['title'] ?? '' ?>">

        <label>Description</label>
        <textarea name="description" id="editor" class="form-control"><?= $data['description'] ?? '' ?></textarea>

        <?php if ($id): ?>
            <div class="form-check mt-2">
                <input type="checkbox" name="is_active" class="form-check-input"
                    <?= $data['is_active'] ? 'checked' : '' ?>>
                <label class="form-check-label">Active</label>
            </div>
        <?php endif; ?>

        <div class="mb-1">
            <a href="admission-steps.php" class="btn btn-secondary mt-3">Back</a>
            <button class="btn btn-primary mt-3">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>

<script>
    CKEDITOR.replace('editor', {
        height: 200
    });
</script>