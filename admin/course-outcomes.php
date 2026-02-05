<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$course_id = $_GET['course_id'];
$rows = $pdo->prepare("SELECT * FROM course_outcomes WHERE course_id=?");
$rows->execute([$course_id]);
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Learning Outcomes</h5>
        <a href="course-outcome-action.php?course_id=<?= $course_id ?>" class="btn btn-primary">Add Outcome</a>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Icon</th>
            <th>Title</th>
            <th>Status</th>
            <th width="120">Action</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= $r['icon'] ?></td>
                <td><?= $r['title'] ?></td>
                <td><?= $r['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="course-outcome-action.php?id=<?= $r['id'] ?>&course_id=<?= $course_id ?>" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="courses.php" class="btn btn-secondary mt-3">Back to Courses</a>
</div>

<?php require_once 'include/footer.php'; ?>