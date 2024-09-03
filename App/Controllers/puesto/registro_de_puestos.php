<?php

include_once '../../config.php';

$nombre_puesto = $_GET['nombre_puesto'];
$ubicacion_puesto = $_GET['ubicacion_puesto'];

$sentencia = $pdo->prepare("INSERT INTO puesto (NombrePuesto, UbicacionPuesto) VALUES (:NombrePuesto, :UbicacionPuesto)");

$sentencia->bindParam('NombrePuesto', $nombre_puesto);
$sentencia->bindParam('UbicacionPuesto', $ubicacion_puesto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El puesto se ha agregado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Puesto";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al agregar el puesto";
    $_SESSION['icono'] = "error";
}
