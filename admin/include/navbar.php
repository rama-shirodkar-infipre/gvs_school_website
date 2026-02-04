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
            <a href="trustees.php"
                class="<?= isActive(['trustees.php', 'trustee-add.php', 'trustee-edit.php']) ?>">
                <i class="bi bi-people-fill"></i>
                <span>Trustees</span>
            </a>
        </li>

        <!-- Team -->
        <li>
            <a href="team.php"
                class="<?= isActive(['team.php', 'team-add.php', 'team-edit.php']) ?>">
                <i class="bi bi-people"></i>
                <span>Team</span>
            </a>
        </li>

        <!-- Services -->
        <li>
            <a href="services.php"
                class="<?= isActive(['services.php', 'service-add.php', 'service-edit.php', 'service-feature.php']) ?>">
                <i class="bi bi-briefcase-fill"></i>
                <span>Services</span>
            </a>
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

        <!-- Blogs -->
        <li>
            <a href="blogs.php"
                class="<?= isActive(['blogs.php', 'blog-add.php', 'blog-edit.php']) ?>">
                <i class="bi bi-journal-text"></i>
                <span>Blogs</span>
            </a>
        </li>

        <!-- Programs & Activities -->
        <li>
            <a href="programs-activities.php"
                class="<?= isActive([
                            'programs-activities.php',
                            'program-add.php',
                            'program-edit.php'
                        ]) ?>">
                <i class="bi bi-calendar2-event-fill"></i>
                <span>Programs & Activities</span>
            </a>
        </li>

        <!-- Mi Vaishya -->
        <li>
            <a href="mi-vaishya.php"
                class="<?= isActive(['mi-vaishya.php', 'mi-vaishya-edit.php']) ?>">
                <i class="bi bi-heart-fill"></i>
                <span>Mi Vaishya</span>
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