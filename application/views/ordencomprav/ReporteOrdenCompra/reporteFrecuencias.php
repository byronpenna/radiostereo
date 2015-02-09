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
foreach ($encFre as $key => $value) {
$mipdf->Cell(180, 6, utf8_decode("CLIENTE:    " . $value->cli_nombres ), 0 , 1);
$mipdf->Cell(180, 6, utf8_Decode("PRODUCTO: " . $value->pro_nomb_producto), 0 , 1);
$mipdf->Cell(180, 6, "PERIODO: Del " . date("d/m/Y",strtotime($value->enc_fecha_inicio))  . " al " . date("d/m/Y",strtotime($value->enc_fecha_fin)) , 0 , 1);
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
	$i++;
}

$espacio = 170; //Cantidad de px que uso

for ($j=0; $j < $i ; $j++) { 
	$ocupar[$j] = $espacio/$i;
	$mipdf->Cell( $ocupar[$j] , 6, $mes[$j], 'TBR', 0 , 'C');
}
$mipdf->ln();


//Segunda linea
$mipdf->Cell(40, 6, "Radios", 1, 0, 'C');
$mipdf->Cell(20, 6, utf8_decode("Costo"), 1 , 0, 'C');	
$mipdf->Cell(25, 6, utf8_decode("Paquete") , 1 , 0, 'C');
$mipdf->Cell(15, 6, utf8_decode("Cantidad"), 1 , 0, 'C');

$h = 0;
foreach ($fechaDia as $key => $value) {
	for ($j=0; $j < $i ; $j++) { 
		if ($value->mes == $mesN[$j]) {
			$esDia[$h] = $ocupar[$j]/$numDias[$j];
			$mipdf->Cell( $esDia[$h] , 6, $value->dia , 1, 0, 'C');
			$diaP[$h] = $value->dia;
		}	
	}
$h++;
}
$mipdf->ln();


//Aqui van los datos
$conCostoS= 0;
$conSubtotal= 0;
$conCant = 0;
foreach ($dataServicio as $key => $value) {	
	$conCostoS += $value->costoS;
	$conSubtotal += $value->det_subtotal;
	$conCant += $value->det_cantidad;
	$mipdf->Cell(40, 6, utf8_decode($value->detalleServicio), 'LRT', 0, 'C');
	$mipdf->Cell(20, 6, utf8_decode("$ ". $value->costoS), '1' , 0, 'C');
	$mipdf->Cell(25, 6, utf8_decode("$ ". $value->det_subtotal) , '1' , 0, 'C');
	$mipdf->Cell(15, 6, utf8_decode($value->det_cantidad), 1 , 0, 'C');
	$id= $value->det_id;
	foreach ($fechaFrec as $aa => $frec) {
		for ($k=0; $k < $h ; $k++) { 
			if ($id== $frec->id_detalle && $frec->dia == $diaP[$k]) {
				$mipdf->Cell($esDia[$k], 6, $frec->frecuencia, 1, 0, 'C');
			}
		}	
	}
	$mipdf->ln();
}


///Con Total iva incluido
$conCostoS = round($conCostoS * 1.13, 2);
$conSubtotal = round($conSubtotal * 1.13, 2);

$mipdf->Cell(40, 6, "TOTAL IVA INCLUIDO", 1, 0, 'C');
$mipdf->Cell(20, 6, "$ " . $conCostoS, 'LRB' , 0, 'C');
$mipdf->Cell(25, 6, "$ " . $conSubtotal , 'LRB' , 0, 'C');
$mipdf->Cell(15, 6, $conCant , 1 , 1, 'C');

/*//espacio en blanco
$mipdf->Cell(40, 6, "", 1, 0, 'C');
$mipdf->Cell(20, 6, "", 'LRB' , 0, 'C');
$mipdf->Cell(25, 6, "", 'LRB' , 0, 'C');
$mipdf->Cell(15, 6, "" , 1 , 1, 'C');*/




$mipdf->SetAuthor('GrupoRadioStereo');
$mipdf -> Output();

?>