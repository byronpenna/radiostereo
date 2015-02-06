<?php

class MIPDF extends FPDF {

//Encabezado
public function header(){
//Logo
$this -> SetFont ( 'Arial' , 'B' , 10);
$this->SetDrawColor(0,0,0);
$this -> SetTextColor (0,0,0);

$urlHeader= base_url("resources/imagenes/Reporte/headerReporte.jpg");
$this->Cell(180 , 15, utf8_decode("DISTRIBUCIÓN DE PAUTA EN GRUPO RADIO STEREO"), 1 , 0, 'C');
$this->Cell(10, 15, "", 0 , 0);
$this -> Image ( $urlHeader , null , null , 90, 20 );
$this->ln(5);
}

public function Footer(){

   	//Posición: a 3cm del final
    $this->SetY(-20);
    $urlFooter = base_url("resources/imagenes/Reporte/footerReporte.jpg");
    $this -> Image ( $urlFooter, null , null , 280, 20 );
   }

}

setlocale(LC_TIME,"spanish"); 
$mipdf = new MIPDF('L','mm','A4');
$mipdf -> addPage();
$mipdf->SetFont ( 'Arial' , '' , 9);
$mipdf->SetDrawColor(0,0,0);
$mipdf->SetTextColor(0,0,0);
$mipdf->SetMargins(15, 10, 15);

//Encabezado  Cliente
$mipdf->ln(1); 
$mipdf->Cell(180, 6, utf8_decode("CLIENTE:    " /*. $datosEnc['nombres']*/), 0 , 1);
$mipdf->Cell(180, 6, utf8_Decode("PRODUCTO: " /*. $datosEnc['producto']*/), 0 , 1);
$mipdf->Cell(180, 6, "PERIODO: ", 0 , 1);

$mipdf->ln(10);
$mipdf->Cell(40, 6, "", 0, 0);
$mipdf->Cell(80, 6, "", 'TLB', 0, 'C');
$mipdf->Cell(150, 6 , "las fechas", 'RTB' ,1 , 'C');


$mipdf->Cell(40, 6, "Radios", 1, 0, 'C');
$mipdf->Cell(25, 6, utf8_decode("Costo Por Cuña"), 1 , 0, 'C');	
$mipdf->Cell(30, 6, utf8_decode("Inversión Paquete") , 1 , 0, 'C');
$mipdf->Cell(25, 6, utf8_decode("Total Cuñas"), 1 , 0, 'C');
$mipdf->Cell(150, 6, utf8_decode("estas | son | las | fechas| 05 |  06 |"), 1, 1, 'C');

//Aqui van los datos
foreach ($dataServicio as $key => $value) {	
	$mipdf->Cell(40, 6, utf8_decode($value->detalleServicio), 'LRT', 0, 'C');
	$mipdf->Cell(25, 6, utf8_decode("$ ". $value->costoS), '1' , 0, 'C');
	$mipdf->Cell(30, 6, utf8_decode("$ ". $value->det_subtotal) , '1' , 0, 'C');
	$mipdf->Cell(25, 6, utf8_decode($value->det_cantidad), 1 , 0, 'C');
	$mipdf->Cell(150, 6, utf8_decode(""), 1, 1, 'C');

}


///Con Total iva incluido

$mipdf->Cell(40, 6, "TOTAL IVA INCLUIDO", 1, 0, 'C');
$mipdf->Cell(25, 6, utf8_decode(""), 'LRB' , 0, 'C');
$mipdf->Cell(30, 6, utf8_decode("") , 'LRB' , 0, 'C');
$mipdf->Cell(25, 6, utf8_decode(""), 1 , 0, 'C');
$mipdf->Cell(150, 6, utf8_decode(""), 1, 1, 'C');




$mipdf->SetAuthor('GrupoRadioStereo');
$mipdf -> Output();

?>