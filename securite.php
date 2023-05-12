<?php

session_start();
if(!isset($_SESSION['user'])) {
    $_SESSION['info'] = "Acces non autorise";
    header('location:login.php');
}