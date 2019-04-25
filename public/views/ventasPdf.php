<?php
// require '../../config/conexion.php';
require '../../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
// recoger el contenido del html
if (isset($_GET['idventa'])) {
  ob_start();
  require_once '../componentes/dataVentasPdf.php';
  $html = ob_get_clean();

  $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
  $html2pdf->writeHTML($html);
  $html2pdf->output('pdf_generate.pdf');
}
 ?>
