(function($) {
    $(document).ready(function() {
		$("#contrato").submit( function(event) {
            var fields = {};

			event.preventDefault();
            fields.id_cliente = $('input[name=id_cliente]').val();
            fields.id_hogar = $('input[name=id_hogar]').val();
            fields.plan = $( ".plan option:selected" ).val();

            $.ajax({
              method: "POST",
              data: JSON.stringify(fields),
              url: "http://www.seguridadlandia.com/api/contrato",
            })
            .done(function( respuesta ) {
            });     
		});
    })
})(jQuery);