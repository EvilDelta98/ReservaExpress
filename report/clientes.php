<?php
require_once("../lib/vendor/autoload.php");
echo "PDF";
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
//conxion
//antes de hacer esto llamar al dao de clientes
//llamar listar ->gaurdar en una variable
//dos foreach uno para celdas y otro para registros
$html='<html>';
$html.='<head> </head>'; //se puede traer el css aca 
$html.='<body>';
$html.='<table>';
$html.='<thead><tr><th>Apellido</th><th>Nombres</th></tr></thead>';
$html.='<tbody>';
$html.='</tbody>';
$html.='</table>';
$html.='</body>';
$html.='</html>';
$dompdf->loadHtml($html); //file getcontents para levantar una rchivo aparte

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(); //
//"reporte_cliente",array("Attachment"=>0 )