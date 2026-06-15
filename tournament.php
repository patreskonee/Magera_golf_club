<?php
require_once __DIR__ . '/includes/bootstrap.php';

$tournamentModel = new Tournament(Database::connect());
$tournament = $tournamentModel->find((int) ($_GET['id'] ?? 0));

if (!$tournament) {
    http_response_code(404);
    $title = 'Turnaj nenajdeny';
    require __DIR__ . '/includes/header.php';
    echo '<section class="section-padding"><div class="container"><h1>Turnaj nenajdeny</h1><p>Vybrany turnaj neexistuje.</p></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$title = $tournament['title'] . ' - Magera Golf Club';
$activePage = 'tournaments';
require __DIR__ . '/includes/header.php';
?>

<section class="hero-section hero-50 d-flex justify-content-center align-items-center">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <h1 class="text-white mb-4 pb-2"><?= e($tournament['title']) ?></h1>
                <a href="tournaments.php" class="btn custom-btn">Spat na turnaje</a>
            </div>
        </div>
    </div>
</section>

<section class="events-section events-detail-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-12 mx-auto">
                <div class="custom-block-image-wrap">
                    <img src="<?= e($tournament['image_path']) ?>" class="custom-block-image img-fluid" alt="<?= e($tournament['title']) ?>">
                </div>

                <div class="custom-block-info">
                    <h2 class="mb-3"><?= e($tournament['title']) ?></h2>
                    <p><?= nl2br(e($tournament['description'])) ?></p>

                    <div class="events-detail-info row my-5">
                        <div class="col-lg-3 col-12">
                            <span class="custom-block-span">Datum:</span>
                            <p class="mb-0"><?= e(date('d.m.Y', strtotime($tournament['tournament_date']))) ?></p>
                        </div>

                        <div class="col-lg-3 col-12">
                            <span class="custom-block-span">Miesto:</span>
                            <p class="mb-0"><?= e($tournament['location']) ?></p>
                        </div>

                        <div class="col-lg-3 col-12">
                            <span class="custom-block-span">Hracov:</span>
                            <p class="mb-0"><?= $tournament['max_players'] ? (int) $tournament['max_players'] : 'Bez limitu' ?></p>
                        </div>

                        <div class="col-lg-3 col-12">
                            <span class="custom-block-span">Startovne:</span>
                            <p class="mb-0"><?= $tournament['entry_fee'] !== null ? e(number_format((float) $tournament['entry_fee'], 2, ',', ' ')) . ' EUR' : 'Zadarmo' ?></p>
                        </div>
                    </div>

                    <a href="tournaments.php" class="btn custom-btn">Vsetky turnaje</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
