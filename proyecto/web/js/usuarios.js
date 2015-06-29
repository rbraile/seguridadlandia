(function($) {
    $(document).ready(function() {
        $('input[name=nombre]').val('pedro');
        $('input[name=apellido]').val('picapiedra');
        $('input[name=dni]').val('99999999');
        $('input[name=email]').val('pedro@picapiedra.com');
        $('input[name=telefono]').val('44667789');
        $('input[name=password]').val('pedro');
        $('input[name=password2]').val('pedro');
        $('input[name=calle]').val('arieta');
        $('input[name=numero]').val('1234');

        $.ajax({
          method: "GET",
          url: "http://www.seguridadlandia.com/api/usuario"
        })
        .done(function( usuarios ) {
            ShowUsuarios(usuarios);
        });

        $(".logout").click(function() {
            logout();
        });

        $("#login").submit(function(event) {
            event.preventDefault();
            var usuario = $("input[name=usuario]").val();
            var clave = $("input[name=clave]").val();

            if(usuario != "" && clave != "") {
                loginUsuario(usuario, clave);
            }
            return false;
        })

        $("#token").click(function() {
             $.ajax({
                  method: "GET",
                  url: "http://www.seguridadlandia.com/api/hashToken?id=2",
                })
                .done(function( token ) {
                    alert(token)
                });
        });

        // $("#password2").change(function() {
        //     if($("#password2").val() === $("#password").val()) {
        //         alert("son iguales");
        //     } else {
        //         alert("NO son iguales");
        //     }
        // });

        $("#register").submit(function(event) {
            event.preventDefault();
                var fields = {};
                var password2 = $('input[name=password2]').val();

                fields.nombre = $('input[name=nombre]').val();
                fields.apellido = $('input[name=apellido]').val();
                fields.dni = $('input[name=dni]').val();
                fields.email = $('input[name=email]').val();
                fields.telefono = $('input[name=telefono]').val();
                fields.password = $('input[name=password]').val();
                fields.calle = $('input[name=calle]').val();
                fields.numero = $('input[name=numero]').val();
                fields.tipo_usuario = this.tipo_usuario.value;
   
                $.ajax({
                  method: "POST",
                  data: JSON.stringify(fields),
                  url: "/api/usuario"
                })
                .done(function( usuarios ) {
                    console.log(usuarios);
                });           
        });

    });

})(jQuery);

function logout() {
    $.ajax({
      method: "GET",
      url: "/api/logout"
    })
    .done(function( msg ) {
        var url = "/";
        window.location = url;
    });
}

function ShowUsuarios(usuariosJSON) {
    var usuarios = eval(usuariosJSON);
    $.each(usuarios, function( index, usuario){
        $(".usuarios table").append("<tr><td>" 
            + usuario.nombre + "</td><td>" 
            + usuario.apellido + "</td><td>" 
            + usuario.dni + "</td><td>" 
            + usuario.email + "</td><td></tr>");
    });
}

function loginUsuario(usuario, clave) {
    $.post( "/api/login", { nombre: usuario, password: clave } )
        .done(function( respuesta ) {
            if(respuesta) {
                var url = "/web/" + respuesta;
                window.location = url;
            } else {
                $(".error-login").html("Verifica los datos ingresados");
            }
        });
}