<?php

$sql_proveedores = "SELECT * FROM proveedor";
$query_proveedores = $pdo->query($sql_proveedores);
$query_proveedores->execute();
$total_proveedores = $query_proveedores->rowCount();
$proveedores_datos = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);
