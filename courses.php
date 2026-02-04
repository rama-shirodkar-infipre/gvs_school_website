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
          <h2 class="mb-0">Courses</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
      </div>
    </div>
  </div>


  <div class="custom-breadcrumns border-bottom">
    <div class="container">
      <a href="index.html">Home</a>
      <span class="mx-3 icon-keyboard_arrow_right"></span>
      <span class="current">Courses</span>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 mb-5">
          <div class="academic-card">
            <img src="images/pre-primary.jpg" alt="Pre Primary" class="img-fluid">

            <div class="academic-card-body">
              <h3>Pre-Primary School</h3>
              <p>
                Our Pre-Primary program focuses on nurturing curiosity and building
                foundational skills through play-based learning in a joyful environment.
              </p>

              <a href="pre-primary.php" class="academic-link">
                Discover Pre-Primary →
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-5">
          <div class="academic-card featured">
            <img src="images/primary.jpg" alt="Primary School" class="img-fluid">

            <div class="academic-card-body">
              <h3>Primary School</h3>
              <p>
                We build a strong academic foundation in core subjects, blending
                curriculum with engaging activities for holistic growth.
              </p>

              <a href="primary.php" class="academic-link">
                Explore Primary Curriculum →
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-5">
          <div class="academic-card">
            <img src="images/high-school.jpg" alt="High School" class="img-fluid">

            <div class="academic-card-body">
              <h3>High School</h3>
              <p>
                Our High School program focuses on academic excellence, career
                preparation, and success in board examinations.
              </p>

              <a href="high-school.php" class="academic-link">
                Learn About High School →
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5 justify-content-center text-center">
        <div class="col-lg-4 mb-5">
          <h2 class="section-title-underline mb-5">
            <span>Why Choose Gopal Krishna School?</span>
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

          <div class="feature-1 border">
            <div class="icon-wrapper bg-primary">
              <span class="flaticon-mortarboard text-white"></span>
            </div>
            <div class="feature-1-content">
              <h2>Character Development</h2>
              <p>We instill strong values like integrity, respect, and empathy, preparing students to be responsible
                and compassionate citizens.</p>
              <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="feature-1 border">
            <div class="icon-wrapper bg-primary">
              <span class="flaticon-school-material text-white"></span>
            </div>
            <div class="feature-1-content">
              <h2>Academic Excellence</h2>
              <p>Our rigorous curriculum and dedicated faculty empower students to achieve their full academic
                potential and succeed in their chosen paths</p>
              <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="feature-1 border">
            <div class="icon-wrapper bg-primary">
              <span class="flaticon-library text-white"></span>
            </div>
            <div class="feature-1-content">
              <h2>Holistic Well-being</h2>
              <p>Our supportive environment fosters emotional intelligence and resilience for a balanced and joyful
                school experience.</p>
              <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section cta-academic">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">

          <h2 class="cta-title">
            Ready to Join Our Academic Community?
          </h2>

          <p class="cta-text">
            Discover the difference a strong foundation can make. Our admissions team
            is ready to guide you through the next steps.
          </p>

          <a href="admissions.html" class="btn btn-primary cta-btn">
            Begin Admission Process
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