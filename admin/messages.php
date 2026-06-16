<?php
require_once __DIR__ . '/../includes/bootstrap.php';
Auth::requireLogin();

$messageModel = new ContactMessage(Database::connect());
$messages = $messageModel->all();
require __DIR__ . '/partials/header.php';
?>

<div class="admin-toolbar">
    <div>
        <h1>Spravy</h1>
        <p>Spravy odoslane cez kontaktny formular.</p>
    </div>
</div>

<div class="admin-panel">
    <div class="table-responsive">
        <table class="table align-middle admin-table">
            <thead>
                <tr>
                    <th>Meno</th>
                    <th>Email</th>
                    <th>Sprava</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><strong><?= e($message['full_name']) ?></strong></td>
                        <td><a href="mailto:<?= e($message['email']) ?>"><?= e($message['email']) ?></a></td>
                        <td><?= nl2br(e($message['message'])) ?></td>
                        <td><?= e(date('d.m.Y H:i', strtotime($message['created_at']))) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ($messages === []): ?>
                    <tr><td colspan="4">Zatial nebola odoslana ziadna sprava.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
