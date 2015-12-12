
<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Empresas Contratistas</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/inventario.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">
  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <?php require('menu.php'); ?>
        <div class="container theme-showcase" role="main">
        <div class="row jumbotron color-fondo">

            <div class="col-md-9">
                    <?php $time = time(); ?>
                    <h4 class="text-center"><strong>INVENTARIO FÍSICO DE BIENES PATRIMONIALES - FECHA <?php echo date("d/m/Y", $time) ?></h4>
            </div>
            <div class="col-md-2 col-md-offset-1">
                <h4>N° 000038</h4>
            </div>
        </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                  <div class="col-md-12">
                  
                      <legend class="scheduler-border">Datos Generales</legend>
                        <div class="row form-group">
                          <div id="mensaje"></div>
                          <div class="col-md-4">
                            <label for="local">LOCAL</label>
                            <input id="txtlocal" type="text" class="form-control" name="local" placeholder="Ingrese el Local" required>
                          </div>
                          <div class="col-md-4">
                            <label for="fechaInicio">UBICACIÓN</label>
                            <input type="text"  name="fechaInicio" id="fechaInicio" class="form-control" placeholder="Ingrese la ubicación"/>
                          </div>
                          <div class="col-md-4">
                            <label for="fecha">FECHA</label>
                            <input type="date"  name="fecha" id="txtfecha" class="form-control" value="<?php echo date("d/m/Y", $time) ?>"/>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-4">
                              <label for="dependencia">DEPENDENCIA</label>
                              <input type="text"  name="dependencia" id="txtdependencia" class="form-control" placeholder="Ingrese la dependencia"/>
                          </div>
                          <div class="col-md-4">
                            <label for="ambiente">AMBIENTE</label>
                            <input id="txtambiente" type="text" class="form-control" name="ambiente" placeholder="Ingrese el ambiente">
                          </div>
                          <div class="col-md-4">
                              <label for="area">ÁREA</label>
                              <input type="text"  name="area" id="txtarea" class="form-control" placeholder="Ingrese el área"/>
                          </div>
                        </div>                        
                    </fieldset>
          </form>
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Bienes</legend>
                        <div class="row form-group">
                          <div class="col-md-3">
                              <label for="codigoInventario">CÓDIGO INVENTARIO</label>
                              <input type="text"  name="codigoInventario" id="txtcodigoInventario" class="form-control" placeholder="Cod. Inventario"/>
                          </div>
                          <div class="col-md-3">
                              <label for="codigoInventario2015">CÓDIGO INVENTARIO 2015</label>
                              <input type="text"  name="codigoInventario2015" id="txtcodigoInventario2015" class="form-control" placeholder="Cod. Inventario 2015"/>
                          </div>
                          <div class="col-md-3">
                              <label for="codigobarras">CÓDIGO DE BARRAS</label>
                              <input type="text"  name="codigobarras" id="txtcodigobarras" class="form-control" placeholder="Cod. Barras"/>
                          </div>
                        </div>
                         <legend class="scheduler-border">Descripción del Bien</legend>
                         <div class="row form-group">
                           <div class="col-md-12">
                              <label for="denominacion">DENOMINACIÓN</label>
                              <input type="text"  name="denominacion" id="txtdenominacion" class="form-control" placeholder="Ingrese una denominación"/>
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
                                <input type="text"  name="largo" id="txtlargo" class="form-control" placeholder="En metros"/>
                            </div>
                            <div class="col-md-2">
                                <label for="ancho">ANCHO</label>
                                <input type="text"  name="ancho" id="txtancho" class="form-control" placeholder="En metros"/>
                            </div>
                            <div class="col-md-2">
                                <label for="alto">ALTO</label>
                                <input type="text"  name="alto" id="txtalto" class="form-control" placeholder="En metros"/>
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
                                      <input type="checkbox" name="etiquetado" id="chkEtiquetado"> Etiquetado
                                    </label>
                                  </div>
                              </div>
                              <div class="col-md-2">                                 
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="operativo" id="chkOperativo"> Operativo
                                    </label>
                                  </div>
                              </div>
                            </div>              

                         </div>
                        <div class="row form-group">
                          <div class="col-md-offset-2 col-md-8">
                            <input type="button" class="btn btn-md btn-primary btn-block" name="btnAgregarDetalle" id="btnAgregarDetalle" value="AGREGAR BIEN PATRIMONIAL"/>
                          </div>
                        </div> 
                  </form>

                  <div class="row">
                      <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">N°</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Inv.Ant.</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Inv.2015</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Cod.Barras</th>
                                  <th colspan="4" class="text-center" style="vertical-align: middle;">Descripción del Bien</th>
                                  <th colspan="3" class="text-center" style="vertical-align: middle;">Dimensiones</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Estado</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Etiq.</th>
                                  <th rowspan="2" class="text-center" style="vertical-align: middle;">Situa.</th>
                              </tr>
                              <tr>
                                  <th class="text-center" style="vertical-align: middle;">Denominación</th>
                                  <th class="text-center" style="vertical-align: middle;">Marca</th>
                                  <th class="text-center" style="vertical-align: middle;">Modelo</th>
                                  <th class="text-center" style="vertical-align: middle;">Serie</th>
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

