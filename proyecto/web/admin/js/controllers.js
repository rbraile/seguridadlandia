(function($) {
    $(document).ready(function() {
        $("#password2").change(function() {
            $("html, body").animate({scrollTop: 0}, 800);
            if($("#password2").val() !== $("#password").val()) {
                $(".error p").html("las claves no son iguales");
                $(".error").show();
            } else {
                $(".error").hide();
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
                $("html, body").animate({scrollTop: 0}, 800);
                if(msg == 1) {
                    $(".error").hide();
                    $(".message").show();
                    var url = "/web/admin";
                    setTimeout(function(){window.location = url;}, 2000);        
                } else {
                    $(".error").show();
                }
            });           
        });
    });

})(jQuery);

function ShowUsuarios(usuariosJSON) {
    var usuarios = eval(usuariosJSON);
    $.each(usuarios, function( index, usuario){
        $(".usuarios table").append("<tr><th scope='row'>" 
            + usuario.id + "</th><td>" 
            + usuario.nombre + "</td><td>" 
            + usuario.apellido + "</td><td>" 
            + usuario.email + "</td><td><a href='#'>Ver usuario</a></td></tr>");
    });
}
