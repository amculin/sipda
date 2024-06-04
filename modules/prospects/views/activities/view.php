<?php

use app\assets\FormModalAsset;
use app\modules\prospects\models\Aktivitas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\AktivitasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="page-wrapper" data-menu-active="Prospek">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Prospek</a></li>
                            <li class="breadcrumb-item active"><a href="#">Aktivitas</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Aktivitas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card h-100">
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI KLIEN</div>
                        <div class="d-none" id="lead-id"><?= $lead['id']; ?></div>
                        <div class="d-none" id="lead-id_tahapan"><?= $lead['id_tahapan']; ?></div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Nama Kontak</td>
                                <td class="text-end"><?= $lead['nama_klien']; ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td class="text-end"><?= $lead['nomor_telepon']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="text-end"><?= $lead['email']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-auto d-none d-lg-block p-0" style="border-right: 1px dashed #ddd;"></div>
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI PEKERJAAN</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Nama Perusahaan</td>
                                <td class="text-end"><?= $lead['nama_perusahaan']; ?></td>
                            </tr>
                            <tr>
                                <td>Kebutuhan</td>
                                <td class="text-end"><?= $lead['kebutuhan']; ?></td>
                            </tr>
                            <tr>
                                <td>Event Promosi</td>
                                <td class="text-end"><?= isset($lead['event_name']) ? $lead['event_name'] : '-'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header fw-bold">Aktivitas</div>
                <div class="card-header">
                    <a href="<?= Url::to(['create'], true); ?>" class="btn btn-primary d-none d-sm-inline-block me-2 modal-trigger"
                        data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <a href="?page=promosi-penawaran-form" class="btn btn-warning d-none d-sm-inline-block">
                        <i class="bi bi-envelope-paper"></i>
                        Buat Quotation
                    </a>
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-success rounded-circle"><i class="bi bi-check h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Meeting Awal</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 5 September 2023</span>
                                    <span><i class="bi bi-geo me-1"></i> PT. Citra Gemilang</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fs-4 fw-bold">Progres:</div>
                                <div class="text-secondary fs-5">
                                    Sudah terlaksana.
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <div class="dropdown">
                                    <a href="#" class="dropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil me-2"></i> Edit</a>
                                        <a href="#" class="dropdown-item text-danger" onclick="deleteData();"><i class="bi bi-trash me-2"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-success rounded-circle"><i class="bi bi-check h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Meeting Teknis</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 12 September 2023</span>
                                    <span><i class="bi bi-geo me-1"></i> PT. Citra Gemilang</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fs-4 fw-bold">Progres:</div>
                                <div class="text-secondary fs-5">
                                    Sudah terlaksana, jadwal pengerjaan mohon dipercepat.
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <div class="dropdown">
                                    <a href="#" class="dropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil me-2"></i> Edit</a>
                                        <a href="#" class="dropdown-item text-danger" onclick="deleteData();"><i class="bi bi-trash me-2"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-warning rounded-circle"><i class="bi bi-envelope-paper h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Quotation - SP2023090018</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 14 September 2023</span>
                                    <span><i class="bi bi-geo me-1"></i> PT. Citra Gemilang</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fs-4 fw-bold">Harga Penawaran:</div>
                                <div class="text-secondary fs-5">
                                    Rp. 1.500.000.000
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <div class="dropdown">
                                    <a href="#" class="dropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="?page=promosi-penawaran-form" class="dropdown-item"><i class="bi bi-pencil me-2"></i> Edit</a>
                                        <a href="#" class="dropdown-item text-danger" onclick="deleteData();"><i class="bi bi-trash me-2"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded-circle"></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Tender</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 12 September 2023</span>
                                    <span><i class="bi bi-geo me-1"></i> PT. Citra Gemilang</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fs-4 fw-bold">Progres:</div>
                                <div class="text-secondary fs-5">
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <div class="dropdown">
                                    <a href="#" class="dropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil me-2"></i> Edit</a>
                                        <a href="#" class="dropdown-item text-danger" onclick="deleteData();"><i class="bi bi-trash me-2"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-blur activity-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);
?>