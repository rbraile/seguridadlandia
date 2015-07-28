<?php include_once("../include/verify-cliente.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("../include/bootstrap.php"); ?>
    <?php include("../include/header.php");?>
    <script type="text/javascript" src="/web/cliente/js/facturas.js"></script>
</head>
<body>
    <div class="container cliente page-facturas">
        <div class="panel panel-default">
            <div class="row title-qr">        
                <?php include("navbar.php");?>
            </div>
        </div><!-- /.panel panel-default -->

          </div>
        <div class="container">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="panel panel-default contenido">
                        <div class="panel-heading">listado de facturas</div>
                        <div class="panel-body">
                            <table id="facturas" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:33%">N° Factura</th>
                                        <th style="width:33%">Fecha</th>
                                        <th style="width:33%">Estado</th>
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
              <!-- FOOTER -->
      <?php include("footer.php"); ?>
    </div>
</body>
</html>