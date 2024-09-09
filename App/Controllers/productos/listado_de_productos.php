<?php

$sql_productos = "SELECT pro.*, ca.NombreCategoria, pue.NombrePuesto FROM producto pro
                INNER JOIN categoria ca on pro.IdCategoria = ca.IdCategoria
                INNER JOIN puesto pue on pro.IdPuesto = pue.IdPuesto";

$query_productos = $pdo->query($sql_productos);
$query_productos->execute();
$total_productos = $query_productos->rowCount();
$contador_de_producto = $query_productos->rowCount() + 1;
$total_productos_dashboard = $query_productos->rowCount();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);
