(function($) {
    $(document).ready(function() {
        $(".logout").click(function() {
            logout();
        });
        
        $("#password2").change(function() {
            if($("#password2").val() != $("#password").val()) {
                console.log("entro por aca");
                $("html, body").animate({scrollTop: 0}, 800);
                $(".error p").html("las claves no son iguales");
                $(".error").removeClass("hide");
            } 
        });

        $.ajax({
          method: "GET",
          url: "http://www.seguridadlandia.com/api/usuario"
        })
        .done(function( usuarios ) {
            ShowUsuarios(usuarios);
        });

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
            .done(function( msg ) {
                console.log(msg);
                if(msg == "error") {     
                    $(".error").removeClass("hide");
                } else {
                    $("html, body").animate({scrollTop: 0}, 800);
                    redirectToTime("/web/admin/clientes.php");       
                }
            });

        });
        $("#editar-usuario").submit(function(event) {
            event.preventDefault();
            var fields = {};
            var password2 = $('input[name=password2]').val();
            
            fields.id = $('input[name=id]').val();
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
              method: "PUT",
              data: JSON.stringify(fields),
              url: "/api/usuario"
            })
            .done(function( respuesta ) {
                if(respuesta) {
                    redirectToTime("/web/admin/clientes.php");
                } else {
                    error("/web/admin/clientes.php");
                }
            });
        });

        $(".delete-user").click(function(event) {
            event.preventDefault();
            $.ajax({
              method: "DELETE",
              url: "/api/usuario/" + $(".delete-user").data("id")
            })
            .done(function( respuesta ) {
                if(respuesta) {
                    console.log(respuesta);
                    redirectToTime("/web/admin/clientes.php");
                } else {
                    error("/web/admin/clientes.php");
                }
            });
        });
    });

})(jQuery);

function ShowUsuarios(usuariosJSON) {
    var usuarios = eval(usuariosJSON);
    $.each(usuarios, function( index, usuario){
        var toAppend = "<tr><th scope='row'>" 
            + usuario.id + "</th><td>" 
            + usuario.apellido + "</td><td>" 
            + usuario.email + "</td><td>" 
            + "<a class='editar-usuario btn btn-default' href='editar-usuario.php?id=" + usuario.id + "'>Ver usuario</a>";
        if(usuario.tipo_usuario == 'cliente') {
            toAppend += "</td><td><a class='btn btn-default' href='crear-contrato.php?id=" + usuario.id +"'>+ Contrato</a></td></tr>";
        } else {
            toAppend += "<td></td></tr>";
        }
        $(".usuarios table").append(toAppend);
    });
}
