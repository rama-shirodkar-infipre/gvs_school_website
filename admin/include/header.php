<?php
require_once __DIR__ . '/../helpers.php';
require_login($site_url);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel | GVS School</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= $site_url ?>images/logo.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #51be78;
            --primary-dark: #2f9e5f;
            --primary-soft: #7fe0a6;
            --primary-accent: #1f7f4a;
        }

        body {
            background: #f1f5f9;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
        }

        /* Stat cards */
        .stat-card {
            border-radius: 14px;
            text-align: center;
            padding: 22px;
            box-shadow: 0 12px 30px rgba(81, 190, 120, 0.35);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
        }

        /* Primary gradients */
        .bg-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .bg-primary-soft {
            background: linear-gradient(135deg, var(--primary-soft), var(--primary));
        }

        .bg-primary-dark {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-accent));
        }

        .bg-primary-accent {
            background: linear-gradient(135deg, var(--primary), #166534);
        }

        /* Quick cards hover */
        .hover-scale {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 14px 35px rgba(81, 190, 120, 0.25);
        }

        /* Icon theme color */
        .text-theme {
            color: var(--primary) !important;
        }

        .admin-wrap {
            min-height: 100vh;
            display: flex;
        }

        .content {
            flex: 1;
            padding: 28px;
        }

        .topbar {
            background: #ffffff;
            border-radius: 14px;
            padding: 14px 20px;
            box-shadow: 0 6px 20px rgba(81, 190, 120, 0.15);
            margin-bottom: 25px;
        }

        /* Stat cards */
        .stat-card {
            border: none;
            border-radius: 18px;
            color: #fff;
            box-shadow: 0 18px 40px rgba(81, 190, 120, 0.35);
        }

        /* Primary theme gradients */
        .bg-primary {
            background: linear-gradient(135deg, #51be78, #2f9e5f);
        }

        .bg-primary-dark {
            background: linear-gradient(135deg, #3fae6a, #1f7f4a);
        }

        .bg-primary-soft {
            background: linear-gradient(135deg, #6ed69a, #51be78);
        }

        .bg-primary-accent {
            background: linear-gradient(135deg, #51be78, #166534);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f2e1f, #062016);
            display: flex;
            flex-direction: column;
            padding: 18px;
        }

        .sidebar-header img {
            width: 72px;
            margin-bottom: 8px;
        }

        .sidebar-header h6 {
            color: #ffffff;
            margin-bottom: 0;
            font-weight: 600;
        }

        .sidebar-header span {
            font-size: 13px;
            color: #a7f3c0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin-top: 30px;
            flex: 1;
        }

        .sidebar-menu li {
            margin-bottom: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #bbf7d0;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.25s ease;
        }

        .sidebar-menu a i {
            font-size: 18px;
        }

        .sidebar-menu a:hover {
            background: rgba(81, 190, 120, 0.15);
            color: #ffffff;
            transform: translateX(6px);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #51be78, #2f9e5f);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(81, 190, 120, 0.55);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 15px;
        }

        .sidebar-footer a {
            color: #fca5a5;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .sidebar-footer a:hover {
            background: rgba(252, 165, 165, 0.15);
        }

        .btn-primary {
            background-color: #51be78;
            border-color: #51be78;
        }

        .btn-primary:hover {
            background-color: #429e5a;
            border-color: #429e5a;
        }
    </style>

</head>

<body>
    <div class="admin-wrap">