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
          <h2 class="mb-0">Contact</h2>
          <p>Have questions about our programs?.</p>
        </div>
      </div>
    </div>
  </div>


  <div class="custom-breadcrumns border-bottom">
    <div class="container">
      <a href="index.html">Home</a>
      <span class="mx-3 icon-keyboard_arrow_right"></span>
      <span class="current">Contact</span>
    </div>
  </div>


  <div class="site-section">
    <div class="container">
      <div class="row">

        <!-- LEFT COLUMN : CONTACT INFO -->
        <div class="col-lg-4 mb-5">

          <h4 class="mb-3">General</h4>
          <p>
            For any general inquiries about our school, feel free to contact our main office:
            <br>
            <a href="mailto:info@gopalkrishnaschool.com">info@gopalkrishnaschool.com</a>
          </p>

          <hr>

          <h4 class="mb-3">Parents</h4>
          <p>
            For admissions or parent-related queries, contact:
            <br>
            <a href="mailto:admissions@gopalkrishnaschool.com">
              admissions@gopalkrishnaschool.com
            </a>
          </p>

          <hr>

          <h4 class="mb-3">Vendor</h4>
          <p>
            For partnership or vendor proposals:
            <br>
            <a href="mailto:collab@gopalkrishnaschool.com">
              collab@gopalkrishnaschool.com
            </a>
          </p>

        </div>

        <!-- RIGHT COLUMN : FORM -->
        <div class="col-lg-8">

          <h2 class="mb-4">Have questions about our programs?</h2>
          <p class="mb-5">
            Fill out the form below, and our admissions team will get back to you promptly.
          </p>

          <form action="#" method="post">

            <div class="form-group">
              <label>Parent's Name *</label>
              <input type="text" class="form-control form-control-lg" required>
            </div>

            <div class="form-group">
              <label>Email *</label>
              <input type="email" class="form-control form-control-lg" required>
            </div>

            <div class="form-group">
              <label>I have a question about</label>
              <div>
                <label class="mr-3">
                  <input type="radio" name="program"> Pre-Primary
                </label>
                <label class="mr-3">
                  <input type="radio" name="program"> Primary
                </label>
                <label>
                  <input type="radio" name="program"> High School
                </label>
              </div>
            </div>

            <div class="form-group">
              <label>Questions or message *</label>
              <textarea class="form-control" rows="6" required></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg px-5">
                Submit Inquiry
              </button>
            </div>

          </form>

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