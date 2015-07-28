(function($) {
    $(document).ready(function() {

        $(".camara-s").click(function(event) {
            event.preventDefault();
            $(".camaras-ts").addClass("hide");  
            $("." + $(this).data("c")).removeClass("hide");
        });

        // $.ajax({
        //     method: "GET",
        //     dataType: 'jsonp',
        //     url: "http://181.171.231.235/alarmas/alta.php?accion=a&usuario=grupo10&password=grupo10&sistema=57&cliente=57&camara=3"
        // })
        // .done(function( msg ) {
        //     console.log(msg);
        // });

        // $.ajax({
        //     method: "GET",
        //     dataType: 'jsonp',
        //     url: "http://181.171.231.235/alarmas/consulta.php?accion=c&usuario=grupo10&password=grupo10&sistema=57&cliente=57"
        // })
        // .done(function( msg ) {
        //     console.log(msg);
        // });

        // $.ajax({
        //     method: "GET",
        //     dataType: 'jsonp',
        //     url: "http://181.171.231.235/alarmas/consulta.php?accion=v&usuario=grupo10&password=grupo10&sistema=361&cliente=57&camara=1"
        // })
        // .done(function( msg ) {
        //     console.log(msg);
        // });

        if($(".visualizacion").length != 0) {
            var id = $(".visualizacion").data("id");
            $.ajax({
                method: "GET",
                url: "/api/visualizacion/" + id
            })
            .done(function( rta ) {
                var visualizacion;
                var texto;
                var estado = JSON.parse(rta);
                
                if(estado[0].visualizacion == 0) {
                    visualizacion = "1";
                    texto = "Activar visualizacion";
                } else {
                    visualizacion = "0";
                    texto = "Desactivar visualizacion";          
                }

                $(".visualizacion").attr("data-visualizacion", visualizacion).text(texto);
            });
        }

        $(".visualizacion").click(function(event) {
            event.preventDefault();
            var visualizacion = $(this).data("visualizacion");
            var id = $(this).data("id");
            $.ajax({
                method: "PUT",
                data: {"id":id,"visualizacion": visualizacion},
                url: "/api/visualizacion"
            })
            .done(function( respuesta ) {
               if(respuesta == 1) {
                    redirectToTime("/web/cliente/");
                } else {
                    error("/web/cliente/");
                }
            });
        });

        $(".alarma").click(function(event) {
            var id_cliente = $(event.currentTarget).data("user");
             $.ajax({
                data: {"id_cliente": id_cliente},
              method: "POST",
              url: "/api/alarmaUsuario"
            })
            .done(function( respuesta ) {
                if(respuesta == 1) {
                    $(".alarma").addClass("hide");
                    $(".alarma-stop").removeClass("hide");
                    $(".alarma-false").removeClass("hide");
                }
            });

            location.href="/web/cliente/";
        }); 

        $(".alarma-stop").click(function(event) {
            var id_cliente = $(event.currentTarget).data("user");
             $.ajax({
                data: {"id_cliente": id_cliente},
              method: "PUT",
              url: "/api/alarmaUsuario"
            })
            .done(function( respuesta ) {

                if(respuesta == 1) {
                    $(".alarma-stop").addClass("hide");
                    $(".alarma-false").addClass("hide");
                    $(".alarma").removeClass("hide");
                }
            });
            location.href="/web/cliente/";
        }); 

        $(".alarma-false").click(function(event) {
            var id_cliente = $(event.currentTarget).data("user");
             $.ajax({
                data: {"id_cliente": id_cliente},
              method: "POST",
              url: "/api/alarmaFalse"
            })
            .done(function( respuesta ) {
                if(respuesta == 1) {
                    $(".alarma-stop").addClass("hide");
                    $(".alarma-false").addClass("hide");
                    $(".alarma").removeClass("hide");
                }
                location.href="/web/cliente/";
            });
        }); 
    });
    
})(jQuery);

