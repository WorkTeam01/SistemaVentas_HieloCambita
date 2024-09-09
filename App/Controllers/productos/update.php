<?php

include_once '../../config.php';

$id_producto = $_POST['id_producto'];
$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$id_puesto = $_POST['id_puesto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$image_text = $_POST['image_text'];

if (!empty($_FILES['image']['name'])) {
    // Obtener el nombre de la imagen actual
    $sentencia = $pdo->prepare("SELECT ImagenProducto FROM producto WHERE IdProducto = :IdProducto");
    $sentencia->bindParam('IdProducto', $id_producto);
    $sentencia->execute();
    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
    $imagenActual = $producto['ImagenProducto'];

    // Eliminar la imagen actual si no es la imagen por defecto
    if ($imagenActual && $imagenActual != 'producto_default.png' && file_exists("../../../Views/Productos/img_productos/" . $imagenActual)) {
        unlink("../../../Views/Productos/img_productos/" . $imagenActual);
    }

    // Subir la nueva imagen
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $image_text = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../Views/Productos/img_productos/" . $image_text;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
}

$sentencia = $pdo->prepare("UPDATE producto
    SET NombreProducto = :NombreProducto, DescripcionProducto = :DescripcionProducto, Stock = :Stock, StockMinimo = :StockMinimo,
        StockMaximo = :StockMaximo, PrecioCompra = :PrecioCompra, PrecioVenta = :PrecioVenta,
        FechaIngreso = :FechaIngreso, ImagenProducto = :ImagenProducto, IdCategoria = :IdCategoria, IdPuesto = :IdPuesto
    WHERE IdProducto = :IdProducto");

$sentencia->bindParam('NombreProducto', $nombre);
$sentencia->bindParam('DescripcionProducto', $descripcion);
$sentencia->bindParam('Stock', $stock);
$sentencia->bindParam('StockMinimo', $stock_minimo);
$sentencia->bindParam('StockMaximo', $stock_maximo);
$sentencia->bindParam('PrecioCompra', $precio_compra);
$sentencia->bindParam('PrecioVenta', $precio_venta);
$sentencia->bindParam('FechaIngreso', $fecha_ingreso);
$sentencia->bindParam('ImagenProducto', $image_text);
$sentencia->bindParam('IdCategoria', $id_categoria);
$sentencia->bindParam('IdPuesto', $id_puesto);
$sentencia->bindParam('IdProducto', $id_producto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'El producto se actualizó exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Productos');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al actualizar el producto';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Productos/update.php?id=' . $id_producto);
}
