<?php

include_once '../../config.php';

$id_pedido = $_GET['id_pedido'];
$nro_pedido = $_GET['nro_pedido'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("DELETE FROM pedido WHERE IdPedido = :IdPedido");

$sentencia->bindParam('IdPedido', $id_pedido);

if ($sentencia->execute()) {
    $sentencia2 = $pdo->prepare("DELETE FROM detalle_pedido WHERE NroPedido = :NroPedido");
    $sentencia2->bindParam('NroPedido', $nro_pedido);
    $sentencia2->execute();

    $pdo->commit();
    session_start();
    $_SESSION['mensaje'] = "Pedido eliminado con éxito";
    $_SESSION['icono'] = 'success';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos";
    </script>
<?php } else {
    session_start();
    $_SESSION['error'] = "Error al eliminar el pedido";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos";
    </script>
<?php }
$pdo->rollBack();
