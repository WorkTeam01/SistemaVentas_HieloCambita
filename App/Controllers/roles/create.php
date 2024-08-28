<?php

include_once '../../config.php';

$rol = $_POST['rol'];

$sentencia = $pdo->prepare("INSERT INTO rol_usuario (RolUsuario) VALUES (:RolUsuario)");

$sentencia->bindParam('RolUsuario', $rol);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'EL rol se registró exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Roles');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al crear el rol';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Roles/create.php');
}
