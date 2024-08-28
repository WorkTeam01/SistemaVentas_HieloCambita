<?php

$sql_usuarios = "SELECT us.IdUsuario, us.NombresUsuario, us.EstadoUsuario, us.EmailUsuario, tip.RolUsuario FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario";
$query_usuarios = $pdo->query($sql_usuarios);
$query_usuarios->execute();
$total_user = $query_usuarios->rowCount();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
