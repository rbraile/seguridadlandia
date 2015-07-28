(function($) {
    $(document).ready(function() {
// $.getJSON("http://181.171.231.235/alarmas/alta.php?Accion=A&Usuario=grupo10&Password=grupo10&Sistema=1&Cliente=2&Camara=3", function( result ) {
//     console.log(result);
// });
// $.getJSON("http://181.171.231.235/alarmas/consulta.php?Accion=c&Usuario=grupo10&Password=grupo10&Sistema=1&Cliente=2", function( result ) {
//     console.log(result);
// });

        // $.ajax({
        //     method: "GET",
        //     dataType: "jsonp",
        //     url: "http://181.171.231.235/alarmas/alta.php?Accion=A&Usuario=grupo10&Password=grupo10&Sistema=1&Cliente=2&Camara=3"
        // })
        // .done(function( msg ) {
        //     console.log(msg);
        // });
            // url: "http://181.171.231.235/alarmas/consulta.php?accion=v&usuario=grupo10&password=grupo10&sistema=1&cliente=2&camara=3"


        // $.ajax({
        //     method: "GET",
        //     url: "http://181.171.231.235/alarmas/alta.php?accion=a&usuario=grupo10&pssword=grupo10&sistema=1&cliente=21&camara=3"
        // })
        // .done(function( msg ) {
        //     console.log("hola");
        //     console.log(msg);
        // });

        $.ajax({
            method: "GET",
            url: "http://181.171.231.235/alarmas/consulta.php?accion=v&usuario=grupo10&password=grupo10&sistema=1&cliente=21&camara=2"
        })
        .done(function( msg ) {
            console.log(msg);
        });

        // $.ajax({
        //     method: "GET",
        //     dataType: "jsonp",
        //     url: "http://181.171.231.235/alarmas/alta.php?accion=A&usuario=grupo10&password=grupo10&sistema=1&cliente=2&camara=2"
        // })
        // .done(function( msg ) {
        //     console.log(msg);
        // });

        


        // $.ajax({
        //     type: 'GET',
        //     "url": "http://181.171.231.235/alarmas/consulta.php?Accion=c&Usuario=grupo10&Password=grupo10&Sistema=1&Cliente=2",
        //     "dataType": "jsonp",
        //     jsonpCallback: 'logicaCliente'
        // });                   

        function logicaCliente(data){
                console.log(data);
        }


    });

// http://181.171.231.235/alarmas/consulta.php?accion=c&usuario=grupo10&password=grupo10&sistema=1&cliente=2


})(jQuery);