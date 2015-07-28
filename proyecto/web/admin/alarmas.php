<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
</head>
<body>
<div class="container cliente">
    <div class="panel panel-default">
        <div class="row"> 
            <?php include_once("navbar.php"); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="panel panel-default">
    <div class="row listado-de-alarmas">
        <div class="alarmas-list">
        <input type="text" name="id" class="valor" />
        <select class="selector">
            <option value=" id_cliente">N° de cliente</option>
            <option value="factor_alarma">Tipo de alarma</option>
            <option value="fecha">Fecha</option>
        </select>
        <input type="button" name="filtrar" value="Filtrar" class="filtro" />
            <table class="table">
                <thead>
                    <tr>
                        <th>N° de Cliente</th>
                        <th>Factor de alarma</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="listado-alarmas">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <?php include_once("footer.php"); ?>
</div><!-- /.container -->

</body>
</html>
