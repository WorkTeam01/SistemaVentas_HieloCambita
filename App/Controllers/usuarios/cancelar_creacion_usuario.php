<?php
include_once('../../config.php');

session_start();
// Limpiar los datos del formulario de la sesión
unset($_SESSION['form_data']);

// Redirigir a la página de usuarios
header('Location:' . $URL . ' /Views/Usuarios');
exit();
