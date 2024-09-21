<?php

// Verificar si el usuario es Administrador o si es de otro rol y debe ver solo los pedidos de su puesto
if ($rol_sesion == 'Administrador') {
    // Si es administrador, obtiene todos los pedidos
    $sql_pedidos = "SELECT pe.*, c.IdCliente, c.CelularCliente, c.DescuentoCliente, cn.NombreCliente, cj.RazonSocial, p.IdPuesto, p.NombrePuesto, tp.IdTipoPago, tp.TipoPago
                    FROM pedido pe
                    INNER JOIN cliente c ON pe.IdCliente = c.IdCliente
                    LEFT JOIN cnatural cn ON c.IdCliente = cn.IdCliente
                    LEFT JOIN cjuridico cj ON c.IdCliente = cj.IdCliente
                    INNER JOIN puesto p ON p.IdPuesto = pe.IdPuesto
                    INNER JOIN tipo_pago tp ON pe.IdTipoPago = tp.IdTipoPago";
} else {
    // Si no es administrador, filtrar los pedidos por el puesto del usuario
    $sql_pedidos = "SELECT pe.*, c.IdCliente, c.CelularCliente, c.DescuentoCliente, cn.NombreCliente, cj.RazonSocial, p.IdPuesto, p.NombrePuesto, tp.IdTipoPago, tp.TipoPago
                    FROM pedido pe
                    INNER JOIN cliente c ON pe.IdCliente = c.IdCliente
                    LEFT JOIN cnatural cn ON c.IdCliente = cn.IdCliente
                    LEFT JOIN cjuridico cj ON c.IdCliente = cj.IdCliente
                    INNER JOIN puesto p ON p.IdPuesto = pe.IdPuesto
                    INNER JOIN tipo_pago tp ON pe.IdTipoPago = tp.IdTipoPago
                    WHERE pe.IdPuesto = :IdPuesto"; // Filtrar por el puesto del usuario
}

// Preparar la consulta
$query_pedidos = $pdo->prepare($sql_pedidos);

// Si el usuario no es administrador, enlazar el parámetro del puesto
if ($rol_sesion != 'Administrador') {
    $query_pedidos->bindParam(':IdPuesto', $id_puesto_sesion, PDO::PARAM_INT);
}

// Ejecutar la consulta
$query_pedidos->execute();

// Obtener los datos de pedidos
$total_pedidos = $query_pedidos->rowCount();
// Obtener el último número de pedido
$sql_ultimo_pedido = "SELECT MAX(NroPedido) as ultimo_pedido FROM pedido";
$query_ultimo_pedido = $pdo->prepare($sql_ultimo_pedido);
$query_ultimo_pedido->execute();
$resultado_ultimo_pedido = $query_ultimo_pedido->fetch(PDO::FETCH_ASSOC);

// Incrementar el contador para el nuevo pedido
$contador_de_pedidos = $resultado_ultimo_pedido['ultimo_pedido'] + 1;
$pedidos_datos = $query_pedidos->fetchAll(PDO::FETCH_ASSOC);

// En tu controlador PHP
$sql_puestos = "SELECT IdPuesto, NombrePuesto FROM puesto ORDER BY IdPuesto DESC";
$query_puestos = $pdo->query($sql_puestos);
$puestos_datos = $query_puestos->fetchAll(PDO::FETCH_ASSOC);
