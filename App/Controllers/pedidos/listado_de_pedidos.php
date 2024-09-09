<?php

$sql_pedidos = "SELECT pe.*, c.IdCliente, c.CelularCliente, c.DescuentoCliente, cn.NombreCliente, cj.RazonSocial, p.IdPuesto, p.NombrePuesto, tp.IdTipoPago, tp.TipoPago
            FROM pedido pe
            INNER JOIN cliente c on pe.IdCliente = c.IdCliente
            LEFT JOIN cnatural cn on c.IdCliente = cn.IdCliente
            LEFT JOIN cjuridico cj on c.IdCliente = cj.IdCliente
            INNER JOIN puesto p on p.IdPuesto = pe.IdPuesto
            INNER JOIN tipo_pago tp on pe.IdTipoPago = tp.IdTipoPago";

$query_pedidos = $pdo->query($sql_pedidos);
$query_pedidos->execute();
$contador_de_pedidos = $query_pedidos->rowCount() + 1;
$total_pedidos = $query_pedidos->rowCount();
$pedidos_datos = $query_pedidos->fetchAll(PDO::FETCH_ASSOC);
