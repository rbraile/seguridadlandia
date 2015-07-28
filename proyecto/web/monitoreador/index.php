<?php include("verify.php");?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
    <link rel="stylesheet" type="text/css" href="/web/css/general.css">
    <script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(".camara-s").click(function(event) {
                event.preventDefault();
                $(".camaras-ts").addClass("hide");  
                $("." + $(this).data("c")).removeClass("hide");
            });
        });
    })(jQuery);
    </script>
</head>
<body>
<script src="https://maps.googleapis.com/maps/api/js"></script>            
    <div class="container">
        <div class="panel panel-default">
            <div class="">         
                <?php include("navbar.php");?>
            </div>
        </div><!-- /.panel panel-default -->

        <div class="hide error alert alert-danger" role="alert">
            <p>Ha ociurrido un error intentelo nuevamente en unos minutos</p>
        </div>
        <div class="hide message alert alert-success" role="alert">
            <p>La accion se a realizado correctamente</p>
        </div>


        <div id="mostrar" class="hide">
        </div>
        <div class="panel panel-default">
            <div class="row content-mapa">
                <div id="mapa"></div>
            </div>
        </div>

        <div id="camaras-mo" class="collapse">
            <div class="panel panel-default camaras-content">
                <div class="row">
                    <ul class="list-camaras">
                        <li><a href="#" data-c="camara1" class="btn btn-default alert-success camara-s">Camara 1</a></li>
                        <li><a href="#" data-c="camara2" class="btn btn-default alert-success camara-s">Camara 2</a></li>
                        <li><a href="#" data-c="camara3" class="btn btn-default alert-success camara-s">Camara 3</a></li>
                    </ul>
                    <img class="camaras-ts camara1" src="/web/images/hogar1.jpg">
                    <img class="camaras-ts camara2 hide" src="/web/images/hogar2.gif">
                    <img class="camaras-ts camara3 hide" src="/web/images/hogar3.jpg">
                </div>
            </div>
        </div>
        <?php include("footer.php");?>
    </div>
<script type="text/javascript">
        function initialize() {
            var url = "/api/cliente-by-zona/" + <?php echo $_SESSION["id_zona"]; ?>;
            $.getJSON(url, {format: "json"}, function(data) { 
                if(!!data.length) { 
                    for(var i = 0;i<data.length;i++) {   
                        var j=0;
                        var dato = data[i];
                        getAddress(dato);
                    }
                } else {    
                  console.log("error");
                }
            });

        var mapCanvas = document.getElementById('mapa');
        geocoder = new google.maps.Geocoder();

        var mapOptions = {
          center: new google.maps.LatLng(-34.6728278, -58.56818240000001),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        function getAddress(dato) {
            var partido;
            switch (dato.id_zona) {
                case 1:
                    partido = "la matanza";
                break;
                case 2:
                    partido = "la matanza";
                break;
                case 3:
                    partido = "moron";
                break;
                default:
                    partido = "la matanza";
                break;
            }
            var camaras = "";
            if(dato.visualizacion == 1) {
                camaras = "<p><a href='#' class='ver-camaras' data-toggle='collapse' data-target='#camaras-mo'>Ver Camaras</p>";
            }

            var address = dato.calle + " " + dato.numero + " " + partido;
            var title = dato.nombre + " " + dato.apellido;
            geocoder.geocode( { 'address': address}, function(results, status) {
                var image = 'http://www.seguridadlandia.com/web/images/casa-v.png';
                var acciones = "";
                if(dato.estado == 1) {
                    image = 'http://www.seguridadlandia.com/web/images/casa-r.gif';
                    acciones = "<p><a href='tel:911'>Llamar al 911</a></p>" +
                    "<p><a id='alarma' data-address='" + address + "' data-userid='" + dato.id + "' href='#'>Disparar alarma interna</a></p>";
                } 
                if (status == google.maps.GeocoderStatus.OK) {
                    var contentString = "<img src='" + image + "' />" + 
                    "<p>Nombre: <strong>" + title + "</strong></p>" +
                    "<p>Dir: <strong>" + address + "</strong></p>" +
                    "<p>Tel: <strong>" + dato.telefono + "</strong></p>" +
                    "<p>DNI: <strong>" + dato.dni + "</strong></p>" + acciones + camaras;

                    map.setCenter(results[0].geometry.location);
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: title,
                        icon: image,
                        optimized: false
                    });

                    google.maps.event.addListener(marker, 'click', function(event) {
                        infowindow.open(map,marker);
                    });

              } else {
                // alert("Geocode was not successful for the fossslowing reason: " + status);
              }
            });
        }  
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);

      function dispararAlamra(address, userid) {
           $.ajax({
                method: "POST",
                data: address, userid,
                url: "/api/alarmaInterna"
            })
            .done(function( zona ) {
                 console.log(zona);
            });
      }
</script>
</body>
</html>