<?php

$id_producto_get = $_GET['id'];

$sql_producto = "SELECT *, ca.NombreCategoria, p.NombrePuesto FROM producto pro
                INNER JOIN categoria ca on pro.IdCategoria = ca.IdCategoria
                INNER JOIN puesto p on pro.IdPuesto = p.IdPuesto
                WHERE pro.IdProducto = '$id_producto_get'";

$query_producto = $pdo->query($sql_producto);
$query_producto->execute();
$productos_dato = $query_producto->fetchAll(PDO::FETCH_ASSOC);

foreach ($productos_dato as $producto_dato) {
    $codigo = $producto_dato['CodigoProducto'];
    $categoria = $producto_dato['NombreCategoria'];
    $puesto_producto = $producto_dato['NombrePuesto'];
    $nombre = $producto_dato['NombreProducto'];
    $descripcion = $producto_dato['DescripcionProducto'];
    $stock = $producto_dato['Stock'];
    $stock_minimo = $producto_dato['StockMinimo'];
    $stock_maximo = $producto_dato['StockMaximo'];
    $precio_compra = $producto_dato['PrecioCompra'];
    $precio_venta = $producto_dato['PrecioVenta'];
    $fecha_ingreso = $producto_dato['FechaIngreso'];
    $imagen = $producto_dato['ImagenProducto'];
}
