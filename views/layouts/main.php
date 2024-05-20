<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use app\assets\DeleteAlertAsset;
use app\customs\FMenu;
use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Menu;

MainAsset::register($this);
DeleteAlertAsset::register($this);
$this->beginPage();

$userData = Yii::$app->session->get('user_data');
$words = explode(' ', Yii::$app->user->identity->nama);
$acronym = '';

foreach ($words as $w) {
  $acronym .= substr($w, 0, 1);
}

$unit = $userData['kode'] . ' (' . $userData['unit_name'] . ')';
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
                    Unit : <?= $unit; ?>
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
                        <?php
                        echo FMenu::widget();
                        ?>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg>
                            <span class="badge bg-red"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <div class="dropdown-item">Belum ada notifikasi </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0 dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="bg-primary text-white avatar rounded-circle">
                            <?= $acronym; ?>
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div class="fw-bold"><?= $userData['group_name']; ?></div>
                                <div class="mt-1 small text-primary"><?= Yii::$app->user->identity->nama; ?></div>
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