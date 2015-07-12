<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>
<?php 
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $URL = "http://www.seguridadlandia.com/api/usuario/$id";
        $usuario = json_decode(file_get_contents($URL), true);
        if(!$usuario) {
            ?>
                <script type="text/javascript">
                    $(".error").show();
                    $(".error p").html("el usuario no existe");
                    var url = "/web/admin";
                    setTimeout(function(){window.location = url;}, 2000); 
                </script>
            <?php
        } 
    } else {
        $usuario = false;
    }
?>
    <div class="container-general">
        <?php include_once("navbar.php"); ?>
        <div class="form-container">
            <div class="message alert alert-success hide" role="alert">
                <p>Usuario registrado correctamente</p>
            </div>
            <div class="error alert alert-danger hide" role="alert">
                <p>No se pudo registrar el usuario intentelo nuevamente</p> 
            </div>
            <form id="editar-usuario" method="POST">
                <label>Tipo de usuario</label>
                <input id="tipo_usuario" name="tipo_usuario" placeholder="<?php if($usuario) {echo $usuario[0]['tipo_usuario'];}?>" disabled=disabled />
                <div class="form-group">
                    <label for="nombre">Nombre:</label> 
                    <input id="nombre" value="<?php if($usuario && $usuario[0]["nombre"] ){ echo $usuario[0]["nombre"];}else{echo 'Nombre';}?>" tipe="text" name="nombre" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label> 
                    <input id="apellido" value="<?php if($usuario && $usuario[0]["apellido"] ){ echo $usuario[0]["apellido"];}else{echo 'Apellido';}?>" tipe="text" name="apellido" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="email">email:</label> 
                    <input type="email" name="email" value="<?php if($usuario && $usuario[0]["email"] ){ echo $usuario[0]["email"];}else{echo 'Email';}?>" id="exampleInputEmail1" class="form-control">
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono:</label> 
                    <input type="number" name="telefono" value="<?php if($usuario && $usuario[0]["telefono"] ){ echo $usuario[0]["telefono"];}else{echo 'Telefono';}?>" id="telefono" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label for="calle">Calle:</label> 
                    <input type="text" name="calle" value="<?php if($usuario && $usuario[0]["calle"]){ echo $usuario[0]["calle"];}else{echo 'Calle';}?>" id="calle" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label for="numero">Numeración:</label> 
                    <input type="number" name="numero" value="<?php if($usuario && $usuario[0]["numero"]){ echo $usuario[0]["numero"];}else{echo 'Numero';}?>" id="numero" class="form-control" />
                </div>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="dni">DNI:</label> 
                    <input type="number" name="dni" value="<?php if($usuario && $usuario[0]["dni"] ){ echo $usuario[0]["dni"];}else{echo 'DNI';}?>" id="dni" class="form-control" /> <br />
                </div>
                <input class="btn btn-default" type="submit" name="editar" value="<?php if($usuario){ echo 'Editar';}else{echo 'Registrar';}?>" />
                <a class="delete-user btn btn-default" data-id="<?php echo $id;?>" href="#">Borrar usuario</a>
            </form>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>