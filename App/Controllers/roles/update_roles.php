<?php

$id_rol_get = $_GET['id'];

$sql_roles = "SELECT * FROM rol_usuario WHERE IdRolUsuario = '$id_rol_get'";
$query_roles = $pdo->query($sql_roles);
$query_roles->execute();

$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato) {
    $rol = $roles_dato['RolUsuario'];
}
