<?php
    include('../scripts/funciones.php');
    $clase = new sistema;
    $areas = obtenerAreas();   
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
              <!-- agregar jeiner -->                         
              <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>

              <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">         
              <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
              
              <link rel="stylesheet" href="../css/alertify.core.css" />
              <link rel="stylesheet" href="../css/alertify.default.css" />
              <script type="text/javascript" src="../js/alertify.js"></script>

              <script type="text/javascript" src="../js/trabajoRequerido.js"></script>
              <link rel="stylesheet" href="../css/jeiner.css">
              
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Trabajo Requerido</title>

    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    

    <!--<script src="../js/jquery.js"></script>-->
    <script src="../js/mijava.js"></script>
  </head>

  <body role="document">

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

    
    <div class="container theme-showcase" role="main">
      <div class="jumbotron color-fondo">
        <h3 class="text-center"><strong>TRABAJO REQUERIDO</strong></h3>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="col-md-offset-4">
            <input type="button" value="Agregar Nuevo Trabajo Requerido" id="nuevoTrabajoRequerido" class="btn btn-primary"/>
            <input type="button" class="btn btn-danger" value="Eliminar" id="btnEliminarTR" onCLick="peticionEliminar();">
          </div>
          <hr> <br>
        </div>
        <div class="col-md-1"></div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 table-responsive">
          
                    <div class="listaDatos">
                      <table id="tablaDatos" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Área</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha límite</th>
                                </tr>
                            </thead>           
                            <tfoot>
                                <tr>
                                    <th>Área ID</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha límite</th>
                                </tr>
                            </tfoot>
                            <tbody id="cuerpoTabla">
                              <!-- Aqui irán los elementos de la tabla -->
                              
                            </tbody>
                        </table>
                    </div> <!-- listadatos -->
        </div>
        <div class="col-md-1"></div>
      </div>

 
      <div class="modal fade" id="modalNuevoTrabajoRequerido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 type="hidden" class="modal-title subfuente text-center" id="cabeceraRegistro">Registrar Nuevo Trabajo Requerido</h4>
                          <input type="text" id="txtFlag" value="N" hidden>
                          <input type="text" id="txtCodigo"  hidden>
                        </div>
                        <div class="modal-body">
                          <form action="" class="form-horizontal">
                            <div id="mensaje"></div>                             
                                <div class="form-group">
                                  <label for="areaID" class="col-md-3 control-label">ÁREA</label>
                                  <div class="col-md-8">
                                    <select  id="areaID" name="areaID" class="form-control" required>
                                      <option value="0">--Seleccionar--</option>
                                      <?php foreach($areas as $area): ?>
                                        <option value="<?= $area[0] ?>"><?= $area[1] ?></option>
                                      <?php endforeach; 
                                      ?>
                                    </select> 
                                  </div>                                  
                                </div>
                              <div class="form-group">
                                 <label for="descripcion" class="col-md-3 control-label">DESCRIPCIÓN</label>
                                 <div class="col-md-8">
                                     <input id="descripcion" type="text" class="form-control" name="descripcion" placeholder="Ingrese el trabajo requerido">
                                 </div>
                              </div>    
                              <div class="form-group">
                                <label for="fechaLimite" class="col-md-3 control-label">FECHA LÍMITE</label>
                                <div class="col-md-8">
                                  <input id="fechaLimite" value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control" name="fechaLimite" required>
                                </div>                                
                              </div> 
                               <div class="form-group">
                                <label for="estado" class="col-md-3 control-label">ESTADO</label>                                
                               
                                  <div class="radio-inline">                                
                                    <label>                                   
                                      <input id="rbPendiente" type="radio" name="estado" value="Pendiente" checked>
                                      Pendiente                                                          
                                    </label>
                                  </div>                                
                                
                                  <div class="radio-inline">
                                    <label>                                    
                                        <input id="rbSolicitado" type="radio" name="estado" value="Solicitado">
                                        Solicitado                                                                 
                                    </label>
                                  </div>                                 
                                
                                <div class="radio-inline">
                                  <label>
                                    <input id="rbEjecutando" type="radio" name="estado" value="Ejecutando">
                                    Ejecutando
                                  </label>
                                </div>
                                <div class="radio-inline">
                                  <label>
                                    <input id="rbFinalizado" type="radio" name="estado" value="Finalizado">
                                    Finalizado
                                  </label>
                                </div>
                              </div>                        
                              
                              <div class="form-group">
                                <a class="btn btn-default col-md-offset-3" data-dismiss="modal">Cancelar</a>
                                <input type="button" id="registroTrabajoRequerido" class="btn btn-success col-md-offset-2" value="Guardar"/>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
    </div> <!-- /container -->

    <!--<script src="../js/jquery.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
