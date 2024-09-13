<?php

// Verificar si el usuario es Administrador o si es de otro rol y debe ver solo los productos de su puesto
if ($rol_sesion == 'Administrador') {
    // Si es administrador, obtiene todos los productos
    $sql_productos = "SELECT pro.*, ca.NombreCategoria, pue.NombrePuesto 
                      FROM producto pro
                      INNER JOIN categoria ca ON pro.IdCategoria = ca.IdCategoria
                      INNER JOIN puesto pue ON pro.IdPuesto = pue.IdPuesto";
} else {
    // Si no es administrador, filtrar los productos por el puesto del usuario
    $sql_productos = "SELECT pro.*, ca.NombreCategoria, pue.NombrePuesto 
                      FROM producto pro
                      INNER JOIN categoria ca ON pro.IdCategoria = ca.IdCategoria
                      INNER JOIN puesto pue ON pro.IdPuesto = pue.IdPuesto
                      WHERE pro.IdPuesto = :IdPuesto"; // Filtrar por el puesto del usuario
}

// Preparar la consulta
$query_productos = $pdo->prepare($sql_productos);

// Si el usuario no es administrador, enlazar el parámetro del puesto
if ($rol_sesion != 'Administrador') {
    $query_productos->bindParam(':IdPuesto', $id_puesto_sesion, PDO::PARAM_INT);
}

// Ejecutar la consulta
$query_productos->execute();

// Obtener los datos de productos
$total_productos = $query_productos->rowCount();
$contador_de_producto = $total_productos + 1;
$total_productos_dashboard = $total_productos;
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);
