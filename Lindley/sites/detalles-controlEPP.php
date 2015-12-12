

<?php 
    session_start();

    $NUM = $_GET['id'];
    $Servidor ='localhost';
    $Usuario ='root';
    $Clave ='';
    $BaseDatos ='lindley';
    $item = 0;
    $Conexion = @mysql_connect($Servidor,$Usuario, $Clave, $BaseDatos) or die('No se Puede conectar');
    @mysql_select_db($BaseDatos, $Conexion) or die('No se puede conectar a la base de datos');
?>

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
    <script>
        function imprime(){
        //desaparece el boton
            document.getElementById("btnRegresar").style.display='none'
            document.getElementById("btnImprimir").style.display='none'
            document.getElementById("nover").style.display='none'
            //se imprime la pagina
            window.print()
            //reaparece el boton
            document.getElementById("btnRegresar").style.display='inline'
            document.getElementById("btnImprimir").style.display='inline'
            document.getElementById("nover").style.display='inline'
        }
    </script>

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
                <h1 class="text-center letra" >Detalle de Control de Entrega de EPP N° <?php echo $NUM ?></h1><br><br>
                <div class="row">
                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Datos Generales</legend>
                    <div class="col-md-1"></div>
                    <?php
                            $Consulta ="SELECT C.numSolicitudEPP, A.area, CONCAT(T.nombres,' ',T.apellidos) AS INHOUSE, C.fechaIngreso FROM ControlEntregaEPP C inner join area A ON A.areaID = C.areaID inner join trabajador T ON T.codigoTrabajador = C.trabajadorID WHERE C.numSolicitudEPP = '".$NUM."'";
                            $Resultado= @mysql_query($Consulta);
                        while ($fila = @mysql_fetch_array($Resultado)){
                                
                                $NUM=$fila["numSolicitudEPP"];  
                                $AREA=$fila["area"];  
                                $INGRESO=$fila["fechaIngreso"];                         
                                $TRABAJADOR=$fila["INHOUSE"];                                                 
                            }
                        ?>
                        
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Area: </strong><?php echo $AREA ?>
                            </div>                            
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Trabajador Lindley: </strong><?php echo $TRABAJADOR ?>
                            </div>                            
                        </div>
                        
                        
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Fecha de Ingreso: </strong><?php echo $INGRESO ?>
                            </div>                            
                        </div>
                        <div class="col-md-1"></div>
                                               
                    </fieldset>
                </div><br>
                <div class="row">
                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Trabajos Requeridos</legend>
                    
                    <div class="col-md-1"></div>
                    <div class="col-md-10 table-responsive">
                  
                        <?php
                            $Consulta ="SELECT CE.detalleID, E.descripcion FROM ControlEntregaEPPDetalle CE inner join equipoProteccion E on E.equipoProteccionID = CE.equipoProteccionID WHERE CE.numSolicitudEPP = '".$NUM."' ORDER BY CE.detalleID DESC";
                            $Resultado= @mysql_query($Consulta);
                        ?>
                        <table id="tablaControl" class="table table-striped table-bordered table-hover">                
                            <thead>
                                <tr>
                                    <th class="text-center">*</th>
                                    <th class="text-center">EQUIPO PROTECCION</th>
                                    
                                </tr>
                            </thead>           
                            <tbody>
                        <?php
                            while ($fila = @mysql_fetch_array($Resultado)){
                                $item = $item +1 ;
                                echo '<tr>
                                        <td class="text-center">'.$item.'</td>
                                        <td class="text-center">'.$fila['descripcion'].'</td>
                                                                
                                    </tr>';
                            }
                        ?>
                                </tbody>
                    <?php
                    ?>
                      </table>
                    </div>
                    <div class="col-md-1"></div>
                    </fieldset>
                </div><br>
                <div class="row">
                <div class="col-md-offset-4 col-md-10">
                  <div class="form-group">
                    <a href="lista-ControlEPP.php" id="nover"><input type="button" class="btn btn-md btn-primary" id="btnRegresar" name="name" value="Regresar"/></a>
                    <input type="button" class="col-md-offset-1 btn btn-md btn-danger" name="name" id="btnImprimir" value="Imprimir" onClick="imprime()";/>
                  </div>
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

