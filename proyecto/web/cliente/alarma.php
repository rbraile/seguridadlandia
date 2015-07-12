<?php include_once("../include/verify-cliente.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("../include/bootstrap.php"); ?>
    <script type="text/javascript" src="http://www.seguridadlandia.com/web/cliente/js/webservice.js"></script>
</head>
<body>
    <div class="container cliente">
      <!-- Three columns of text below the carousel -->

      <div class="panel panel-default">
        <div class="row title-qr">
            <div class="col-sm-12">
                <h1>Bienvenido <?php echo $_SESSION["user_type"];?></h1>
            </div>
            <div class="qr">
                <?php echo '<img src="../cliente/qr.php" />';?>
            </div>
            
        <div class="row">
            <?php include("navbar.php");?>
        </div>

        </div>
            <ul class="botonera">
                <li class=""><a class="btn btn-default btn-lg alert-danger" href="#">Disparar Alarma</a></li>
                <li><a class="btn btn-default btn-lg alert-danger" href="tel:<?php echo $_SESSION["telefono"];?>">Realizar llamada al 911</a></li>
            </ul>
      </div><!-- /.panel panel-default -->

       <div id="camaras" class="collapse">
            <div class="panel panel-default">            
                <img src="/web/images/monitoreo-camara.jpg">   
           </div>
       </div> 

      <!-- FOOTER -->
      <footer class="panel panel-default">
        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


</body>
</html>