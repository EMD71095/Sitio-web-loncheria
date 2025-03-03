<?php
require_once 'modelo/Conexion.php';

$sql = "select * from ordenes_view;";
$query = Conexion::conectar()->query($sql);
$array = $query->fetch_all();

/* --- funciones php que permiten obtener fecha y hora ---- */
//America/Mexico_City
date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d");
$hora = date("h:i:s A");

/* ----- Configuración para generar el documento pdf ----- */
require_once('TCPDF/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GUERRERITO');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10, false);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('Helvetica', '', 10);
$pdf->addPage();
/* ----- Configuración para generar el documento pdf ----- */

/* --- la variable $contenido es un String con toda la estructura(html) 
    datos(php o calculos o variables) y estilos(CSS o estilos en linea) 
    que queremos en el documento ---*/
$contenido = '
        <table border="0" cellspacing="0" style="text-align: center;">
            <tr>
                <th><img src="img/logo.png" width="150px"/></th>
                <th text-align="center">
                    <h1 class="text-center">"El guerrerito"</h1>
                    <span>Gorditas al carbón y lonches</span>
                    <p>Calle 20 de Noviembre #256 col.Centro, Gómez Palacio, Mexico</p>
                    <h4>Reporte de venta</h4>
                </th>
                <th>Fecha de impresión:' . $fecha . '</th>
            </tr>
        </table>
        <br>
        <br>';
$contenido .= '
        <table border="1" cellspacing="0" style="text-align: center;">
            <tr>
                <th> Orden No:</th>
                <th> Cliente</th>
                <th> Fecha</th>
                <th> Total de la orden</th>
            </tr>';
$total = 0;
foreach ($array as $row => $item) {
    $contenido .= '
        <tr>
        <th> ' . $item[0] . '</th>
        <th> ' . $item[1] . '</th>
        <th> ' . $item[2] . '</th>
        <th> $ ' . $item[3] . '</th>
    </tr>
        ';
    $total += $item[3];
}
$contenido .= '        
        </table>
    ';

$contenido .= '  
    <h4>Total de ordenes en linea: $' . $total . '</h4>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p style="text-align: center;">Firma del administrador responsable</p>
    ';




/* -------------- configuracion de salida del pdf ------------------ */
$pdf->writeHTML($contenido, true, 0, true, 0);
$pdf->lastPage();
$nombreDoc = $fecha;
$pdf->output($nombreDoc . '.pdf', 'I');
