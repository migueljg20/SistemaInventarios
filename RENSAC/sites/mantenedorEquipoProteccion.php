<?php
    include('../scripts/funciones.php');
    $clase = new sistema;
?>
<!DOCTYPE html>
<html lang="es">
  <head>

                  <!-- agregar jeiner -->                         
                  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>

                  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">         
                  <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
                  
                  <link rel="stylesheet" href="../css/alertify.core.css" />
                  <link rel="stylesheet" href="../css/alertify.default.css" />
                  <script type="text/javascript" src="../js/alertify.js"></script>

                  <script type="text/javascript" src="../js/epp.js"></script>
                  <link rel="stylesheet" href="../css/jeiner.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>EPP</title>

    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">

    <!--<script src="../js/jquery.js"></script>-->
   <script src="../js/mijava.js"></script>


  </head>

  <body role="document">

    <?php require 'menu.php'; ?>

    <div class="container theme-showcase" role="main">
      <div class="jumbotron color-fondo">
        <h3 class="text-center"><strong>EQUIPO DE PROTECCION</strong></h3>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="col-md-offset-4">
            <input type="button" value="Agregar Nuevo Equipo" id="nuevoEquipo" class="btn col-md-offset-1 btn-primary"/>
            <input type="button" class="btn btn-danger" value="Eliminar" id="btnEliminarTR" onCLick="eliminar();">
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
                                    <th>CÓDIGO</th>
                                    <th>EQUIPO</th>
                                    <th>STOCK</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>COLOR</th>
                                </tr>
                            </thead>           
                            <tfoot>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>EQUIPO</th>
                                    <th>STOCK</th>   
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>COLOR</th>                                 
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

 
      <div class="modal fade" id="modalNuevoEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 id="cabeceraRegistro"type="hidden" class="modal-title subfuente text-center">Registrar Nuevo Equipo</h4>
              <input type="hidden" id="txtFlag" value="N">              
            </div>
            <div class="modal-body">
              <form action="" class="form-horizontal">
                <div id="mensaje"></div>
                  <div class="form-group">
                      <label for="codigoEquipo" class="col-md-3 control-label">CÓDIGO</label>
                      <div class="col-md-8">
                          <input id="codigoEquipo" type="text" class="form-control" name="codigoEquipo" placeholder="">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="descripcion" class="col-md-3 control-label">EQUIPO PROTECCIÓN</label>
                      <div class="col-md-8">
                          <input id="descripcion" onkeypress="return textonly(event);" type="text" class="form-control" name="descripcion" placeholder="Ingrese el nombre del equipo de protección">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stock" class="col-md-3 control-label">STOCK</label>
                      <div class="col-md-8">
                          <input id="stock" onkeypress="return numbersonly(event);" type="text" class="form-control" name="stock" placeholder="Ingrese el stock del equipo de protección">
                      </div>
                  </div>    
                  <div class="form-group">
                      <label for="marca" class="col-md-3 control-label">MARCA</label>
                      <div class="col-md-8">
                          <input id="marca" onkeypress="return textonly(event);" type="text" class="form-control" name="marca" placeholder="Ingrese la marca del equipo de protección">
                      </div>
                  </div> 
                  <div class="form-group">
                      <label for="modelo" class="col-md-3 control-label">MODELO</label>
                      <div class="col-md-8">
                          <input id="modelo" type="text" class="form-control" name="modelo" placeholder="Ingrese el modelo del equipo de protección">
                      </div>
                  </div> 
                  <div class="form-group">
                      <label for="color" class="col-md-3 control-label">COLOR</label>
                      <div class="col-md-8">
                          <input id="color" onkeypress="return textonly(event);" type="text" class="form-control" name="color" placeholder="Ingrese el color del equipo de protección">
                      </div>
                  </div>               
                  <div class="form-group">
                    <a class="btn btn-default col-md-offset-3" data-dismiss="modal">Cancelar</a>
                    <input type="button" id="registroEquipo" class="btn btn-success col-md-offset-2" value="Guardar"/>
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
