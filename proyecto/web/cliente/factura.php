<?php include_once("../include/verify-cliente.php"); 
    $id = $_SESSION["user_id"];
        $URL = "http://www.seguridadlandia.com/api/factura-cliente/$id";
        $factura = json_decode(file_get_contents($URL), true)[0];
        $fecha = $factura["fecha"];

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("../include/bootstrap.php"); ?>
    <?php include("../include/header.php");?>
    <style type="text/css">
        .clearfix:after {
             visibility: hidden;
             display: block;
             font-size: 0;
             content: " ";
             clear: both;
             height: 0;
             }
        .clearfix { display: inline-block; }
        /* start commented backslash hack \*/
        * html .clearfix { height: 1%; }
        .clearfix { display: block; }
        /* close commented backslash hack */
    </style>
</head>
<body>
<div class="contenedor clearfix" style="width:960px;margin:20px auto;padding: 20px; border: 2px solid #ccc;">
    <div class="header clearfix" style="clear: both">
        <div class="hide error alert alert-danger" role="alert">
            <p>Este usuario no existe o no tiene hogar relacionado verifique sus datos</p>
        </div>
        <div class="hide message alert alert-success" role="alert">
            <p>Este usuario no existe o no tiene hogar relacionado verifique sus datos</p>
        </div>
        <div class="left" style="float:left; background-color: #ccc;padding: 20px;width: 40%">
            <p style="margin-bottom: 0">Seguridadlandia S.A.</p>
            <p style="margin-bottom: 0">Dr. Ignacio Arieta 3000</p>
            <p style="margin-bottom: 0">Codigo postal 1754</p>
            <p style="margin-bottom: 0">0810-3030-333</p>
            <p style="margin-bottom: 0">La matanza, Buenos Aires</p>
        </div>
        <div class="right" style="float:right; width: 40%;">
            <div class="factura-fecha" style=" background-color: #ccc;padding: 20px; border: 1px solid #999;">
                <p class="numero-factura">Numero de factura <span><?php echo $factura["id"];?></span></p>
                <p class="fecha">Fecha: <span><?php echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];?></span></p>
            </div>
            <div class="cliente">
                <h4>Cliente:</h4>
                <p class="nombre">Nombre: <?php echo $factura["nombre"] . " " . $factura["apellido"]?></p>
                <p class="calle">Dirección: <?php echo $factura["calle"] . " " . $factura["numero"]?></p>
                <p class="telefono">Telefono: <?php echo $factura["telefono"];?></p>
            </div>
        </div>
    </div>
    <div class="content">
        <table style="width: 100%;border: 1px solid #000">
            <thead style="background-color: #ccc;">
                <tr>
                    <th style="width:25%;text-align: center; height:30px;">Concepto</th>
                    <th style="width:25%;text-align: center; height:30px;">Cantidad</th>
                    <th style="width:25%;text-align: center; height:30px;">Precio</th>
                    <th style="width:25%;text-align: center; height:30px;">Importe</th>
                </tr>
                <tbody class="detalle"></tbody>
                <tfoot style="background-color: #ccc;height:35px;" class="total"></tfoot>
            </thead>
            <tbody>                
                <?php
                    $rows = explode("/", $factura["detalle"]);
                    $total = $factura["importe"];
                    foreach($rows AS $row) {
                        if($row != "") {
                            $item = explode(",", $row);
                            $precio = intval($item[1]);
                            $cantidad = intval($item[2]);
                            $importe = $precio * $cantidad;
                            echo "<tr style='height: 30px;text-align:center;border-bottom: 1px solid #ccc'><td>" . $item[0] . "</td><td>" . $precio . "</td><td>" . $cantidad . "</td><td>" . $importe . "</td></tr>";
                        }
                    }
                    echo "<tr style='background-color:#ccc;text-align:right;'><td></td><td></td><td><strong>TOTAL</strong></td><td><strong style='padding-right: 10px;'>" . $total . "</strong></td>";
                ?>
            </tbody>
        </table>
    </div>
    <br />
    <a class="btn btn-default" href="pdf.php">Descargar pdf</a>
    <a class="btn btn-default" href="index.php">Volver</a>
</div>
</body>
</html>