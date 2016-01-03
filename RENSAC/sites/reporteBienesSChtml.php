<?php
    include('../scripts/functions.php');
    $bienessc = bienesSinCodigoBarras();   
?>
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none;  border-bottom: solid 0.8mm; padding: 2mm }
    table.page_footer {width: 100%; border: none;  padding: 2mm}
    td{height: 10px;}  
-->
</style>
<page backtop="32mm" backbottom="28mm" backleft="10mm" backright="12mm" pagegroup="new" style="font-size: 10pt">
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
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;"></td>
                <td style="width: 34%; text-align: center"></td>
                <td style="width: 33%; text-align: right">
                   PÁGINA [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>    
    <br>
       
      <table BORDER=0.5 CELLSPACING=0 style="width: 100%; font-size: 8px; " align="left">
                    <thead>
                            <tr>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=2%;" align="center">N°</th>
                                  <th rowspan="2" style="vertical-align: middle; width=6%;" align="center">N° Invent.</th>
                                  <th rowspan="2" style="vertical-align: middle; width=6%;" align="center">Cod.Inv.Ant.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=6%; " align="center">Cod.Inv.2015</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=5%;" align="center">Cod.Bar.</th>
                                  <th colspan="5" style="vertical-align: middle; height: 22px; width=60%;" align="center">Descripción del Bien</th>
                                  <th colspan="3" style="vertical-align: middle; height: 22px; width=9%;" align="center">Dimensiones</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=3%;" align="center">Est.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=3%;" align="center">Etiq.</th>
                                  <th rowspan="2" style="vertical-align: middle; height: 22px; width=3%;" align="center">Sit.</th>
                              </tr>
                              <tr>
                                  <th style="vertical-align: middle; height: 22px; width=22%;">Denominación</th>
                                  <th style="vertical-align: middle; height: 22px; width=7%;" align="center">Marca</th>
                                  <th style="vertical-align: middle; height: 22px; width=7%;" align="center">Modelo</th>
                                  <th style="vertical-align: middle; height: 22px; width=7%;" align="center">Serie</th>
                                  <th style="vertical-align: middle; height: 22px; width=6%" align="center">Color</th>
                                  <th style="vertical-align: middle; height: 22px; width=3%" align="center">La.</th>
                                  <th style="vertical-align: middle; height: 22px; width=3%" align="center">An.</th>
                                  <th style="vertical-align: middle; height: 22px; width=3%" align="center">Al.</th>
                              </tr>
                          </thead>
                    <tbody>

                     <?php
                        $i = 1; 
                        foreach ((array)$bienesscs as $bienessc): ?>
                        <tr >
                            <td align="center"><?= $i ?></td>
                            <td align="center"><?= $bienessc[0] ?></td>
                            <td align="center"><?= $bienessc[1] ?></td>
                            <td align="center"><?= $bienessc[2] ?></td>
                            <td align="center"><?= $bienessc[3] ?></td>
                            <td><?= $bienessc[4] ?></td>
                            <td align="center"><?= $bienessc[5] ?></td>
                            <td><?= $bienessc[6] ?></td>
                            <td><?= $bienessc[7] ?></td>
                            <td><?= $bienessc[8] ?></td>
                            <td align="center"><?= $bienessc[9] ?></td>
                            <td align="center"><?= $bienessc[10] ?></td>
                            <td align="center"><?= $bienessc[11] ?></td>
                            <td align="center"><?= $bienessc[12] ?></td>
                            <td align="center"><?= $bienessc[13] ?></td>
                            <td align="center"><?= $bienessc[14] ?></td>                                                                   
                        </tr>
                    <?php $i++; endforeach ?> 
                    </tbody>
                </table>
   

</page>