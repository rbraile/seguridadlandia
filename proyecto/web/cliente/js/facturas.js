(function($) {  
    $(document).ready(function() {
        var id = getUrlVars()['id'];
        $.ajax({
            method: "GET",
            url: "/api/getFacturasByCliente/" + id
        })
        .done(function( facturas ) {
            ShowFacturas(facturas);
        });
    });
})(jQuery);

function ShowFacturas(facturas) {
    var facturas = eval(facturas);
    $.each(facturas, function( index, factura){
        var pago = (factura.pago == 1 )? "<span style='color:green;font-weight:bold;'>Pagado</span>":"<span style='color:red;font-weight:bold;'>InPago</span>";
        var toAppend = "<tr height='50px'><th scope='row'>" 
            + factura.id + "</th><td>" 
            + factura.fecha + "</td><td>" 
            + pago + "</td><td>" 
            + "<a class='ver-factura btn btn-default' href='factura.php?id_factura=" + factura.id + "'>Ver factura</a>";
            toAppend += "<td></td></tr>";
            $("#facturas").append(toAppend);
    });
}

