<?php

$id_proveedor_get = $_GET['id'];

$sql_proveedores = "SELECT * FROM proveedor WHERE IdProveedor = '$id_proveedor_get'";
$query_proveedores = $pdo->query($sql_proveedores);
$query_proveedores->execute();

$proveedores_datos = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);

foreach ($proveedores_datos as $proveedores_dato) {
    $id_proveedor = $proveedores_dato['IdProveedor'];
    $nombre_proveedor = $proveedores_dato['NombreProveedor'];
    $celular = $proveedores_dato['CelularProveedor'];
    $telefono = $proveedores_dato['TelefonoProveedor'];
    $email = $proveedores_dato['EmailProveedor'];
    $direccion = $proveedores_dato['DireccionProveedor'];
}
