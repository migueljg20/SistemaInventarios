<?php 
    ob_start();
    include('reporteDetalleshtml.php');
    $content = ob_get_clean();

    require_once('../html2pdf/html2pdf.class.php');
    try
    {
        $pdf = new HTML2PDF('L', 'A4', 'fr', true, 'UTF-8', 0);
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->writeHTML($content);
        $pdf->pdf->IncludeJS('print(TRUE)');
        $pdf->Output('reporteBienes.pdf'); //aqui con q nombre saldra el rep       
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>