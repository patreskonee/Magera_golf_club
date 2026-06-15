<?php
require_once __DIR__ . '/../includes/bootstrap.php';
Auth::requireLogin();

$tournamentModel = new Tournament(Database::connect());
$tournaments = $tournamentModel->all();
require __DIR__ . '/partials/header.php';
?>

<div class="admin-toolbar">
    <div>
        <h1>Turnaje</h1>
        <p>Pridavanie, uprava a mazanie klubovych turnajov.</p>
    </div>
    <a href="tournaments/create.php" class="btn admin-btn"><i class="bi-plus-lg"></i> Novy turnaj</a>
</div>

<div class="admin-panel">
    <div class="table-responsive">
        <table class="table align-middle admin-table">
            <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Datum</th>
                    <th>Miesto</th>
                    <th>Stav</th>
                    <th class="text-end">Akcie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tournaments as $tournament): ?>
                    <tr>
                        <td><strong><?= e($tournament['title']) ?></strong></td>
                        <td><?= e(date('d.m.Y', strtotime($tournament['tournament_date']))) ?></td>
                        <td><?= e($tournament['location']) ?></td>
                        <td><span class="admin-badge"><?= e($tournament['status']) ?></span></td>
                        <td class="text-end">
                            <a href="../tournament.php?id=<?= (int) $tournament['id'] ?>" class="btn btn-sm btn-outline-secondary">Detail</a>
                            <a href="tournaments/edit.php?id=<?= (int) $tournament['id'] ?>" class="btn btn-sm btn-outline-primary">Upravit</a>
                            <form method="post" action="tournaments/delete.php" class="d-inline" onsubmit="return confirm('Naozaj vymazat tento turnaj?');">
                                <input type="hidden" name="id" value="<?= (int) $tournament['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Vymazat</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if ($tournaments === []): ?>
                    <tr><td colspan="5">Zatial nie su vytvorene ziadne turnaje.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
