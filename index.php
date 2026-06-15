<?php
require_once __DIR__ . '/includes/bootstrap.php';

$tournamentModel = new Tournament(Database::connect());
$tournaments = $tournamentModel->upcoming(2);
$title = 'Magera Golf Club';
$activePage = 'home';
require __DIR__ . '/includes/header.php';
?>

<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <h2 class="text-white">Vitajte v klube</h2>
                <h1 class="text-white mb-4 pb-2">Magera Golf Club</h1>

                <div class="custom-btn-group">
                    <a href="tournaments.php" class="btn custom-btn me-3">Pozriet turnaje</a>
                    <a href="#kontakt" class="link">Kontakt</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <h2 class="mb-4">Golfovy klub pre hracov aj hosti</h2>
                <p>Magera Golf Club ponuka priestor pre trening, oddych a klubove turnaje. Stranka je dynamicka a turnaje sa spravuju cez administraciu.</p>
            </div>

            <div class="col-lg-6 col-12">
                <img src="images/professional-golf-player.jpg" class="img-fluid custom-block-image" alt="Golfovy hrac">
            </div>
        </div>
    </div>
</section>

<section class="events-section section-bg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Najblizsie turnaje</h2>
                <a href="tournaments.php" class="btn custom-btn">Vsetky turnaje</a>
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

<section class="contact-section section-padding" id="kontakt">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Kontakt</h2>
                <p>Mate zaujem o turnaj alebo clenstvo? Ozvite sa nam.</p>
                <p><strong>Email:</strong> info@mageragolf.sk</p>
                <p><strong>Telefon:</strong> +421 900 000 000</p>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
