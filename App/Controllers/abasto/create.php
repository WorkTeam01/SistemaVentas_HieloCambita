<?php

include_once '../../config.php';

$id_producto = $_GET['id_producto'];
$nro_abasto = $_GET['nro_abasto'];
$fecha_abasto = $_GET['fecha_abasto'];
$id_proveedor = $_GET['id_proveedor'];
$comprobante = $_GET['comprobante'];
$id_usuario = $_GET['id_usuario'];
$precio_abasto = $_GET['precio_abasto'];
$cantidad = $_GET['cantidad_abasto'];
$stock_total = $_GET['stock_total'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO abasto
            (IdProducto, NroAbasto, FechaAbasto, IdProveedor, ComprobanteAbasto, IdUsuario, PrecioAbasto, CantidadAbasto) 
    VALUES  (:IdProducto, :NroAbasto, :FechaAbasto, :IdProveedor, :ComprobanteAbasto, :IdUsuario, :PrecioAbasto,:CantidadAbasto)");

$sentencia->bindParam('IdProducto', $id_producto);
$sentencia->bindParam('NroAbasto', $nro_abasto);
$sentencia->bindParam('FechaAbasto', $fecha_abasto);
$sentencia->bindParam('IdProveedor', $id_proveedor);
$sentencia->bindParam('ComprobanteAbasto', $comprobante);
$sentencia->bindParam('IdUsuario', $id_usuario);
$sentencia->bindParam('PrecioAbasto', $precio_abasto);
$sentencia->bindParam('CantidadAbasto', $cantidad);

if ($sentencia->execute()) {

    // Actualizando stock desde la compra
    $sentencia = $pdo->prepare("UPDATE producto SET Stock = :Stock WHERE IdProducto = :IdProducto");

    $sentencia->bindParam('Stock', $stock_total);
    $sentencia->bindParam('IdProducto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = 'La compra se registró exitosamente';
    $_SESSION['icono'] = 'success';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Abasto";
    </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = 'Error al crear la compra';
    $_SESSION['icono'] = 'error';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Abasto/create.php";
    </script>
<?php
}
