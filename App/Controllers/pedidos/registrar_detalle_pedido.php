<?php

include_once '../../config.php';

$nro_pedido = $_GET['nro_pedido'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$precio = $_GET['precio'];

$sentencia = $pdo->prepare("INSERT INTO detalle_pedido
            (NroPedido, IdProducto, Cantidad, Precio) 
    VALUES  (:NroPedido,:IdProducto,  :Cantidad, :Precio)");

$sentencia->bindParam('NroPedido', $nro_pedido);
$sentencia->bindParam('IdProducto', $id_producto);
$sentencia->bindParam('Cantidad', $cantidad);
$sentencia->bindParam('Precio', $precio);

if ($sentencia->execute()) { ?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos/create.php";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al crear el pedido';
    $_SESSION['icono'] = 'error';
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Pedidos/create.php";
    </script>
<?php
}
