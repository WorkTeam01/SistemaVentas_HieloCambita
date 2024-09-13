<?php
// Incluye la biblioteca de TCPDF
require_once('../../App/TCPDF-main/tcpdf.php');
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarRoles(['Administrador', 'Vendedor']);

if (session_status() == PHP_SESSION_NONE)
    session_start();

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

function ceros($numero)
{
    $len = 0;
    $cantidad_ceros = 6;
    $aux = $numero;
    $pos = strlen($numero);
    $len = $cantidad_ceros - $pos;
    for ($i = 0; $i < $len; $i++) {
        $aux = "0" . $aux;
    }
    return $aux;
}

$nro_pedido = ceros($nro_pedido);

// Extraer día, mes y año de la fecha del pedido
$timestamp = strtotime($fecha_pedido);
$dia = date('d', $timestamp);
$mes = date('m', $timestamp);
$año = date('Y', $timestamp);

if (!empty($razon_social)) {
    $cliente = $razon_social;
} else {
    $cliente = $nombre_cliente;
}

// create new PDF document
$pdf = new TCPDF('L', 'mm', array(106, 151), true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hielo Cambita');
$pdf->SetTitle('Nota de Entrega');
$pdf->SetSubject('Nota de Entrega');
$pdf->setKeywords('Nota de Entrega');

// set margins
$pdf->setMargins(5, 5, 5);

// remove header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Agregar página
$pdf->AddPage();

// Establecer transparencia para la imagen (0 = totalmente transparente, 1 = totalmente opaco)
$pdf->SetAlpha(0.3); // Ajusta la opacidad de la imagen

// Agregar una imagen centrada como fondo, esta vez antes del contenido
$pdf->Image('../../Public/Img/logo_hielo_cambita_2.jpeg', 65, 50, 30, 0, '', '', '', true, 300, '', false, false, 0, true, false, false);

// Restablecer la opacidad a 100% (para el resto del contenido)
$pdf->SetAlpha(1);

// Crear el HTML con estilos en línea
$html = /*html*/ '
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    .header {
        text-align: center;
        color: #4CAF50;
        font-size: 20px;
        font-weight: bold;
    }
    .subheader {
        text-align: center;
        color: #FF6600;
        font-size: 14px;
    }
    .invoice-number {
        text-align: right;
        color: #FF0000;
        font-size: 14px;
    }
    .details td {
        border: 1px solid #4CAF50;
        padding: 5px;
    }
    .details th {
        background-color: #FFA500;
        color: white;
        border: 1px solid #4CAF50;
        padding: 5px;
        text-align: center;
        font-size: 12px;
    }
    .text {
        color: #4CAF50;
        font-size: 12px;
    }
    .firm {
        font-size: 10px;
    }
</style>

<table border="0">
    <tr>
        <td style="text-align: center; width: 20%">
            <img src="../../Public/Img/logo_hielo_cambita.jpeg" alt="Logo" width="70">
        </td>
        <td style="text-align: center; width: 80%">
            <br> <b class="header">NOTA DE ENTREGA</b> <br>
            <img src="../../Public/Img/whatsapp.jpg" alt="Whatsapp" width="12">
            <b class="subheader"> 78574507 - 60906058</b>
            <div class="invoice-number">Nº ' . $nro_pedido . '</div>
        </td>
    </tr>
</table>

<table border="0" cellpadding="2">
    <tr>
        <td style="width: 20%"></td>
        <td style="width: 45%; font-size: 13px; color: #4CAF50;"><b>Tipo de pago: </b>' . $tipo_pago . '</td>
        <td style="width: 35%; font-size: 13px; color: #4CAF50;"><b>Fecha:</b> &nbsp;&nbsp;&nbsp;&nbsp;' . $dia . ' / ' . $mes . ' / ' . $año . '</td>
    </tr>
</table>

<table border="0" cellpadding="3">
    <tr class="text">
        <td style="width: 60%"><b>Cliente:</b> ' . $cliente . '</td>
        <td style="width: 40%;"><b>Código Cliente:</b> ' . $id_cliente . '</td>
    </tr>
    <tr class="text">
        <td style="width: 60%"><b>Dirección:</b> _________________________________</td>
        <td style="width: 40%;"><b>Nº de factura:</b>_________________</td>
    </tr>
</table>

<br>

<table class="details" cellpadding="3">
    <tr>
        <th style="width: 15%">CANTIDAD</th>
        <th style="width: 55%">D E T A L L E</th>
        <th style="width: 10%">P.U.</th>
        <th style="width: 20%">PRECIO TOTAL</th>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

<!-- Aquí comienza una nueva tabla exclusiva para el total -->
<table cellpadding="2" style="color: #4CAF50; font-weight: bold; width: 100%;">
    <tr>
        <td style="width: 70%"></td>
        <td style="width: 10%; text-align: right; border: 1px solid #4CAF50">Total</td>
        <td style="width: 20%; border: 1px solid #4CAF50;">&nbsp;</td>
    </tr>
</table>

<br><br><br>

<table>
    <tr>
        <td class="firm" style="width: 35%; text-align: center; color: #4CAF50">
            ________________________<br>
            Recibí Conforme<br>
            Nombre: ________________
        </td>
        <td style="width: 30%"></td>
        <td class="firm" style="width: 40%; text-align: center; color: #4CAF50">
            ________________________<br>
            Recibí Conforme<br>
            Nombre: ________________
        </td>
    </tr>
</table>
';

// Escribir el HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y dar salida al PDF
$pdf->Output('nota_de_entrega.pdf', 'I');
