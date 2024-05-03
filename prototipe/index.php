<?php
    session_start();
    if(isset($_SESSION['role'])){
        include 'pages/layout.php';
    } else {
        header ("location:login.php");
    }
?>