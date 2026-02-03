<?php
require_once 'include/header.php';

$id = $_GET['id'] ?? 0;

// Fetch record
$stmt = $pdo->prepare("SELECT * FROM mi_vaishya_pdfs WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die('PDF record not found');
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Keep old PDF by default
    $pdf_file = $data['pdf_file'];

    // Replace PDF if uploaded
    if (!empty($_FILES['pdf_file']['name'])) {
        $newPdf = upload_file($_FILES['pdf_file'], 'mi-vaishya');
        if ($newPdf) {
            $pdf_file = $newPdf;
        }
    }

    $pdo->prepare("
        UPDATE mi_vaishya_pdfs SET
            title = ?,
            pdf_file = ?,
            quarter = ?,
            year = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['title'],
        $pdf_file,
        $_POST['quarter'],
        $_POST['year'],
        $_POST['is_active'],
        $id
    ]);

    header("Location: mi-vaishya.php");
    exit;
}
require_once 'include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Edit Mi Vaishya PDF</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($data['title']) ?>"
                required>
        </div>

        <!-- Quarter & Year -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Quarter</label>
                <select name="quarter" class="form-select">
                    <?php foreach (['Q1', 'Q2', 'Q3', 'Q4'] as $q): ?>
                        <option value="<?= $q ?>" <?= $data['quarter'] === $q ? 'selected' : '' ?>>
                            <?= $q ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Year</label>
                <input type="number"
                    name="year"
                    class="form-control"
                    value="<?= (int)$data['year'] ?>"
                    required>
            </div>
        </div>

        <!-- Existing PDF -->
        <div class="mb-3">
            <label class="form-label">Current PDF</label><br>
            <a href="<?= $site_url ?>uploads/<?= $data['pdf_file'] ?>"
                target="_blank"
                class="btn btn-sm btn-outline-primary">
                View PDF
            </a>
        </div>

        <!-- Replace PDF -->
        <div class="mb-3">
            <label class="form-label">Replace PDF (optional)</label>
            <input type="file"
                name="pdf_file"
                accept="application/pdf"
                class="form-control">
            <small class="text-muted">Leave empty to keep existing PDF</small>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="is_active" class="form-select">
                <option value="1" <?= $data['is_active'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$data['is_active'] ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="mt-3">
            <button class="btn btn-primary">Update</button>
            <a href="mi-vaishya.php" class="btn btn-secondary">Back</a>
        </div>

    </form>
</div>

<?php include 'include/footer.php'; ?>