<?php include_once("../include/verify-cliente.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("../include/bootstrap.php"); ?>
    <?php include("../include/header.php");?>
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
           
      </div><!-- /.panel panel-default -->

      <!-- FOOTER -->
      <footer class="panel panel-default">
        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


</body>
</html>