<?php

class MIPDF extends FPDF {

//Encabezado
public function header(){
//Logo
$this -> SetFont ( 'Arial' , 'B' , 10);
$this->SetDrawColor(15,80,180);
$this -> SetTextColor (0,0,0);

$urlHeader= base_url("resources/imagenes/Reporte/headerReporte.jpg");
$this -> Image ( $urlHeader , 15 , null , 170, 25 );
$this->ln(10);
$this->Cell(0 , 0, "Orden de Compra de Publicidad", 0 , 0, 'C');
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
$mipdf->SetFont ( 'Arial' , '' , 9);
$mipdf->SetDrawColor(0,0,0);
$mipdf->SetTextColor(0,0,0);
$mipdf->SetMargins(15, 10, 15);
$mipdf->SetAutoPageBreak( true , 40);
if (isset($detalleP['progNombre']) && $detalleP != "") {
	$cosito = "Servicios";
	$descriCOS = utf8_decode($detalleP['progNombre']);
}else{
	$cosito = "Radio";
	$descriCOS = utf8_decode($detalleP['secNombre']);
}


//Datos
$mipdf->ln(2);

$mipdf->Cell(90, 5, utf8_decode("Número de Orden de Compra:   ") . $id , 1, 0 );
$mipdf->Cell(90, 5, utf8_decode("Teléfono:   " . $datosEnc['telefono']), 1 , 1);

$x = $mipdf->GetX();
$y1 = $mipdf->GetY();
$mipdf->MultiCell(90, 5, utf8_decode("Razón Social:   " . $datosEnc['razon']) , 1, 'L');
$y2 = $mipdf->GetY();
$yTotal = $y2 - $y1;
$mipdf->SetXY($x + 90, $y1);

$mipdf->Cell(90, 5, utf8_decode("Correo:   " . $datosEnc['correo']), 1 , 1);

$mipdf->Cell(90, 5, utf8_decode("Contacto:   " . $datosEnc['contacto'] ) , 1, 0 );
$mipdf->Cell(90, 5, utf8_decode("NIT:   " . $datosEnc['nit']), 1 , 1);

$x = $mipdf->GetX();
$y1 = $mipdf->GetY();
$mipdf->MultiCell(90, 5, utf8_decode("Giro:   " . $datosEnc['giro']) , 1, 'L');
$y2 = $mipdf->GetY();
$yTotal = $y2 - $y1;
$mipdf->SetXY($x + 90, $y1);

$mipdf->Cell(90, $yTotal, utf8_decode("Categoría de Contribuyente:   " . $datosEnc['categoria'] ) , 1 , 1 );

$mipdf->Cell(90, 5, utf8_decode("Orden Generada Por : " . $datosEnc['vendedor']), 1 , 0);
$mipdf->Cell(90, 5, utf8_decode("NRC: " . $datosEnc['ncr']), 1, 1 );

$mipdf->Multicell(180, 5, utf8_decode("Dirección: " . $datosEnc['direccion']), 1 , 'J');



$mipdf->ln(5);

//Productos
$mipdf->Cell(180, 5, "PRODUCTO A ANUNCIAR", 1 , 1, 'C');
$mipdf->Cell(180, 5, "   " . utf8_decode($datosEnc['producto']), 1 , 1, 'L');

$mipdf->ln(5);


//Cuñas y otros servicios - Encabezado
$mipdf->Cell(180, 5, utf8_decode("CUÑAS Y OTROS SERVICIOS"), 1 , 1 , 'C');
$mipdf->Cell(20, 5, "Cantidad", 1, 0, 'C');
$mipdf->Cell(80, 5, utf8_decode("Descripción"), 1 , 0 , 'C');
$mipdf->Cell(40, 5, $cosito , 1 , 0, 'C');
$mipdf->Cell(40, 5, utf8_decode("Costo"), 1, 1, 'C');


$subtotal = 0;
//Cuñas y otros servicios - Datos
foreach ($detalleP['datosServ'] as $key => $value) {
	$mipdf->Cell(20, 5, $value->det_cantidad, 1, 0, 'C');
	//Cambio de cuñas en descricos Los valores que puede 
	//tomar solo son produccion, entrevista, cuña
	if($value->det_cantidad>1 AND $cosito != "Servicios"){
		if ($descriCOS != "Producción" AND $detalleP['secNombre'] != "Producción") {
			$mipdf->Cell(80, 5, "   " .  $descriCOS. "s" , 1 , 0 , 'L');
		}else{
			$mipdf->Cell(80, 5, "   " .  $descriCOS , 1 , 0 , 'L');
		}
	}else{
		$mipdf->Cell(80, 5, "   " .  $descriCOS , 1 , 0 , 'L');
	}

	//Nombre de servicio, en este puede tomar 
	//Entrevista, cuña, menciones, programa
	if($cosito == "Servicios"){
		if($value->det_cantidad>1){
      if($value->serv_nombre!="Menciones"){
      	$mipdf->Cell(40, 5, utf8_decode($value->serv_nombre ."s") , 1 , 0, 'C');
      }else{
      	$mipdf->Cell(40, 5, utf8_decode($value->serv_nombre) , 1 , 0, 'C');
      }
    }else{
    	if($value->serv_nombre=="Menciones"){
      	$mipdf->Cell(40, 5, utf8_decode("Mención") , 1 , 0, 'C');
      }else{
      	$mipdf->Cell(40, 5, utf8_decode($value->serv_nombre) , 1 , 0, 'C');
      }
    }	
	}else{
		$mipdf->Cell(40, 5, utf8_decode($value->rad_nombre) , 1 , 0, 'C');
	}
	$mipdf->Cell(40, 5, "$ " .  number_format($value->det_subtotal,2,".",",") , 1, 1, 'R');
	$subtotal += $value->det_subtotal;	
}

$descuento = $subtotal - str_replace(",", "", $detalleP['precioVenta']);

$mipdf->ln(5);

//Descuentos
$mipdf->Cell(180, 5, "DESCUENTOS", 1 , 1, 'C' );
$mipdf->Cell(140, 5, utf8_decode("Descripción"), 1 , 0 , 'C' );
$mipdf->Cell(40, 5, "Costo", 1, 1, 'C');


$x = $mipdf->GetX();
$y1 = $mipdf->GetY();
$mipdf->MultiCell(140, 5, utf8_decode($datosEnc['detcDes']) , 1, 'J');
$y2 = $mipdf->GetY();
$yTotal = $y2 - $y1;
$mipdf->SetXY($x + 140, $y1);
$mipdf->Cell(40, $yTotal, "$ "  .number_format($descuento,2,".",","), 1, 1, 'R');
$mipdf->SetXY($x, $y2);
$mipdf->Cell(140, 6, "   SUB-TOTAL", 1, 0, 'L');
$mipdf->Cell(40, 6, "$ " . number_format($descuento,2,".",","), 1 , 1, 'R');

$mipdf->ln(5);

//Detalle de Compra
$mipdf->Cell(180, 5, "DETALLE DE COMPRA", 1 , 1, 'C' );
$mipdf->Cell(140, 5, utf8_decode("Tipo de Pago"), 1 , 0 , 'L' );
$mipdf->Cell(40, 5, utf8_decode($datosEnc['tipoPago']), 1, 1, 'R');
$mipdf->Cell(140, 5, utf8_decode("Fecha de Emisión"), 1, 0, 'L');
$mipdf->Cell(40, 5, $datosEnc['fechEmision'] , 1, 1, 'R');
$mipdf->Cell(140, 5, utf8_decode("SUB-TOTAL"), 1 , 0 , 'L' );
$mipdf->Cell(40, 5, "$ " . number_format($subtotal,2,".",",") ,  1, 1, 'R');
$mipdf->Cell(140, 5, utf8_decode("Descuentos"), 1, 0, 'L');
$mipdf->Cell(40, 5, "$ " . number_format($descuento,2,".",","),  1, 1, 'R');

if ($datosEnc['cat_id'] == 4) {
	$mipdf->Cell(140, 5, utf8_decode("Total sin IVA"), 1 , 0 , 'L' );
	$mipdf->Cell(40, 5, "$ " . $detalleP['precioVenta'] , 1, 1, 'R');
	$mipdf->Cell(140, 5, utf8_decode("IVA 13%"), 1, 0, 'L');
	$mipdf->Cell(40, 5, "-" , 1, 1, 'R');
	$tpagar = $detalleP['precioVenta'];
	$mipdf->Cell(140, 6, "   TOTAL A PAGAR", 1, 0, 'L');
	$mipdf->Cell(40, 6, "$ " . $tpagar   , 1 , 1, 'R');
	
}else{
	$mipdf->Cell(140, 5, utf8_decode("Total sin IVA"), 1 , 0 , 'L' );
	$mipdf->Cell(40, 5, "$ " . $detalleP['precioVenta'], 1, 1, 'R');
	$iva = (str_replace(",", "", $detalleP['precioVenta'])*0.13);
	$mipdf->Cell(140, 5, utf8_decode("IVA 13%"), 1, 0, 'L');
	$mipdf->Cell(40, 5, "$ ". number_format($iva,2,".",",")  , 1, 1, 'R');
	$tpagar = str_replace(",", "", $detalleP['precioVenta']) + $iva;
	$mipdf->Cell(140, 6, "   TOTAL A PAGAR", 1, 0, 'L');
	$mipdf->Cell(40, 6, "$ " . number_format($tpagar,2,".",",") , 1 , 1, 'R');
}


$mipdf->ln(10);

$mipdf->Cell(90, 0, "___________________________", 0 , 0, 'C'); 
$mipdf->Cell(90, 0, "___________________________", 0 , 1, 'C');
$mipdf->Cell(90, 10, "Gerencia de Ventas", 0 , 0, 'C'); 
$mipdf->Cell(90, 10, "Continuidad", 0 , 1, 'C');

$mipdf->ln(10);


$mipdf->Cell(90, 0, "___________________________", 0 , 0, 'C'); 
$mipdf->Cell(90, 0, "___________________________", 0 , 1, 'C');
$mipdf->Cell(90, 10, "Cliente", 0 , 0, 'C'); 
$mipdf->Cell(90, 10, "Contabilidad", 0 , 1, 'C');

$mipdf->SetAuthor('BISA');
$mipdf -> Output();

?>