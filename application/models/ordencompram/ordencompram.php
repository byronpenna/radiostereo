<?php 
class Ordencompram extends CI_Model
{
	
	function __construct()
	{
		
	}
	function getCalendarFrecuencia($cotizacion){
		$sql = "SELECT *
				FROM fec_fechas
				INNER JOIN enc_encabezado_bloque
				on enc_id = fec_enc_id
				INNER JOIN cot_encabezado_cotizacion 
				on enc_cot_id = cot_id 
				where enc_cot_id = ".$cotizacion.";";
		
	}
}