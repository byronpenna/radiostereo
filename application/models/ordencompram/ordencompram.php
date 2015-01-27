<?php 
class Ordencompram extends CI_Model
{
	public function __construct(){
			parent:: __construct();
	}

	public function getCalendarFrecuencia($cotizacion){
		$this->load->model("cotizacionesm/cotizacionesm");
		$cotizacionesm = new cotizacionesm();
		$enc  	=  	$cotizacionesm->getEncId($cotizacion);
		$det	= 	$cotizacionesm->getDetId($enc[0]->enc_id);
		$fechas =	$cotizacionesm->getFechas($enc[0]->enc_id);
		$res = new stdClass();
		$res->tabla="
					<tr>
						<td style='width:15%;'></td> ";
						foreach ($fechas as $fec) {
							$res->tabla.="<td style='border:1px solid red;'>".substr($fec->fec_fecha,8,2)."</td>";
						}
					$res->tabla.="</tr>
		";
		foreach ($enc as $row) {
			if($row->enc_precio_venta && $row->enc_fecha_inicio && $enc){
				if($row->enc_prog_id){
					$res->titulo="Programa";
				}else if($row->enc_sec_id){
					$sec 	= 	$cotizacionesm->getNombreSec($row->enc_sec_id);
					$res->titulo=$sec[0]->sec_nombre;
				}
				foreach ($det as $deta) {
					if($deta->det_pre_id && $deta->det_cantidad && $deta->det_duracion){
						if($deta->det_serv_id){
							$serv = $cotizacionesm->getServicios($deta->det_serv_id);
							$res->tabla.="
							<tr>
								<td>".$serv[0]->serv_nombre."</td>";
								foreach ($fechas as $fec) {
									$res->tabla.="<td><input type='text' name='txtCantidadDiaria' style='width:90%;margin:0.5px;'/></td>";
								}
							$res->tabla.="</tr>";
						}
					}
				}
			}
		}
		return $res;
	}
}