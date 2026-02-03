<?php
require_once __DIR__ . '/../helpers.php';
require_login($site_url);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel | Vaishya Global</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= $site_url ?>assets/img/vgct.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
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
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .stat-card {
            border: none;
            border-radius: 18px;
            color: #fff;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
        }

        .bg-blue {
            background: linear-gradient(135deg, #2563eb, #1e40af);
        }

        .bg-green {
            background: linear-gradient(135deg, #16a34a, #065f46);
        }

        .bg-purple {
            background: linear-gradient(135deg, #7c3aed, #4c1d95);
        }

        .bg-orange {
            background: linear-gradient(135deg, #ea580c, #9a3412);
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #020617, #0f172a);
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
            color: #94a3b8;
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
            color: #cbd5f5;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.25s ease;
        }

        .sidebar-menu a i {
            font-size: 18px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(6px);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.45);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 15px;
        }

        .sidebar-footer a {
            color: #f87171;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .sidebar-footer a:hover {
            background: rgba(248, 113, 113, 0.15);
        }
    </style>
</head>

<body>
    <div class="admin-wrap">