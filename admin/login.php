<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (Auth::check()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth(Database::connect());

    if ($auth->login((string) ($_POST['email'] ?? ''), (string) ($_POST['password'] ?? ''))) {
        redirect('index.php');
    }

    $error = 'Nespravny email alebo heslo.';
}
?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin prihlasenie</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>
<body class="admin-login-page">
    <div class="admin-login-card">
        <img src="../images/logo.png" alt="Magera Golf Club" class="admin-logo">
        <h1>Administracia</h1>
        <p>Sprava turnajov Magera Golf Club</p>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Heslo</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn admin-btn w-100">Prihlasit sa</button>
        </form>

        <a href="../index.php" class="admin-back-link">Spat na web</a>
    </div>
</body>
</html>
