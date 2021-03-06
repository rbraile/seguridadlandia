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
            <form id="register" method="POST">
                <div class="message alert alert-success hide" role="alert">
                    <p>Usuario registrado correctamente</p>
                </div>
                <div class="error alert alert-danger hide" role="alert">
                    <p>No se pudo registrar el usuario intentelo nuevamente</p> 
                </div>
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
                    <input type="number" name="telefono" placeholder="<?php if($usuario && $usuario[0]["telefono"] ){ echo $usuario[0]["telefono"];}else{echo 'Telefono';}?>" id="telefono" class="form-control" />
                </div>

                <div class="form-group zona">
                    <label>Zona</label>
                    <select id="zona" name="zona">
                        <option value="1">San justo</option>
                        <option value="2">Ramos Mejia</option>
                        <option value="3">Moron</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="calle">Calle:</label> 
                    <input type="text" name="calle" placeholder="<?php if($usuario && $usuario[0]["calle"]){ echo $usuario[0]["calle"];}else{echo 'Calle';}?>" id="calle" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label for="numero">Numeración:</label> 
                    <input type="number" name="numero" placeholder="<?php if($usuario && $usuario[0]["numero"]){ echo $usuario[0]["numero"];}else{echo 'Numero';}?>" id="numero" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="dni">DNI:</label> 
                    <input type="number" name="dni" placeholder="<?php if($usuario && $usuario[0]["dni"] ){ echo $usuario[0]["dni"];}else{echo 'DNI';}?>" id="dni" class="form-control" /> <br />
                </div>
                <input class="btn btn-default" type="submit" name="registration" value="<?php if($usuario){ echo 'Editar';}else{echo 'Registrar';}?>" />
            </form>
        </div>
        <?php include("footer.php");?>
    </div>
</body>
</html>