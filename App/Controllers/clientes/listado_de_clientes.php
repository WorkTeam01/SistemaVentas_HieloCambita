<?php

$sql_clientes = "SELECT c.IdCliente, c.CelularCliente, c.DescuentoCliente, cj.RazonSocial, cj.RepresentanteLegal, cj.EmailJuridico, cn.NombreCliente, cn.Genero
                FROM cliente c
                LEFT JOIN cjuridico cj on c.IdCliente = cj.IdCliente
                LEFT JOIN cnatural cn on c.IdCliente = cn.IdCliente";

$query_clientes = $pdo->query($sql_clientes);
$query_clientes->execute();
$total_clientes = $query_clientes->rowCount();
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
