<?php
require_once __DIR__ . '/include/header.php';
require_once __DIR__ . '/include/navbar.php';

$sliders = $pdo->query("SELECT * FROM home_sliders ORDER BY display_order, id DESC")->fetchAll();
$testimonials = $pdo->query("SELECT * FROM testimonials ORDER BY display_order, id DESC")->fetchAll();
$faqs = $pdo->query("SELECT * FROM faqs ORDER BY display_order, id DESC")->fetchAll();
?>

<div class="content">
    <div class="topbar mb-3">
        <h5>Home Page Master</h5>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <!-- ================= SLIDER ================= -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Home Slider</strong>
            <a href="slider-add.php" class="btn btn-sm btn-primary">Add Slide</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($sliders as $i => $s): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><img src="<?= $site_url.'uploads/'. $s['image'] ?>" height="50"></td>
                        <td><?= htmlspecialchars($s['title']) ?></td>
                        <td><?= $s['is_active'] ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <a href="slider-edit.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="slider-delete.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- ================= TESTIMONIAL ================= -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Testimonials</strong>
            <a href="testimonial-add.php" class="btn btn-sm btn-primary">Add Testimonial</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($testimonials as $i => $t): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($t['name']) ?></td>
                        <td><?= substr(strip_tags($t['message']), 0, 60) ?>...</td>
                        <td><?= $t['is_active'] ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <a href="testimonial-edit.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="testimonial-delete.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- ================= FAQ ================= -->
    <!-- <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>FAQs</strong>
            <a href="faq-add.php" class="btn btn-sm btn-primary">Add FAQ</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($faqs as $i => $f): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($f['question']) ?></td>
                        <td><?= $f['is_active'] ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <a href="faq-edit.php?id=<?= $f['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="faq-delete.php?id=<?= $f['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div> -->

</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>