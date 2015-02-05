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
	public function addFrecuencia($frm,$encabezado){
		foreach ($frm as $valor) {
			$data = $this->insertFr($valor,$encabezado);
		}
		return $data;
		
	}

	public function insertFr($obj,$encabezado){
		$tabla = array(
			'frecuencia' 	=> 	$obj->frecuencia, 
			'id_seccion' 	=>	$encabezado,
			'id_fecha' 		=>	$obj->fecha,
			'id_detalle'	=> 	$obj->detalle
			);
		
		$res = $this->db->insert('frec_fecuencia',$tabla);

		return $res;
	}



	public function getMonth($nMes){

		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 

		return $meses[$nMes]; 
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
				$fechas 		=	$cotizacionesm->getFechas($encabezado->enc_id);
				$enca 			= 	"";
				$enca 	.= 	"<tr class='active'><th></th>";
				$col  			= 	array();
				// echo "<pre>";
				// 	print_r($fechas);
				// echo "</pre>";

				foreach ($fechas as $fec) {
					$fecha 	= 	substr($fec->fec_fecha, 5,2);
					$enca 	.= 	"<th class='text-center'>";
					if(isset($col[$fecha])){
						$col[$fecha] += 1;
					}else{
						$col[$fecha] = 1;
					}
					// $enca .= $fec->fec_fecha." || ";
					$enca 	.= 	substr($fec->fec_fecha, 8,2)."</th>";
				}
				
				$encaAnt = "<thead><tr class='success'><td></td>";
				foreach ($col as $key => $value) {
					$encaAnt .= "<th colspan='".$value."' class='text-center'>".$this->getMonth(intval($key))."</th>";
				}
				$encaAnt 	.= "</tr>";
				$res->tabla .= $encaAnt.$enca;
				$res->tabla .= "</thead><tbody encabezado='".$encabezado->enc_id."' id='tbTabla'>";
				$det	= 	$cotizacionesm->getDetId($encabezado->enc_id);
				// echo "<pre>";
				// 	print_r($det);
				// echo "</pre>";
				// echo "<pre>".$res->tabla."</pre>";
				foreach ($det as $deta) {
					if($deta->det_pre_id && $deta->det_cantidad && $deta->det_duracion){
						if($deta->det_serv_id){
							$servicio  = $cotizacionesm->getServicios($deta->det_serv_id);
							$nombreDet = $servicio[0]->serv_nombre;
						}else if($deta->det_rad_id){
							$radio = $cotizacionesm->getRadiosReporte($deta->det_rad_id);
							$nombreDet = $radio[0]->rad_nombre;
						}
						$res->tabla.="<tr detalle='".$deta->det_id."'>
								<td class='active col-sm-2'>".$nombreDet."</td>";
								foreach ($fechas as $fec) {
									$res->tabla.="<td><input detalle='".$deta->det_id."' type='text' class='txtFrecuencia' name='".$fec->fec_id."' style='width:100%;'/></td>";
								}
						$res->tabla.="</tr>";	
					}
				}
				$res->tabla .= "</tbody>";
			}
		}
		return $res;
	}


//Reporte de Orden de Compra

//Datos del encabezado del cliente
	function getDatosCli($idCot){
		$sql = $this->db->query("SELECT cli_nombres, cli_contacto, cli_nit, cli_giro, cli_direccion, cli_telefono, cli_correo 
			FROM cot_encabezado_cotizacion
			INNER JOIN cli_cliente ON cot_cli_id = cli_id 
			WHERE cot_id =" . $idCot );
		foreach ($sql->result_array() as $datos) {
			$retorno['nombres'] = $datos['cli_nombres'];
			$retorno['contacto'] = $datos['cli_contacto'];
			$retorno['nit'] = $datos['cli_nit'];
			$retorno['giro'] = $datos['cli_giro']; 
			$retorno['direccion'] = $datos['cli_direccion'];
			$retorno['telefono'] = $datos['cli_telefono'];
			$retorno['correo'] = $datos['cli_correo'];
		}
		$sql2 = $this->db->query("SELECT
			pro_nomb_producto
			FROM
				cot_encabezado_cotizacion
			INNER JOIN pro_producto ON cot_pro_id = pro_id
			WHERE cot_id =" . $idCot);
		foreach ($sql2->result_array() as $key) {
			$retorno['producto'] = $key['pro_nomb_producto'];
		}
		return $retorno;
	}

	function getEncCli($idCot){
		$sql = "SELECT det_cantidad, det_cuna_diaria, det_duracion, det_subtotal, enc_fecha_inicio, enc_fecha_fin, serv_nombre, rad_nombre, pre_precio
					FROM
					( (	(
						det_detalle_bloque
						INNER JOIN enc_encabezado_bloque ON det_enc_id = enc_id
						)
						LEFT JOIN serv_servicio ON serv_id = det_serv_id
						)
						LEFT JOIN rad_radio ON rad_id = det_rad_id
						)
						LEFT JOIN pre_precio ON pre_id = det_pre_id
					WHERE enc_id =" . $idCot;
		foreach ($sql->result_array() as $valores) {
			$retorno['cantidad'] =  $valores['det_cantidad'];
			$retorno['cuna'] =  $valores['det_cuna_diaria'];
			$retorno['duracion'] = $valores['det_duracion'];
			$retorno['subtotal'] = $valores['det_subtotal'];
			$retorno['finicio'] = $valores['enc_fecha_inicio'];
			$retorno['ffin'] = $valores['enc_fecha_fin'];
			$retorno['nombreServicio'] = $valores['serv_nombre'];
			$retorno['nombreRadio'] = $valores['rad_nombre'];
			$retorno['precio'] = $valores['pre_precio'];
		}
	}

}