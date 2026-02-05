<?php
include 'include/config.php';
include 'admin/helpers.php';
include 'include/header.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $stmt = $pdo->prepare("
        INSERT INTO contact_enquiries 
        (name, email, service, message, is_read, created_at)
        VALUES (?,?,?,?,0,NOW())
    ");

  $stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['service'],
    $_POST['message']
  ]);

  $success = true;
}
?>

<div class="site-wrap">
  <?php include 'include/navbar.php'; ?>

  <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
    style="background-image:
     linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
     url('images/bg_1.jpg')">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-lg-7">
          <h2 class="mb-0">Contact</h2>
          <p>Have questions about our programs?</p>
        </div>
      </div>
    </div>
  </div>

  <div class="custom-breadcrumns border-bottom">
    <div class="container">
      <a href="index.php">Home</a>
      <span class="mx-3 icon-keyboard_arrow_right"></span>
      <span class="current">Contact</span>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">

        <!-- LEFT : CONTACT INFO -->
        <div class="col-lg-4 mb-5">

          <h4 class="mb-3">General</h4>
          <p>
            <a href="mailto:info@gopalkrishnaschool.com">
              info@gopalkrishnaschool.com
            </a>
          </p>

          <hr>

          <h4 class="mb-3">Admissions</h4>
          <p>
            <a href="mailto:admissions@gopalkrishnaschool.com">
              admissions@gopalkrishnaschool.com
            </a>
          </p>

          <hr>

          <h4 class="mb-3">Vendors</h4>
          <p>
            <a href="mailto:collab@gopalkrishnaschool.com">
              collab@gopalkrishnaschool.com
            </a>
          </p>

        </div>

        <!-- RIGHT : FORM -->
        <div class="col-lg-8">

          <h2 class="mb-4">Have questions about our programs?</h2>
          <p class="mb-4">Fill out the form below and we’ll get back to you.</p>

          <?php if ($success): ?>
            <div class="alert alert-success">
              Thank you! Your enquiry has been submitted successfully.
            </div>
          <?php endif; ?>

          <form method="post">

            <div class="form-group mb-3">
              <label>Parent's Name *</label>
              <input type="text" name="name"
                class="form-control form-control-lg" required>
            </div>

            <div class="form-group mb-3">
              <label>Email *</label>
              <input type="email" name="email"
                class="form-control form-control-lg" required>
            </div>

            <div class="form-group mb-3">
              <label>I have a question about *</label>
              <div>
                <label class="me-3">
                  <input type="radio" name="service"
                    value="Pre-Primary" required> Pre-Primary
                </label>

                <label class="me-3">
                  <input type="radio" name="service"
                    value="Primary"> Primary
                </label>

                <label>
                  <input type="radio" name="service"
                    value="High School"> High School
                </label>
              </div>
            </div>

            <div class="form-group mb-4">
              <label>Questions / Message *</label>
              <textarea name="message"
                class="form-control"
                rows="6" required></textarea>
            </div>

            <button type="submit"
              class="btn btn-primary btn-lg px-5">
              Submit Inquiry
            </button>

          </form>

        </div>
      </div>
    </div>
  </div>

  <?php include 'include/footer.php'; ?>
</div>
<?php include 'include/footerScript.php'; ?>