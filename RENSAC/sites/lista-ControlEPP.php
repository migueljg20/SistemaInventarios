
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/lindley.css">
    <title>Control Entrega EPP's</title>

    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">


  </head>

  <body role="document">
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
                            <li><a href="mantenedorArea.php">Áreas</a></li>
                            <li><a href="trabajador.php">Trabajador</a></li>
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
            <div class="container-fluid fondo">
            <!--CONTENIDO EDITABLE-->
            <div class="jumbotron color-fondo">
              <h3 class="text-center"><strong>CONTROL ENTREGA EPP'S</strong></h3>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                  <div class="form-group pull-right">
                    <a href="control-entregaEPP.php"><input type="button" class="btn btn-md btn-primary" name="name" value="Nuevo Control EPP's"/></a>                
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10 table-responsive">
                  
                        <?php
    
            $Servidor ='localhost';
            $Usuario ='root';
            $Clave ='';
            $BaseDatos ='lindley';
            $item = 0;

            $Conexion = @mysql_connect($Servidor,$Usuario, $Clave, $BaseDatos) or die('No se Puede conectar');
            @mysql_select_db($BaseDatos, $Conexion) or die('No se puede conectar a la base de datos');


                $Consulta ="SELECT C.numSolicitudEPP, A.area, T.codigoTrabajador, C.fechaIngreso, C.observaciones FROM ControlEntregaEPP C inner join Area A on C.areaID = A.areaID 
                  inner join Trabajador T ON T.codigoTrabajador = C.trabajadorID";

                $Resultado= @mysql_query($Consulta);
                ?>
                <table id="tablaProforma" class="table table-striped table-bordered table-hover">                
                            <thead>
                                <tr>
                                    <th class="text-center">*</th>
                                    <th class="text-center">N° CONTROL ENTREGA</th>
                                    <th class="text-center">AREA</th>
                                    <th class="text-center">TRABAJADOR</th>
                                    <th class="text-center">FECHA INGRESO</th>
                                    <th class="text-center">OBSERVACIONES</th>
                                    <th class="text-center">OPERACIONES</th>
                                </tr>
                            </thead>           
                    <tbody>
        <?php
            while ($fila = @mysql_fetch_array($Resultado)){
                $item = $item +1 ;
                echo '<tr>
                        <td class="text-center">'.$item.'</td>
                        <td class="text-center">'.$fila['numSolicitudEPP'].'</td>
                        <td class="text-center">'.$fila['area'].'</td>
                        <td class="text-center">'.$fila['codigoTrabajador'].'</td>
                        <td class="text-center">'.$fila['fechaIngreso'].'</td>
                        <td class="text-center">'.$fila['observaciones'].'</td>
                        <td>
                            <a href="detalles-controlEPP.php?id='.$fila['numSolicitudEPP'].'"><input type ="button" class="btn btn-success btn-xs col-md-offset-2" value="Imprimir Detalles"></a>
                        </td>
                    </tr>';
            }
        ?>
                </tbody>
    <?php
    ?>

                   
                  </table>
                </div>
            </div>



            <!--CONTENIDO EDITABLE-->
            </div>
            <!-- /.container-fluid -->
        </div>            
          </div>
             
            </div>
            
          </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

