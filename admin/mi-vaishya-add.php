<?php
require_once 'include/header.php';

if ($_POST) {

    $pdf = upload_file($_FILES['pdf_file'], 'mi-vaishya');

    $pdo->prepare("
        INSERT INTO mi_vaishya_pdfs
        (title, pdf_file, quarter, year, is_active)
        VALUES (?,?,?,?,?)
    ")->execute([
        $_POST['title'],
        $pdf,
        $_POST['quarter'],
        $_POST['year'],
        $_POST['is_active']
    ]);

    header("Location: mi-vaishya.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <h5>Add Mi Vaishya PDF</h5>

    <form method="post" enctype="multipart/form-data" class="card p-4">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Quarter</label>
                <select name="quarter" class="form-select">
                    <option>Q1</option>
                    <option>Q2</option>
                    <option>Q3</option>
                    <option>Q4</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" value="<?= date('Y') ?>" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">PDF File</label>
            <input type="file" name="pdf_file" accept="application/pdf" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="mt-3">

            <button class="btn btn-primary">Save</button>
            <a href="mi-vaishya.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>