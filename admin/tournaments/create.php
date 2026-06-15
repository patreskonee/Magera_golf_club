<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
Auth::requireLogin();

$tournamentModel = new Tournament(Database::connect());
$errors = [];
$values = $_POST ?: null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $tournamentModel->validate($_POST);

    if ($errors === []) {
        $tournamentModel->create($_POST);
        redirect('../index.php');
    }
}

require __DIR__ . '/../partials/header.php';
?>

<div class="admin-toolbar">
    <div>
        <h1>Novy turnaj</h1>
        <p>Vypln udaje, ktore sa zobrazia na webe.</p>
    </div>
</div>

<div class="admin-panel">
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php require __DIR__ . '/form.php'; ?>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
