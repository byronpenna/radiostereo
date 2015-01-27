<?php 
class Ordencompram extends CI_Model
{
	public function __construct(){
			parent:: __construct();
	}


	public function getPrograma($idProg){
		$sql="SELECT * FROM prog_programa
		WHERE prog_id=".$idProg."";
		$this->db->trans_start();
		$query = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;
	}

	public function getCalendarFrecuencia($cotizacion){
		$this->load->model("cotizacionesm/cotizacionesm");
		$cotizacionesm = new cotizacionesm();
		$res = new stdClass();
		$enc  	=  	$cotizacionesm->getEncId($cotizacion);
		$res->tabla="";
		foreach ($enc as $encabezado) {
			if($encabezado->enc_precio_venta && $encabezado->enc_fecha_inicio && $encabezado->enc_fecha_fin){
				if($encabezado->enc_prog_id){
					$res->titulo="Programa";
					$programa = $this->getPrograma($encabezado->enc_prog_id);
					$res->programa="<b>".$programa[0]->prog_nombre."</b>";
				}else{
					$seccion  = $cotizacionesm->getNombreSec($encabezado->enc_sec_id);
					$res->titulo=$seccion[0]->sec_nombre;
					$res->programa="";
				}
				$fechas =	$cotizacionesm->getFechas($encabezado->enc_id);
				$res->tabla.="<tr><td></td>";
				foreach ($fechas as $fec) {
					$res->tabla.="<td class='text-center'>";
					$res->tabla.=substr($fec->fec_fecha, 5,2);
					$res->tabla.= substr($fec->fec_fecha, 8,2)."</td>";
				}
				$res->tabla.="</tr>";
				$det	= 	$cotizacionesm->getDetId($encabezado->enc_id);
				foreach ($det as $deta) {
					if($deta->det_pre_id && $deta->det_cantidad && $deta->det_duracion){
						if($deta->det_serv_id){
							$servicio  = $cotizacionesm->getServicios($deta->det_serv_id);
							$nombreDet = $servicio[0]->serv_nombre;
						}else if($deta->det_rad_id){
							$radio = $cotizacionesm->getRadiosReporte($deta->det_rad_id);
							$nombreDet = $radio[0]->rad_nombre;
						}
						$res->tabla.="<tr>
								<td>".$nombreDet."</td>";
								foreach ($fechas as $fec) {
									$res->tabla.="<td><input  type='text' name='' style='width:100%;'/></td>";
								}
						$res->tabla.="</tr>";	
					}
				}
			}
		}
		return $res;
	}
}