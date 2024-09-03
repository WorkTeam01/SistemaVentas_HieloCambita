<?php

$sql_puestos = "SELECT * FROM puesto";
$query_puestos = $pdo->query($sql_puestos);
$query_puestos->execute();
$total_puestos = $query_puestos->rowCount();
$puestos_datos = $query_puestos->fetchAll(PDO::FETCH_ASSOC);
