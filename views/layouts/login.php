<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\LoginAsset;
use yii\bootstrap5\Html;
use yii\web\View;

LoginAsset::register($this);
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
    <body class="d-flex flex-column flex-md-row page-login">
    <?php $this->beginBody() ?>
        <div class="login-cover bg-dark col d-flex align-items-end order-md-last swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="image/slide-1.jpeg" alt="" class="cover" />
                </div>
                <div class="swiper-slide">
                    <img src="image/slide-2.jpeg" alt="" class="cover" />
                </div>
                <div class="swiper-slide">
                    <img src="image/slide-3.jpeg" alt="" class="cover" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"><i class="bi bi-arrow-left-circle text-white fs-1"></i></div>
            <div class="swiper-button-next"><i class="bi bi-arrow-right-circle text-white fs-1"></i></div>
        </div>
        <div class="loginbox d-flex align-items-center justify-content-center col">
            <div class="box col-md-8 p-4">
                <?= $content; ?>
            </div>
        </div>
    </div>

    <!-- Modal Forgot Password -->
    <div class="modal fade modal-blur" id="modal-forgot-password" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Enter your email and we'll send you a link to get back into your account. <br /><br />
                    <div class="mb-2">
                        <label for="" class="form-label">Your Email</label>
                        <input type="email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Send Password Change Link</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    $js = "
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            effect: 'fade',
            speed:2000,
            autoplay: {
                delay: 5000,
            },

            // If we need pagination
            pagination: {
            el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    ";
    $this->registerJs(
        $js,
        View::POS_READY,
        'swiper-handler'
    );
    ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>