<?php

include_once '../../config.php';

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];

$image = $_POST['image'];

if ($image != "") {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../Views/Productos/img_productos/" . $filename;

    move_uploaded_file($_FILES['image']['tmp_name'], $location);
} else {
    $filename = "producto_default.png";
}

$sentencia = $pdo->prepare("INSERT INTO producto
            (CodigoProducto, NombreProducto, DescripcionProducto, Stock, StockMinimo, StockMaximo, PrecioCompra, PrecioVenta, FechaIngreso, ImagenProducto, IdCategoria) 
    VALUES  (:CodigoProducto, :NombreProducto, :DescripcionProducto, :Stock, :StockMinimo, :StockMaximo, :PrecioCompra, :PrecioVenta, :FechaIngreso, :ImagenProducto, :IdCategoria)");

$sentencia->bindParam('CodigoProducto', $codigo);
$sentencia->bindParam('NombreProducto', $nombre);
$sentencia->bindParam('DescripcionProducto', $descripcion);
$sentencia->bindParam('Stock', $stock);
$sentencia->bindParam('StockMinimo', $stock_minimo);
$sentencia->bindParam('StockMaximo', $stock_maximo);
$sentencia->bindParam('PrecioCompra', $precio_compra);
$sentencia->bindParam('PrecioVenta', $precio_venta);
$sentencia->bindParam('FechaIngreso', $fecha_ingreso);
$sentencia->bindParam('ImagenProducto', $filename);
$sentencia->bindParam('IdCategoria', $id_categoria);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'EL producto se registró exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Productos');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al crear el producto';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Productos/create.php');
}
