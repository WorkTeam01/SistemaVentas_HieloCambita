<?php
// Incluye la biblioteca de TCPDF
require_once('../../App/TCPDF-main/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hielo Cambita');
$pdf->SetTitle('Nota de Entrega');
$pdf->SetSubject('Nota de Entrega');

// set margins
$pdf->setMargins(10, 10, 10);

// remove header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Agregar página
$pdf->AddPage();

// Crear el HTML con estilos en línea
$html = /*html*/ '
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    .header {
        text-align: center;
        color: #FF6600;
        font-size: 24px;
        font-weight: bold;
    }
    .subheader {
        text-align: center;
        color: #4CAF50;
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
        font-weight: bold;
    }
</style>

<table>
    <tr>
        <td class="header">HIELO hc Cambita</td>
    </tr>
    <tr>
        <td class="subheader">NOTA DE ENTREGA</td>
    </tr>
    <tr>
        <td class="subheader">WhatsApp: 78574507 - 60906058</td>
    </tr>
</table>

<div class="invoice-number">No. 00430</div>

<table>
    <tr>
        <td>CONTADO [ ] CREDITO [ ]</td>
        <td>Fecha: ___/___/____</td>
    </tr>
    <tr>
        <td>Cliente: _________________________</td>
        <td>Código Cliente: __________________</td>
    </tr>
    <tr>
        <td>Dirección: _______________________</td>
        <td>No. de factura: __________________</td>
    </tr>
</table>

<br><br>

<table class="details" cellpadding="5">
    <tr>
        <th>CANTIDAD</th>
        <th>DETALLE</th>
        <th>P.U.</th>
        <th>PRECIO TOTAL</th>
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
    <tr>
        <td colspan="3" style="text-align: right; color:green; font-weight: bold">Total</td>
        <td>&nbsp;</td>
    </tr>
</table>

<br><br><br><br>

<table>
    <tr>
        <td style="width: 50%; text-align: center; color:green">
            ________________________<br>
            Recibí Conforme<br>
            Nombre: ________________
        </td>
        <td style="width: 50%; text-align: center; color:green">
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
