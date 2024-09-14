<?php

$id_abasto_get = $_GET['id'];

$sql_abasto = "SELECT aba.IdAbasto, aba.NroAbasto, aba.ComprobanteAbasto, aba.PrecioAbasto, aba.CantidadAbasto, aba.FechaAbasto, 
                p.*, pro.IdProveedor, pro.NombreProveedor, pro.CelularProveedor, pro.TelefonoProveedor, pro.EmailProveedor, pro.DireccionProveedor,
                us.NombresUsuario, us.ApellidosUsuario, cat.NombreCategoria, pue.IdPuesto, pue.NombrePuesto
                FROM abasto aba
                INNER JOIN producto p ON aba.IdProducto = p.IdProducto
                INNER JOIN proveedor pro ON aba.IdProveedor = pro.IdProveedor
                INNER JOIN usuario us ON aba.IdUsuario = us.IdUsuario
                INNER JOIN categoria cat ON p.IdCategoria = cat.IdCategoria
                INNER JOIN puesto pue on aba.IdPuesto = pue.IdPuesto
                WHERE aba.IdAbasto = '$id_abasto_get'";

$query_abasto = $pdo->query($sql_abasto);
$query_abasto->execute();
$abasto_dato = $query_abasto->fetchAll(PDO::FETCH_ASSOC);

foreach ($abasto_dato as $abasto_dato) {
    $id_abasto = $abasto_dato['IdAbasto'];
    $nro_abasto = $abasto_dato['NroAbasto'];
    $comprobante = $abasto_dato['ComprobanteAbasto'];
    $precio_abasto = $abasto_dato['PrecioAbasto'];
    $cantidad = $abasto_dato['CantidadAbasto'];
    $fecha_abasto = $abasto_dato['FechaAbasto'];

    $id_producto_tabla = $abasto_dato['IdProducto'];
    $codigo = $abasto_dato['CodigoProducto'];
    $nombre_categoria = $abasto_dato['NombreCategoria'];
    $nombre_producto = $abasto_dato['NombreProducto'];
    $nombre_usuario = $abasto_dato['NombresUsuario'] . " " . $abasto_dato['ApellidosUsuario'];
    $descripcion_producto = $abasto_dato['DescripcionProducto'];
    $stock = $abasto_dato['Stock'];
    $stock_minimo = $abasto_dato['StockMinimo'];
    $stock_maximo = $abasto_dato['StockMaximo'];
    $precio_compra = $abasto_dato['PrecioCompra'];
    $precio_venta = $abasto_dato['PrecioVenta'];
    $fecha_ingreso = $abasto_dato['FechaIngreso'];
    $imagen = $abasto_dato['ImagenProducto'];
    $id_puesto_actual = $abasto_dato['IdPuesto'];
    $puesto_actual = $abasto_dato['NombrePuesto'];

    $id_proveedor_tabla = $abasto_dato['IdProveedor'];
    $nombre_proveedor_tabla = $abasto_dato['NombreProveedor'];
    $celular_proveedor = $abasto_dato['CelularProveedor'];
    $telefono_proveedor = $abasto_dato['TelefonoProveedor'];
    $email_proveedor = $abasto_dato['EmailProveedor'];
    $direccion_proveedor = $abasto_dato['DireccionProveedor'];
}
