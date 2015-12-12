
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/lindley.css">
    <title>Empresas Contratistas</title>

    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">


  </head>

  <body role="document" style="background:#E7E7E7;">
    <!-- Fixed navbar -->
       <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="principal.php">Principal</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Planes de Trabajo<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                            <li><a href="lista-plan.php">Planes de Trabajo Registrados</a></li>
                            <li><a href="mantenedorTrabajoRequerido.php">Trabajo requerido</a></li>
                            <li><a href="plan-trabajo.php">Registrar Plan de Trabajo</a></li>
                    </ul>
                </li>
                <li><a href="../sites/mantenedorEmpresas.php">Empresas</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Control Entrega EPP<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                            <li><a href="lista-ControlEPP.php">Control Entrega EPP'S Registrados</a></li>
                            <li><a href="../sites/mantenedorArea.php">Áreas</a></li>
                            <li><a href="../sites/trabajador.php">Trabajador</a></li>
                            <li><a href="mantenedorEquipoProteccion.php">Equipo Proteccion</a></li>
                            <li><a href="control-entregaEPP.php">Registrar ControlEntregaEPP</a></li>
                    </ul>
                </li>
                <li><a href="../sites/contratistas.php">Trabajador Empresa Contratista</a></li>
                
                
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php
                      session_start();
                      if (isset($_SESSION['usuario']))
                      {
                          echo '<li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"> </span>'.'  '.$_SESSION['usuario'].'<span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu">
                                              <li><a href="../scripts/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a></li>
                                      </ul>
                                  </li>'; 
                          }
                      else
                          echo '<a href="../index.php">Iniciar</a>';
                  ?>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="../img/banner02.jpg" alt="Chania">
                </div>

                <div class="item">
                  <img src="../img/banner03.jpg" alt="Chania">
                </div>

                <div class="item">
                  <img src="../img/banner04.jpg" alt="Flower">
                </div>

                <div class="item">
                  <img src="../img/banner05.jpg" alt="Flower">
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <div class="container">
            <div class="row">
              
              <div class="col-md-12">
                <div class="cuadro-contenido box-gris marco-estrategico">      
                <div class="texto-libre">
                  <a name="marco_estrategico"></a>
                  <h3>Marco Estrat&eacute;gico</h3>
                  <p>Son las definiciones centrales del prop&oacute;sito y direcci&oacute;n de la empresa. Describe el porqu&eacute; existimos y qu&eacute; queremos llegar a ser, cu&aacute;l es nuestro negocio, cual es nuestro cliente y c&oacute;mo hacemos la diferencia frente a nuestros competidores. Se revisa anualmente en un taller con la Direcci&oacute;n donde se debate el mantenimiento o replanteamiento de su contenido expresado en la Misi&oacute;n, Visi&oacute;n, Valores de la compa&ntilde;ia. Ordinariamente se incluye tambi&eacute;n las Pol&iacute;ticas Organizacionales.</p>
                </div>

                <div class="box-mision-vision visible-desktop">
                  <div style="position: absolute"><img src="../img/backg-mision-vision.png" border="0" style="width: 100%" /></div>
                  <div style="position: absolute; width: 100%">
                    <a name="mision_vision"></a>
                    <div class="texto-libre box-mision">
                      <h4>Misi&oacute;n</h4>
                      <h5>...nuestra raz&oacute;n de ser</h5>
                      <p>Operar con excelencia para ser la opci&oacute;n preferida de clientes y consumidores, logrando un crecimiento rentable y sostenible y generando valor a nuestros p&uacute;blicos de inter&eacute;s.</p>
                    </div>
                    <div class="texto-libre box-vision">
                      <h4>Visi&oacute;n</h4>
                      <h5>...nuestro destino</h5>
                      <p>Ser la empresa peruana de clase mundial l&iacute;der en bebidas no alcoh&oacute;licas.</p>
                    </div>
                    <div class="texto-libre lista-medios">
                      <p class="texto-medios medio01">Talento Comprometido</p>
                      <p class="texto-medios medio02">Infraestructura Moderna</p>
                      <p class="texto-medios medio03">Productividad</p>
                      <p class="texto-medios medio04">&Oacute;ptimo servicio al mercado</p>
                      <p class="texto-medios medio05">Sostenibilidad</p>
                    </div>
                    <div class="texto-libre box-imperativos">
                      <h4 style="text-align: right">Imperativos Estrat&eacute;gicos</h4>
                      <h5 style="text-align: right">...nuestros medios para llegar</h5>
                    </div>
                  </div>
                </div>
            </div>
              </div>
             
            </div>
            
          </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

