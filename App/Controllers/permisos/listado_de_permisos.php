<?php

$sql_permisos = "SELECT * FROM permiso";
$query_permisos = $pdo->query($sql_permisos);
$query_permisos->execute();
$total_permisos = $query_permisos->rowCount();
$permisos_datos = $query_permisos->fetchAll(PDO::FETCH_ASSOC);
