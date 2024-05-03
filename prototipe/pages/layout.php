<?php require 'config.php';?>

<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title><?=$appName;?></title>
        <!-- <link rel="shortcut icon" href="static/client-logo.png"> -->
        <!-- CSS files -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
        <link href="./dist/css/custom.css" rel="stylesheet"/>

        <!-- Libs JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Tabler Core -->
        <script src="./dist/js/tabler.min.js" defer></script>
        <script src="./dist/js/app.js" defer></script>
    </head>
    <body >
        <div class="page">
            <?php include 'sidebar.php';?>
            <?php include 'header.php';?>

            <?php if(!isset($_GET['page'])) $_GET['page'] = 0;?>
            <?php
                if ($_GET['page']) {
                    require_once 'pages/'.$_GET['page'] . '.php';
                } else {
                    require_once 'pages/home.php';
                }
            ?>
            
            
        </div>
    </body>
</html>