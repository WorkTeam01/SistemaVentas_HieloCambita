<?php

include_once '../../config.php';

$id_proveedor = $_POST['id_proveedor'];

$sentencia = $pdo->prepare("DELETE FROM proveedor WHERE IdProveedor = :IdProveedor");

$sentencia->bindParam('IdProveedor', $id_proveedor);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El proveedor se ha eliminado correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' . $URL . '/Views/Proveedores');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar el proveedor";
    $_SESSION['icono'] = "error";
    header('Location:' . $URL . '/Views/Proveedores/delete.php?id=' . $id_proveedor);
}
