<?php

include_once '../../config.php';

$id_detalle_pedido = $_POST['id_detalle_pedido'];

$sentencia = $pdo->prepare("DELETE FROM detalle_pedido WHERE IdDetallePedido = :IdDetallePedido");

$sentencia->bindParam('IdDetallePedido', $id_detalle_pedido);

if ($sentencia->execute()) { ?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos/create.php";
    </script>
<?php } else { ?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos/create.php";
    </script>
<?php
}
