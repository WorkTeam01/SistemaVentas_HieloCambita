<?php

include_once '../../config.php';

$rol = $_POST['rol'];
$id_rol = $_POST['id_rol'];
$sentencia = $pdo->prepare("UPDATE rol_usuario
        SET RolUsuario = :RolUsuario
        WHERE IdRolUsuario = :IdRolUsuario");

$sentencia->bindParam('RolUsuario', $rol);
$sentencia->bindParam('IdRolUsuario', $id_rol);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'EL rol se actualizó exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Roles');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al actualizar el rol';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Roles/update.php?id=' . $id_rol);
}
