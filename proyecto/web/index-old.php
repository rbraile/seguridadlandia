<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>seguridadlandia con jquery</title>
    <script type="text/javascript" src="js/lib/jquery.js"></script>
    <script type="text/javascript" src="js/lib/jquery.validation.js"></script>
    <script type="text/javascript" src="js/usuarios.js"></script>
</head>
<body>
<h1>Bienvenidos a segurilandia</h1>

<form id="login" method="POST">
    <p class="error-login" style="color: red;"></p>
    <label>
        usuario
        <input class="usuario" type="text" name="usuario" />
    </label>
    <label>
        clave
        <input class="clave" type="password" name="clave" />
    </label>
    <input id="enviar" type="submit" name="enviar" value="enviar" />
</form>
<h2>Registrar usuario</h2>
<form id="register" method="POST">
    <label>Tipo de usuario</label>
    <select id="tipo_usuario" name="tipo_usuario">
        <option value="cliente">Cliente</option>
        <option value="vigilador">Vigilador</option>
        <option value="monitoreador">Monitoreador</option>
        <option value="admin">Administrador</option>
    </select><br />
    <label>Nombre:</label> 
    <input tipe="text" name="nombre" /><br />
    <label>Apellido:</label> 
    <input tipe="text" name="apellido" /> <br />
    <label>email:</label> 
    <input tipe="email" name="email" /> <br />

    <label>Clave:</label> 
    <input id="password" tipe="password" name="password" /> <br />

    <label>Repitir clave</label>
    <input id="password2" tipe="password" name="password2" /> <br />

    <label>Telefono:</label> 
    <input tipe="text" name="telefono" /> <br />

    <label>Calle:</label> 
    <input tipe="text" name="calle" /> <br />

    <label>Numeración:</label> 
    <input tipe="text" name="numero" /> <br />

    <label>DNI:</label> 
    <input tipe="text" name="dni" /> <br />

    <input type="submit" name="registration" value="Registrarce" />
</form>

<a href="#" id="token">traer token</a>

<h3>Tabla usuarios</h3>
<div class="usuarios">
    <table>
        
    </table>
</div>
</body>
</html>