<?php

include_once '../../config.php';

$nombre_categoria = $_GET['nombre_categoria'];

$sentencia = $pdo->prepare("INSERT INTO categoria (NombreCategoria) VALUES (:NombreCategoria)");

$sentencia->bindParam('NombreCategoria', $nombre_categoria);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "La categoria se ha agregado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Categorias";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al agregar categoria";
    $_SESSION['icono'] = "error";
}
