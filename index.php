<?php
require_once __DIR__ . '/includes/bootstrap.php';

$tournaments = [];
$databaseError = false;
$contactNotice = '';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    $db = Database::connect();
    $tournamentModel = new Tournament($db);

    if ($requestMethod === 'POST' && isset($_POST['full-name'], $_POST['email'], $_POST['message'])) {
        $contactMessage = new ContactMessage($db);
        $errors = $contactMessage->validate($_POST);

        if ($errors === []) {
            $contactMessage->create($_POST);
            redirect('index.php?contact=sent#section_5');
        }

        $contactNotice = '<div class="alert alert-danger mb-4">' . e(implode(' ', $errors)) . '</div>';
    }

    $tournaments = $tournamentModel->upcoming(2);
} catch (PDOException) {
    $databaseError = true;
}

if (($_GET['contact'] ?? '') === 'sent') {
    $contactNotice = '<div class="alert alert-success mb-4">Sprava bola odoslana. Dakujeme, ozveme sa vam co najskor.</div>';
} elseif ($databaseError && $requestMethod === 'POST') {
    $contactNotice = '<div class="alert alert-danger mb-4">Spravu sa nepodarilo ulozit, pretoze databaza nie je dostupna.</div>';
}

function renderTournamentRow(array $tournament, bool $highlight = false): string
{
    $date = strtotime($tournament['tournament_date']);
    $day = date('d', $date);
    $monthYear = date('M Y', $date);
    $rowClass = $highlight ? 'row custom-block custom-block-bg' : 'row custom-block mb-3';
    $detailUrl = 'tournament.php?id=' . (int) $tournament['id'];
    $price = $tournament['entry_fee'] !== null
        ? e(number_format((float) $tournament['entry_fee'], 2, ',', ' ')) . ' EUR'
        : 'Zadarmo';
    $description = strlen((string) $tournament['description']) > 150
        ? substr((string) $tournament['description'], 0, 150) . '...'
        : (string) $tournament['description'];

    return '
                        <div class="' . $rowClass . '">
                            <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">
                                <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">
                                    <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">' . e($day) . '</h6>
                                    <strong class="text-white">' . e($monthYear) . '</strong>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">
                                <div class="custom-block-image-wrap">
                                    <a href="' . e($detailUrl) . '">
                                        <img src="' . e($tournament['image_path']) . '" class="custom-block-image img-fluid" alt="' . e($tournament['title']) . '">
                                        <i class="custom-block-icon bi-link"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 order-3 order-lg-0">
                                <div class="custom-block-info mt-2 mt-lg-0">
                                    <a href="' . e($detailUrl) . '" class="events-title mb-3">' . e($tournament['title']) . '</a>
                                    <p class="mb-0">' . e($description) . '</p>

                                    <div class="d-flex flex-wrap border-top mt-4 pt-3">
                                        <div class="mb-4 mb-lg-0">
                                            <div class="d-flex flex-wrap align-items-center mb-1">
                                                <span class="custom-block-span">Location:</span>
                                                <p class="mb-0">' . e($tournament['location']) . '</p>
                                            </div>

                                            <div class="d-flex flex-wrap align-items-center">
                                                <span class="custom-block-span">Ticket:</span>
                                                <p class="mb-0">' . $price . '</p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center ms-lg-auto">
                                            <a href="' . e($detailUrl) . '" class="btn custom-btn">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
}

$rows = '';
foreach ($tournaments as $index => $tournament) {
    $rows .= renderTournamentRow($tournament, $index % 2 === 1);
}

if ($databaseError) {
    $rows = '<p>Databaza momentalne nie je dostupna. Zapnite MySQL v XAMPP a turnaje sa nacitaju automaticky.</p>';
} elseif ($rows === '') {
    $rows = '<p>Zatial nie su vypisane ziadne turnaje.</p>';
}

$eventsSection = '
            <section class="events-section section-bg section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-lg-3">Upcoming Events</h2>
                        </div>
' . $rows . '
                    </div>
                </div>
            </section>

';

$template = file_get_contents(__DIR__ . '/index.html');

$template = str_replace('href="index.html"', 'href="index.php"', $template);
$template = str_replace('href="event-listing.html"', 'href="tournaments.php"', $template);
$template = str_replace('href="event-detail.html"', 'href="tournaments.php"', $template);
$template = str_replace('Event Listing', 'Event Listing', $template);
$template = str_replace('Event Detail', 'Tournament Detail', $template);
$template = str_replace(
    '<form action="#" method="post" class="custom-form contact-form" role="form">',
    '<form action="index.php#section_5" method="post" class="custom-form contact-form" role="form">',
    $template
);
$template = str_replace(
    '<h2 class="mb-4 pb-2">Contact Tiya</h2>',
    '<h2 class="mb-4 pb-2">Contact Tiya</h2>' . $contactNotice,
    $template
);

$template = str_replace(
    '<a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>',
    '<a class="btn custom-btn custom-border-btn" href="admin/login.php">Admin</a>',
    $template
);
$template = str_replace('Member Login', 'Admin', $template);

$template = preg_replace(
    '/\s*<section class="events-section section-bg section-padding" id="section_4">.*?<\/section>\s*(?=<section class="contact-section)/s',
    $eventsSection,
    $template,
    1
);

echo $template;
