(function($) {
    $(document).ready(function() {
        $(".aceptar-pago").click(function(event) {
            event.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                method: "POST",
                data: {"id":id},
                url: "/api/pagarFactura"
            })
            .done(function( msg ) {
                console.log(msg);
                if(msg == 1) {
                    $(".success").removeClass("hide");
                    $(".pago").addClass("hide");
                    var url = "/web/cliente"
                    setTimeout(function(){window.location = url;}, 2000); 
                } else {
                    $(".error").removeClass("hide");
                    $(".pago").addClass("hide");
                    var url = "/web/cliente"
                    // setTimeout(function(){window.location = url;}, 2000); 
                }
            });

        });
    });
})(jQuery);