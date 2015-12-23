<?php
    include('../scripts/functions.php');
    $listados = getListaDetalles($_GET['id']);   
?>
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none;  border-bottom: solid 0.8mm; padding: 2mm }
    table.page_footer {width: 100%; border: none;  border-top: solid 0.8mm ; padding: 2mm}
    td{height: 25px;}
-->
</style>
<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" pagegroup="new" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
             <tr>
             <td style="width: 5%; text-align: left">
                </td>
                <td style="width: 40%; text-align: left">SEDALIB S.A.
                </td>
                <td style="width: 50%; text-align: right">RED EMPRESARIAL DEL NORTE
                </td>
                <td style="width: 5%; text-align: right">
                </td>
            </tr>
        </table>       
        
    </page_header>
        <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;"></td>
                <td style="width: 34%; text-align: center"></td>
                <td style="width: 33%; text-align: right">
                   PÁGINA [[page_cu]]/[[page_nb]] </td>
            </tr>
        </table>
    </page_footer>    
    <br><br><br>
        <div align="center"><span style="font-size: 20px;
            font-weight: bold;text-decoration: underline">
            Reporte de Inventario <?php echo $_GET['id']; ?></span></div><br>
        <br>     
    <br>
       <table BORDER=0.5 CELLSPACING=0 style="width: 100%; font-size: 12px; " align="left">
                    <thead>
                            <tr>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=2%;" align="center">N°</th>
                                  <th rowspan="2" style="vertical-align: middle; width=9%;" align="center">Cod.Inv.Ant.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=8%; " align="center">Cod.Inv.2015</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=7%;" align="center">Cod.Bar.</th>
                                  <th colspan="5" style="vertical-align: middle; height: 25px; width=48%;" align="center">Descripción del Bien</th>
                                  <th colspan="3" style="vertical-align: middle; height: 25px; width=12%;" align="center">Dimensiones</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=4%;" align="center">Est.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=4%;" align="center">Etiq.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 25px; width=4%;" align="center">Sit.</th>
                              </tr>
                              <tr>
                                  <th style="vertical-align: middle; height: 25px; width=22%;">Denominación</th>
                                  <th style="vertical-align: middle; height: 25px; width=6%;" align="center">Marca</th>
                                  <th style="vertical-align: middle; height: 25px; width=8%;" align="center">Modelo</th>
                                  <th style="vertical-align: middle; height: 25px; width=6%;" align="center">Serie</th>
                                  <th style="vertical-align: middle; height: 25px; width=6%" align="center">Color</th>
                                  <th style="vertical-align: middle; height: 25px; width=4%" align="center">La.</th>
                                  <th style="vertical-align: middle; height: 25px; width=4%" align="center">An.</th>
                                  <th style="vertical-align: middle; height: 25px; width=4%" align="center">Al.</th>
                              </tr>
                          </thead>
                    <tbody>

                     <?php
                        $i = 1; 
                        foreach ((array)$listados as $listado): ?>
                        <tr >
                            <td align="center"><?= $i ?></td>
                            <td align="center"><?= $listado[1] ?></td>
                            <td align="center"><?= $listado[2] ?></td>
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
                            <td align="center"><?= $listado[13] ?></td>
                            <td align="center"><?= $listado[14] ?></td>                                                                   
                        </tr>
                    <?php $i++; endforeach ?> 

                    </tbody>
                </table>
</page>