<!-- <ul class="nav nav-pills">
    <li class=""><a data-toggle="collapse" data-target="#camaras">Monitorear Camaras</a></li>
    <li><a href="facturas.php?id=<?php echo $_SESSION["user_id"];?>">Ver factura a pagar</a></li>
    <li><a class="logout" href="#">logout</a></li>               
  </ul> -->

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#" class="navbar-brand">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a class="homepage" href="/web/cliente/">Home</a></li>
            <li><a class="facturas-link" href="facturas.php?id=<?php echo $_SESSION["user_id"];?>">Ver facturas</a></li>
           <li><a class="logout" href="#">logout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
                <form role="search" class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" placeholder="Buscar" class="form-control">
                </div>
                <button class="btn btn-default" type="submit">Submit</button>
                </form>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
     
    