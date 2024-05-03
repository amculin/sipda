<?php require 'config.php';?>
<?php
    session_start();
?>
<?php if(isset($_SESSION['role'])):?>
<?php
    header ("location:index.php");
?>
<?php else:?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title><?=$appName;?></title>
        <!-- <link rel="shortcut icon" href="static/client-logo.png"> -->
        <!-- CSS files -->
        <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
        <link href="./dist/css/custom.css" rel="stylesheet"/>
        <link href="./dist/css/login.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <body class="d-flex flex-column">
        <div class="login-cover bg-dark position-fixed swiper" style="inset:0;">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="static/login/slide-1.jpeg" alt="" class="cover">
                </div>
                <div class="swiper-slide">
                    <img src="static/login/slide-2.jpeg" alt="" class="cover">
                </div>
                <div class="swiper-slide">
                    <img src="static/login/slide-3.jpeg" alt="" class="cover">
                </div>
            </div>
        </div>
        <div class="page page-center position-relative" style="z-index: 10;">
            <div class="container container-tight py-4">
                <div class="card card-md card-loginbox" style="background:#ffffffcc;backdrop-filter: blur(20px);">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-4 align-items-center">
                            <div class="logo">
                                <img src="static/logo-persada.webp" alt="" height="30">
                            </div>
                            <div class="logo-text">
                                <h1 class="mb-0 text-primary"><?=$appName;?></h1>
                                <div><?=$clientName;?></div>
                            </div>
                        </div>
                        <p class="text-center">
                            Selamat Datang, silahkan masukkan username dan password anda!
                        </p>
                        <form action="auth.php" method="POST">
                            <div class="mb-2">
                                <input type="username" class="form-control py-3 border-0 bg-light text-dark" placeholder="Type your username" name="username" required>
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control py-3 border-0 bg-light text-dark input-password" name="password" placeholder="Type your password">
                            </div>
                            <div class="mb-2 text-end">
                                <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modal-forgot-password">Lupa Password?</a>
                            </div>
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary text-uppercase shadow py-3" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
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

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js" defer></script>
    <script src="./dist/js/app.js" defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        const swiper = new Swiper('.swiper', {
            loop: true,
            effect: 'fade',
            speed:2000,
            autoplay: {
               delay: 5000,
            },
        });
    </script>
</body>
</html>
<?php endif;?>