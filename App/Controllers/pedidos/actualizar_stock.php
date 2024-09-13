<?php

include_once '../../config.php';

$id_producto = $_GET['id_producto'];
$stock_calculado = $_GET['stock_calculado'];

$sentencia = $pdo->prepare("UPDATE producto SET Stock = :Stock WHERE IdProducto = :IdProducto");

$sentencia->bindParam('Stock', $stock_calculado);
$sentencia->bindParam('IdProducto', $id_producto);

if ($sentencia->execute()) {
    echo "Se actualizó correctamente el stock";
} else {
    echo "Error al actualizar el stock";
}
