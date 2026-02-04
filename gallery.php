<?php
include 'include/config.php';
include 'include/header.php';
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
            <a href="index.html">Home</a>
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
                        <button data-filter=".annual">Annual Day</button>
                        <button data-filter=".sports">Science Fair</button>
                        <button data-filter=".classroom">Cultural Fest</button>
                        <button data-filter=".festival">Annual Art Exhibition</button>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="row gallery-grid">

                <!-- Annual Day -->
                <div class="col-lg-4 col-md-6 mb-4 gallery-item annual">
                    <a href="images/gallery/annual1.jpg" data-fancybox="gallery">
                        <img src="images/gallery/annual1.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Day</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item annual">
                    <a href="images/gallery/annual2.jpg" data-fancybox="gallery">
                        <img src="images/gallery/annual2.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Day</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item annual">
                    <a href="images/gallery/annual3.jpg" data-fancybox="gallery">
                        <img src="images/gallery/annual3.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Day</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item annual">
                    <a href="images/gallery/annual4.jpg" data-fancybox="gallery">
                        <img src="images/gallery/annual4.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Day</span></div>
                    </a>
                </div>

                <!-- Science Fair -->
                <div class="col-lg-4 col-md-6 mb-4 gallery-item sports">
                    <a href="images/gallery/science1.jpg" data-fancybox="gallery">
                        <img src="images/gallery/science1.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Science Fair</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item sports">
                    <a href="images/gallery/science3.jpg" data-fancybox="gallery">
                        <img src="images/gallery/science3.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Science Fair</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item sports">
                    <a href="images/gallery/science4.jpg" data-fancybox="gallery">
                        <img src="images/gallery/science4.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Science Fair</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item sports">
                    <a href="images/gallery/science2.jpg" data-fancybox="gallery">
                        <img src="images/gallery/science2.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Science Fair</span></div>
                    </a>
                </div>

                <!-- Cultural Fest -->
                <div class="col-lg-4 col-md-6 mb-4 gallery-item classroom">
                    <a href="images/gallery/cultural1.jpg" data-fancybox="gallery">
                        <img src="images/gallery/cultural1.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Cultural Fest</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item classroom">
                    <a href="images/gallery/cultural3.jpg" data-fancybox="gallery">
                        <img src="images/gallery/cultural3.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Cultural Fest</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item classroom">
                    <a href="images/gallery/cultural4.jpg" data-fancybox="gallery">
                        <img src="images/gallery/cultural4.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Cultural Fest</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item classroom">
                    <a href="images/gallery/cultural2.jpg" data-fancybox="gallery">
                        <img src="images/gallery/cultural2.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Cultural Fest</span></div>
                    </a>
                </div>

                <!-- Annual Art Exhibition -->
                <div class="col-lg-4 col-md-6 mb-4 gallery-item festival">
                    <a href="images/gallery/2.jpg" data-fancybox="gallery">
                        <img src="images/gallery/art2.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Art Exhibition</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item festival">
                    <a href="images/gallery/art3.jpg" data-fancybox="gallery">
                        <img src="images/gallery/art3.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Art Exhibition</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item festival">
                    <a href="images/gallery/art4.jpg" data-fancybox="gallery">
                        <img src="images/gallery/art4.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Art Exhibition</span></div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery-item festival">
                    <a href="images/gallery/art1.jpg" data-fancybox="gallery">
                        <img src="images/gallery/art1.jpg" class="img-fluid">
                        <div class="gallery-overlay"><span>Annual Art Exhibition</span></div>
                    </a>
                </div>

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
            let filter = $(this).attr('data-filter');

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