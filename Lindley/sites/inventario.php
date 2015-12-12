
<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Empresas Contratistas</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/cabeceraDetalle.js"></script>
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
        data: 'detalle='+id+'&tipo='+3,
        url: '../scripts/grabaDetalle.php',
        success: function(data){
            $('#proforma').html(data);
            $('#cantidad').val('');
            $('#unidad').val('');
            $('#descripcion').val('');
            $('#unitario').val('');
        }
      });
  }
    </script>
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
        <div class="col-md-10">
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                  <div class="col-md-12">
                    <fieldset class="scheduler-border">
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

                        <div class="row form-group">
                          <div class="col-md-offset-5">
                            <input type="button" id="agregarCabecera" class="btn btn-md btn-primary" name="agregarCabecera" value="Agregar Recursos"/>
                          </div>
                        </div>
                    </fieldset>
          </form>
          <form id="form-equipo" method="POST" action="" enctype="multipart/form-data">
                   <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Recursos</legend>
                        <div class="row form-group">
                          <div class="col-md-offset-3 col-md-6">
                              <label for="requerido">TRABAJO REQUERIDO</label>
                              <select class="form-control" id="requerido" name="requerido" disabled=”disabled”/>
                                <option value=''>Seleccionar Trabajo Requerido</option>
                                  <?php
                                      $con=@mysql_connect('localhost','root','');
                                      @mysql_select_db("lindley");

                                      $sql = "SELECT trabajoRequeridoID, descripcion FROM TrabajoRequerido order by descripcion asc";
                                      $resultado = @mysql_query($sql);
                                      while ($row=@mysql_fetch_row($resultado)) {
                                          echo "<option value='".$row['0']."'>".utf8_decode($row['1'])."</option>";
                                      }
                                  ?>
                              </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-offset-5">
                            <input type="button" class="btn btn-md btn-primary" name="btnAgregarDetalle" id="btnAgregarDetalle" value="Agregar" disabled=”disabled”/>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-offset-1 col-md-10 table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tablaDatos">
                              <thead>
                                <tr>
                                  <th class="text-center">TRABAJO REQUERIDO</th>
                                  <th class="text-center">OPERACIONES</th>
                                </tr>
                              </thead>
                              <tbody id="proforma">

                            </tbody>
                        </table>
                        </div>
                        </div>
                    </fieldset>

                 </form>
                 <div>
                   <a href="proforma-compra.php"><input type="button" id="imprimir" class="btn btn-md btn-primary pull-right" name="imprimir" value="Registrar Plan de Trabajo" disabled=”disabled”/></a>
                </div>
        </div>
    </div> <!-- /container -->



    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

