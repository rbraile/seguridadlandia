<?php include_once("../include/verify-cliente.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("../include/bootstrap.php"); ?>
    <?php include("../include/header.php");?>
    <script type="text/javascript" src="/web/cliente/js/controller.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
</head>
<body>
    <div class="container cliente">
        <div class="panel panel-default">
            <div class="row title-qr">         
                <?php include("navbar.php");?>
            </div>
        </div><!-- /.panel panel-default -->

            <div class="hide error alert alert-danger" role="alert">
                <p>Ha ociurrido un error intentelo nuevamente en unos minutos</p>
            </div>
            <div class="hide message alert alert-success" role="alert">
                <p>La accion se a realizado correctamente</p>
            </div>

         <div class="panel panel-default contenido">
            <div class="row">
                <div class="col-md-7">
                    <ul class="botonera">
                        <li class="">
                            <a class="btn btn-default btn-lg alert-danger alarma" data-user="<?php echo $_SESSION["user_id"];?>" href="#">Disparar Alarma</a>
                        </li>
                        <li>
                            <a class="btn btn-default btn-lg alert-success alarma-false hide" data-user="<?php echo $_SESSION["user_id"];?>" href="#">Falsa Alarma</a>
                        </li>
                         <li>
                            <a class="btn btn-default btn-lg alert-success alarma-stop hide" data-user="<?php echo $_SESSION["user_id"];?>" href="#">Desactivar Alarma</a>
                        </li>
                        <li>
                            <a class="btn btn-default btn-lg alert-danger" href="tel:911">Realizar llamada al 911</a>
                        </li>
                    </ul>
                    <div class="qr">
                        <h3>QR de desbloqueo</h3>
                        <?php echo '<img src="../cliente/qr.php" />';?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="personales">
                        <div class="datos">
                            <p><strong>Nombre: </strong><?php echo $_SESSION["nya"];?></p>
                            <p><strong>Teléfono: </strong><?php echo $_SESSION["telefono"];?></p>
                            <p><strong>Dirección: </strong><?php echo $_SESSION["dire"];?></p>
                            <p>
                                <a data-id="<?php echo $_SESSION["user_id"];?>" class="btn btn-default visualizacion"></a>
                            </p>
                            <p>
                                <a class="btn btn-default monitoreo" href="#" data-toggle="collapse" data-target="#camaras-mo">Monitorear Camaras</a>
                            </p>
                        </div>
                        <div id="mapa-cliente">
                            
                        </div>
                    </div>
                </div>
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
                    <div id="#camaras">
                        <img class="camaras-ts camara1" src="/web/images/hogar1.jpg">
                        <img class="camaras-ts camara2 hide" src="/web/images/hogar2.gif">
                        <img class="camaras-ts camara3 hide" src="/web/images/hogar3.jpg">
                    </div>
                </div>
            </div>
        </div> 

      <!-- FOOTER -->
      <?php include("footer.php"); ?>

    </div><!-- /.container -->
        <script type="text/javascript">
            function initialize() {
            var dire = "<?php echo $_SESSION['dire']; ?>";
            var zona = "<?php echo $_SESSION['id_zona']; ?>";
            var estado;

            var url = "/api/getAlarmaState/" + <?php echo $_SESSION["user_id"]; ?>;
                $.getJSON(url, {format: "json"}, function(data) { 
                    if(!!data.length) { 
                        estado = data[0].estado
                        getAddress(dire, zona, estado);
                        setBtn(estado);                
                    } else {    
                      console.log("error");
                    }
                });

            var mapCanvas = document.getElementById('mapa-cliente');
            geocoder = new google.maps.Geocoder();

            var mapOptions = {
              center: new google.maps.LatLng(-34.6728278, -58.56818240000001),
              zoom: 13,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(mapCanvas, mapOptions);

            
            function getAddress(dire, zona, estado) {
                var partido;
                switch (zona) {
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

                // console.log(estado);

                var address = dire + " " + partido;
                geocoder.geocode( { 'address': address}, function(results, status) {

                    var image = 'http://www.seguridadlandia.com/web/images/casa-v.png';
                    
                    if(estado == 1) {
                        image = 'http://www.seguridadlandia.com/web/images/casa-r.gif';
                    }

                    var acciones = "";
                    
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var infowindow = new google.maps.InfoWindow({
                        });

                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            icon: image,
                            optimized: false
                        });
                    } 
                });
            }  
          }
          
          google.maps.event.addDomListener(window, 'load', initialize);
          function setBtn(estado) {
              if(estado == 1) {
                    $(".alarma").addClass("hide");
                    $(".alarma-stop").removeClass("hide");
                    $(".alarma-false").removeClass("hide");
              } else {
                $(".alarma-stop").addClass("hide");
                $(".alarma-false").addClass("hide");
                $(".alarma").removeClass("hide");
              }
          }
    </script>

</body>
</html>