<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$course_id = $_GET['course_id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM course_curriculum WHERE course_id=? ORDER BY sort_order ASC");
$stmt->execute([$course_id]);
$rows = $stmt->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <h5>Course Curriculum</h5>
        <a href="course-curriculum-action.php?course_id=<?= $course_id ?>" class="btn btn-primary">
            Add Curriculum
        </a>
    </div>

    <table class="table table-bordered mt-3 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Order</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $r): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><?= $r['sort_order'] ?></td>
                    <td>
                        <?= $r['is_active']
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-secondary">Inactive</span>' ?>
                    </td>
                    <td>
                        <a href="course-curriculum-action.php?id=<?= $r['id'] ?>&course_id=<?= $course_id ?>"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$rows): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">No curriculum added</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="courses.php" class="btn btn-secondary mt-3">Back to Courses</a>
</div>

<?php require_once 'include/footer.php'; ?>