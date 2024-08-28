<?php

$id_usuario_get = $_GET['id'];

$sql_usuarios = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, us.EstadoUsuario, us.EmailUsuario, rol.RolUsuario FROM Usuario us
                INNER JOIN rol_usuario rol on us.IdRolUsuario = rol.IdRolUsuario
                WHERE us.IdUsuario = '$id_usuario_get'";
$query_usuarios = $pdo->query($sql_usuarios);
$query_usuarios->execute();

$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato) {
    $usuario = $usuarios_dato['Usuario'];
    $nombres_usuario = $usuarios_dato['NombresUsuario'];
    $apellidos_usuario = $usuarios_dato['ApellidosUsuario'];
    $estado_usuario = $usuarios_dato['EstadoUsuario'];
    $email_usuario = $usuarios_dato['EmailUsuario'];
    $rol = $usuarios_dato['RolUsuario'];

    if ($estado_usuario === 1) {
        $estado_usuario = "Activo";
    } else {
        $estado_usuario = "Inactivo";
    }
}
