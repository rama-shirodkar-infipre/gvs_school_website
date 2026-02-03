<?php
require_once __DIR__ . '/include/header.php';

// Fetch settings (single row)
$stmt = $pdo->query("SELECT * FROM settings WHERE id=1");
$settings = $stmt->fetch();

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) {
        die('Invalid CSRF token');
    }

    // Keep old logo
    $logo = $settings['logo'];

    if (!empty($_FILES['logo']['name'])) {
        $newLogo = upload_image($_FILES['logo'], 'settings');
        if ($newLogo) {
            $logo = $newLogo;
        }
    }

    $pdo->prepare("
        UPDATE settings SET
            site_name = ?,
            site_email = ?,
            site_phone = ?,
            site_address = ?,
            logo = ?,
            facebook = ?,
            instagram = ?,
            twitter = ?,
            linkedin = ?
        WHERE id = 1
    ")->execute([
        $_POST['site_name'],
        $_POST['site_email'],
        $_POST['site_phone'],
        $_POST['site_address'],
        $logo,
        $_POST['facebook'],
        $_POST['instagram'],
        $_POST['twitter'],
        $_POST['linkedin']
    ]);

    flash_set('success', 'Settings updated successfully');
    header("Location: settings.php");
    exit;
}
require_once __DIR__ . '/include/navbar.php';
?>

<div class="content">
    <div class="topbar">
        <h5>Website Settings</h5>
    </div>

    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <!-- Site Info -->
        <h6 class="mb-3">Basic Information</h6>

        <div class="mb-3">
            <label class="form-label">Site Name</label>
            <input type="text"
                name="site_name"
                class="form-control"
                value="<?= $settings['site_name']?htmlspecialchars($settings['site_name']):'' ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Site Email</label>
                <input type="email"
                    name="site_email"
                    class="form-control"
                    value="<?= $settings['site_email']?htmlspecialchars($settings['site_email']):'' ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text"
                    name="site_phone"
                    class="form-control"
                    value="<?= $settings['site_phone']?htmlspecialchars($settings['site_phone']):'' ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="site_address"
                class="form-control"
                rows="3"><?= $settings['site_address']?htmlspecialchars($settings['site_address']):'' ?></textarea>
        </div>

        <!-- Logo -->
        <h6 class="mt-4 mb-3">Branding</h6>

        <div class="mb-3">
            <label class="form-label">Site Logo</label><br>

            <?php if (!empty($settings['logo'])): ?>
                <img src="<?= $site_url.'uploads/' . $settings['logo'] ?>"
                    height="80"
                    class="mb-2 border rounded">
                <br>
            <?php endif; ?>

            <input type="file" name="logo" class="form-control">
        </div>

        <!-- Social Links -->
        <h6 class="mt-4 mb-3">Social Media</h6>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Facebook</label>
                <input type="text"
                    name="facebook"
                    class="form-control"
                    value="<?= $settings['facebook']?htmlspecialchars($settings['facebook']):'' ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Instagram</label>
                <input type="text"
                    name="instagram"
                    class="form-control"
                    value="<?= $settings['instagram']?htmlspecialchars($settings['instagram']):'' ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Twitter</label>
                <input type="text"
                    name="twitter"
                    class="form-control"
                    value="<?= $settings['twitter']?htmlspecialchars($settings['twitter']):'' ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">LinkedIn</label>
                <input type="text"
                    name="linkedin"
                    class="form-control"
                    value="<?= $settings['linkedin']?htmlspecialchars($settings['linkedin']):'' ?>">
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-4">
            <button class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>