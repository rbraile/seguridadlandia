<?php include_once("../include/verify-cliente.php");?>
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
        .pagar-factura {
            display: inline-block;
        }
    </style>
    <script type="text/javascript" src="js/factura.js"></script>
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
                <p class="numero-factura">Numero de factura <span><?php echo $_GET["id_factura"];?></span></p>
                <p class="fecha">Fecha: <span></span></p>
            </div>
            <div class="cliente">
                <h4>Cliente:</h4>
                <p class="nombre">Nombre: <?php echo $_SESSION["nya"];?></p>
                <p class="calle">Dirección: <?php echo $_SESSION["dire"];?></p>
                <p class="telefono">Telefono: <?php echo $_SESSION["telefono"];?></p>
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
               
            </tbody>
        </table>
    </div>
    <br />
    <a class="btn btn-default" href="pdf.php?id=<?php echo $_GET['id_factura'];?>">Descargar pdf</a>
    <form class="pagar-factura" action="pagar.php" method="POST">
        <input type="hidden" name="importe" value="" />
        <input type="hidden" name="fecha" value="" />
        <input type="hidden" name="nombre" value="" />
        <input type="hidden" name="dire" value="" />
        <input type="hidden" name="pago" value="" />
        <input type="hidden" name="id" value="<?php echo $_GET['id_factura'];?>" />
        <input class="btn btn-default" type="submit" value="Pagar factura" />
    </form>
    <a class="btn btn-default" href="/web/cliente/facturas.php?id=<?php echo $_SESSION['user_id'];?>">Volver</a>
</div>
</body>
</html>