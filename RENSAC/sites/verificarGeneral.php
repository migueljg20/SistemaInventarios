<?php
    include('../scripts/functions.php');

    $listados = getListaInventarios();
    $cantidad = verCantidadDigitados();
   
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
    <link rel="stylesheet" href="../css/jeiner.css">

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
                <h4 class="text-center"><strong>LISTADO DE INVENTARIOS REGISTRADOS AL 31 DE DICIEMBRE</strong></h4>
            </div>            
       </div>


       <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12 table-responsive">
<p><b> Cantidad de Bienes Digitados:</b> <?= $cantidad[0][0] ?> </p>
                    <div class="listaDatos">
                      <table id="tablaDatos" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>N°</th>                                  
                                  <th>N° Inventario</th>
                                  <th>Fecha</th>
                                  <th>Local</th>
                                  <th>Ubicación</th>
                                  <th>Usuario</th>
                                  <th>Inventariador 1</th>
                                  <th>Inventariador 2</th>
                                  <th>Operaciones</th>
                                </tr>
                            </thead>          
                            
                            <tbody>
                              <!-- Aqui irán los elementos de la tabla -->
                                
                                <?php
                                $i = 1; 
                                foreach ((array)$listados as $listado): ?>
                                    <tr>
                                          <td><?= $i ?></td>
                                          <td><?= $listado[0] ?></td>
                                          <td><?= $listado[1] ?></td>
                                          <td><?= $listado[2] ?></td>
                                          <td><?= $listado[3] ?></td>
                                          <td><?= $listado[4] ?></td>
                                          <td><?= $listado[5] ?></td>
                                          <td><?= $listado[6] ?></td>
                                          <td value="<?= $listado[0] ?>"><a href="detallesInventario.php?id=<?= $listado[0] ?>" class="btn btn-success btn-xs col-md-offset-2">Ver Detalles</a></td>
                                    </tr>
                                <?php $i++; endforeach ?> 
                            </tbody>
                        </table>
                    </div> <!-- listadatos -->


        </div>
        <div class="col-md-1"></div>
      </div>

      <div class="row form-group">
        <div class="col-md-offset-2 col-md-8">
            <a href="reporteDetalles2.php" class="btn btn-md btn-warning btn-block" name="btnAgregarDetalle" id="btnAgregarDetalle" target="_blank"><span class="glyphicon glyphicon-duplicate pull-left"></span> GENERAR DOCUMENTO PDF</a>
        </div>
    </div>

 
      
    </div> <!-- /container -->

    <!--<script src="../js/jquery.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>