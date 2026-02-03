<?php
require_once __DIR__ . '/include/header.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM team WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die('Team member not found');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) {
        die('Invalid CSRF');
    }

    // Keep old photo if new not uploaded
    $photo = $data['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $photo = upload_image($_FILES['photo'], 'team');
    }

    $pdo->prepare("
        UPDATE team SET
            name = ?,
            designation = ?,
            photo = ?,
            linkedin = ?,
            twitter = ?,
            instagram = ?,
            display_order = ?,
            is_active = ?
        WHERE id = ?
    ")->execute([
        $_POST['name'],
        $_POST['designation'],
        $photo,
        $_POST['linkedin'],
        $_POST['twitter'],
        $_POST['instagram'],
        $_POST['display_order'],
        $_POST['is_active'],
        $id
    ]);

    flash_set('success', 'Team member updated successfully');
    header("Location: team.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Edit Team Member</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($data['name']) ?>"
                required>
        </div>

        <!-- Designation -->
        <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text"
                name="designation"
                class="form-control"
                value="<?= htmlspecialchars($data['designation']) ?>">
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label class="form-label">Photo</label><br>

            <?php if (!empty($data['photo'])): ?>
                <img src="<?= $site_url.'uploads/' . $data['photo'] ?>"
                    alt="Team Photo"
                    height="90"
                    class="mb-2 rounded border">
                <br>
            <?php endif; ?>

            <input type="file" name="photo" class="form-control">
        </div>

        <!-- Social Links -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">LinkedIn</label>
                <input type="text"
                    name="linkedin"
                    class="form-control"
                    value="<?= htmlspecialchars($data['linkedin']) ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Twitter</label>
                <input type="text"
                    name="twitter"
                    class="form-control"
                    value="<?= htmlspecialchars($data['twitter']) ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Instagram</label>
                <input type="text"
                    name="instagram"
                    class="form-control"
                    value="<?= htmlspecialchars($data['instagram']) ?>">
            </div>
        </div>

        <!-- Display Order & Status -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                    name="display_order"
                    class="form-control"
                    value="<?= (int)$data['display_order'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" <?= $data['is_active'] ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= !$data['is_active'] ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mb-3">
            <button class="btn btn-primary">Update</button>
            <a href="team.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>