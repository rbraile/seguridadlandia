<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
</head>
<body>
    <div class="container">
        <?php include_once("navbar.php"); ?>
        <div class="container facturas-content">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">listado de facturas</div>
                    <div class="panel-body">
                        <table id="facturas" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:33%">N° Factura</th>
                                    <th style="width:33%">Fecha</th>
                                    <th style="width:33%">Pago</th>
                                    <th style="width:33%">Ver</th>
                                </tr>
                            </thead>
                           <tbody></tbody>
                           <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                
            </div>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>