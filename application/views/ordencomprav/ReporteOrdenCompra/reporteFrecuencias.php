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
    $this -> Image ( $urlFooter, 10 , 180 , 280, 30 );
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
foreach ($encFre as $key => $value) {
$mipdf->Cell(180, 6, utf8_decode("CLIENTE:    " . $value->cli_nombres ), 0 , 1);
$mipdf->Cell(180, 6, utf8_Decode("PRODUCTO: " . $value->pro_nomb_producto), 0 , 1);
$mipdf->Cell(180, 6, "PERIODO: Del " . date("d/m/Y",strtotime($value->enc_fecha_inicio))  . " al " . date("d/m/Y",strtotime($value->enc_fecha_fin)) , 0 , 1);
$precioVenta = $value->enc_precio_venta;
}

$mipdf->ln(10);
$mipdf->Cell(40, 6, "", 0, 0);
$mipdf->Cell(60, 6, "", 'TBL', 0, 'C');

//Calcular el espacio para los meses además de escribirlos
$i = 0;
$diasT = 0;
foreach ($fechaMes as $key => $value) {
	$numDias[$i] = $value->contada;
	$mes[$i] = $value->mes;
	$mesN[$i] = $value->mesN;
	$diasT += $value->contada;
	$i++;
}


$espacio = 170; //Cantidad de px que uso 

for ($j=0; $j < $i ; $j++) { 
	$ocupar[$j] = ( $espacio / $diasT) * $numDias[$j] ;
	$mipdf->Cell( $ocupar[$j] , 6, $mes[$j], 'TBR', 0 , 'C');
}
$mipdf->ln();


//Segunda linea
$mipdf->Cell(40, 6, "Radios", 1, 0, 'C');
$mipdf->Cell(20, 6, utf8_decode("Cuña + IVA"), 1 , 0, 'C');	
$mipdf->Cell(25, 6, utf8_decode("Paquete") , 1 , 0, 'C');
$mipdf->Cell(15, 6, utf8_decode("Cantidad"), 1 , 0, 'C');


//Datos de los dias
$h = 0;
foreach ($fechaDia as $key => $value) {
	for ($j=0; $j < $i ; $j++) { 
		if ($value->mes == $mesN[$j]) {
			$esDia[$h] = $ocupar[$j]/$numDias[$j];
			$mipdf->Cell( $esDia[$h] , 6, $value->dia , 1, 0, 'C');
			$diaP[$h] = $value->dia;
			$coMes[$h] = $value->mes;
		}	
	}
$h++;
}
$mipdf->ln();


$conCant = 0;
$conSubtotal = 0;
foreach ($dataServicio as $key => $value) {
	$conCant += $value->det_cantidad;
	$conSubtotal += $value->det_subtotal;
}

$porcentaje = $precioVenta/$conSubtotal; 
//Aqui van los datos

	
foreach ($dataServicio as $key => $value) {
	$costoUni = $value->costoS*$porcentaje;
	$subtotalUni = $value->det_subtotal*$porcentaje;

	$mipdf->Cell(40, 6, utf8_decode($value->detalleServicio), 'LRT', 0, 'C');
	$mipdf->Cell(20, 6, utf8_decode("$ ". number_format( $costoUni ,2,".",",")), '1' , 0, 'C');
	$mipdf->Cell(25, 6, utf8_decode("$ ". number_format( $subtotalUni,2,".",",")) , '1' , 0, 'C');
	$mipdf->Cell(15, 6, utf8_decode($value->det_cantidad), 1 , 0, 'C');
	$id= $value->det_id;
	foreach ($fechaFrec as $aa => $frec) {
		for ($k=0; $k < $h ; $k++) { 
			if ($id== $frec->id_detalle && $frec->dia == $diaP[$k] && $frec->mes == $coMes[$k]) {
				$mipdf->Cell($esDia[$k], 6, $frec->frecuencia, 1, 0, 'C');
			}
		}	
	}
	$mipdf->ln();
}


///Con Total iva incluido
$conCostoS = round($precioVenta / $conCant, 2);

$mipdf->Cell(40, 6, "TOTAL + IVA", 1, 0, 'C');
$mipdf->Cell(20, 6, "$ " . number_format($conCostoS,2,".",","), 'LRB' , 0, 'C');
$mipdf->Cell(25, 6, "$ " . number_format($precioVenta,2,".",",") , 'LRB' , 0, 'C');
$mipdf->Cell(15, 6, $conCant , 1 , 1, 'C');

$conCostoS = round($conCostoS * 1.13, 2);
$conSubtotal = round($precioVenta * 1.13, 2);

//espacio en blanco
$mipdf->Cell(40, 6, "TOTAL IVA INCLUIDO", 1, 0, 'C');
$mipdf->Cell(20, 6, "$ " . number_format($conCostoS,2,".",","), 'LRB' , 0, 'C');
$mipdf->Cell(25, 6, "$ " . number_format($conSubtotal,2,".",",") , 'LRB' , 0, 'C');
$mipdf->Cell(15, 6, $conCant , 1 , 1, 'C');




$mipdf->SetAuthor('GrupoRadioStereo');
$mipdf -> Output();

?>