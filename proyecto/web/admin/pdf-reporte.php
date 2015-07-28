<?php require_once("../lib/dompdf/dompdf_config.inc.php");

    $URL = "http://www.seguridadlandia.com/api/alarmas-fecha";
    $alarmas = json_decode(file_get_contents($URL), true)[0];
    $auxFechas = "";
    $auxCantidad = "";
    foreach ($alarmas as $alarma) {
        $auxFechas .= $alarma[0] . ",";
        $auxCantidad .= $alarma[1] . ",";        
    }

    $fechas = rtrim($auxFechas, ',');
    $cantidad = rtrim($auxCantidad, ',');

    $lineas = '/web/admin/graficos/alarma-fecha.php?fechas=' . $fechas . '&cantidad=' . $cantidad; 


    $URL = "http://www.seguridadlandia.com/api/alarmas";
    $alarmas_factor = json_decode(file_get_contents($URL), true)[0];

    $torta = '/web/admin/graficos/alarmas-factor-barra.php?false=' . $alarmas_factor["falsa"] . '&real=' . $alarmas_factor["real"];
    $barra = '/web/admin/graficos/alarmas-factor-barra.php?false=' . $alarmas_factor["falsa"] . '&real=' . $alarmas_factor["real"]; 



$html = '<div><img class="cliente-barra" src=""></div>
<div><img class="cliente-torta" src=""></div>
<div><img class="alarmas-factor-torta" src=""></div>
<div><img class="alarmas-factor-barra" src=""></div>
<div><img class="alarmas-linea" src="' . $barra . '"></div>';


// echo $html;
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('letter', 'landscape');
$dompdf->render();
$dompdf->stream("reportes.pdf");