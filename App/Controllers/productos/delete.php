<?php

include_once '../../config.php';

$id_producto = $_POST['id_producto'];

// Obtener el nombre de la imagen actual
$sentencia = $pdo->prepare("SELECT ImagenProducto FROM producto WHERE IdProducto = :IdProducto");
$sentencia->bindParam(':IdProducto', $id_producto);
$sentencia->execute();
$producto = $sentencia->fetch(PDO::FETCH_ASSOC);
$imagenActual = $producto['ImagenProducto'];

// Eliminar la imagen actual si no es la imagen por defecto
if ($imagenActual && $imagenActual != 'producto_default.png' && file_exists("../../../Views/Productos/img_productos/" . $imagenActual)) {
    unlink("../../../Views/Productos/img_productos/" . $imagenActual);
}

// Eliminar el producto
$sentencia = $pdo->prepare("DELETE FROM producto WHERE IdProducto = :IdProducto");
$sentencia->bindParam(':IdProducto', $id_producto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el producto exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/Views/Productos');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al intentar eliminar el producto";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/Views/Productos/delete.php?id=' . $id_producto);
}
