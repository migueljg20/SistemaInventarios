<?php
    include('../scripts/functions.php');
    $listados = getListaDetalles($_GET['id']);   
    $encabezado = getCabecera($_GET['id']);
?>
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none;  border-bottom: solid 0.8mm; padding: 2mm }
    table.page_footer {width: 100%; border: none;  padding: 2mm}
    td{height: 10px;}  
-->
</style>
<page backtop="28mm" backbottom="28mm" backleft="10mm" backright="12mm" pagegroup="new" style="font-size: 10pt">
    <page_header>
        <table class="page_header">
             <tr>
             <td style="width: 2%; text-align: left">
                </td>
                <td style="width: 43%; text-align: left"><img src="../img/sedalib.jpg" alt="loogo" style="width: 30%">
                </td>
                <td style="width: 53%; text-align: right"><img src="../img/redemp.jpg" alt="loogo" style="width: 30%">
                </td>
                <td style="width: 2%; text-align: right">
                </td>
            </tr>
        </table>
        <br>       
        <div align="center"><span style="font-size: 20px;
            font-weight: bold;">
            INVENTARIO FISICO DE BIENES PATRIMONIALES AL 31 DE DICIEMBRE DEL 2015</span>
        </div>
    </page_header>
    <page_footer>
        <table style="width: 100%">
            <tr>
                <td style="width: 33%; text-align: right;">____________________________</td>
                <td style="width: 34%; text-align: center">__________________________________</td>
                <td style="width: 33%; text-align: left">_____________________________________</td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: right;"> NOMBRE Y FIRMA DEL USUARIO</td>
                <td style="width: 34%; text-align: center"> NOMBRE Y FIRMA DEL INVENTARIADOR</td>
                <td style="width: 33%; text-align: left"> FIRMA EQUIPO/COMISIÓN DE INVENTARIO</td>
            </tr>
        </table>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;"></td>
                <td style="width: 34%; text-align: center"></td>
                <td style="width: 33%; text-align: right">
                   </td>
            </tr>
        </table>
    </page_footer>    
    
     <table style="width: 100%; font-size: 9pt" class="cabecera">
       <tr>
         <td style="width:18%; text-align: left"><b>DEPENDENCIA </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][7]; ?></td>
         <td style="width:20%; text-align: left"></td>
         <td style="width:18%; text-align: left"><b>INVENTARIADO POR </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][8]; ?></td>
       </tr>
       <tr>
         <td style="width:18%; text-align: left"><b>UNIDAD ORGANICA </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][5]; ?></td>
         <td style="width:20%; text-align: left"></td>
         <td style="width:18%; text-align: left"><b>INVENTARIADO POR </b></td>
         <td style="width:22%: text-align: left"><?php echo $encabezado[0][9]; ?></td>
       </tr>
       <tr>
         <td style="width:18%; text-align: left"><b>UBICACION </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][3]; ?></td>
         <td style="width:20%; text-align: left"></td>
         <td style="width:18%; text-align: left"><b>FECHA </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][1]; ?></td>
       </tr>
       <tr>
         <td style="width:18%; text-align: left"><b>USUARIO RESPONSABLE </b></td>
         <td style="width:22%; text-align: left"><?php echo $encabezado[0][4]; ?></td>
         <td style="width:20%; text-align: left"></td>
         <td style="width:18%; text-align: left"><b>HORA </b></td>
         <td style="width:22%; text-align: left">0:00</td>
       </tr>
     </table>
      <br>    
       <table BORDER=0.5 CELLSPACING=0 style="width: 100%; font-size: 8px; " align="left">
                    <thead>
                            <tr>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=2%;" align="center">N°</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=6%;" align="center">Código Patrimonial</th>
                                  <th colspan="5" style="vertical-align: middle; height: 22px; width=62%;" align="center">Descripción del Bien</th>
                                  <th colspan="3" style="vertical-align: middle; height: 22px; width=12%;" align="center">Dimensiones</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=4%;" align="center">Estado</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=6%;" align="center">Observaciones</th>
                              </tr>
                              <tr>
                                  <th style="vertical-align: middle; height: 22px; width=22%;">Denominación</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%;" align="center">Marca</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%;" align="center">Modelo</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%;" align="center">Serie</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%" align="center">Color</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%" align="center">Largo</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%" align="center">Ancho</th>
                                  <th style="vertical-align: middle; height: 22px; width=4%" align="center">Alto</th>
                              </tr>
                          </thead>
                    <tbody>

                     <?php
                        $i = 1; 
                        foreach ((array)$listados as $listado): ?>
                        <tr >
                            <td align="center"><?= $i ?></td>
                            <td align="center"><?= $listado[3] ?></td>
                            <td><?= $listado[4] ?></td>
                            <td align="center"><?= $listado[5] ?></td>
                            <td><?= $listado[6] ?></td>
                            <td><?= $listado[7] ?></td>
                            <td><?= $listado[8] ?></td>
                            <td align="center"><?= $listado[9] ?></td>
                            <td align="center"><?= $listado[10] ?></td>
                            <td align="center"><?= $listado[11] ?></td>
                            <td align="center"><?= $listado[12] ?></td>
                            <td align="center"><?= $listado[15] ?></td>
                        </tr>
                    <?php $i++; endforeach ?> 
                          <?php 
                          if($i<=16){
                            for($j=$i;$j<=16;$j++)
                            { ?>
                              <tr >
                            <td align="center"><?= $j ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                            }
                          }
                           ?>
                    </tbody>
                </table>
                <br>
                <div style="font-size: 7pt">
                <b>LEYENDA:</b> ESTADO (N) NUEVO (B) BUENO (R) REGULAR (M) MALO
                <ul>
                  <li>EL USUARIO DECLARA HABER MOSTRADO TODOS LOS BIENES PATRIMONIALES QUE SE ENCUENTRAN BAJO SU RESPONSABILIDAD 
                  Y NO CONTAR CON MAS BIENES PATRIMONIALES MATERIA DE INVENTARIO.</li>
                  <li>EL USUARIO ES EL RESPONSABLE DEL BUEN USO DE LOS BIENES PATRIMONIALES REGISTRADOS EN LA PRESENTE FICHA Y 
                  EN CASO PÉRDIDA O EXTRAVÍO, SERÁN REPUESTOS O REEMBOLSADOS POR ÉL,
                  <br>DE SER EL RESULTADO DE LAS INDAGACIONES REALIZADAS POR LA ENTIDAD.<br>
                  CUALQUIER MOVIMIENTO DE BIENES DENTRO O FUERA DE LAS INSTALACIONES DE SEDALIB S.A. DEBERÁ SER COMUNICADO AL RESPONSABLE 
                  DE CONTROL PATRIMONIAL BAJO RESPONSABILIDAD.</li>
                </ul>
                </div>
                <br>
                <br>
                <br>
   

</page>