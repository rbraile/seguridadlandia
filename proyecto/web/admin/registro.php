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
            <div class="message alert alert-success" role="alert">
                <p>Usuario registrado correctamente</p>
            </div>
            <div class="error alert alert-danger" role="alert">
                <p>No se pudo registrar el usuario intentelo nuevamente</p> 
            </div>
            <form id="register" method="POST">
                <label>Tipo de usuario</label>
                <select id="tipo_usuario" name="tipo_usuario">
                    <option value="cliente" <?php if($usuario && $usuario[0]["tipo_usuario"] == 'cliente'){ echo 'selected';}?> >Cliente</option>
                    <option value="vigilador" <?php if($usuario && $usuario[0]["tipo_usuario"] == 'vigilador'){ echo 'selected';}?>>Vigilador</option>
                    <option value="monitoreador" <?php if($usuario && $usuario[0]["tipo_usuario"] == 'monitoreador'){ echo 'selected';}?>>Monitoreador</option>
                    <option value="admin" <?php if($usuario && $usuario[0]["tipo_usuario"] == 'admin'){ echo 'selected';}?>>Administrador</option>
                </select>
                <div class="form-group">
                    <label for="nombre">Nombre:</label> 
                    <input id="nombre" placeholder="<?php if($usuario && $usuario[0]["nombre"] ){ echo $usuario[0]["nombre"];}else{echo 'Nombre';}?>" tipe="text" name="nombre" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label> 
                    <input id="apellido" placeholder="<?php if($usuario && $usuario[0]["apellido"] ){ echo $usuario[0]["apellido"];}else{echo 'Apellido';}?>" tipe="text" name="apellido" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="email">email:</label> 
                    <input type="email" name="email" placeholder="<?php if($usuario && $usuario[0]["email"] ){ echo $usuario[0]["email"];}else{echo 'Email';}?>" id="exampleInputEmail1" class="form-control">
                </div>

                <?php if(!isset($_GET["id"])):?>
                    <div class="form-group">
                        <label for"password">Clave:</label> 
                        <input type="password" name="password" placeholder="Clave" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for"password2">Repetir clave:</label> 
                        <input id="password2" type="password" placeholder="Repetir clave" id="password2" class="form-control" name="password2" />
                    </div>
                <?php endif;?>
                
                <div class="form-group">
                    <label for="telefono">Telefono:</label> 
                    <input type="text" name="telefono" placeholder="<?php if($usuario && $usuario[0]["telefono"] ){ echo $usuario[0]["telefono"];}else{echo 'Telefono';}?>" id="telefono" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label for="calle">Calle:</label> 
                    <input type="text" name="calle" placeholder="<?php if($usuario && $usuario[0]["calle"]){ echo $usuario[0]["calle"];}else{echo 'Calle';}?>" id="calle" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label for="numero">Numeración:</label> 
                    <input type="text" name="numero" placeholder="<?php if($usuario && $usuario[0]["numero"]){ echo $usuario[0]["numero"];}else{echo 'Numero';}?>" id="numero" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="dni">DNI:</label> 
                    <input type="text" name="dni" placeholder="<?php if($usuario && $usuario[0]["dni"] ){ echo $usuario[0]["dni"];}else{echo 'DNI';}?>" id="dni" class="form-control" /> <br />
                </div>
                <input class="btn btn-default" type="submit" name="registration" value="<?php if($usuario){ echo 'Editar';}else{echo 'Registrar';}?>" />
            </form>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>