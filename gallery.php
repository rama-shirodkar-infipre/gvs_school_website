<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';

$categories = $pdo->query("
    SELECT * FROM gallery_categories
    WHERE is_active=1
    ORDER BY display_order ASC
")->fetchAll(PDO::FETCH_ASSOC);

$items = $pdo->query("
    SELECT gi.*, gc.id AS cat_id, gc.title AS cat_title
    FROM gallery_items gi
    JOIN gallery_categories gc ON gc.id = gi.category_id
    WHERE gi.is_active=1 AND gc.is_active=1
    ORDER BY gi.display_order ASC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="site-wrap">
    <?php
    include 'include/navbar.php';
    ?>
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image:
     linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
     url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">Gallery</h2>
                    <p>Explore the memorable moments from our School's recent events and celebrations</p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.php">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Gallery</span>
        </div>
    </div>

    <!-- Gallery Page -->
    <div class="site-section bg-light">
        <div class="container">

            <!-- Title -->
            <div class="row mb-4 justify-content-center text-center">
                <div class="col-lg-6">
                    <h2 class="section-title-underline">
                        <span>School Gallery</span>
                    </h2>
                    <p>Moments from academics, celebrations, and activities.</p>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="gallery-filters">
                        <button class="active" data-filter="*">All</button>

                        <?php foreach ($categories as $cat): ?>
                            <button data-filter=".cat<?= $cat['id'] ?>">
                                <?= htmlspecialchars($cat['title']) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="row gallery-grid">

                <?php foreach ($items as $img): ?>
                    <div class="col-lg-4 col-md-6 mb-4 gallery-item cat<?= $img['category_id'] ?>">
                        <a href="<?= $site_url ?>uploads/<?= $img['image'] ?>"
                            data-fancybox="gallery"
                            data-caption="<?= htmlspecialchars($img['title']) ?>">

                            <img src="<?= $site_url ?>uploads/<?= $img['image'] ?>"
                                class="img-fluid">

                            <div class="gallery-overlay">
                                <span><?= htmlspecialchars($img['title']) ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
    <?php
    include 'include/footer.php';
    ?>

</div>
<?php
include 'include/footerScript.php';
?>
<script>
    $(document).ready(function() {
        $('.gallery-filters button').click(function() {

            let filter = $(this).data('filter');

            $('.gallery-filters button').removeClass('active');
            $(this).addClass('active');

            if (filter === '*') {
                $('.gallery-item').show();
            } else {
                $('.gallery-item').hide();
                $(filter).show();
            }
        });
    });
</script>