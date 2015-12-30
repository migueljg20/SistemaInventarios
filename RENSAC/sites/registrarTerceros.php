<?php 

  include ('../scripts/functions.php');

  $usuarios   = getUsuarios();
  $inventariadores   = getInventariadores();

?>
<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Inventario General</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/inventarioTerceros.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" />
    <script type="text/javascript" src="../js/alertify.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="../Wickedpicker/stylesheets/wickedpicker.css">
    <script src="../Wickedpicker/src/wickedpicker.js"></script>
    

  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <?php require('menu.php'); ?>
        <div class="container theme-showcase" role="main">
        <div class="row jumbotron color-fondo">

            <div class="col-md-12">
                    <?php $time = time(); ?>
                    <h4 class="text-center"><strong>INVENTARIO FÍSICO DE BIENES DE PROPIEDAD DE TERCEROS AL 31 DE DICIEMBRE DEL 2015</strong></h4>
            </div>            
        </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <form id="formTercerosCabecera">
                  <div class="col-md-12">
                  
                      <legend class="scheduler-border">Datos Generales</legend>
                        <div class="row form-group">                          
                          <div class="col-md-4">
                            <label for="idInventario">N° INVENTARIO</label>
                            <div class="input-group">                             
                              <input type="text"  name="idInventario" id="idInventario" class="form-control" placeholder="N° de Inventario" required/>
                              <span class="input-group-btn">
                                <button id="verNumeroInventarioTerceros" class="btn btn-default glyphicon glyphicon-search" type="button" title="Buscar número de inventario."></button>
                              </span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label for="dependencia">DEPENDENCIA</label>
                            <input type="text" class="form-control" name="dependencia"  id="dependencia"  placeholder="Ingrese la dependencia"/>
                          </div>
                          <div class="col-md-4">
                            <label for="unidadOrganica">UNIDAD ORGÁNICA</label>
                            <input type="text" class="form-control" name="unidadOrganica" id="unidadOrganica"  placeholder="Ingrese la unidad orgánica"/>
                          </div>                          
                        </div>
                        <div class="row form-group">
                          <div class="col-md-4">
                            <label for="ubicacion">UBICACIÓN</label>
                            <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ingrese la unidad orgánica"/>
                          </div>
                          <div class="col-md-4">
                              <label for="responsable">USUARIO RESPONSABLE</label>
                              <select id="usuario" name="usuario" class="form-control" required>
                                <option value=""></option>
                                  <?php foreach ($usuarios as $usuario): ?>
                                      <option value="<?= $usuario[0] ?>"><?= $usuario[0] ?></option>
                                  <?php endforeach ?>                                 
                              </select>
                          </div>
                          <div class="col-md-4">
                                <label for="inventariador">INVENTARIADOR</label>
                                <select id="inventariador" name="inventariador" class="form-control" required>
                                     <option value=""></option>
                                      <?php foreach ($inventariadores as $inventariador): ?>
                                          <option value="<?= $inventariador[0] ?>"><?= $inventariador[1] ?></option>
                                      <?php endforeach ?> 
                                </select>
                          </div>                          
                        </div>  
                        <div class="row form-group">
                          <div class="col-md-4">
                              <label for="fechaHora">FECHA</label>   
                              <input type="date"  name="fecha" id="fecha" class="form-control" value="<?php echo date("d/m/Y", $time) ?>"/>                             
                          </div>
                          <div class="col-md-4">
                              <label for="timepicker">HORA</label> 
                              <input type="text" id="timepicker" name="timepicker" class="timepicker form-control hasWickedpicker" onkeypress="return false;">
                              <script type="text/javascript">
                                  $('.timepicker').wickedpicker();
                              </script>                                           
                          </div>
                          <div class="col-md-4">
                              <br>
                              <input type="submit" id="btnAgregarCabeceraTerceros" class="btn btn-md btn-primary btn-block" name="agregarCabecera" value="Agregar Encabezado"/>
                            </div>
                        </div>                      
                    </fieldset>
          </form>
          <form id="formDetalleTerceros">
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Bienes</legend>
                        <div class="row form-group">                         
                          <div class="col-md-4">
                              <label for="codigoInventario2015">CÓDIGO INVENTARIO 2015</label>
                              <div class="input-group">
                                <input type="text"  name="codigoInventario2015" id="txtcodigoInventario2015" class="form-control" placeholder="Cod. Inventario 2015" required/>
                                <span class="input-group-btn">
                                  <button id="btnVerCodInventario2015" class="btn btn-success glyphicon glyphicon-ok" type="button" title="Verificar la existencia del código actual."></button>
                                </span>
                              </div>                             
                          </div>
                          
                        </div>
                         <legend class="scheduler-border">Descripción del Bien</legend>
                         <div class="row form-group">
                           <div class="col-md-9">
                              <label for="denominacion">DENOMINACIÓN</label>
                              <input type="text"  name="denominacion" id="txtdenominacion" class="form-control" placeholder="Ingrese una denominación" required/>
                           </div>
                           <div class="col-md-3">
                              <label for="color">COLOR</label>
                              <input type="text"  name="color" id="txtcolor" class="form-control" placeholder="Ingrese un color"/>
                           </div>
                         </div>
                          <div class="row form-group">
                            <div class="col-md-4">
                                <label for="marca">MARCA</label>
                                <input type="text"  name="marca" id="txtmarca" class="form-control" placeholder="Ingrese una marca"/>
                            </div>
                            <div class="col-md-4">
                                <label for="modelo">MODELO</label>
                                <input type="text"  name="modelo" id="txtmodelo" class="form-control" placeholder="Ingrese un modelo"/>
                            </div>
                            <div class="col-md-4">
                                <label for="serie">SERIE</label>
                                <input type="text"  name="serie" id="txtserie" class="form-control" placeholder="Ingrese una serie"/>
                            </div>
                          </div> 
                          

                           <legend class="scheduler-border">Dimensiones</legend>     
                           <div class="row form-group">
                              <div class="col-md-2">
                                <label for="largo">LARGO</label>
                                <input type="double"  name="largo" id="txtlargo" class="form-control" placeholder="En metros"/>
                              </div>
                              <div class="col-md-2">
                                <label for="ancho">ANCHO</label>
                                <input type="double"  name="ancho" id="txtancho" class="form-control" placeholder="En metros"/>
                              </div>
                              <div class="col-md-2">
                                <label for="alto">ALTO</label>
                                <input type="double"  name="alto" id="txtalto" class="form-control" placeholder="En metros"/>
                              </div>
                              <div class="col-md-5 col-md-offset-1">
                                <label for="estado">ESTADO DE CONSERVACIÓN</label>
                                <br>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacion" id="rbNuevo" value="N" checked> Nuevo
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacion" id="rbBueno" value="B"> Bueno
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacion" id="rbRegular" value="R"> Regular
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacion" id="rbMalo" value="M"> Malo
                                </label>
                              </div>                            
                           </div>    
                           <div class="row form-group">
                              <div class="col-md-6">
                                <label for="propietario">PROPIETARIO</label>
                                <input type="double"  name="propietario" id="txtpropietario" class="form-control" placeholder="Ingrese el propietario"/>
                              </div>
                              <div class="col-md-6">
                                <label for="observacion">OBSERVACIÓN</label>
                                <input type="double"  name="observacion" id="txtobservacion" class="form-control" placeholder="Ingrese la observación"/>
                              </div>
                           </div>            

                        
                        <div class="row form-group">
                          <div class="col-md-offset-2 col-md-8">
                            <input type="submit" class="btn btn-md btn-primary btn-block" name="btnAgregarDetalle" id="btnAgregarDetalle" value="AGREGAR BIEN PATRIMONIAL"/>
                          </div>
                        </div> 
                  </form>

                 
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                        <table id="detalleInventarioTerceros" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">N°</th>                                
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Inv.2015</th>                                  
                                  <th colspan="5" class="text-center" style="vertical-align: middle;">Descripción del Bien</th>
                                  <th colspan="3" class="text-center" style="vertical-align: middle;">Dimensiones</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Estado</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Propietario</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Observación</th>
                              </tr>
                              <tr>
                                  <th class="text-center" style="vertical-align: middle;">Denominación</th>
                                  <th class="text-center" style="vertical-align: middle;">Marca</th>
                                  <th class="text-center" style="vertical-align: middle;">Modelo</th>
                                  <th class="text-center" style="vertical-align: middle;">Serie</th>
                                  <th class="text-center" style="vertical-align: middle;">Color</th>
                                  <th class="text-center" style="vertical-align: middle;">Largo</th>
                                  <th class="text-center" style="vertical-align: middle;">Ancho</th>
                                  <th class="text-center" style="vertical-align: middle;">Alto</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>
                      </table>
                    </div>
                </div>
        </div>

       
    </div> <!-- /container -->



    <script src="../js/jquery.js"></script>    
    <script src="../js/bootstrap.min.js"></script>
    
  </body>
</html>

