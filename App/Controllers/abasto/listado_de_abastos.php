<?php

$sql_abasto = "SELECT aba.IdAbasto, aba.NroAbasto, aba.ComprobanteAbasto, aba.PrecioAbasto, aba.CantidadAbasto, aba.FechaAbasto, aba.Notas, p.*, pro.NombreProveedor,
                pro.CelularProveedor, pro.TelefonoProveedor, pro.EmailProveedor, pro.DireccionProveedor, us.NombresUsuario, us.ApellidosUsuario, cat.NombreCategoria
                FROM abasto aba
                INNER JOIN producto p ON aba.IdProducto = p.IdProducto
                INNER JOIN proveedor pro ON aba.IdProveedor = pro.IdProveedor
                INNER JOIN usuario us ON aba.IdUsuario = us.IdUsuario
                INNER JOIN categoria cat ON p.IdCategoria = cat.IdCategoria";

$query_abasto = $pdo->query($sql_abasto);
$query_abasto->execute();
$contador_de_abasto = $query_abasto->rowCount() + 1;
$total_abasto = $query_abasto->rowCount();
$abasto_datos = $query_abasto->fetchAll(PDO::FETCH_ASSOC);
