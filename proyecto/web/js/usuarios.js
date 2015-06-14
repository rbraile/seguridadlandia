(function($) {
    $(document).ready(function() {
        $.ajax({
          method: "GET",
          url: "http://www.seguridadlandia.com/api/usuario"
        })
        .done(function( usuarios ) {
            ShowUsuarios(usuarios);
        });

        $("#login").submit(function(event) {
            event.preventDefault();
            event.stopPropagation();
            var usuario = $("input[name=usuario]").val();
            var clave = $("input[name=clave]").val();
            if(usuario != "" && clave != "") {
                loginUsuario(usuario, clave);
            }
        })

    });

})(jQuery);


function ShowUsuarios(usuariosJSON) {
    var usuarios = eval(usuariosJSON);
    $.each(usuarios, function( index, usuario){
        $(".usuarios table").append("<tr></td>" 
            + usuario.nombre + "</td><td>" 
            + usuario.apellido + "</td><td>" 
            + usuario.password + "</td><td>" 
            + usuario.email + "</td><td></tr>");
    });
}

function loginUsuario(usuario, clave) {
    $.post( "http://www.seguridadlandia.com/api/login", { nombre: usuario, password: clave } )
        .done(function( data ) {
            alert( "Data Loaded: " + data );
        });
}