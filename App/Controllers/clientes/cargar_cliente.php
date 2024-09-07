<?php

$id_cliente_get = $_GET['id'];

$sql_clientes = "SELECT c.IdCliente, c.CelularCliente, c.DescuentoCliente, cj.RazonSocial, cj.RepresentanteLegal, cj.EmailJuridico, cn.NombreCliente, cn.Genero
                FROM cliente c
                LEFT JOIN cjuridico cj on c.IdCliente = cj.IdCliente
                LEFT JOIN cnatural cn on c.IdCliente = cn.IdCliente
                WHERE c.IdCliente = '$id_cliente'";

$query_clientes = $pdo->query($sql_clientes);
$query_clientes->execute();
$total_clientes = $query_clientes->rowCount();
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

foreach ($clientes_datos as $clientes_dato) {
    $id_cliente = $clientes_dato['IdCliente'];
    $celular_cliente = $clientes_dato['CelularCliente'];
    $descuento_cliente = $clientes_dato['DescuentoCliente'];
    $razon_social = $clientes_dato['RazonSocial'];
    $representante_legal = $clientes_dato['RepresentanteLegal'];
    $email_juridico = $clientes_dato['EmailJuridico'];
    $nombre_cliente = $clientes_dato['NombreCliente'];
    $genero_cliente = $clientes_dato['Genero'];
}
