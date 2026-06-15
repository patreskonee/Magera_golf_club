<?php
$values = $values ?? [
    'title' => '',
    'tournament_date' => date('Y-m-d'),
    'location' => '',
    'description' => '',
    'max_players' => '',
    'entry_fee' => '',
    'status' => 'planned',
    'image_path' => 'images/professional-golf-player.jpg',
];
?>

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="title">Nazov turnaja</label>
        <input class="form-control" type="text" name="title" id="title" value="<?= e($values['title']) ?>" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="tournament_date">Datum</label>
        <input class="form-control" type="date" name="tournament_date" id="tournament_date" value="<?= e($values['tournament_date']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label" for="location">Miesto</label>
        <input class="form-control" type="text" name="location" id="location" value="<?= e($values['location']) ?>" required>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="max_players">Max. hracov</label>
        <input class="form-control" type="number" name="max_players" id="max_players" min="0" value="<?= e((string) $values['max_players']) ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label" for="entry_fee">Startovne EUR</label>
        <input class="form-control" type="number" step="0.01" name="entry_fee" id="entry_fee" min="0" value="<?= e((string) $values['entry_fee']) ?>">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="status">Stav</label>
        <select class="form-select" name="status" id="status">
            <option value="planned" <?= $values['status'] === 'planned' ? 'selected' : '' ?>>Planovany</option>
            <option value="open" <?= $values['status'] === 'open' ? 'selected' : '' ?>>Otvorena registracia</option>
            <option value="closed" <?= $values['status'] === 'closed' ? 'selected' : '' ?>>Uzatvoreny</option>
            <option value="finished" <?= $values['status'] === 'finished' ? 'selected' : '' ?>>Ukonceny</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label" for="image_path">Obrazok</label>
        <input class="form-control" type="text" name="image_path" id="image_path" value="<?= e($values['image_path']) ?>">
    </div>

    <div class="col-12">
        <label class="form-label" for="description">Popis</label>
        <textarea class="form-control" name="description" id="description" rows="7"><?= e($values['description']) ?></textarea>
    </div>
</div>

<div class="admin-form-actions">
    <button class="btn admin-btn" type="submit">Ulozit</button>
    <a class="btn btn-outline-secondary" href="../index.php">Zrusit</a>
</div>
