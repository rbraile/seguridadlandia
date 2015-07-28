<?php 
include_once("verify.php"); 
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        header("location: /");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrador</title>
    <?php include_once("header.php"); ?>
</head>
<body>
<div class="container envio-factura">
    <div class="panel panel-default">
        <div class="row"> 
            <?php include_once("navbar.php"); ?>
        </div>
    </div>
</div>

<div class="container">
    
</div>

<div class="container marketing">
    <?php include_once("footer.php"); ?>
</div><!-- /.container -->

</body>
</html>
