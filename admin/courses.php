<?php require_once 'include/header.php';
require_once 'include/navbar.php'; ?>
<?php $rows = $pdo->query("SELECT * FROM courses")->fetchAll(); ?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Courses</h5>
        <a href="course-action.php" class="btn btn-primary">Add Course</a>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php if ($r['image']): ?><img src="<?= $site_url ?>uploads/<?= $r['image'] ?>" height="50"><?php endif; ?></td>
                <td><?= $r['title'] ?></td>
                <td><?= $r['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="course-action.php?id=<?= $r['id'] ?>" class="btn btn-sm m-1 btn-warning">Edit</a>
                    <a href="course-outcomes.php?course_id=<?= $r['id'] ?>" class="btn btn-sm m-1 btn-success">Add Key Learning Outcomes</a>
                    <a href="course-curriculum.php?course_id=<?= $r['id'] ?>" class="btn btn-sm m-1 btn-info">Add Curriculum & Subjects</a>
                    <a href="course-methodology.php?course_id=<?= $r['id'] ?>" class="btn btn-sm m-1 btn-secondary">Add Our Teaching Methodology</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'include/footer.php'; ?>