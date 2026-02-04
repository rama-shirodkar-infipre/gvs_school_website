<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM admission_documents WHERE id=?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    if ($id) {
        $pdo->prepare("UPDATE admission_documents SET document_name=? WHERE id=?")
            ->execute([$_POST['document_name'], $id]);
    } else {
        $pdo->prepare("INSERT INTO admission_documents (document_name) VALUES (?)")
            ->execute([$_POST['document_name']]);
    }

    header("Location: admission-documents.php");
    exit;
}

require_once 'include/navbar.php';
?>

<div class="content">
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <label>Document Name</label>
        <input name="document_name" class="form-control mb-2"
            value="<?= $data['document_name'] ?? '' ?>">

        <div class="mb-1">

            <a href="admission-documents.php" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>