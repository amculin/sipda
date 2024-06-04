<?php
use yii\helpers\Url;
?>
<div class="modal-header">
    <h5 class="modal-title">Tracking Prospek</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="list-group">
        <div class="list-group-item">
            <div class="row">
                <div class="col-auto">
                    <span class="avatar bg-primary rounded-circle"><i class="bi bi-megaphone h1 m-0"></i></span>
                </div>
                <div class="col">
                    <div class="fw-bold mb-1 text-truncate">Promosi : <?= ($event === false) ? 'Tanpa Promo': $event['nama']; ?></div>
                    <div class="text-secondary fs-5 hstack gap-3">
                        <?php
                        $eventDate = ($event === false) ? '-' : date('d F Y', strtotime($event['tanggal_mulai'])) . ' - ' .
                            date('d F Y', strtotime($event['tanggal_selesai']));
                        ?>
                        <span><i class="bi bi-calendar-week me-1"></i> <?= $eventDate; ?></span>
                    </div>
                </div>
                <div class="col-lg-2">
                    
                </div>
            </div>
        </div>
        <?php foreach ($histories as $key => $val) { ?>
        <div class="list-group-item">
            <div class="row">
                <div class="col-auto">
                    <span class="avatar rounded-circle" style="background: <?= $val['warna']; ?>"><i class="<?= $val['icon']; ?> h1 m-0"></i></span>
                </div>
                <div class="col">
                    <div class="fw-bold mb-1 text-truncate"><?= ucfirst(strtolower($val['nama'])); ?></div>
                    <div class="text-secondary fs-5 hstack gap-3">
                        <span><i class="bi bi-calendar-week me-1"></i> <?= date('d F Y', strtotime($val['timestamp'])); ?></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fw-bold mb-1 text-truncate">Harga</div>
                    <div class="text-secondary fs-5 hstack gap-3">
                        <span><i class="bi bi-cash-stack me-1"></i> <?= number_format($val['nilai'], 0, ',', '.'); ?></span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <?php if ($val['file']) { ?>
                    <a href="<?= Url::to(['download', 'id' => $val['id']], true); ?>" class="btn btn-default">Lampiran</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>