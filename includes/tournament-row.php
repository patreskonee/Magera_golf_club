<div class="row custom-block custom-block-bg mb-3 p-3">
    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">
        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">
            <strong class="custom-block-date d-block"><?= e(date('d', strtotime($tournament['tournament_date']))) ?></strong>
            <span class="d-block"><?= e(date('m Y', strtotime($tournament['tournament_date']))) ?></span>
        </div>
    </div>

    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">
        <div class="custom-block-image-wrap">
            <a href="tournament.php?id=<?= (int) $tournament['id'] ?>">
                <img src="<?= e($tournament['image_path']) ?>" class="custom-block-image img-fluid" alt="<?= e($tournament['title']) ?>">
                <i class="custom-block-icon bi-link"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-12 order-3 order-lg-0">
        <div class="custom-block-info mt-2 mt-lg-0">
            <a href="tournament.php?id=<?= (int) $tournament['id'] ?>" class="events-title mb-3"><?= e($tournament['title']) ?></a>
            <?php $shortDescription = strlen((string) $tournament['description']) > 150 ? substr((string) $tournament['description'], 0, 150) . '...' : (string) $tournament['description']; ?>
            <p class="mb-0"><?= e($shortDescription) ?></p>

            <div class="d-flex flex-wrap border-top mt-4 pt-3">
                <div class="mb-2 me-4">
                    <span class="custom-block-span">Miesto:</span>
                    <p class="mb-0"><?= e($tournament['location']) ?></p>
                </div>

                <div class="mb-2 me-4">
                    <span class="custom-block-span">Startovne:</span>
                    <p class="mb-0"><?= $tournament['entry_fee'] !== null ? e(number_format((float) $tournament['entry_fee'], 2, ',', ' ')) . ' EUR' : 'Zadarmo' ?></p>
                </div>

                <div class="d-flex align-items-center ms-lg-auto">
                    <a href="tournament.php?id=<?= (int) $tournament['id'] ?>" class="btn custom-btn">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
