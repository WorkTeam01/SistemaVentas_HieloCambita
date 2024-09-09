<?php

// Include the main TCPDF library (search for installation path).
require_once('../../App/TCPDF-main/tcpdf.php');
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../App/Controllers/pedidos/literal.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

if (isset($_SESSION['sesion_user'])) {

    $user_session = $_SESSION['sesion_user'];
    $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, p.NombrePuesto, tip.RolUsuario FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario
                INNER JOIN puesto p on us.IdPuesto = p.IdPuesto
                WHERE Usuario = '$user_session' OR EmailUsuario = '$user_session'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['IdUsuario'];
        $usuario_sesion = $usuario['Usuario'];
        $nombres_sesion = $usuario['NombresUsuario'];
        $apellidos_sesion = $usuario['ApellidosUsuario'];
        $puesto_usuario_sesion = $usuario['NombrePuesto'];
        $rol_sesion = $usuario['RolUsuario'];
    }
}

$fecha_actual = date('d/m/Y');

$id_pedido_get = $_GET['id'];
$nro_pedido_get = $_GET['nro_pedido'];

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
    $celular_cliente = $pedidos_dato['CelularCliente'];
    $descuento_cliente = $pedidos_dato['DescuentoCliente'];
    $nombre_cliente = $pedidos_dato['NombreCliente'];
    $razon_social = $pedidos_dato['RazonSocial'];
    $id_puesto = $pedidos_dato['IdPuesto'];
    $nombre_puesto = $pedidos_dato['NombrePuesto'];
    $id_tipo_pago = $pedidos_dato['IdTipoPago'];
    $tipo_pago = $pedidos_dato['TipoPago'];
    $fecha_pedido = $pedidos_dato['FechaPedido'];
    $monto_pago = $pedidos_dato['MontoPago'];
    $estado_pedido = $pedidos_dato['EstadoPedido'];
}

