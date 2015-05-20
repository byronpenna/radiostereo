<?php

function meses(){
		$meses = array(
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre");
		return $meses;
}

class MIPDF extends FPDF {

//Encabezado
public function header(){
//Logo
$this -> SetFont ( 'Arial' , '' , 10);
$this->SetDrawColor(0,0,0);
$this -> SetTextColor (0,0,0);

//$urlHeader= base_url("resources/imagenes/Reporte/headerReporte.jpg");
//$this -> Image ( $urlHeader , 15 , null , 170, 25 );

$this->ln(20);
$this->Cell(6,5,"",0,0);
$meses = meses();
$this->Cell(174 , 5, utf8_decode("San Salvador, ".date('d')." de ". $meses[date('n')-1]. " del ".date('Y')), 'T' , 0, 'C');
$this->ln(5);

}

public function Footer(){

   	//Posición: a 2cm del final
    $this->SetY(-25);
    //$urlFooter = base_url("resources/imagenes/Reporte/footerReporte.jpg");
    //$this -> Image ( $urlFooter, 10, null , 190, 20 );
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
$mipdf->Cell(0, 5, utf8_decode($cli_titulo . " " . $cli_contacto) ,0,1,"L");
$mipdf->Cell(0,5, utf8_decode($cli_razon_social) ,0 ,1, "L");
$mipdf->Cell(0,5, "Presente",0 ,1, "L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode( $saludo . " " . $cli_titulo . " " . $cli_contacto2),0 ,1, "L");
$mipdf->ln(5);
$mipdf->Multicell(0,5, utf8_decode("Reciba un cordial saludo de parte de Grupo Radio Stereo y sus estaciones: Fiesta, Femenina, Ranchera, Láser Inglés y Láser Español."), 0 , "J", false);
$mipdf->ln(5);


if ($tipoCot == "programa") {
	/// Si es Programa
	$mipdf->Multicell(0,5, utf8_decode("Por este medio someto a su evaluación, presupuesto de inversión publicitaria en el Programa : " . $nombrePrograma . ", para la campaña de ". $producto .". A continuación el detalle:"), 0,"J",false);
	$mipdf->ln(5);
	$mipdf->SetFont ( 'Arial' , 'B' , 10);
	$mipdf->Cell(0,5, utf8_decode("Programa: " . $nombrePrograma ), 0,1,'L');
	$mipdf->SetFont ( 'Arial' , '' , 10);

	$mipdf->ln(5);
	$mipdf->Cell(0,5, utf8_decode("Período de Contratación : " . $periodo), 0,1,'C');
	$mipdf->ln(5);



	$mipdf->Cell(38,7, "Servicio", 1, 0, "C");
	$mipdf->Cell(47,7, "Costo por Segundo", 1, 0, "C");
	$mipdf->Cell(25,7, "Cantidad", 1, 0, "C");
	$mipdf->Cell(37,7, utf8_decode("Duración(Seg)"), 1,0, "C");
	$mipdf->Cell(30,7, utf8_decode("Subtotal"), 1,1 , "C");

	for ($i=0; $i < count($detalle->servi->ser) ; $i++) {
		$mipdf->Cell(38,5, utf8_decode($detalle->servi->ser[$i]) , 1, 0, "L");
		$mipdf->Cell(47,5, "$ " . number_format( $detalle->servi->precio[$i] ,2,".",",") , 1, 0, "C");
		$mipdf->Cell(25,5, $detalle->servi->cantidad[$i] , 1, 0, "C");
		$mipdf->Cell(37,5, $detalle->servi->duracion[$i] , 1,0, "C");
		$mipdf->Cell(30,5, "$ " . number_format( $detalle->servi->subtotal[$i] ,2,".",",") , 1,1 , "R");
	}



}else{
	//Si es Seccionada
	$mipdf->Multicell(0,5, utf8_decode("Por este medio someto a su evaluación, presupuesto de inversión publicitaria en radios: ". $detalle->detRadios .", para la campaña de ". $producto .". A continuación el detalle:"), 0, "J",false);
	$mipdf->ln(5);
	$mipdf->SetFont ( 'Arial' , 'B' , 10);
	$mipdf->Cell(0,5, utf8_decode("Servicio Ofertado: " . $nombrePrograma), 0,1,'L');

	$mipdf->SetFont ( 'Arial' , '' , 10);

	$mipdf->ln(5);
	$mipdf->Cell(0,5, utf8_decode("Período de Contratación : " . $periodo), 0,1,'C');
	$mipdf->ln(5);

	//Si es cuña
	if ($nombrePrograma == "Cuña Rotativa") {
		$mipdf->Cell(33,7, "Radio", 1, 0, "C");
		$mipdf->Cell(40,7, "Costo por Segundo", 1, 0, "C");
		$mipdf->Cell(22,7, "Cantidad", 1, 0, "C");
		$mipdf->Cell(23,7, utf8_decode("Cuñas Diarias"), 1, 0, "C");
		$mipdf->Cell(32,7, utf8_decode("Duración(Seg)"), 1,0, "C");
		$mipdf->Cell(25,7, utf8_decode("Subtotal"), 1,1 , "C");

		//Detalle
		for ($i=0; $i < count($detalle->servi->ser) ; $i++) { 
			$mipdf->Cell(33,5, utf8_decode($detalle->servi->ser[$i]) , 1, 0, "L");
			$mipdf->Cell(40,5, "$ " . number_format( $detalle->servi->precio[$i] ,2,".",",") , 1, 0, "C");
			$mipdf->Cell(22,5, $detalle->servi->cantidad[$i] , 1, 0, "C");
			$mipdf->Cell(23,5, $detalle->servi->cuna[$i] , 1, 0, "C");
			$mipdf->Cell(32,5, $detalle->servi->duracion[$i] , 1,0, "C");
			$mipdf->Cell(25,5, "$ " . number_format( $detalle->servi->subtotal[$i] ,2,".",",") , 1,1 , "R");	
		}

	}else{ //Sino es cuña es de cual otra menos programa
		$mipdf->Cell(38,7, "Radio", 1, 0, "C");
		$mipdf->Cell(47,7, "Costo por Segundo", 1, 0, "C");
		$mipdf->Cell(25,7, "Cantidad", 1, 0, "C");
		$mipdf->Cell(37,7, utf8_decode("Duración(Seg)"), 1,0, "C");
		$mipdf->Cell(30,7, utf8_decode("Subtotal"), 1,1 , "C");

		for ($i=0; $i < count($detalle->servi->ser) ; $i++) {
			$mipdf->Cell(38,5, utf8_decode($detalle->servi->ser[$i]) , 1, 0, "L");
			$mipdf->Cell(47,5, "$ " . number_format( $detalle->servi->precio[$i] ,2,".",",") , 1, 0, "C");
			$mipdf->Cell(25,5, $detalle->servi->cantidad[$i] , 1, 0, "C");
			$mipdf->Cell(37,5, $detalle->servi->duracion[$i] , 1,0, "C");
			$mipdf->Cell(30,5, "$ " . number_format( $detalle->servi->subtotal[$i] ,2,".",",") , 1,1 , "R");
		}
	}

}

//espacio para las tablas que no se dañen
if ($nombrePrograma == "Cuña Rotativa") {
	$blanco = 118;
	$lin1 = 32;
	$lin2 = 25;
}else{
	$blanco = 110;
	$lin1 = 37;
	$lin2 = 30;
}

// Aqui va la otra tabla
$mipdf->Cell($blanco,5, "", 0, 0);
$mipdf->Cell($lin1,5, utf8_decode("Total sin IVA"), 1,0, "C");
$mipdf->Cell($lin2,5, "$ " . number_format( $detalle->total ,2,".",",")  , 1,1 , "R");

$mipdf->Cell($blanco,5, "", 0, 0);
$mipdf->Cell($lin1,5, utf8_decode("Descuento"), 1,0, "C");
$mipdf->Cell($lin2,5, "$ " . number_format( $detalle->descuento ,2,".",",") , 1,1 , "R");

$mipdf->Cell($blanco,5, "", 0, 0);
$mipdf->Cell($lin1,5, utf8_decode("Precio de Vta."), 1,0, "C");
$precioVta = str_replace(",", "", $detalle->total) - str_replace(",", "", $detalle->descuento);
$mipdf->Cell($lin2,5, "$ " . number_format( $precioVta ,2,".",",") , 1,1 , "R");

if ($cli_cat_id != 4) {
	$mipdf->Cell($blanco,5, "", 0, 0);
	$mipdf->Cell($lin1,5, utf8_decode("IVA 13%"), 1,0, "C");
	$iva = $precioVta * 0.13; 
	$mipdf->Cell($lin2,5, "$ " . number_format($iva, 2, ".", ","), 1,1 , "R");
}else{
	$mipdf->Cell($blanco,5, "", 0, 0);
	$mipdf->Cell($lin1,5, utf8_decode("IVA 13%"), 1,0, "C");
	$iva = 0; 
	$mipdf->Cell($lin2,5, "Exento" , 1,1 , "R");
}

$totalPagar = $precioVta + $iva;
$mipdf->Cell($blanco,5, "", 0, 0);
$mipdf->Cell($lin1,5, utf8_decode("Total a Pagar"), 1,0, "C");
$mipdf->SetFont ( 'Arial' , 'B' , 10);
$mipdf->Cell($lin2,5, "$ ". number_format($totalPagar, 2, "." , ",") , 1,1 , "R");
$mipdf->SetFont ( 'Arial' , '' , 10);



//Beneficios de la compra
$mipdf->SetFont ( 'Arial' , 'B' , 10);
$mipdf->Cell(0,5,"Beneficios de la Compra",0,1,"L");
$mipdf->SetFont ( 'Arial' , '' , 10);
$mipdf->Multicell(0,5, utf8_decode($valorAgregado), 0,1,false);

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Forma de Pago: " . $formaPago ), 0,1,"L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Esperando poder servirles muy pronto, me despido."), 0,1,"L");

$mipdf->ln(5);
$mipdf->Cell(0,5, utf8_decode("Atentamente"), 0,1,"L");

$mipdf->ln(5);
$mipdf->Multicell(0,5, utf8_decode($usu_firma), 0,1,false);






$mipdf->SetAuthor('BISA');
$mipdf -> Output();

?>