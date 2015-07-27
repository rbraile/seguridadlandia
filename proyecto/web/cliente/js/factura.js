(function($) {
    $(document).ready(function() {
        $.getJSON("http://www.seguridadlandia.com/api/facturas/" + getUrlVars()['id_factura'], {format: "json"}, function(data) { 
            if(!!data.length) {
                var dato = data[0];
                var fecha = dato.fecha.split("-"); 
                var detalles = dato.detalle.split("/");
                detalles.pop();
                var total = dato.importe;
                var detalle;
                $(".numero-factura span").append(dato.id);
                $(".fecha span").append(fecha[2] + "-" + fecha[1] + "-" + fecha[0]);
                $(".cliente .nombre").append(dato.nombre + " "  + dato.apellido);
                $(".cliente .calle").append(dato.calle + " " + dato.numero);
                $(".cliente .telefono").append(dato.telefono);

                for(var i=0; i < detalles.length; i++) {
                    var fila = detalles[i].split(",");
                    var importe = eval(fila[1]) * eval(fila[2]);
                    detalle += "<tr style='height: 30px;text-align:center;border-bottom: 1px solid #ccc'><td>" + fila[0] + "</td><td>" + fila[1] + "</td><td>" + fila[2] + "</td><td>" + importe + "</td></tr>"
                }

                if(dato.detalle == "factura mensual") {
                   detalle = "<tr style='height: 30px;text-align:center;border-bottom: 1px solid #ccc'><td>" + dato.detalle + "</td><td>1</td><td></td><td>" + total + "</td></tr>";
                }

                $(".detalle").html(detalle);
                $(".total").html("<tr style='text-align:right;'><td></td><td></td><td><strong>TOTAL</strong></td><td><strong style='padding-right: 10px;'>" + total + "</strong></td>");
                $("input[name=importe]").val(total);
                $("input[name=dire]").val(dato.calle + " " + dato.numero);
                $("input[name=fecha]").val(fecha[2] + "-" + fecha[1] + "-" + fecha[0]);
                $("input[name=nombre]").val(dato.nombre + " "  + dato.apellido);
                if(dato.pago == "1") {
                    $(".pagar-factura").addClass("hide");
                }
            } else {
               // error("/web/admin/clientes.php");
            }
        });
        
    });
})(jQuery);