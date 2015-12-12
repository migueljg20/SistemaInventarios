

<?php 
    session_start();

    $PLAN = $_GET['id'];
    $Servidor ='localhost';
    $Usuario ='root';
    $Clave ='';
    $BaseDatos ='LINDLEY';
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
                <h1 class="text-center letra" >Detalle de Plan de Trabajo N° <?php echo $PLAN ?></h1><br><br>
                <div class="row">
                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Datos Generales</legend>
                    <div class="col-md-1"></div>
                    <?php
                            $Consulta ="SELECT P.planTrabajoID, EC.razonSocial, A.area, P.fechaInicio, P.fechaFin, P.horario, P.areaESp, CONCAT(T.nombres,' ',T.apellidos) AS INHOUSE, CONCAT(TC.contratistaNombres,' ',TC.contratistaApellidos) AS CONTRATISTA FROM PLANTRABAJO P inner join empresacontratista EC on EC.ruc = P.empresaContratistaRUC inner join area A ON A.areaID = P.areaID inner join trabajador T ON T.codigoTrabajador = P.trabajadorID INNER JOIN trabajadorContratista TC on TC.trabajadorContratistaDNI = P.trabajadorContratistaDNI WHERE P.planTrabajoID = '".$PLAN."'";
                            $Resultado= @mysql_query($Consulta);
                        while ($fila = @mysql_fetch_array($Resultado)){
                                
                                $EMPRESA=$fila["razonSocial"];  
                                $AREA=$fila["area"];  
                                $INICIO=$fila["fechaInicio"]; 
                                $FINAL=$fila["fechaFin"]; 
                                $HORARIO=$fila["horario"]; 
                                $ESPECIFICO=$fila["areaESp"]; 
                                $CONTRATISTA=$fila["CONTRATISTA"]; 
                                $INHOUSE=$fila["INHOUSE"];                      
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>N° de Plan: </strong><?php echo $PLAN ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Area: </strong><?php echo $AREA ?>
                            </div>
                            <div class="col-md-5">
                                <strong>Responsable de Area: </strong><?php echo $INHOUSE ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Empresa Contratista: </strong><?php echo $EMPRESA ?>
                            </div>
                            <div class="col-md-5">
                                <strong>Responsable Contratista: </strong><?php echo $CONTRATISTA ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Area Especifica: </strong><?php echo $ESPECIFICO ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Fecha de Inicio: </strong><?php echo $INICIO ?>
                            </div>
                            <div class="col-md-5">
                                <strong>Fecha de Finalización: </strong><?php echo $FINAL ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Horarios a Trabajar: </strong><?php echo $HORARIO ?>
                            </div>
                        </div>                        
                    </fieldset>
                </div><br>
                <div class="row">
                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Trabajos Requeridos</legend>
                    
                    <div class="col-md-1"></div>
                    <div class="col-md-10 table-responsive">
                  
                        <?php
                            $Consulta ="SELECT DP.detalleID, TR.descripcion FROM plantrabajodetalle DP inner join trabajoRequerido TR on TR.trabajoRequeridoID = DP.trabajoRequeridoID WHERE planTrabajoID = '".$PLAN."' ORDER BY detalleID DESC";
                            $Resultado= @mysql_query($Consulta);
                        ?>
                        <table id="tablaProforma" class="table table-striped table-bordered table-hover">                
                            <thead>
                                <tr>
                                    <th class="text-center">*</th>
                                    <th class="text-center">TRABAJO REQUERIDO</th>
                                    
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
                    <a href="lista-plan.php" id="nover"><input type="button" class="btn btn-md btn-primary" id="btnRegresar" name="name" value="Regresar"/></a>
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

