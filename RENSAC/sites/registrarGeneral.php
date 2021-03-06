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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/inventario.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" />
    <script type="text/javascript" src="../js/alertify.js"></script>
    
    

  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <?php require('menu.php'); ?>
        <div class="container theme-showcase" role="main">
        <div class="row jumbotron color-fondo">

            <div class="col-md-12">
                    <?php $time = time(); ?>
                    <h4 class="text-center"><strong>INVENTARIO FÍSICO DE BIENES PATRIMONIALES AL 31 DE DICIEMBRE DEL 2015</strong></h4>
            </div>            
        </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <form id="formCabecera">
                  <div class="col-md-12">                      
                  
                      <legend class="scheduler-border">Datos Generales</legend>
                        <div class="row form-group">
                          <div class="col-md-4">
                            <label for="idInventario">N° INVENTARIO</label>
                            <div class="input-group">                             
                              <input type="text"  name="idInventario" id="idInventario" class="form-control" placeholder="N° de Inventario" required/>
                              <span class="input-group-btn">
                                <button id="verNumeroInventario" class="btn btn-default glyphicon glyphicon-search" type="button" title="Buscar número de inventario."></button>
                              </span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label for="fecha">FECHA</label>
                            <input type="date"  name="fecha" id="fecha" class="form-control" value="<?php echo date("d/m/Y", $time) ?>"/>
                          </div>
                           <div class="col-md-4">
                            <label for="local">LOCAL</label>
                            <input id="local" type="text" class="form-control" name="local" placeholder="Ingrese el Local" required>
                          </div>                          
                        </div>
                        <div class="row form-group">
                          <div id="mensaje"></div>
                         
                          <div class="col-md-4">
                            <label for="ubicacion">UBICACIÓN</label>
                            <input type="text"  name="ubicacion" id="ubicacion" class="form-control" placeholder="Ingrese la ubicación"/>
                          </div>
                          <div class="col-md-4">
                              <label for="usuario">USUARIO</label>
                              <select id="usuario" name="usuario" class="form-control" required>
                                <option value=""></option>
                                  <?php foreach ($usuarios as $usuario): ?>
                                      <option value="<?= $usuario[0] ?>"><?= $usuario[0] ?></option>
                                  <?php endforeach ?>                                 
                              </select>
                          </div>
                          <div class="col-md-4">
                            <label for="cargo">CARGO</label>
                             <input type="text"  name="cargo" id="cargo" class="form-control" placeholder="Ingrese el cargo del usuario"/>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-4">
                              <label for="dependencia">DEPENDENCIA</label>
                              <input type="text"  name="dependencia" id="dependencia" class="form-control" placeholder="Ingrese la dependencia"/>
                          </div>
                          <div class="col-md-4">
                            <label for="ambiente">AMBIENTE</label>
                            <input id="ambiente" type="text" class="form-control" name="ambiente" placeholder="Ingrese el ambiente">
                          </div>
                          <div class="col-md-4">
                              <label for="area">ÁREA</label>
                              <input type="text"  name="area" id="area" class="form-control" placeholder="Ingrese el área"/>
                          </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="inventariador1">INVENTARIADOR 1</label>
                                <select id="inventariador1" name="inventariador1" class="form-control" required>
                                     <option value=""></option>
                                      <?php foreach ($inventariadores as $inventariador): ?>
                                          <option value="<?= $inventariador[0] ?>"><?= $inventariador[1] ?></option>
                                      <?php endforeach ?> 
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inventariador2">INVENTARIADOR 2</label>
                                <select id="inventariador2" name="inventariador2" class="form-control" required>
                                   <option value=""></option>
                                      <?php foreach ($inventariadores as $inventariador): ?>
                                          <option value="<?= $inventariador[0] ?>"><?= $inventariador[1] ?></option>
                                      <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                              <br>
                              <input type="submit" id="btnAgregarCabecera" class="btn btn-md btn-primary btn-block" name="agregarCabecera" value="Agregar Encabezado"/>
                            </div>
                          </div>                       
                    </fieldset>
          </form>
          <form id="formDetalle">
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Bienes</legend>
                        <div class="row form-group">
                          <div class="col-md-4">
                              <label for="codigoInventario">CÓDIGO INVENTARIO ANTIGUO</label>
                              <div class="input-group"> 
                              <input type="text"  name="codigoInventario" id="txtcodigoInventario" class="form-control" placeholder="Cod. Inventario Antiguo"/>
                              <span class="input-group-btn">
                                <button id="btnVerAnterior" class="btn btn-default glyphicon glyphicon-search" type="button" title="Buscar bien por el código anterior."></button>
                              </span>
                            </div>    
                          </div>
                          <div class="col-md-4">
                              <label for="codigoInventario2015">CÓDIGO INVENTARIO 2015</label>
                              <div class="input-group">
                                <input type="text"  name="codigoInventario2015" id="txtcodigoInventario2015" class="form-control" placeholder="Cod. Inventario 2015" required/>
                                <span class="input-group-btn">
                                  <button id="btnVerCodInventario2015" class="btn btn-success glyphicon glyphicon-ok" type="button" title="Verificar la existencia del código actual."></button>
                                </span>
                              </div>
                             
                          </div>
                          <div class="col-md-4">
                             <label for="codigobarras">CÓDIGO DE BARRAS</label>
                             <div class="input-group">                                 
                              <input type="text"  name="codigobarras" id="txtcodigobarras" class="form-control" placeholder="Cod. Barras"/>
                              <span class="input-group-btn">
                                <button id="btnVerCodBarras" class="btn btn-default glyphicon glyphicon-search" type="button" title="Buscar bien por el código de barras."></button>
                                <button id="btnVerificarCodBarras" class="btn btn-success glyphicon glyphicon-ok" type="button"  title="Verificar la existencia del código de barras."></button>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">  
                          <div class="col-md-5 ">
                                <label for="anoInventario">AÑO DE INVENTARIO</label>
                                <br>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2008" value="8" checked> 2008
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2009" value="9"> 2009
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2010" value="10"> 2010
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2011" value="11"> 2011
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2012" value="12"> 2012
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="anoInventario" id="rb2013" value="13"> 2013
                                </label>
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
                              <div class="col-md-2">                                 
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="etiquetado" id="chkEtiquetado" checked> Etiquetado
                                    </label>
                                  </div>
                              </div>
                              <div class="col-md-2">                                 
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="operativo" id="chkOperativo" checked> Operativo
                                    </label>
                                  </div>
                              </div>                              
                            </div>   

                            <div class="row form-group">
                              <div class="col-md-12"> 
                                <label for="observacion">OBSERVACIÓN</label>
                                <input type="text"  name="observacion" id="txtobservacion" class="form-control" placeholder="Ingrese una observación"/>
                              </div>
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
                        <table id="detalleInventario" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">N°</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Inv.Ant.</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Inv.2015</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Barras</th>
                                  <th colspan="5" class="text-center" style="vertical-align: middle;">Descripción del Bien</th>
                                  <th colspan="3" class="text-center" style="vertical-align: middle;">Dimensiones</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Estado</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Etiq.</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Situa.</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Observación</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Opción</th>
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


        <div id="modalEditar" class="modal fade" role="dialog" style="width: 100%" >
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ventana de edición</h4>
                </div>
                <form action="#" id="formEditar" method="POST" style="font-size: 8pt">
                    <div class="modal-body">                           
                        <input type="hidden" id="idEdit" name="id" value=""/>
                        <legend class="scheduler-border">Bienes</legend>
                        <div class="row form-group">
                          <div class="col-md-4">
                              <label for="codigoInventario">CÓDIGO INVENTARIO ANTIGUO</label>
                              <div class="input-group"> 
                              <input type="text"  name="codigoInventario" id="txtcodigoInventarioM" class="form-control" placeholder="Cod. Inventario Antiguo"/>
                              
                            </div>    
                          </div>
                          <div class="col-md-4">
                              <label for="codigoInventario2015">CÓDIGO INVENTARIO 2015</label>
                              <div class="input-group">
                                <input type="text"  name="codigoInventario2015" id="txtcodigoInventario2015M" class="form-control" placeholder="Cod. Inventario 2015" required/>
                                
                              </div>
                             
                          </div>
                          <div class="col-md-4">
                             <label for="codigobarras">CÓDIGO DE BARRAS</label>
                             <div class="input-group">                                 
                              <input type="text"  name="codigobarras" id="txtcodigobarrasM" class="form-control" placeholder="Cod. Barras"/>
                              
                            </div>
                          </div>
                        </div>                        
                         <legend class="scheduler-border">Descripción del Bien</legend>
                         <div class="row form-group">
                           <div class="col-md-9">
                              <label for="denominacion">DENOMINACIÓN</label>
                              <input type="text"  name="denominacion" id="txtdenominacionM" class="form-control" placeholder="Ingrese una denominación" required/>
                           </div>
                           <div class="col-md-3">
                              <label for="color">COLOR</label>
                              <input type="text"  name="color" id="txtcolorM" class="form-control" placeholder="Ingrese un color"/>
                           </div>
                         </div>
                          <div class="row form-group">
                            <div class="col-md-4">
                                <label for="marca">MARCA</label>
                                <input type="text"  name="marca" id="txtmarcaM" class="form-control" placeholder="Ingrese una marca"/>
                            </div>
                            <div class="col-md-4">
                                <label for="modelo">MODELO</label>
                                <input type="text"  name="modelo" id="txtmodeloM" class="form-control" placeholder="Ingrese un modelo"/>
                            </div>
                            <div class="col-md-4">
                                <label for="serie">SERIE</label>
                                <input type="text"  name="serie" id="txtserieM" class="form-control" placeholder="Ingrese una serie"/>
                            </div>
                          </div> 


                           <legend class="scheduler-border">Dimensiones</legend>     
                           <div class="row form-group">
                              <div class="col-md-2">
                                <label for="largo">LARGO</label>
                                <input type="double"  name="largo" id="txtlargoM" class="form-control" placeholder="En metros"/>
                            </div>
                            <div class="col-md-2">
                                <label for="ancho">ANCHO</label>
                                <input type="double"  name="ancho" id="txtanchoM" class="form-control" placeholder="En metros"/>
                            </div>
                            <div class="col-md-2">
                                <label for="alto">ALTO</label>
                                <input type="double"  name="alto" id="txtaltoM" class="form-control" placeholder="En metros"/>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <label for="estado">ESTADO DE CONSERVACIÓN</label>
                                <br>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacionM" id="rbNuevoM" value="N" > N
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacionM" id="rbBuenoM" value="B"> B
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacionM" id="rbRegularM" value="R"> R
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="estadoConservacionM" id="rbMaloM" value="M"> M
                                </label>
                            </div>
                            
                           </div>  

                           <div class="row form-group">
                              <div class="col-md-2">                                 
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="etiquetado" id="chkEtiquetadoM" > Etiquetado
                                    </label>
                                  </div>
                              </div>
                              <div class="col-md-2">                                 
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="operativo" id="chkOperativoM" > Operativo
                                    </label>
                                  </div>
                              </div>                              
                            </div>   

                            <div class="row form-group">
                              <div class="col-md-12"> 
                                <label for="observacion">OBSERVACIÓN</label>
                                <input type="text"  name="observacion" id="txtobservacionM" class="form-control" placeholder="Ingrese una observación"/>
                              </div>
                            </div> 
                          </div>                         
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" id="btnCancelar">Cancelar</button>
                          <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
       
    </div> <!-- /container -->

    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

