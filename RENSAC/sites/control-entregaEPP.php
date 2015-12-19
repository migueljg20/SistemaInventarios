
<!DOCTYPE html>
<html lang="es">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Empresas Contratistas</title>
    <script type="text/javascript" src="../js/jquery.js"></script>                  
    <script type="text/javascript" src="../js/maestroDetalle.js"></script>
    <script type="text/javascript" src="../js/comboObjeInicial.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    <script>
        function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 46) {
            if (unicode < 48 || unicode > 57) //if not a number
            { return false } //disable key press    
        }
    }

    function eliminar(id) {
      $.ajax({
        type: 'POST',
        data: 'solicitud='+id+'&tipo='+3,
        url: '../scripts/grabaDeta.php',
        success: function(data){
          $('#control').html(data);        
          $('#equipoProteccionID').val('');
          $('#fechaEntrega').val('');
          $('#motivo').val('');          
        }
      });
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
        <div class="container theme-showcase" role="main">
      <div class="jumbotron color-fondo">
        <h3 class="text-center"><strong>CONTROL ENTREGA EPP'S</strong></h3>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                  <div class="col-md-12">
                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Datos Generales</legend>
                        <div class="row form-group">
                          <div id="mensaje"></div>
                          <div class="col-md-6">
                            <label for="numSolicitud">N° SOLICITUD EPP</label>
                            <input id="numSolicitud" type="text" class="form-control" name="numSolicitud" placeholder="N° de Solicitud" required>
                          </div>
                          <div class="col-md-6">
                            <label for="fechaIngreso">FECHA DE INGRESO</label>
                            <input type="text"  readonly name="fechaIngreso" id="fechaIngreso" value="<?php echo date("Y/m/d",time()-18000); ?>" class="form-control" />            
                          </div>                          
                        </div>
                        <div class="row form-group">
                          <div class="col-md-6">
                              <label for="areaID">ÁREA</label>
                              <select class="form-control" id="areaID" name="areaID">
                                <option value=''>Seleccionar área</option>
                                  <?php
                                      $con=@mysql_connect('localhost','root','');
                                      @mysql_select_db("lindley");

                                      $sql = "SELECT areaID, area FROM area order by area asc";
                                      $resultado = @mysql_query($sql);
                                      while ($row=@mysql_fetch_row($resultado)) {
                                          echo "<option value='".$row['0']."'>".utf8_decode($row['1'])."</option>";
                                      }
                                  ?>
                              </select>
                          </div>                              
                          <div class="col-md-6">
                              <label for="trabajadorID">TRABAJADOR INHOSE</label>
                              <select class="form-control" id="trabajadorID" name="trabajadorID">
                                <option value=''>Seleccionar trabajador</option>
                                  <?php
                                      $con=@mysql_connect('localhost','root','');
                                      @mysql_select_db("lindley");

                                      $sql = "SELECT codigoTrabajador, CONCAT(nombres , ' ' , apellidos) AS NOMBRES FROM trabajador order by 2 asc";
                                      $resultado = @mysql_query($sql);
                                      while ($row=@mysql_fetch_row($resultado)) {
                                          echo "<option value='".$row['0']."'>".utf8_decode($row['1'])."</option>";
                                      }
                                  ?>
                              </select>
                          </div>                    
                        </div>
                        <div class="row form-group">                          
                         
                        <div class="col-md-12">
                            <label for="observaciones">OBSERVACIONES</label>
                            <textarea id="observaciones" type="text" rows="2" class="form-control" name="observaciones" placeholder="Ingrese algunas observaciones"></textarea>
                          </div> 
                        </div>
                                              
                        <div class="row form-group">
                          <div class="col-md-offset-5">
                            <input type="button" id="agregarMaestro" class="btn btn-md btn-primary" name="agregarMaestro" value="Agregar EPP'S"/>
                          </div>
                        </div>
                    </fieldset>
          </form>
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Solicitudes</legend>
                        <div class="row form-group">
                         <div id="mensaje"></div>
                          <div class="col-md-6">
                              <label for="equipoProteccionID">EQUIPO PROTECCIÓN</label>
                              <select class="form-control" id="equipoProteccionID" name="equipoProteccionID" disabled=”disabled”/>
                                <option value=''>Seleccionar Equipo Protección</option>
                                  <?php
                                      $con=@mysql_connect('localhost','root','');
                                      @mysql_select_db("lindley");

                                      $sql = "SELECT equipoProteccionID, descripcion FROM equipoProteccion order by descripcion asc";
                                      $resultado = @mysql_query($sql);
                                      while ($row=@mysql_fetch_row($resultado)) {
                                          echo "<option value='".$row['0']."'>".utf8_decode($row['1'])."</option>";
                                      }
                                  ?>
                              </select>
                          </div> 
                          <div class="row form-group">  
                          <div class="col-md-6">
                              <label for="fechaEntrega">Fecha de Entrega</label>
                              <input id="fechaEntrega" value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control" name="fechaEntrega" disabled=”disabled” required />
                          </div>  
                          </div>                         
                        </div> 

                        <div class="row form-group">
                        <div class="col-md-12">
                            <label for="motivo">MOTIVO</label>
                            <input id="motivo" type="text"  class="form-control" name="motivo" placeholder="Ingrese un motivo" disabled=”disabled” required>
                          </div> 
                        </div> 
                        
                                        
                        <div class="row form-group">
                          <div class="col-md-offset-5">
                            <input type="button" class="btn btn-md btn-primary" name="btnAgregarDeta" id="btnAgregarDeta" value="Agregar" disabled=”disabled”/>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-offset-1 col-md-10 table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tablaControl">    
                              <thead>                    
                                <tr>
                                  <th class="text-center">EQUIPO PROTECCION</th>
                                  <th class="text-center">FECHA ENTREGA</th>
                                  <th class="text-center">MOTIVO</th>                                
                                  <th class="text-center">OPERACIONES</th>
                                </tr> 
                              </thead>
                              <tbody id="control">
                                
                            </tbody>                        
                        </table>      
                        </div>
                        </div>
                    </fieldset>
                    
                 </form>
                 <div>
                   <a href="lista-ControlEPP.php"><input type="button" id="imprimir" class="btn btn-md btn-primary pull-right" name="imprimir" value="Registrar Control Entrega EPP" disabled=”disabled”/></a>
                </div>
        </div>
    </div> <!-- /container -->
         
             
          
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

