<?php

$id_pedido_get = $_GET['id'];

$sql_pedidos = "SELECT pe.*, c.IdCliente, c.CelularCliente, c.DescuentoCliente, cn.NombreCliente, cj.RazonSocial, p.IdPuesto, p.NombrePuesto, tp.IdTipoPago, tp.TipoPago
            FROM pedido pe
            INNER JOIN cliente c on pe.IdCliente = c.IdCliente
            LEFT JOIN cnatural cn on c.IdCliente = cn.IdCliente
            LEFT JOIN cjuridico cj on c.IdCliente = cj.IdCliente
            INNER JOIN puesto p on p.IdPuesto = p.IdPuesto
            INNER JOIN tipo_pago tp on pe.IdTipoPago = tp.IdTipoPago
            WHERE pe.IdPedido = '$id_pedido_get'";

$query_pedidos = $pdo->query($sql_pedidos);
$query_pedidos->execute();
$contador_de_pedidos = $query_pedidos->rowCount() + 1;
$total_de_pedidos = $query_pedidos->rowCount();
$pedidos_datos = $query_pedidos->fetchAll(PDO::FETCH_ASSOC);

foreach ($pedidos_datos as $pedidos_dato) {
    $nro_pedido = $pedidos_dato['NroPedido'];
    $id_cliente = $pedidos_dato['IdCliente'];
    $id_puesto = $pedidos_dato['IdPuesto'];
    $id_tipo_pago = $pedidos_dato['IdTipoPago'];
    $tipo_pago = $pedidos_dato['TipoPago'];
    $fecha_pedido = $pedidos_dato['FechaPedido'];
    $monto_pago = $pedidos_dato['MontoPago'];
    $estado_pedido = $pedidos_dato['EstadoPedido'];
}
