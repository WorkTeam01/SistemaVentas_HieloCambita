<?php

include_once '../../config.php';

$tipo_pago = $_GET['tipo_pago'];
$id_tipo_pago = $_GET['id_tipo_pago'];

$sentencia = $pdo->prepare("UPDATE tipo_pago SET TipoPago = :TipoPago
                            WHERE IdTipoPago = :IdTipoPago");

$sentencia->bindParam('TipoPago', $tipo_pago);
$sentencia->bindParam('IdTipoPago', $id_tipo_pago);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El tipo de pago se ha actualizado correctamente.";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/TipoPago";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el tipo de pago.";
    $_SESSION['icono'] = "error";
}
