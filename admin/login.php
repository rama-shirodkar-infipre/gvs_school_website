<?php
require_once __DIR__ . '/helpers.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf'] ?? '')) {
        $error = 'Invalid request';
    } else {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email=? AND is_active=1");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid email or password';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login | GVS School Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon icon -->
    <link rel="icon" type="image/png" href="<?= $site_url ?>images/logo.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            /* background: linear-gradient(135deg, #0f172a, #1e293b); */
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            /* background: linear-gradient(135deg, #102820, #1f6f54); */
            background: linear-gradient(135deg, #f3faf6, #dff3e9);

        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .login-logo {
            width: 90px;
            height: auto;
        }

        .form-control {
            height: 48px;
            border-radius: 10px;
        }

        .btn-login {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
        }

        .brand-title {
            font-weight: 700;
            color: #0f172a;
        }

        .brand-subtitle {
            font-size: 14px;
            color: #64748b;
        }

        .custom-button-color {
            background-color: #51be78;
            border-color: #51be78;
        }

        .custom-button-color:hover {
            background-color: #429e5a;
            border-color: #429e5a;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- Logo -->
        <div class="text-center mb-3">
            <img src="<?= $site_url ?>images/logo.png" class="login-logo mb-2" alt="Vaishya Global">
            <h5 class="brand-title mb-0">Admin Panel</h5>
        </div>

        <!-- Error -->
        <?php if ($error): ?>
            <div class="alert alert-danger text-center py-2">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post">
            <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button class="btn btn-primary custom-button-color w-100 btn-login mt-2">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>

        <div class="text-center mt-3 small text-muted">
            © <?= date('Y') ?> GVS School Website
        </div>

    </div>

</body>

</html>