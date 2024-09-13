<?php

// Verificar si el usuario es Administrador o si es de otro rol y debe ver solo los abastos de su puesto
if ($rol_sesion == 'Administrador') {
    // Si es administrador, obtiene todos los abastos
    $sql_abasto = "SELECT aba.IdAbasto, aba.NroAbasto, aba.ComprobanteAbasto, aba.PrecioAbasto, aba.CantidadAbasto, aba.FechaAbasto, aba.Notas, 
                    p.*, pro.NombreProveedor, pro.CelularProveedor, pro.TelefonoProveedor, pro.EmailProveedor, pro.DireccionProveedor, 
                    us.NombresUsuario, us.ApellidosUsuario, cat.NombreCategoria, pue.NombrePuesto
                    FROM abasto aba
                    INNER JOIN producto p ON aba.IdProducto = p.IdProducto
                    INNER JOIN proveedor pro ON aba.IdProveedor = pro.IdProveedor
                    INNER JOIN usuario us ON aba.IdUsuario = us.IdUsuario
                    INNER JOIN categoria cat ON p.IdCategoria = cat.IdCategoria
                    INNER JOIN puesto pue on aba.IdPuesto = pue.IdPuesto";
} else {
    // Si no es administrador, filtrar los abastos por el puesto del usuario
    $sql_abasto = "SELECT aba.IdAbasto, aba.NroAbasto, aba.ComprobanteAbasto, aba.PrecioAbasto, aba.CantidadAbasto, aba.FechaAbasto, aba.Notas, 
                    p.*, pro.NombreProveedor, pro.CelularProveedor, pro.TelefonoProveedor, pro.EmailProveedor, pro.DireccionProveedor, 
                    us.NombresUsuario, us.ApellidosUsuario, cat.NombreCategoria, pue.NombrePuesto
                    FROM abasto aba
                    INNER JOIN producto p ON aba.IdProducto = p.IdProducto
                    INNER JOIN proveedor pro ON aba.IdProveedor = pro.IdProveedor
                    INNER JOIN usuario us ON aba.IdUsuario = us.IdUsuario
                    INNER JOIN categoria cat ON p.IdCategoria = cat.IdCategoria
                    INNER JOIN puesto pue on aba.IdPuesto = pue.IdPuesto
                    WHERE aba.IdPuesto = :IdPuesto"; // Filtrar por el puesto del usuario
}

// Preparar la consulta
$query_abasto = $pdo->prepare($sql_abasto);

// Si el usuario no es administrador, enlazar el parámetro del puesto
if ($rol_sesion != 'Administrador') {
    $query_abasto->bindParam(':IdPuesto', $id_puesto_sesion, PDO::PARAM_INT);
}

// Ejecutar la consulta
$query_abasto->execute();

// Obtener los datos de abastos
$contador_de_abasto = $query_abasto->rowCount() + 1;
$total_abasto = $query_abasto->rowCount();
$abasto_datos = $query_abasto->fetchAll(PDO::FETCH_ASSOC);

// En tu controlador PHP
$sql_puestos = "SELECT IdPuesto, NombrePuesto FROM puesto ORDER BY IdPuesto DESC";
$query_puestos = $pdo->query($sql_puestos);
$puestos_datos = $query_puestos->fetchAll(PDO::FETCH_ASSOC);