if (!empty($razon_social)) {
    $cliente = $razon_social;
} else {
    $cliente = $nombre_cliente;
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Hielo Cambita');
$pdf->setTitle('Nota de Entrega');
$pdf->setSubject('Nota de Entrega');
$pdf->setKeywords('Nota de Entrega');

// remove header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(15, 15, 15);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('Helvetica', '', 12);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = /*html*/ '
<table border="0" style="font-size: 10px">
    <tr>
        <td style="text-align: center; width: 180px">
        <img src="../../Public/Img/user_default.jpg" alt="Imagen" width="70px"> <br><br>
            <b>SISTEMA DE VENTAS</b> <br>
            Tecer anillo interno, Av. Bush <br>
            3113646 - 78569885 <br>
            SANTA CRUZ - BOLIVIA
        </td>
        <td style="width: 179px"></td>
        <td style="font-size: 16px; width: 300px"><br><br><br><br>
            <b>Número factura: </b> ' . $id_pedido_get . ' <br>
            <b>Número de autorización: </b>565586565
            <p style="text-align: center"><B>ORIGINAL</B></p>
        </td>
    </tr>
</table>

<p style="text-align: center; font-size: 25px"><b>FACTURA</b></p>

<div>
    <table border="0" cellspacing="2">
        <tr>
            <td><b>Fecha: </b> ' . $fecha_actual . ' </td>
            <td></td>
            <td>
                <b>Celular: </b>' . $celular_cliente . '
            </td>
        </tr>
        <tr>
            <td colspan="3"><b>Nombre/Razon social: </b>' . $cliente . '</td>
        </tr>
    </table>
</div>

<br>

<table border="1" cellpadding="5" style="font-size: 12px">
    <tr style="text-align: center; background-color: #d6d6d6">
        <th style="width: 40px"><b>Nro</b></th>
        <th style="width: 120px"><b>Producto</b></th>
        <th style="width: 180px"><b>Descripción</b></th>
        <th style="width: 65px"><b>Cantidad</b></th>
        <th style="width: 100px"><b>Precio Unitario</b></th>
        <th style="width: 80px"><b>Descuento</b></th>
        <th style="width: 74px"><b>Sub Total</b></th>
    </tr>
';

$contador_de_detalles_pedido = 0;
$cantidad_total = 0;
$total_precio_unitario = 0;
$precio_total = 0;

$NroPedido = $pedidos_dato['NroPedido'];
$sql_detalle_pedido = "SELECT dtp.*, p.IdProducto, p.NombreProducto, p.DescripcionProducto, p.PrecioVenta, p.Stock FROM detalle_pedido dtp
                        INNER JOIN producto p on dtp.IdProducto = p.IdProducto
                        WHERE NroPedido = '$NroPedido' ORDER BY IdDetallePedido ASC";
$query_detalle_pedido = $pdo->prepare($sql_detalle_pedido);
$query_detalle_pedido->execute();
$detalle_pedido_datos = $query_detalle_pedido->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_pedido_datos as $detalle_pedido_dato) {
    $id_detalle_pedido = $detalle_pedido_dato['IdDetallePedido'];
    $nombre_producto = $detalle_pedido_dato['NombreProducto'];
    $descripcion_producto = $detalle_pedido_dato['DescripcionProducto'];
    $cantidad_productos = $detalle_pedido_dato['Cantidad'];
    $precio_unitario = $detalle_pedido_dato['PrecioVenta'];
    $contador_de_detalles_pedido += 1;
    $cantidad_total = $cantidad_total + $cantidad_productos;
    $total_precio_unitario = $total_precio_unitario + floatval($precio_unitario);
    $sub_total = (floatval($cantidad_productos) * floatval($precio_unitario)) - $descuento_cliente;
    $precio_total += $sub_total;
    $html .= /*html*/ '
    <tr>
        <td style="text-align: center">' . $contador_de_detalles_pedido . '</td>
        <td>' . $nombre_producto . '</td>
        <td>' . $descripcion_producto . '</td>
        <td style="text-align: center">' . $cantidad_productos . '</td>
        <td style="text-align: center">Bs. ' . $precio_unitario . '</td>
        <td style="text-align: center">Bs. ' . $descuento_cliente . '</td>
        <td style="text-align: center">Bs. ' . $sub_total . '</td>
    </tr>
    ';
}

// Convertir precio total a literal
// $monto_literal = numeroletras($total_pagado);
$monto_literal = numeroletras($precio_total);

$html .= /* html*/ '
    <tr style="background-color: #d6d6d6">
        <td colspan="3" style="text-align: right"><b>Total</b></td>
        <td style="text-align: center">' . $cantidad_total . '</td>
        <td style="text-align: center">Bs. ' . $total_precio_unitario . '</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">Bs. ' . $precio_total . '</td>
    </tr>
</table>

<p style="text-align: right"> <b>Monto Total: </b>Bs. ' . $precio_total . '</p>
<p><b>Son: </b>' . $monto_literal . '</p>
<br>
====================================== <br>
<b>Usuario: </b>' . $nombres_sesion . '
<p style="text-align: center"></p>
<p style="text-align: center">Esta factura contribuye al desarrollo del país, el uso ilícito de ésta será sancionado de acuerdo a la ley</p>
<p style="text-align: center">Gracias por su preferencia</p>
';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// Draw rounded rectangle
$pdf->RoundedRect(15, 80, 186, 15, 3.50, '1111', 'D');

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255, 255, 255)
    'module_width' => 1,
    'module_height' => 1
);

$QR = 'Factura realizada por el sistema de ventas, al cliente: ' . $cliente . ', con celular: ' . $celular_cliente . ',
en fecha: ' . $fecha_actual . ', con el monto total de: ' . $precio_total . ' Bs.';
$pdf->write2DBarcode($QR, 'QRCODE,L', 165, 200, 35, 35, $style);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
