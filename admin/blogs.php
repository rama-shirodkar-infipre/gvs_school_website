<?php
require_once __DIR__ . '/include/header.php';
require_once __DIR__ . '/include/navbar.php';

$blogs = $pdo->query("SELECT * FROM blogs ORDER BY blog_date DESC")->fetchAll();
?>

<div class="content">
    <div class="topbar d-flex justify-content-between">
        <h5>Blogs</h5>
        <a href="blog-add.php" class="btn btn-primary">Add Blog</a>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $i => $b): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($b['title']) ?></td>
                    <td><?= $b['author'] ?></td>
                    <td><?= date('d M Y', strtotime($b['blog_date'])) ?></td>
                    <td><?= $b['is_active'] ? 'Active' : 'Inactive' ?></td>
                    <td>
                        <a href="blog-edit.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="blog-delete.php?id=<?= $b['id'] ?>"
                            onclick="return confirm('Delete blog?')"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/include/footer.php'; ?>