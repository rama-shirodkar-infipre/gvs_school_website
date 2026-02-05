<?php

// define('DB_HOST','localhost');
// define('DB_NAME','gvs_school_cms');
// define('DB_USER','root');
// define('DB_PASS','');

define('DB_HOST','sql108.infinityfree.com');
define('DB_NAME','if0_41069573_gvs_school_db');
define('DB_USER','if0_41069573');
define('DB_PASS','H9QCAYfDxYWHKK');

/* Upload path */
define('UPLOAD_DIR', dirname(__DIR__) . '/uploads/');
define('UPLOAD_URL', '/gvs_school_website/uploads/');

if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

$site_url = 'http://localhost/gvs_school_website/';
$site_url = 'https://gvs-school-website.great-site.net/';
