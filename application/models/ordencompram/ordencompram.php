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
				
				$encaAnt = "<thead><tr class='success'><td><a href='".base_url("ordencompra/printFrecuencia/".$encabezado->enc_id."")."'><button class='btn-primary'>Imprimir</button></a></td>";
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
		$sql = $this->db->query("SELECT
				cli_nombres, cli_contacto,
				cli_nit, cli_giro,
				cli_direccion, cli_telefono,
				cli_correo, cot_valor_agregado,
				tip_tipo, pro_nomb_producto, 
				CURDATE() AS 'fechEmision'
			FROM ( (
						cot_encabezado_cotizacion
						INNER JOIN cli_cliente ON cot_cli_id = cli_id
					) INNER JOIN tip_tipo ON cot_tip_id = tip_id
				) INNER JOIN pro_producto ON cot_pro_id = pro_id
			WHERE cot_id =" . $idCot );
		foreach ($sql->result_array() as $datos) {
			$retorno['nombres'] = $datos['cli_nombres'];
			$retorno['contacto'] = $datos['cli_contacto'];
			$retorno['nit'] = $datos['cli_nit'];
			$retorno['giro'] = $datos['cli_giro']; 
			$retorno['direccion'] = $datos['cli_direccion'];
			$retorno['telefono'] = $datos['cli_telefono'];
			$retorno['correo'] = $datos['cli_correo'];
			$retorno['detcDes'] = $datos['cot_valor_agregado'];
			$retorno['tipoPago'] = $datos['tip_tipo'];
			$retorno['producto'] = $datos['pro_nomb_producto'];
			$retorno['fechEmision'] = $datos['fechEmision'];
		}

		return $retorno;
	}

	function getDatosDetalle($idCot){
		$sql = $this->db->query("SELECT enc_id, enc_precio_venta, prog_nombre, sec_nombre
				FROM ( enc_encabezado_bloque LEFT JOIN prog_programa ON enc_prog_id = prog_id )
				LEFT JOIN sec_seccion ON sec_id = enc_sec_id
				WHERE enc_fecha_fin != '0000-00-00' AND enc_cot_id =" . $idCot);
			foreach ($sql->result_array() as $datos) {
			$retorno['precioVenta'] = number_format($datos['enc_precio_venta'], 2);
			$retorno['progNombre'] = $datos['prog_nombre'];
			$retorno['secNombre'] = $datos['sec_nombre'];
			$enc_id = $datos['enc_id'];
		}
		$retorno['datosServ'] = $this->getSacarDatosServ($enc_id);
		return $retorno;
	}

	function getSacarDatosServ($idEnc){
		$sql = $this->db->query("SELECT DISTINCT
						det_id, det_subtotal,
						det_sec_id, rad_nombre,
						serv_nombre, det_cantidad
					FROM ( ( det_detalle_bloque
							LEFT JOIN frec_fecuencia ON det_id = id_detalle )
							LEFT JOIN serv_servicio ON serv_id = det_serv_id )
							LEFT JOIN rad_radio ON rad_id = det_rad_id
					WHERE det_cantidad > 0 AND det_enc_id =" . $idEnc);
		$sql = $sql->result();
		return $sql;
	}


// Reporte de frecuencias

	function getServicios($id){
		$sql = "SELECT  
				det_id,
				if(
					rad_nombre is null,
						serv_nombre,
						rad_nombre
				) detalleServicio,
				det_subtotal, 
				ROUND((det_duracion * pre_precio), 2) AS costoS,
 				det_cantidad 				
				FROM det_detalle_bloque 
				LEFT JOIN rad_radio  ON rad_id = det_rad_id
				LEFT JOIN serv_servicio ON serv_id = det_serv_id
				LEFT JOIN pre_precio ON det_pre_id = pre_id
				where det_enc_id = ".$id." and det_pre_id > 0 and det_cantidad > 0;
				";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;
	}
	
	function fechaFrec($encabezado,$idDetalle){
		$sql = "SELECT fec_id,fec_fecha, 
				(
					Select frecuencia
					from frec_fecuencia 
					where id_fecha = fec_id and id_seccion = ".$encabezado." and id_detalle = ".$idDetalle."
				) as frecuencia
				from fec_fechas
				where fec_enc_id = ".$encabezado.";
				";
		// echo "la query es: ".$sql;
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;	
	}
	function fecha($id){
		$sql = "SELECT  fec_id,DAY(fec_fecha) dia 
				from fec_fechas
				where fec_enc_id = ".$id.";
				";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;	

	}
	function printFrecuencia($id){
		$res = "<table border=1>";
		$servicios 	= $this->getServicios($id);
		// echo "<pre>";
		// 	print_r($servicios);
		// echo "</pre>";
		$fecha 		= $this->fecha($id);
		$res .= "<tr><td></td>";
		foreach ($fecha as $key => $value) {
			$res .= "<td>".$value->dia."</td>";
		}	
		$res .= "</tr>";
		foreach ($servicios as $key => $value) {
			$res .= "<tr>
				<td>".$value->detalleServicio."</td>
				";
				
				$frec = $this->fechaFrec($id,$value->det_id);
				// echo "<pre>";
				// 	print_r($frec);
				// echo "</pre>";
				foreach ($frec as $key => $value) {
					$res .= "<td><input value='".$value->frecuencia."'></td>";
				}
			$res .="
				</tr>
				";
		}
		return $res;
	}

}