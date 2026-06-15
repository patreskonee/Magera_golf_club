<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
Auth::requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tournamentModel = new Tournament(Database::connect());
    $tournamentModel->delete((int) ($_POST['id'] ?? 0));
}

redirect('../index.php');
