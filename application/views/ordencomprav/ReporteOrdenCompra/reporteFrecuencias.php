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

$mipdf = new MIPDF('L','mm','A4');
$mipdf -> addPage();
$mipdf->SetFont ( 'Arial' , '' , 9);
$mipdf->SetDrawColor(0,0,0);
$mipdf->SetTextColor(0,0,0);
$mipdf->SetMargins(15, 10, 15);

//Encabezado  Cliente
$mipdf->ln(1); 
$mipdf->Cell(180, 6, "CLIENTE: ", 0 , 1);
$mipdf->Cell(180, 6, "PRODUCTO: ", 0 , 1);
$mipdf->Cell(180, 6, "PERIODO: ", 0 , 1);

$mipdf->ln(10);


$mipdf->SetAuthor('GrupoRadioStereo');
$mipdf -> Output();

?>