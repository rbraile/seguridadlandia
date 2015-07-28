<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
</head>
<body>
    <div class="container-general">
        <?php include_once("navbar.php"); ?>
        <div class="container">
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">listado de usuarios</div>
                    <div class="usuarios panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Apellido</th>
                                  <th>Tipo de usuario</th>
                                  <th>ver</th>
                                  <th>Contrato</th>
                                  <th>Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Acciones</h3>
                  </div>
                  <div class="panel-body">
                    <a class="" href="registro.php">Ingresar un nuevo usuario</a>
                  </div>
                </div>
            </div>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>