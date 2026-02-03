<?php
// helpers.php
require_once __DIR__ . '/init.php';

function is_logged_in()
{
  return !empty($_SESSION['admin_id']);
}

function require_login($site_url)
{
  if (!is_logged_in()) {
    header('Location: ' . $site_url . 'admin/login.php');
    exit;
  }
}

function csrf_token()
{
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
  }
  return $_SESSION['csrf_token'];
}
function csrf_check($token)
{
  return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function upload_image($file, $subfolder = '')
{
  if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) return null;
  $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
  if (!in_array($file['type'], $allowed)) return null;

  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
  $name = bin2hex(random_bytes(8)) . '.' . $ext;
  $dir = rtrim(UPLOAD_DIR, '/') . ($subfolder ? "/{$subfolder}" : '');
  if (!is_dir($dir)) mkdir($dir, 0755, true);
  $target = $dir . '/' . $name;
  if (move_uploaded_file($file['tmp_name'], $target)) {
    return ($subfolder ? trim($subfolder, '/') . '/' : '') . $name;
  }
  return null;
}

function upload_file($file, $subfolder = '')
{
  if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
    return null;
  }

  // Allowed MIME types
  $allowed = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
  ];

  if (!in_array($file['type'], $allowed)) {
    return null;
  }

  // File extension
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

  // Extra safety: allow only specific extensions
  if (!in_array($ext, ['pdf', 'doc', 'docx'])) {
    return null;
  }

  // Generate safe random file name
  $name = bin2hex(random_bytes(10)) . '.' . $ext;

  // Upload directory
  $dir = rtrim(UPLOAD_DIR, '/') . ($subfolder ? "/{$subfolder}" : '');

  if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
  }

  $target = $dir . '/' . $name;

  if (move_uploaded_file($file['tmp_name'], $target)) {
    return ($subfolder ? trim($subfolder, '/') . '/' : '') . $name;
  }

  return null;
}


function flash_set($k, $v)
{
  $_SESSION['flash'][$k] = $v;
}
function flash_get($k)
{
  $v = $_SESSION['flash'][$k] ?? null;
  unset($_SESSION['flash'][$k]);
  return $v;
}


$currentPage = basename($_SERVER['PHP_SELF']);

function isActive($pages = [])
{
  global $currentPage;
  return in_array($currentPage, $pages) ? 'active' : '';
}
