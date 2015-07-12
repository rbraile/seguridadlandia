<!DOCTYPE html>
<html>
<head>
<meta 
<script type="text/javascript">
</script>
    <title></title>
    <?php include_once("header.php"); ?>
</head>
<body>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>

       function initialize() {
        $.getJSON("http://www.seguridadlandia.com/api/cliente", {format: "json"}, function(data) { 
            
            if(!!data.length) { 
                for(var i = 0;i<data.length;i++) {   

                    var dato = data[i];
                    // var address = dato.calle + " " + dato.numero + "La Matanza"; 
                    // var title = dato.nombre + " " + dato.apellido;
                    // var dni = dato.dni;
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
            var address = dato.calle + " " + dato.numero + "La Matanza";
            var title = dato.nombre + " " + dato.apellido;
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                var contentString = "<img src='http://www.seguridadlandia.com/web/images/casa-v.jpg' />" + 
                "<p>Nombre: <strong>" + title + "</strong></p>" +
                "<p>Tel: <strong>" + dato.telefono + "</strong></p>" +
                "<p>DNI: <strong>" + dato.dni + "</strong></p>";

                map.setCenter(results[0].geometry.location);
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: title
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

              } else {
                alert("Geocode was not successful for the following reason: " + status);
              }
            });
        }  
        // var marker = new google.maps.Marker({
        //       position: pos,
        //       map: map,
        //       
        //   });
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);


    </script>
    <style>
      #mapa {
        width: 500px;
        height: 400px;
      }
    </style>

    <div id="mapa"></div>
</body>
</html>