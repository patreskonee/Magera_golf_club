<?php
require_once __DIR__ . '/includes/bootstrap.php';

$tournamentModel = new Tournament(Database::connect());
$tournaments = $tournamentModel->all();
$title = 'Turnaje - Magera Golf Club';
$activePage = 'tournaments';
require __DIR__ . '/includes/header.php';
?>

<section class="hero-section hero-50 d-flex justify-content-center align-items-center">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h1 class="text-white mb-4 pb-2">Turnaje</h1>
                <a href="#turnaje" class="btn custom-btn smoothscroll me-3">Zobrazit turnaje</a>
            </div>
        </div>
    </div>
</section>

<section class="events-section events-listing-section section-bg section-padding" id="turnaje">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 class="mb-4">Aktualne turnaje</h2>
            </div>

            <?php if ($tournaments === []): ?>
                <div class="col-12"><p>Zatial nie su vypisane ziadne turnaje.</p></div>
            <?php endif; ?>

            <?php foreach ($tournaments as $tournament): ?>
                <?php require __DIR__ . '/includes/tournament-row.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
