<?php
require_once 'include/header.php';
require_once 'include/navbar.php';

$data = $pdo->query("SELECT * FROM about_us LIMIT 1")->fetch();

$history = [];
if ($data) {
    $stmt = $pdo->prepare("SELECT * FROM about_history WHERE about_id=?");
    $stmt->execute([$data['id']]);
    $history = $stmt->fetchAll();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'])) die('Invalid CSRF');

    $img = $data['image'] ?? null;
    if (!empty($_FILES['image']['name'])) {
        $img = upload_image($_FILES['image'], 'about');
    }

    $pimg = $data['president_image'] ?? null;
    if (!empty($_FILES['president_image']['name'])) {
        $pimg = upload_image($_FILES['president_image'], 'about');
    }

    $pdo->prepare("DELETE FROM about_history WHERE about_id=?")
        ->execute([$data['id']]);

    if (!empty($_POST['history'])) {
        $stmt = $pdo->prepare("
        INSERT INTO about_history (about_id, description)
        VALUES (?,?)
    ");
        foreach ($_POST['history'] as $desc) {
            if (trim($desc) !== '') {
                $stmt->execute([$data['id'], $desc]);
            }
        }
    }

    if ($data) {
        $pdo->prepare("
            UPDATE about_us SET
            subheading=?, title=?, description=?, vision=?, mission=?,
            president_name=?, president_designation=?, president_message=?, president_quote=?,
            image=?, president_image=?
        ")->execute([
            $_POST['subheading'],
            $_POST['title'],
            $_POST['description'],
            $_POST['vision'],
            $_POST['mission'],
            $_POST['president_name'],
            $_POST['president_designation'],
            $_POST['president_message'],
            $_POST['president_quote'],
            $img,
            $pimg
        ]);
    } else {
        $pdo->prepare("
            INSERT INTO about_us
            (subheading,title,description,vision,mission,
             president_name,president_designation,president_message,president_quote,
             image,president_image)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)
        ")->execute([
            $_POST['subheading'],
            $_POST['title'],
            $_POST['description'],
            $_POST['vision'],
            $_POST['mission'],
            $_POST['president_name'],
            $_POST['president_designation'],
            $_POST['president_message'],
            $_POST['president_quote'],
            $img,
            $pimg
        ]);
    }

    flash_set('success', 'Updated successfully');
    header("Location: aboutus.php");
    exit;
}

?>

<div class="content">
    <form method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

        <h6>About Section</h6>
        <div class="">
            <label>Subheading</label>
            <input name="subheading" class="form-control mb-2" value="<?= $data['subheading'] ?? '' ?>" placeholder="Subheading">
        </div>
        <div class="">
            <label>Title</label>
            <input name="title" class="form-control mb-2" value="<?= $data['title'] ?? '' ?>" placeholder="Title">
        </div>
        <div class="">
            <label>Description</label>
            <textarea name="description" id="about_editor" class="form-control">
                <?= $data['description'] ?? '' ?>
            </textarea>
        </div>
        <div class="">
            <label>Vision</label>
            <textarea name="vision" class="form-control mb-2" placeholder="Vision"><?= $data['vision'] ?? '' ?></textarea>
        </div>
        <div class="">
            <label>Mission</label>
            <textarea name="mission" class="form-control mb-3" placeholder="Mission"><?= $data['mission'] ?? '' ?></textarea>
        </div>
        <label>About Image</label>
        <input type="file" name="image" class="form-control mb-2">

        <?php if (!empty($data['image'])): ?>
            <div class="mb-3">
                <small class="text-muted">Current Image</small><br>
                <img src="<?= $site_url ?>uploads/<?= $data['image'] ?>"
                    class="img-thumbnail mt-2"
                    style="max-height:150px;">
            </div>
        <?php endif; ?>

        <hr>
        <h6>Saunstha & School History</h6>
        <p class="text-muted mb-2">
            Add one or more history paragraphs. These will appear on the About page.
        </p>

        <div id="history-wrapper">
            <?php if ($history): ?>
                <?php foreach ($history as $index => $h): ?>
                    <div class="history-item card mb-3 border">
                        <div class="card-body">
                            <label class="form-label fw-semibold">
                                History Paragraph <?= $index + 1 ?>
                            </label>
                            <textarea name="history[]" class="form-control mb-2" rows="3"
                                placeholder="Enter history content..."><?= htmlspecialchars($h['description']) ?></textarea>

                            <button type="button" class="btn btn-outline-danger btn-sm remove-history">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button type="button" class="btn btn-outline-primary" id="add-history">
            <i class="bi bi-plus-circle"></i> Add History Paragraph
        </button>
        <hr>
        <h6>President & Head of School</h6>

        <div class="mb-2">
            <label class="form-label">President Name</label>
            <input name="president_name" class="form-control"
                placeholder="Enter name"
                value="<?= $data['president_name'] ?? '' ?>">
        </div>

        <div class="mb-2">
            <label class="form-label">Designation</label>
            <input name="president_designation" class="form-control"
                placeholder="Enter designation"
                value="<?= $data['president_designation'] ?? '' ?>">
        </div>

        <div class="mb-2">
            <label class="form-label">Message</label>
            <textarea name="president_message" class="form-control"
                rows="4"
                placeholder="President’s message"><?= $data['president_message'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Quote (optional)</label>
            <input name="president_quote" class="form-control"
                placeholder="Short inspirational quote"
                value="<?= $data['president_quote'] ?? '' ?>">
        </div>

        <label class="form-label">President Image</label>
        <input type="file" name="president_image" class="form-control mb-2">


        <?php if (!empty($data['president_image'])): ?>
            <div class="mb-3">
                <small class="text-muted">Current President Image</small><br>
                <img src="<?= $site_url ?>uploads/<?= $data['president_image'] ?>"
                    class="img-thumbnail mt-2"
                    style="max-height:150px;">
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <a href="aboutus.php" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<?php require_once 'include/footer.php'; ?>
<script>
    CKEDITOR.replace('about_editor', {
        height: 300,
        removeButtons: 'PasteFromWord',
        filebrowserUploadMethod: 'form'
    });

    let historyCount = document.querySelectorAll('.history-item').length;

    document.getElementById('add-history').addEventListener('click', function() {
        historyCount++;

        const wrapper = document.getElementById('history-wrapper');
        const div = document.createElement('div');
        div.className = 'history-item card mb-3 border';

        div.innerHTML = `
        <div class="card-body">
            <label class="form-label fw-semibold">
                History Paragraph ${historyCount}
            </label>
            <textarea name="history[]" class="form-control mb-2" rows="3"
                placeholder="Enter history content..."></textarea>
            <button type="button" class="btn btn-outline-danger btn-sm remove-history">
                <i class="bi bi-trash"></i> Remove
            </button>
        </div>
    `;
        wrapper.appendChild(div);
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-history')) {
            e.target.closest('.history-item').remove();
        }
    });
</script>