<div class="sidebar">

    <!-- Logo Section -->
    <div class="sidebar-header text-center">
        <img src="<?= $site_url ?>images/logo.png" alt="">
        <h6>GVS</h6>
        <span>Admin Panel</span>
    </div>

    <ul class="sidebar-menu">

        <!-- Dashboard -->
        <li>
            <a href="index.php" class="<?= isActive(['index.php']) ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="home-master.php" class="<?= isActive(['home-master.php']) ?>">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- About Us -->
        <li>
            <a href="aboutus.php" class="<?= isActive(['aboutus.php', 'about-add.php', 'aboutus-edit.php']) ?>">
                <i class="bi bi-info-circle"></i>
                <span>About Us</span>
            </a>
        </li>

        <!-- Trustees -->
        <li>
            <a href="why-choose.php"
                class="<?= isActive(['why-choose.php', 'why-choose-edit.php', 'why-choose-add.php']) ?>">
                <i class="bi bi-people-fill"></i>
                <span>Why Choose Us</span>
            </a>
        </li>

        <!-- Team -->
        <li>
            <a href="staff.php"
                class="<?= isActive(['staff.php', 'staff-add.php', 'staff-edit.php']) ?>">
                <i class="bi bi-people"></i>
                <span>Staff</span>
            </a>
        </li>

        <!-- Admissions -->
        <!-- Admissions -->
        <li class="<?= isActive([
                        'admission-intro.php',
                        'admission-intro-edit.php',

                        'admission-steps.php',
                        'admission-step-add.php',
                        'admission-step-edit.php',

                        'admission-levels.php',
                        'admission-level-add.php',
                        'admission-level-edit.php',

                        'admission-documents.php',
                        'admission-document-add.php',
                        'admission-document-edit.php',

                        'admission-highlights.php',
                        'admission-highlight-add.php',
                        'admission-highlight-edit.php'
                    ]) ?>">

            <a data-bs-toggle="collapse"
                href="#admissionMenu"
                role="button"
                aria-expanded="false"
                aria-controls="admissionMenu">
                <i class="bi bi-mortarboard-fill"></i>
                <span>Admissions</span>
                <i class="bi bi-chevron-down float-end"></i>
            </a>

            <ul class="collapse submenu
        <?= isActive([
            'admission-intro.php',
            'admission-intro-edit.php',

            'admission-steps.php',
            'admission-step-add.php',
            'admission-step-edit.php',

            'admission-levels.php',
            'admission-level-add.php',
            'admission-level-edit.php',

            'admission-documents.php',
            'admission-document-add.php',
            'admission-document-edit.php',

            'admission-highlights.php',
            'admission-highlight-add.php',
            'admission-highlight-edit.php'
        ]) ? 'show' : '' ?>"
                id="admissionMenu">

                <li>
                    <a href="admission-intro.php"
                        class="<?= isActive(['admission-intro.php', 'admission-intro-edit.php']) ?>">
                        Admission Intro
                    </a>
                </li>

                <li>
                    <a href="admission-steps.php"
                        class="<?= isActive(['admission-steps.php', 'admission-step-add.php', 'admission-step-edit.php']) ?>">
                        Admission Steps
                    </a>
                </li>

                <li>
                    <a href="admission-levels.php"
                        class="<?= isActive(['admission-levels.php', 'admission-level-add.php', 'admission-level-edit.php']) ?>">
                        Admission Levels
                    </a>
                </li>

                <li>
                    <a href="admission-documents.php"
                        class="<?= isActive(['admission-documents.php', 'admission-document-add.php', 'admission-document-edit.php']) ?>">
                        Required Documents
                    </a>
                </li>

                <li>
                    <a href="admission-highlights.php"
                        class="<?= isActive(['admission-highlights.php', 'admission-highlight-add.php', 'admission-highlight-edit.php']) ?>">
                        Admission Highlights
                    </a>
                </li>

            </ul>
        </li>

        <!-- Courses & Academics -->
        <li class="<?= isActive([
                'courses.php',
                'course-action.php',

                'course-outcomes.php',
                'course-outcome-action.php',

                'course-curriculum.php',
                'course-curriculum-action.php',

                'course-methodology.php',
                'course-methodology-action.php'
                ]) ?>">

            <a data-bs-toggle="collapse"
            href="#coursesMenu"
            role="button"
            aria-expanded="false"
            aria-controls="coursesMenu">
            <i class="bi bi-book-fill"></i>
            <span>Courses</span>
            <i class="bi bi-chevron-down float-end"></i>
            </a>

            <ul class="collapse submenu
        <?= isActive([
            'courses.php',
            'course-action.php',

            'course-outcomes.php',
            'course-outcome-action.php',

            'course-curriculum.php',
            'course-curriculum-action.php',

            'course-methodology.php',
            'course-methodology-action.php'
        ]) ? 'show' : '' ?>"
            id="coursesMenu">

            <li>
                <a href="courses.php"
                class="<?= isActive(['courses.php', 'course-action.php',

            'course-outcomes.php',
            'course-outcome-action.php',

            'course-curriculum.php',
            'course-curriculum-action.php',

            'course-methodology.php',
            'course-methodology-action.php']) ?>">
                Course Master
                </a>
            </li>

            <!-- <li>
                <a href="course-outcomes.php"
                class="<?= isActive(['course-outcomes.php', 'course-outcome-action.php']) ?>">
                Learning Outcomes
                </a>
            </li>

            <li>
                <a href="course-curriculum.php"
                class="<?= isActive(['course-curriculum.php', 'course-curriculum-action.php']) ?>">
                Curriculum
                </a>
            </li>

            <li>
                <a href="course-methodology.php"
                class="<?= isActive(['course-methodology.php', 'course-methodology-action.php']) ?>">
                Teaching Methodology
                </a>
            </li> -->

            </ul>
        </li>


        <!-- Gallery -->
        <li>
            <a href="gallery-categories.php"
                class="<?= isActive([
                            'gallery-categories.php',
                            'gallery-category-add.php',
                            'gallery-category-edit.php',
                            'gallery-items.php',
                            'gallery-item-add.php',
                            'gallery-item-edit.php'
                        ]) ?>">
                <i class="bi bi-images"></i>
                <span>Gallery</span>
            </a>
        </li>

        <!-- Contact -->
        <li>
            <a href="contact.php"
                class="<?= isActive(['contact.php']) ?>">
                <i class="bi bi-envelope-fill"></i>
                <span>Contact</span>
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a href="settings.php"
                class="<?= isActive(['settings.php']) ?>">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>

    <!-- Logout -->
    <div class="sidebar-footer">
        <a href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>
    </div>

</div>