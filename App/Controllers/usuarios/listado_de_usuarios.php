<?php

$sql_usuarios = "SELECT us.IdUsuario, us.NombresUsuario, us.EstadoUsuario, us.EmailUsuario, tip.RolUsuario, p.NombrePuesto FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario
                INNER JOIN puesto p on us.IdPuesto = p.IdPuesto";
$query_usuarios = $pdo->query($sql_usuarios);
$query_usuarios->execute();
$total_user = $query_usuarios->rowCount();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
