<?php

include_once '../../config.php';

$tipo_pago = $_GET['tipo_pago'];

$sentencia = $pdo->prepare("INSERT INTO tipo_pago (TipoPago) VALUES (:TipoPago)");

$sentencia->bindParam('TipoPago', $tipo_pago);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El tipo de pago se ha agregado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/TipoPago";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al agregar el tipo de pago";
    $_SESSION['icono'] = "error";
}
