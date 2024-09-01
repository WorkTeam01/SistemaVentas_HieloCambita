<?php

include_once '../../config.php';

$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

$sentencia = $pdo->prepare("INSERT INTO proveedor
    (NombreProveedor, CelularProveedor, TelefonoProveedor, EmailProveedor, DireccionProveedor) 
    VALUES (:NombreProveedor, :CelularProveedor, :TelefonoProveedor,  :EmailProveedor, :DireccionProveedor)");

$sentencia->bindParam('NombreProveedor', $nombre_proveedor);
$sentencia->bindParam('CelularProveedor', $celular);
$sentencia->bindParam('TelefonoProveedor', $telefono);
$sentencia->bindParam('EmailProveedor', $email);
$sentencia->bindParam('DireccionProveedor', $direccion);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "La proveedor se ha agregado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/Views/Proveedores";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al agregar proveedor";
    $_SESSION['icono'] = "error";
}
