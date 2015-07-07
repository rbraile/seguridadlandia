<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
    <script type="text/javascript" src="/web/admin/js/contrato.js"></script>
    <link rel="stylesheet" type="text/css" href="/web/admin/css/contrato.css">
    <link rel="stylesheet" type="text/css" href="/web/admin/css/header.css">
<body>
    <?php
        $id = $_GET["id"];
        $apellido = $_GET["apellido"];
    ?>
    <div class="container-general">
        <?php include_once("navbar.php"); ?>
        <div class="container">
            <div class="col-md-13">
                <div class="panel panel-default">
                    <div class="panel-heading">Formulario de alta de contrato</div>
                    <div class="usuarios panel-body">
                        <h2>Creación de contrato para el usuario <strong><?php echo $apellido?></strong></h2>
                        <div class="hide error alert alert-danger" role="alert">
                            <p>Este usuario no existe o no tiene hogar relacionado verifique sus datos</p>
                        </div>
                        <div class="hide message alert alert-success" role="alert">
                            <p>Este usuario no existe o no tiene hogar relacionado verifique sus datos</p>
                        </div>
                        <form id="agregar-contrato" method="POST">
                            <select class="plan" name="plan">
                            </select>
                            <div class="descripcion">
                            </div>
                            <h3>Dirección</h3>
                            <label>Calle</label>
                            <input class="calle" type="text" value="" name="calle" disabled="disabled" />
                            <br />
                            <label>numero</label>
                            <input class="numero" type="text" value="" name="numero" disabled="disabled" />
                            <br />
                            <input type="hidden" value="<?php echo $id;?>" name="id_cliente" />
                            <input class="id_hogar" type="hidden" value="" name="id_hogar" />
                            <br />  
                            <br />  
                            <input type="submit" name="enviar" value="Enviar" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>