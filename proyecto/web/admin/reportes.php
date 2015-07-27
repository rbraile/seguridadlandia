<?php include_once("verify.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php include_once("header.php"); ?>
</head>
<body>
<div class="container cliente">
    <div class="panel panel-default">
        <div class="row"> 
            <?php include_once("navbar.php"); ?>
        </div>
    </div>
</div>
<div class="container">
      
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#zona" aria-controls="zona" role="tab" data-toggle="tab">Clientes por zona</a>
                </li>
                <li role="presentation">
                    <a href="#alarmas" aria-controls="alarmas" role="tab" data-toggle="tab">Factor de alarmas disparadas</a>
                </li>
                <li role="presentation">
                    <a href="#fechas" aria-controls="fechas" role="tab" data-toggle="tab">Alarmas disparadas por fecha</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="panel panel-default" style="border-top: none;">
                <div class="row">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="zona">
                            <div class="servicio-zona">
                                <div class="col-md-6">
                                    <img class="cliente-torta" src="" />
                                    <div class="torta-desc">
                                        <span class="torta1">
                                        </span>
                                        <span>San Justo</span>
                                    </div>   

                                    <div class="torta-desc">
                                        <span class="torta2">                                    
                                        </span>
                                        <span>Ramos Mejia</span>
                                    </div>
                                    <div class="torta-desc">                                        
                                        <span class="torta3">
                                        </span>
                                        <span>Morón</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="cliente-barra" src="" />
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="alarmas">
                             <div class="alarmas-factor">
                                <div class="col-md-6">
                                    <img class="torta" src="" />
                                    <div class="torta-desc">
                                        <span class="torta1">
                                        </span>
                                        <span>Falsa</span>
                                    </div>   

                                    <div class="torta-desc">
                                        <span class="torta2">                                    
                                        </span>
                                        <span>Real</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="barra" src="" />
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="fechas">
                            <div class="alarmas-fecha">
                                <div class="col-md-6">
                                    <img class="torta" src="" />
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<div class="container marketing">
    <?php include_once("footer.php"); ?>
</div><!-- /.container -->

</body>
</html>
