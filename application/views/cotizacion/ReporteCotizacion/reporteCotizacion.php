<?php

class MIPDF extends FPDF {

//Encabezado
public function header(){
//Logo
$this -> SetFont ( 'Arial' , '' , 10);
$this->SetDrawColor(0,0,0);
$this -> SetTextColor (0,0,0);

$urlHeader= base_url("resources/imagenes/Reporte/headerReporte.jpg");
$this -> Image ( $urlHeader , 15 , null , 170, 25 );
$this->ln(5);
$this->Cell(6,5,"",0,0);
$this->Cell(174 , 5, "Fecha", 'T' , 0, 'C');
$this->ln(5);
}

public function Footer(){

   	//Posición: a 2cm del final
    $this->SetY(-25);
    $urlFooter = base_url("resources/imagenes/Reporte/footerReporte.jpg");
    $this -> Image ( $urlFooter, 10, null , 190, 20 );
   }

}

$mipdf = new MIPDF();
$mipdf -> addPage();


//Parametros
$mipdf->SetFont ( 'Arial' , '' , 10);
$mipdf->SetDrawColor(0,0,0);
$mipdf->SetTextColor(0,0,0);
$mipdf->SetMargins(15, 10, 15);
$mipdf->SetAutoPageBreak( true , 40);

$mipdf->ln(1);
$mipdf->Cell(0, 5, "Lic",0,1,"L"); //Recordate colocarlo todo en utf8() para que aparezcan las tildes 
$mipdf->Cell(0,5, "Nombre",0 ,1, "L");
$mipdf->Cell(0,5, "otro coso",0 ,1, "L");
$mipdf->Cell(0,5, "Presente",0 ,1, "L");

$mipdf->ln(5);
$mipdf->Cell(0,5, "Estimada.....",0 ,1, "L");
$mipdf->ln(5);
$mipdf->Multicell(0,5, utf8_decode("Reciba un cordial saludo de parte de Grupo Radio Stereo y sus estaciones: Fiesta, Femenina, Ranchera,
Láser Inglés y Láser Español."), 0 ,1, false);

$mipdf->ln(5);
$mipdf->Multicell(0,5, utf8_decode("Por este medio someto a su evaluación, presupuesto de inversión publicitaria en radios: Femenina 102.5,
Ranchera 106.5 para la campaña de Sylvannia Led. A continuación el detalle:"), 0,1,false);

$mipdf->ln(5);
$mipdf->SetFont ( 'Arial' , 'B' , 10);
$mipdf->Cell(0,5, utf8_decode("Servicio...."), 0,1,'L');
$mipdf->SetFont ( 'Arial' , '' , 10);

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Período de Contratación : 16 días"), 0,1,'C');
$mipdf->ln(5);


$mipdf->Cell(31,7, "Radio", 1, 0, "C");
$mipdf->Cell(42,7, "Costo por Segundo", 1, 0, "C");
$mipdf->Cell(22,7, "Cantidad", 1, 0, "C");
$mipdf->Cell(23,7, utf8_decode("Cuñas Diarias"), 1, 0, "C");
$mipdf->Cell(32,7, utf8_decode("Duración(Seg)"), 1,0, "C");
$mipdf->Cell(25,7, utf8_decode("Subtotal"), 1,1 , "C");

///Aqui va el coso de  de foreach de radios xD
$mipdf->Cell(31,5, "", 1, 0, "C");
$mipdf->Cell(42,5, "$", 1, 0, "C");
$mipdf->Cell(22,5, "1", 1, 0, "C");
$mipdf->Cell(23,5, "1", 1, 0, "C");
$mipdf->Cell(32,5, "1", 1,0, "C");
$mipdf->Cell(25,5, "$ Pisto", 1,1 , "R");

$mipdf->Cell(31,5, "", 1, 0, "C");
$mipdf->Cell(42,5, "$", 1, 0, "C");
$mipdf->Cell(22,5, "1", 1, 0, "C");
$mipdf->Cell(23,5, "1", 1, 0, "C");
$mipdf->Cell(32,5, "1", 1,0, "C");
$mipdf->Cell(25,5, "$ Pisto", 1,1 , "R");

$mipdf->Cell(31,5, "", 1, 0, "C");
$mipdf->Cell(42,5, "$", 1, 0, "C");
$mipdf->Cell(22,5, "1", 1, 0, "C");
$mipdf->Cell(23,5, "1", 1, 0, "C");
$mipdf->Cell(32,5, "1", 1,0, "C");
$mipdf->Cell(25,5, "$ Pisto", 1,1 , "R"); //Borras las dos repetidas te las deje para maquetar


//Fin foreach

// Aqui va la otra tabla
$mipdf->Cell(118,5, "", 0, 0);
$mipdf->Cell(32,5, utf8_decode("Total sin IVA"), 1,0, "C");
$mipdf->Cell(25,5, "$ 0.00" , 1,1 , "R");

$mipdf->Cell(118,5, "", 0, 0);
$mipdf->Cell(32,5, utf8_decode("Descuento"), 1,0, "C");
$mipdf->Cell(25,5, "$ 0.00" , 1,1 , "R");

$mipdf->Cell(118,5, "", 0, 0);
$mipdf->Cell(32,5, utf8_decode("Precio de Vta."), 1,0, "C");
$mipdf->Cell(25,5, "$ 0.00" , 1,1 , "R");

$mipdf->Cell(118,5, "", 0, 0);
$mipdf->Cell(32,5, utf8_decode("IVA 13%"), 1,0, "C");
$mipdf->Cell(25,5, "$ 0.00" , 1,1 , "R");

$mipdf->Cell(118,5, "", 0, 0);
$mipdf->Cell(32,5, utf8_decode("Total a Pagar"), 1,0, "C");
$mipdf->SetFont ( 'Arial' , 'B' , 10);
$mipdf->Cell(25,5, "$ 0.00" , 1,1 , "R");
$mipdf->SetFont ( 'Arial' , '' , 10);

//Beneficios de la compra
$mipdf->Cell(0,5,"Beneficios de la Compra",0,1,"L");
//Su Foreach
$mipdf->Cell(0,5,"- Beneficios de la Compra",0,1,"L");
$mipdf->Cell(0,5,"- Beneficios de la Compra",0,1,"L");
$mipdf->Cell(0,5,"- Beneficios de la Compra",0,1,"L");
$mipdf->Cell(0,5,"- Beneficios de la Compra",0,1,"L");
//fin foreach

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Forma de Pago: "), 0,1,"L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Esperando poder servirles muy pronto, me despido."), 0,1,"L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Atentamente"), 0,1,"L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Root"), 0,1,"L");
$mipdf->Cell(0,5, utf8_decode("usuario"), 0,1,"L");
$mipdf->Cell(0,5, utf8_decode("firma"), 0,1,"L");






$mipdf->SetAuthor('BISA');
$mipdf -> Output();

?>