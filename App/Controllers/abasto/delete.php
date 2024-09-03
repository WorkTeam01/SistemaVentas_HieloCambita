<?php

include_once '../../config.php';

$id_abasto_get = $_GET['id_abasto'];
$id_producto_get = $_GET['id_producto'];
$cantidad_compra = $_GET['cantidad_abasto'];
$stock_actual = $_GET['stock_actual'];

// echo $id_abasto_get . " - " . $id_producto_get . " - " . $cantidad_compra . " - " . $stock_actual;

$pdo->beginTransaction();

$sentencia = $pdo->prepare("DELETE FROM abasto WHERE IdAbasto = :IdAbasto");

$sentencia->bindParam('IdAbasto', $id_abasto_get);

if ($sentencia->execute()) {

    // Actualizar el stock desde la compra
    $stock = $stock_actual - $cantidad_compra;
    $sentencia = $pdo->prepare("UPDATE producto SET Stock = :Stock WHERE IdProducto = :IdProducto");
    $sentencia->bindParam('Stock', $stock);
    $sentencia->bindParam('IdProducto', $id_producto_get);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "La compra se ha eliminado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Abasto";
    </script>
<?php } else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error al eliminar la compra";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Abasto";
    </script>
<?php
}
