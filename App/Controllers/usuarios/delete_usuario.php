<?php

include_once '../../config.php';

$id_usuario = $_POST['id_usuario'];

$sentencia = $pdo->prepare("DELETE FROM usuario WHERE IdUsuario = :IdUsuario");

$sentencia->bindParam('IdUsuario', $id_usuario);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el usuario exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/Views/Usuarios');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar el usuario";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/Views/Usuarios/delete.php?id=' . $id_usuario);
}
