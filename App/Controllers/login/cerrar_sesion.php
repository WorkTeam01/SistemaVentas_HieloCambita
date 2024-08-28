<?php
include_once '../../config.php';

session_start();
if (isset($_SESSION['sesion_user'])) {
    session_destroy();
    header('Location:' . $URL . '/Views/login.php');
}
