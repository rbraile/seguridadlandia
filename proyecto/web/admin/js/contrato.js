(function($) {
    $(document).ready(function() {
        $.ajax({
          method: "GET",
          url: "http://www.seguridadlandia.com/api/getAllPlans"
        })
        .done(function( plans ) {
            ShowPlans(plans);
        });
        
        $(".plan").change(function(event) {
            $(".descripcion .show").removeClass("show");
            $('.plan' + $(event.currentTarget).val()).addClass("show");
        });

        $.getJSON("http://www.seguridadlandia.com/api/getClienteHogar/" + getUrlVars()['id'], {format: "json"}, function(data) { 
            if(!!data.length) { 
                $(".id_hogar").val(data[0].id_hogar);
                $(".calle").val(data[0].calle); 
                $(".numero").val(data[0].numero); 
            } else {    
               error("/web/admin/clientes.php");
            }
        });

        $("#agregar-contrato").submit(function (event) {
            event.preventDefault();
            var fields = {};

            if($('input[name=plan]').val() != "" && $('input[name=id_hogar]').val() && $('input[name=id_cliente]').val() != "") {

                fields.plan = $('select[name=plan]').val();
                fields.id_hogar = $('input[name=id_hogar]').val();
                fields.id_cliente = $('input[name=id_cliente]').val();

                $.ajax({
                    method: "POST",
                    data: JSON.stringify(fields),
                    url: "/api/contrato"
                })
                .done(function(respuesta) {
                    if(respuesta != "") {
                       createFactura(respuesta);
                    }
                });                     
            } else {    
               error("/web/admin/factura.php");
            }
        });

    });
})(jQuery);

function createFactura(id_contrato) {
    $.ajax({
        method: "POST",
        data: id_contrato,
        url: "/api/factura"
    })
    .done(function(id_factura) {
        console.log(id_factura);
        if(id_factura) {
            redirectToTime("/web/admin/factura.php?id_factura=" + id_factura);
        } else {
            error("/web/admin/clientes.php");
        }
    });          
}

function ShowPlans(plans) {
    var plans = eval(plans);
    $.each(plans, function( index, plan){
        $(".plan").append("<option value='" + plan.id + "'>" + plan.nombre + "</option>");
    });
    $.each(plans, function( index, plan){
        $(".descripcion").append("<p class='plan" + plan.id + "'>" + plan.descripcion + "</p>");
    });
    $(".descripcion .plan1").addClass("show");
}
