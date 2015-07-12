<?php require_once("../lib/dompdf/dompdf_config.inc.php");

 include_once("../include/verify-cliente.php"); 
    $id = $_SESSION["user_id"];
        $URL = "http://www.seguridadlandia.com/api/factura-cliente/$id";
        $factura = json_decode(file_get_contents($URL), true)[0];
        $fecha = $factura["fecha"];

$html = "<!DOCTYPE html><html>
<head>
</head>
<body>
<div class='contenedor clearfix' style='width:960px;margin:20px auto;padding: 20px; border: 2px solid #ccc;'>
    <table width='960px'>
        <tr><td  width='50%'><p style='margin-bottom: 0'>Seguridadlandia S.A.</p></td><td width='50%'><p class='numero-factura'>Numero de factura <span>" . $factura['id'] ."</span></p></td></tr>
        <tr><td  width='50%'><p style='margin-bottom: 0'>Dr. Ignacio Arieta 3000</p></td><td width='50%'><p class='numero-factura'>Numero de factura <span>" . $factura['id'] . "</span></p></td></tr>
        <tr><td  width='50%'><p style='margin-bottom: 0'>Codigo postal 1754</p></td><td width='50%'><p class='fecha'>Fecha: <span>" . $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] . "</span></p></td></tr>
        <tr><td  width='50%'><p style='margin-bottom: 0'>0810-3030-333</p></td><td width='50%'><p class='nombre'>Nombre:" . $factura['nombre'] . ' ' . $factura['apellido'] . " </p></td></tr>
        <tr><td  width='50%'><p style='margin-bottom: 0'>La matanza, Buenos Aires</p></td><td width='50%'><p class='calle'>Direccion:" . $factura['calle'] . $factura['numero'] . "</p></td></tr>
        <tr><td  width='50%'></td><td width='50%'><p class='telefono'>Telefono:" . $factura['telefono'] . "</p></td></tr>
    </table>
    <div class='content'>
        <table style='width: 700px;border: 1px solid #000'>
            <thead style='background-color: #ccc;' width='700px'>
                <tr>
                    <th style='width:15%;text-align: center; height:30px;'>Concepto</th>
                    <th style='width:15%;text-align: center; height:30px;'>Cantidad</th>
                    <th style='width:15%;text-align: center; height:30px;'>Precio</th>
                    <th style='width:15%;text-align: center; height:30px;'>Importe</th>
                </tr>
            </thead>
            <tbody class='detalle'>";                             
            $rows = explode('/', $factura['detalle']);
            $html_rows = "";
            foreach($rows AS $row) {
                if($row != '') {
                    $item = explode(',', $row);
                    $cantidad = intval($item[1]);
                    $precio= intval($item[2]);
                    $importe = $precio * $cantidad;
                    $html_rows .= "<tr style='height: 30px;text-align:center;border-bottom: 1px solid #ccc'><td> $item[0]</td><td>$precio </td><td>$cantidad</td><td>$importe</td></tr>";
                }
            }
$html .= $html_rows;
$html .= "<tr bgcolor='#ccc' style='background-color:#ccc;text-align:right;'>
            <td></td><td></td>
            <td><strong>TOTAL</strong></td>
            <td><strong style='padding-right: 10px;'>" . $factura["importe"] . "</strong></td></tr>";
$html .= "</tbody></table></div></div></body></html>";

// echo $html;
$factura_nombre = "factura-" . $factura['id'] . ".pdf"; 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('letter', 'landscape');
$dompdf->render();
$dompdf->stream($factura_nombre);