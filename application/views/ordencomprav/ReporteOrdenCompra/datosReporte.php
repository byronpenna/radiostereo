<?php

class MIPDF extends FPDF {

//Encabezado
public function header(){
//Logo
$this -> SetFont ( 'Arial' , 'B' , 10);
$this->SetDrawColor(15,80,180);
$this -> SetTextColor (0,0,0);

$urlHeader= base_url("resources/imagenes/Reporte/headerReporte.jpg");
$this -> Image ( $urlHeader , 15 , null , 180, 35 );
$this->ln(5);
$this->Cell(0 , 0, "Orden de Compra", 0 , 0, 'C');
$this->ln(5);
}

public function Footer(){

   	//Posición: a 3cm del final
    $this->SetY(-20);
    $urlFooter = base_url("resources/imagenes/Reporte/footerReporte.jpg");
    $this -> Image ( $urlFooter, null , null , 185, 20 );
   }

}

$mipdf = new MIPDF();
$mipdf -> addPage();


//Parametros
$mipdf->SetFont ( 'Arial' , '' , 9);
$mipdf->SetDrawColor(0,0,0);
$mipdf->SetTextColor(0,0,0);
$mipdf->SetMargins(15, 10, 15);
$mipdf->SetAutoPageBreak( true , 40);


//Datos
$mipdf->ln(2);
$mipdf->Cell(90, 5, utf8_decode("Número de Orden de Compra:   ") . $id , 'R', 0 );
$mipdf->Cell(10, 5, "");
$mipdf->Cell(80, 5, utf8_decode("Teléfono:   " . $datosEnc['telefono']), 0 , 1);
$mipdf->Cell(90, 5, utf8_decode("Nombre:   " . $datosEnc['nombres'] ) , 'R', 0 );
$mipdf->Cell(10, 5, "");
$mipdf->Cell(80, 5, utf8_decode("Correo:   " . $datosEnc['correo']), 0 , 1);
$mipdf->Cell(90, 5, utf8_decode("Contacto:   " . $datosEnc['contacto'] ) , 'R', 0 );
$mipdf->Cell(10, 5, "");
$mipdf->Cell(80, 5, utf8_decode("NIT:   " . $datosEnc['nit']), 0 , 1);
$mipdf->Cell(90, 5, utf8_decode("Giro:   " . $datosEnc['giro'] ) , 'R', 0 );
$mipdf->Cell(10, 5, "");
$mipdf->Multicell(80, 5, utf8_decode("Dirección: " . $datosEnc['direccion']), 0 , 'J');

$mipdf->ln(5);

//Productos
$mipdf->Cell(180, 7, "Producto a Anunciar", 1 , 1, 'C');
$mipdf->Cell(180, 5, "   " . utf8_decode($datosEnc['producto']), 1 , 1, 'L');

$mipdf->ln(5);


//Cuñas y otros servicios - Encabezado
$mipdf->Cell(180, 7, utf8_decode("CUÑAS Y OTROS SERVICIOS"), 1 , 1 , 'C');
$mipdf->Cell(30, 5, "Cantidad", 1, 0, 'C');
$mipdf->Cell(90, 5, utf8_decode("Descripción"), 1 , 0 , 'C');
$mipdf->Cell(40, 5, utf8_decode("Radio"), 1 , 0, 'C');
$mipdf->Cell(20, 5, utf8_decode("Costo"), 1, 1, 'C');
//Cuñas y otros servicios - Datos
$mipdf->Cell(30, 5, "", 1, 0, 'C');
$mipdf->Cell(90, 5, "" , 1 , 0 , 'L');
$mipdf->Cell(40, 5, "" , 1 , 0, 'C');
$mipdf->Cell(20, 5, "", 1, 1, 'R');


$mipdf->ln(5);

//Descuentos
$mipdf->Cell(180, 7, "DESCUENTOS", 1 , 1, 'C' );
$mipdf->Cell(140, 5, utf8_decode("Descripción"), 1 , 0 , 'C' );
$mipdf->Cell(40, 5, "Costo", 1, 1, 'C');

$mipdf->Cell(140, 5, "", 1, 0, 'L');
$mipdf->Cell(40, 5, "", 1, 1, 'R');

$mipdf->Cell(140, 7, "   SUB-TOTAL", 1, 0, 'L');
$mipdf->Cell(40, 7, "", 1 , 1, 'R');

$mipdf->ln(5);

//Detalle de Compra
$mipdf->Cell(180, 7, "DETALLE DE COMPRA", 1 , 1, 'C' );
$mipdf->Cell(140, 5, utf8_decode("Tipo de Pago"), 1 , 0 , 'L' );
$mipdf->Cell(40, 5, "", 1, 1, 'C');
$mipdf->Cell(140, 5, utf8_decode("Fecha de Emisión"), 1, 0, 'L');
$mipdf->Cell(40, 5, "", 1, 1, 'R');
$mipdf->Cell(140, 5, utf8_decode("SUB-TOTAL"), 1 , 0 , 'L' );
$mipdf->Cell(40, 5, "", 1, 1, 'C');
$mipdf->Cell(140, 5, utf8_decode("Descuentos"), 1, 0, 'L');
$mipdf->Cell(40, 5, "", 1, 1, 'R');
$mipdf->Cell(140, 5, utf8_decode("Total sin IVA"), 1 , 0 , 'L' );
$mipdf->Cell(40, 5, "", 1, 1, 'C');
$mipdf->Cell(140, 5, utf8_decode("IVA 13%"), 1, 0, 'L');
$mipdf->Cell(40, 5, "", 1, 1, 'R');

$mipdf->Cell(140, 7, "   TOTAL A PAGAR", 1, 0, 'L');
$mipdf->Cell(40, 7, "", 1 , 1, 'R');

$mipdf->ln(5);
$mipdf->Cell(100, 5, "                        ______________________", 0 , 0, 'L'); 
$mipdf->Cell(80, 5, "          ______________________", 0 , 1, 'L');
$mipdf->Cell(100, 5, "                            Gerencia de Ventas", 0 , 0, 'L'); 
$mipdf->Cell(80, 5, "                V.B.O Continuidad", 0 , 1, 'L');

$mipdf->ln(3);
$mipdf->Cell(180, 5, "___________________________", 0 , 1, 'C');
$mipdf->Cell(180, 5, "Cliente", 0 ,1, 'C');

$mipdf->SetAuthor('GrupoRadioStereo');
$mipdf -> Output();

?>