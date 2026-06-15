<?php
$title = $title ?? 'Magera Golf Club';
$activePage = $activePage ?? '';
?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-tiya-golf-club.css" rel="stylesheet">
</head>
<body>
<main>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="Magera Golf Club">
                <span class="navbar-brand-text">Magera<small>Golf Club</small></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-auto">
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="index.php">Domov</a></li>
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'tournaments' ? 'active' : '' ?>" href="tournaments.php">Turnaje</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#kontakt">Kontakt</a></li>
                </ul>

                <div class="d-none d-lg-block ms-lg-3">
                    <a class="btn custom-btn custom-border-btn" href="admin/login.php">Admin</a>
                </div>
            </div>
        </div>
    </nav>
