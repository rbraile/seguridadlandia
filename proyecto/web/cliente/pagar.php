<!DOCTYPE html>
<html>
<head>
    <title>Pago</title>
    <meta charset="utf-8" /> 
<?php include("../include/bootstrap.php");?>
<script src="../js/lib/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/pago.css" />
<script type="text/javascript" src="js/pago.js"></script>
</head>
<body>

<div class="pago">
    <div class="contenedor clearfix">
        <div class="left"> 
            <h3>Detalles de pago</h3>
            <p>Nombre Completo: <strong><?php echo $_POST["nombre"];?></strong></p>
            <p>Dirección: <strong><?php echo $_POST["dire"];?></strong></p>
            <p>Importe:  <strong><?php echo $_POST["importe"];?></strong></p>
            <div><label>Visa</label><input type="checkbox" /></div>
            <div><label>MasterCard</label><input type="checkbox" /></div>
            <input type="number" name="numero" />
        </div>
        <div class="acciones">
            <a data-id="<?php echo $_POST["id"];?>" class="aceptar-pago btn btn-default" href="#">Pagar</a>
            <a class="cancelar-pago btn btn-default" href="#">Cancelar</a>
        </div>
        <div class="right">
            <img class="tarjetas" src="../images/images.png" alt="formas de pago" />
        </div>
    </div>
</div>

<div class="success hide">
    <div class="success-msg alert alert-success" role="alert">
        <h2>Su pago a sido procesado con exito</h2>
        <img src="../images/ok.png" alt="ok" />
    </div>
</div>

<div class="error hide">
    <div class="alert alert-danger" role="alert">
        <p>No se pudo procesar correctamente su pago, intentelo nuevamente en unos minutos</p>
    </div>
</div>

</body>
</html>