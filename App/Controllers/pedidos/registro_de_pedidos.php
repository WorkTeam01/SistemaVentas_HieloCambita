<?php

include_once '../../config.php';

$nro_pedido = $_GET['nro_pedido'];
$id_cliente = $_GET['id_cliente'];
$id_tipo_pago = $_GET['id_tipo_pago'];
$id_usuario = $_GET['id_usuario'];
$fecha_pedido = $_GET['fecha_pedido'];
$total_a_cancelar = $_GET['total_a_cancelar'];
$estado_pedido = $_GET['estado_pago'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO pedido
            (NroPedido, IdCliente, IdTipoPago, IdUsuario, FechaPedido, MontoPago, EstadoPedido) 
    VALUES  (:NroPedido, :IdCliente, :IdTipoPago, :IdUsuario, :FechaPedido, :MontoPago, :EstadoPedido)");

$sentencia->bindParam('NroPedido', $nro_pedido);
$sentencia->bindParam('IdCliente', $id_cliente);
$sentencia->bindParam('IdTipoPago', $id_tipo_pago);
$sentencia->bindParam('IdUsuario', $id_usuario);
$sentencia->bindParam('FechaPedido', $fecha_pedido);
$sentencia->bindParam('MontoPago', $total_a_cancelar);
$sentencia->bindParam('EstadoPedido', $estado_pedido);

if ($sentencia->execute()) {

    // Actualizando stock desde la compra
    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = 'La venta se registró exitosamente';
    $_SESSION['icono'] = 'success';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos";
    </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = 'Error al crear la venta';
    $_SESSION['icono'] = 'error';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos/create.php";
    </script>
<?php
}
