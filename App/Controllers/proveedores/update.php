<?php

include_once '../../config.php';

$nombre_proveedor = $_POST['nombre_proveedor'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$id_proveedor = $_POST['id_proveedor'];

$sentencia = $pdo->prepare("UPDATE proveedor
        SET NombreProveedor = :NombreProveedor, EmailProveedor = :EmailProveedor, DireccionProveedor = :DireccionProveedor, 
        CelularProveedor = :CelularProveedor, TelefonoProveedor = :TelefonoProveedor
        WHERE IdProveedor = :IdProveedor");

$sentencia->bindParam('NombreProveedor', $nombre_proveedor);
$sentencia->bindParam('EmailProveedor', $email);
$sentencia->bindParam('DireccionProveedor', $direccion);
$sentencia->bindParam('CelularProveedor', $celular);
$sentencia->bindParam('TelefonoProveedor', $telefono);
$sentencia->bindParam('IdProveedor', $id_proveedor);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El proveedor se ha actualizado correctamente.";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/Views/Proveedores');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al editar el proveedor.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/Views/Proveedores/update.php?id=' . $id_proveedor);
}
