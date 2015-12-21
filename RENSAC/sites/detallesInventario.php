<?php
    include('../scripts/functions.php');
   
   

    $listados = getListaDetalles($_GET['id']);
   
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

    <script type="text/javascript" src="../js/verificar.js"></script>
   

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Listar Inventarios</title>

    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/theme.css">

    <!--<script src="../js/jquery.js"></script>-->
</head>

    <body role="document">

    <?php require 'menu.php'; ?>

    <div class="container theme-showcase" role="main">
        <div class="row jumbotron color-fondo">
            <div class="col-md-12">                   
                <h4 class="text-center"><strong>INVENTARIO FÍSICO DE BIENES PATRIMONIALES AL 31 DE DICIEMBRE DEL 2015</strong></h4>
            </div>    
         </div> 

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

                     <?php
                        $i = 1; 
                        foreach ($listados as $listado): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $listado[1] ?></td>
                            <td><?= $listado[2] ?></td>
                            <td><?= $listado[3] ?></td>
                            <td><?= $listado[4] ?></td>
                            <td><?= $listado[5] ?></td>
                            <td><?= $listado[6] ?></td>
                            <td><?= $listado[7] ?></td>
                            <td><?= $listado[8] ?></td>
                            <td><?= $listado[9] ?></td>
                            <td><?= $listado[10] ?></td>
                            <td><?= $listado[11] ?></td>
                            <td><?= $listado[12] ?></td>
                            <td><?= $listado[13] ?></td>
                            <td><?= $listado[14] ?></td>                                                                   
                        </tr>
                    <?php $i++; endforeach ?> 

                    </tbody>
                </table>
            </div>
        </div>   
      
        <div class="row form-group">
            <div class="col-md-offset-2 col-md-8">
                <a href="reporteDetalles.php?id=<?php echo $_GET['id']; ?>" class="btn btn-md btn-warning btn-block" target="_blank"><span class="glyphicon glyphicon-duplicate pull-left"></span> GENERAR DOCUMENTO PDF</a>
            </div>
        </div> 


     </div> <!-- /container -->

    <!--<script src="../js/jquery.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>