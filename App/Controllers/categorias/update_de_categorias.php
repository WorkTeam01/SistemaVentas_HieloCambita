<?php

include_once '../../config.php';

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

$sentencia = $pdo->prepare("UPDATE categoria SET NombreCategoria = :NombreCategoria
                            WHERE IdCategoria = :IdCategoria");

$sentencia->bindParam('NombreCategoria', $nombre_categoria);
$sentencia->bindParam('IdCategoria', $id_categoria);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "La categoria se ha actualizado correctamente.";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Categorias";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar la categoria.";
    $_SESSION['icono'] = "error";
}
