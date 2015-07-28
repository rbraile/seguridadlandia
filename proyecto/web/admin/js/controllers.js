(function($) {
    $(document).ready(function() {
        $(".logout").click(function() {
            logout();
        });

        $(".filtro").click(function() {
            var opcion = $(".selector").val();
            var valor = $(".valor").val();
            
            $.ajax({
                method: "POST",
                data: {"tipo":opcion, "dato": valor},
                url: "/api/alarmas-list-by"
            })
            .done(function( alarmasJSON ) {
               var alarmas = eval(alarmasJSON);
               $("#listado-alarmas").empty();
                $.each(alarmas, function( index, alarma){
                    var row="";
                    if(index%2 == 0) {
                        row = "odd";
                    }else {
                        row = "even";
                    }

                    var toAppend = "<tr class='" + row + "'><td class='id'>" + alarma.id_cliente + "</td><td  class='factor'>" + alarma.factor_alarma + "</td><td  class='fecha'>" + alarma.fecha + "</td></tr>";
                    $("#listado-alarmas").append(toAppend);
                });
            });


        });


        if($(".alarmas-list").length > 0) {
            $.ajax({
                    method: "GET",
                    url: "/api/alarmas-list"
                })
                .done(function( alarmasJSON ) {
                    var alarmas = eval(alarmasJSON);
                    $.each(alarmas, function( index, alarma){
                        var row="";
                        if(index%2 == 0) {
                            row = "odd";
                        }else {
                            row = "even";
                        }
                        var toAppend = "<tr class='" + row + "'><td class='id'>" + alarma.id_cliente + "</td><td  class='factor'>" + alarma.factor_alarma + "</td><td  class='fecha'>" + alarma.fecha + "</td></tr>";
                        $("#listado-alarmas").append(toAppend);
                    });
                });
        }

        if($(".servicio-zona").length > 0) {
                $.ajax({
                    method: "GET",
                    url: "/api/cliente"
                })
                .done(function( usuariosJSON ) {
                    var usuarios = eval(usuariosJSON),
                        zona1=0,   
                        zona2=0,   
                        zona3=0;

                    $.each(usuarios, function( index, usuario){
                        switch(usuario.id_zona) {
                            case "1":
                                zona1++;
                            break;
                            case "2":
                                zona2++;
                            break;
                            case "3":
                                zona3++;
                            break;
                            default:
                            break;
                        }
                    });
                    var torta = '/web/admin/graficos/cliente-zona-torta.php?zona1=' + zona1 + '&zona2=' + zona2 + '&zona3=' + zona3; 
                    $(".servicio-zona .cliente-torta").attr("src",torta);
                    
                    var barra = '/web/admin/graficos/cliente-zona-barra.php?zona1=' + zona1 + '&zona2=' + zona2 + '&zona3=' + zona3; 
                    $(".servicio-zona .cliente-barra").attr("src",barra);

                });
        }

        if($(".alarmas-factor").length > 0) {
            $.ajax({
                    method: "GET",
                    url: "/api/alarmas"
                })
                .done(function( alarmasJSON ) {
                    var alarmas = eval(alarmasJSON);
                    
                    var torta = '/web/admin/graficos/alarmas-factor-torta.php?false=' + alarmas[0].falsa + '&real=' + alarmas[0].real; 
                    $(".alarmas-factor .torta").attr("src",torta);

                    var barra = '/web/admin/graficos/alarmas-factor-barra.php?false=' + alarmas[0].falsa + '&real=' + alarmas[0].real; 
                    $(".alarmas-factor .barra").attr("src",barra);
                });
        }

         if($(".alarmas-fecha").length > 0) {
            $.ajax({
                    method: "GET",
                    url: "/api/alarmas-fecha"
                })
                .done(function( alarmasJSON ) {
                    var alarmas = eval(alarmasJSON);
                    var auxCantidad = [];
                    var auxFechas = [];
                    var count = 0;
                    $.each(alarmas[0], function( index, alarma){
                            auxFechas += alarma[0] + ",";
                            auxCantidad += alarma[1] + ",";
                    });
                    var cantidad = auxCantidad.substring(0, auxCantidad.length - 1);
                    var fechas = auxFechas.substring(0, auxFechas.length - 1);
                    var lineas = '/web/admin/graficos/alarma-fecha.php?fechas=' + fechas + '&cantidad=' + cantidad; 

                    $(".alarmas-fecha .torta").attr("src",lineas);

                });
        }

        // if($(".envio-factura").len) {
        //     $.ajax({
        //         method: "POST",
        //         data: {"id":getUrlVars()['id']},
        //         url: "/api/enviar-factura"
        //     })
        //     .done(function( msg  ) {
        //         console.log(msg);
        //     });
        // }

        if($("#facturas")) {
            $.ajax({
              method: "GET",
              url: "/api/factura"
            })
            .done(function( facturas ) {
                ShowFacturas(facturas);
            });
        }

        if($("#monitoreadores")) {
            $.ajax({
              method: "GET",
              url: "/api/monitoreadores"
            })
            .done(function( monitoreadores ) {
                // ShowMonitoreadores(monitoreadores);
            });
        }
        
        $("#password2").change(function() {
            if($("#password2").val() != $("#password").val()) {
                console.log("entro por aca");
                $("html, body").animate({scrollTop: 0}, 800);
                $(".error p").html("las claves no son iguales");
                $(".error").removeClass("hide");
            } 
        });

        if($(".usuarios table").length > 0) {            
            $.ajax({
              method: "GET",
              url: "http://www.seguridadlandia.com/api/usuario"
            })
            .done(function( usuarios ) {
                ShowUsuarios(usuarios);
            });
        }

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
            fields.id_zona = this.zona.value;

            if(fields.password != "" && fields.id_zona != "" && fields.nombre != "" && fields.apellido != "" && fields.dni != "" && fields.email != "" && fields.telefono != "" && fields.calle != "" && fields.numero != "") {
                $.ajax({
                  method: "POST",
                  data: JSON.stringify(fields),
                  url: "/api/usuario"
                })
                .done(function( msg ) {
                   
                    if(msg == "error") {     
                        $(".error").removeClass("hide");
                    } else {
                        $("html, body").animate({scrollTop: 0}, 800);
                        redirectToTime("/web/admin/clientes.php");       
                    }
                });
            } else {
                error("");
            }

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
            + usuario.tipo_usuario + "</td><td>" 
            + "<a class='editar-usuario btn btn-default' href='editar-usuario.php?id=" + usuario.id + "'>Ver usuario</a>";
        if(usuario.tipo_usuario == 'cliente') {
            toAppend += "</td><td><a class='btn btn-default' href='crear-contrato.php?id=" + usuario.id +"'>+ Contrato</a></td>";
            toAppend += "<td><a class='btn btn-default enviar-factura' href='enviarFactura.php?id=" + usuario.id +"'>Enviar Factura</a></td></tr>";
        } else {
            toAppend += "<td></td><td></td></tr>";
        }
        $(".usuarios table").append(toAppend);
    });
}

function ShowFacturas(facturas) {
    var facturas = eval(facturas);
    $.each(facturas, function( index, factura){
        var pago = "";

        if(factura.pago == 1){
            pago = "<strong style='color: green;'>Pagado</strong>";
        } else {
            pago = "<strong style='color: red;'>InPago</strong>";
        }

        var toAppend = "<tr height='50px'><th scope='row'>" 
            + factura.id + "</th><td>" 
            + factura.fecha + "</td><td>" 
            + pago + "</td><td>" 
            + "<a class='ver-factura btn btn-default' href='factura.php?id_factura=" + factura.id + "'>Ver factura</a>";
            toAppend += "<td></td></tr>";
            $("#facturas").append(toAppend);
    });
}

function ShowMonitoreadores(monitoreadores) {
    var monitoreadores = eval(monitoreadores);
    $.each(monitoreadores, function( index, monitoreador){
        var toAppend = "<tr><th scope='row'>" 
            + monitoreador.id + "</th><td>" 
            + monitoreador.fecha + "</td><td>" 
            + "<a class='ver-factura btn btn-default' href='monitoreador.php?id=" + monitoreador.id + "'>Ver monitoreador</a>";
            toAppend += "<td></td></tr>";
            $("#monitoreador").append(toAppend);
    });
}
