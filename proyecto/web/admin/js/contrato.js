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
                .done(function(repsuesta) {
                    redirectToTime("/web/factura.php?id_factura=" + repsuesta);
                    // $.each(usuarios, function( index, usuario){
                });                     
            } else {    
               error("/web/admin/factura.php");
            }
        });

    });
})(jQuery);

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

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function error(url) {
    $(".error").removeClass("hide");
    setTimeout(function(){window.location = url;}, 2000); 
}

function redirectToTime(url) {
    $(".message").removeClass("hide");
    setTimeout(function(){window.location = url;}, 2000); 
}