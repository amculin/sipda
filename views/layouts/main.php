<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use app\assets\DeleteAlertAsset;
use yii\bootstrap5\Html;
use yii\web\View;

MainAsset::register($this);
DeleteAlertAsset::register($this);
$this->beginPage();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title><?= Html::encode(Yii::$app->params['appName']); ?></title>
        <!-- <link rel="shortcut icon" href="static/client-logo.png"> -->
        <!-- CSS files -->
        <?php $this->head() ?> 
    </head>
    <body>
    <?php $this->beginBody() ?>
        <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark sidebar">
            <div class="container-fluid px-0 justify-content-start">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand text-white ms-3 ms-lg-0 gap-3">
                    <div class="logo">
                        <img src="/image/logo_jmc.png" alt="" height="15">
                    </div>
                    <a href="#" class="fw-bold hstack gap-3 text-decoration-none">
                        <div style="font-size: .9rem;"><?=Yii::$app->params['appName'];?></div>
                    </a>
                </h1>
                <div class="text-center p-2 mb-1 bg-primary text-white">
                    Unit : JK01 (Jakarta)
                </div>
                <div class="offcanvas offcanvas-start px-lg-3 bg-dark" id="sidebar-menu">
                    <div class="offcanvas-header">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="image">
                                <img src="/image/logo-persada.webp" alt="" height="15">
                            </div>
                            <div class="logo-text flex-grow-1">
                                <h3 class="m-0"></h3>   
                                <div class="fs-4">Aplikasi Pemasaran</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>  
                    <div class="offcanvas-body p-3 p-lg-0 flex-column flex-grow-1 overflow-auto">
                        <ul class="navbar-nav align-items-start mt-lg-3">
                            <li class="nav-item">
                                <a class="nav-link" href="?page=home">
                                    <i class="bi bi-house fs-3 me-3"></i> Beranda
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=crm-plan" class="nav-link"><i class="bi bi-calendar2 fs-3 me-3"></i> Planning</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-database fs-3 me-3"></i> Prospek
                                </a>
                                <div class="dropdown-menu">
                                    <a href="?page=crm-activity" class="dropdown-item">Leads</a>
                                    <a href="?page=promosi-penawaran" class="dropdown-item">Quotation</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="?page=promosi-event" class="nav-link"><i class="bi bi-lightbulb fs-3 me-3"></i> Program</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-megaphone fs-3 me-3"></i> Broadcast
                                </a>
                                <div class="dropdown-menu">
                                    <a href="?page=promosi-channel" class="dropdown-item">Channel</a>
                                    <a href="?page=promosi-broadcast" class="dropdown-item">Broadcast</a>
                                    <a href="?page=promosi-log" class="dropdown-item">Log Email</a>
                                    <a href="?page=promosi-konfigurasi" class="dropdown-item">Konfigurasi</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="?page=crm-contact" class="nav-link"><i class="bi bi-people fs-3 me-3"></i> Klien</a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=crm-sales-order" class="nav-link"><i class="bi bi-receipt fs-3 me-3"></i> Sales Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=crm-komisi" class="nav-link"><i class="bi bi-cash-stack fs-3 me-3"></i> Komisi Penjualan</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-book fs-3 me-3"></i> Referensi
                                </a>
                                <div class="dropdown-menu">
                                    <a href="?page=referensi-kategori" class="dropdown-item">Kategori</a>
                                    <a href="?page=referensi-produk" class="dropdown-item">Produk</a>
                                    <a href="?page=referensi-tahapan" class="dropdown-item">Tahapan</a>
                                    <a href="/province" class="dropdown-item">Provinsi</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="?page=manajemen-user" class="nav-link"><i class="bi bi-people fs-3 me-3"></i> Manajemen User</a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=konfigurasi" class="nav-link"><i class="bi bi-gear fs-3 me-3"></i> Konfigurasi</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </aside>

        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none sticky-top" id="navbar">
            <div class="container-xl justify-content">
                <button class="sidebar-toggler" type="button">
                    <span class="sidebar-icon"></span>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last ms-md-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0 me-3" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                            <span class="badge bg-red"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <div class="dropdown-item">Belum ada notifikasi </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0 dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="bg-primary text-white avatar rounded-circle">
                            <?= 'KY'; ?>
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div class="fw-bold"><?= 'khalid.yunanto'; ?></div>
                                <div class="mt-1 small text-primary"><?= 'Administrator'; ?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="?page=profile" class="dropdown-item"><i class="bi bi-person me-2"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="bi bi-key me-2"></i> Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?= $content; ?>
        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>