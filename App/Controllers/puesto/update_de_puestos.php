<?php

include_once '../../config.php';

$nombre_puesto = $_GET['nombre_puesto'];
$ubicacion_puesto = $_GET['ubicacion_puesto'];
$id_puesto = $_GET['id_puesto'];

$sentencia = $pdo->prepare("UPDATE puesto SET NombrePuesto = :NombrePuesto, UbicacionPuesto = :UbicacionPuesto
                            WHERE IdPuesto = :IdPuesto");

$sentencia->bindParam('NombrePuesto', $nombre_puesto);
$sentencia->bindParam('UbicacionPuesto', $ubicacion_puesto);
$sentencia->bindParam('IdPuesto', $id_puesto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El puesto se ha actualizado correctamente.";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Puesto";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el puesto.";
    $_SESSION['icono'] = "error";
}
