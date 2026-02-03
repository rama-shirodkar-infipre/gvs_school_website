<?php
require_once __DIR__.'/include/header.php';

$service_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("
        INSERT INTO service_features (service_id,feature_text,display_order)
        VALUES (?,?,?)
    ")->execute([
        $service_id,
        $_POST['feature_text'],
        $_POST['display_order']
    ]);
}

$features = $pdo->prepare("
    SELECT * FROM service_features
    WHERE service_id=?
    ORDER BY display_order ASC
");
$features->execute([$service_id]);
require_once __DIR__.'/include/navbar.php';
?>

<div class="content">
    <h5>Service Features</h5>

    <form method="post" class="row g-2 mb-4">
        <div class="col-md-8">
            <input type="text" name="feature_text" class="form-control" placeholder="Feature text" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="display_order" class="form-control" placeholder="Order">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Add</button>
        </div>
    </form>

    <ul class="list-group">
        <?php foreach ($features as $f): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= htmlspecialchars($f['feature_text']) ?>
                <a href="service-feature-delete.php?id=<?= $f['id'] ?>&serviceId=<?= $service_id ?>" class="text-danger">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once __DIR__.'/include/footer.php'; ?>
