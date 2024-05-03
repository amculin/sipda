<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'admin')
{
    header('Location:index.php');
    $_SESSION['failed'] = 0;
    $_SESSION['role'] = 'admin';
}
else
{
    header('Location:index.php');
    $_SESSION['failed'] = 1;
}

?>
