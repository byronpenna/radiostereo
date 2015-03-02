<?php 
class Ordencompram extends CI_Model{

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

	function queryFrEnc($id){
		$sql="SELECT  * FROM frec_fecuencia
				WHERE id_seccion=".$id."";
		$this->db->trans_start();
		$query = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;
	}

/*
	$this->load->model("cotizacionm/cotizacionm");
			$cotizacionm  = new cotizacionm();
			$cotizacionm->updateFechaAcceso($obj->txtidCliente);*/

	public function addFrecuencia($frm,$encabezado){
		$enc = $this->queryFrEnc($encabezado);
		foreach ($frm as $valor) {
			$flag= $this->queryFrecuencia($encabezado,$valor->detalle,$valor->fecha);
			if($flag){
				foreach ($flag as $row) {
						foreach ($enc as $enca){
							if($row->id_seccion==$enca->id_seccion && $row->id_detalle==$enca->id_detalle && $row->id_fecha == $enca->id_fecha){
							$data = $this->updateFr($row->id,$valor);
						}
					}
				}
			}else{
				$data = $this->insertFr($valor,$encabezado);	
			}
		}
		$idCli =  $this->encFre($encabezado);
		$this->load->model("cotizacionm/cotizacionm");
		$cotizacionm  = new cotizacionm();
		$cotizacionm->updateFechaAcceso($idCli[0]->cot_cli_id);
		return $data;
	}

	public function updateFr($id,$obj){
		$tabla = array(
			'frecuencia' 	=> 	$obj->frecuencia, 
			);
		$this->db->where('id',$id);
		$res = $this->db->update('frec_fecuencia',$tabla);
		return $res;
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
				
				$encaAnt = "<thead><tr class='success'><td><a class='btn btn-block btn-success' target='_blank' href='".base_url("ordencompra/printFrecuencia/".$encabezado->enc_id."")."'><i class='glyphicon glyphicon-print'></i> Imprimir</a></td>";
				foreach ($col as $key => $value) {
					$encaAnt .= "<th colspan='".$value."' class='text-center'>".$this->getMonth(intval($key)-1)."</th>";
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
								<td class='active col-sm-2'><b>".$nombreDet."</b><br>Cantidad : <input type='text' class='Cantidad' disabled style='width:30%;' value='".$deta->det_cantidad."'></td>";
								foreach ($fechas as $fec) {
									$res->tabla.="<td><input detalle='".$deta->det_id."' type='text' class='txtFrecuencia SoloNumero' name='".$fec->fec_id."' style='width:100%; height:100%'/></td>";
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
				CURDATE() AS 'fechEmision',
				cat_categoria, usu_nomcompleto
			FROM
				cot_encabezado_cotizacion
			LEFT JOIN cli_cliente ON cot_cli_id = cli_id
			LEFT JOIN cat_categoria_contribuyente ON cli_cat_id = cat_id
			LEFT JOIN tip_tipo ON cot_tip_id = tip_id
			LEFT JOIN pro_producto ON cot_pro_id = pro_id
			LEFT JOIN usu_usuario ON usu_id = cot_usu_id
			WHERE
				cot_id =" . $idCot );
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
			$retorno['categoria'] = $datos['cat_categoria'];
			$retorno['vendedor'] = $datos['usu_nomcompleto'];
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
				where det_enc_id = ".$id." and det_pre_id > 0 and det_cantidad > 0
				";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;
	}
	
	/*function fechaFrec($encabezado){
		$encontrar= "SELECT  det_id FROM det_detalle_bloque WHERE det_enc_id = ". $encabezado ." AND det_pre_id > 0 AND det_cantidad > 0";
		$encontrar= $this->db->query($encontrar);
		

		$sql = "SELECT fec_id,fec_fecha, 
				(
					Select frecuencia
					from frec_fecuencia 
					where id_fecha = fec_id and id_seccion = ".$encabezado." and id_detalle = ".$idDetalle."
				) as frecuencia
				from fec_fechas
				where fec_enc_id = ".$encabezado.";
				";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;	
	} */
	
	function fechaDia($id){
		$sql = "SELECT DAY(fec_fecha) AS 'dia', MONTH(fec_fecha) AS 'mes' FROM fec_fechas WHERE fec_enc_id = ".$id . " ORDER BY fec_fecha";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;	

	}

	function fechaMes($id){
		$sql = "SELECT DISTINCT
		CASE
			WHEN MONTH (fec_fecha) = 1 THEN
				'Enero'
			WHEN MONTH (fec_fecha) = 2 THEN
				'Febrero'
			WHEN MONTH (fec_fecha) = 3 THEN
				'Marzo'
			WHEN MONTH (fec_fecha) = 4 THEN
				'Abril'
			WHEN MONTH (fec_fecha) = 5 THEN
				'Mayo'
			WHEN MONTH (fec_fecha) = 6 THEN
				'Junio'
			WHEN MONTH (fec_fecha) = 7 THEN
				'Julio'
			WHEN MONTH (fec_fecha) = 8 THEN
				'Agosto'
			WHEN MONTH (fec_fecha) = 9 THEN
				'Septiembre'
			WHEN MONTH (fec_fecha) = 10 THEN
				'Octubre'
			WHEN MONTH (fec_fecha) = 11 THEN
				'Noviembre'
			WHEN MONTH (fec_fecha) = 12 THEN
				'Diciembre'
		END AS 'mes', MONTH(fec_fecha) AS 'mesN', COUNT(fec_fecha) as contada
		FROM fec_fechas
		WHERE fec_enc_id =".$id . " GROUP BY MONTH(fec_fecha)";
		$this->db->trans_start();
		$query  = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;	
	}

	function fechaFre($id){
		$sql = $this->db->query("SELECT frecuencia, id_detalle, DAY(fec_fecha) AS 'dia', MONTH(fec_fecha) AS 'mes'
				FROM fec_fechas LEFT JOIN frec_fecuencia ON id_fecha = fec_id WHERE fec_enc_id =" . $id . " ORDER BY fec_fecha");
		$sql = $sql->result();
		return $sql;

	}

	function encFre($id){
		$sql = $this->db->query("SELECT
			*
		FROM ( ( cot_encabezado_cotizacion
				LEFT JOIN cli_cliente ON cot_cli_id = cli_id )
				LEFT JOIN enc_encabezado_bloque ON enc_cot_id = cot_id )
				LEFT JOIN pro_producto ON cot_pro_id = pro_id
		WHERE enc_id =" . $id);
		$sql = $sql->result();
		return $sql;
	}



//Frecuencias

	function queryFrecuencia($enc,$det,$fec){
		$sql="SELECT  * FROM frec_fecuencia
				WHERE id_fecha=".$fec." AND id_detalle =".$det." AND id_seccion=".$enc."";
		$this->db->trans_start();
		$query = $this->db->query($sql);
		$this->db->trans_complete();
		$query = $query->result();
		return $query;
	}

	function getFrecuencias($frm){
		$encabezado  	= 	$frm->encabezado;
		$detalle 		=	$frm->detalle;
		$fecha 			=	$frm->fecha;
		$res = new stdClass();
		foreach ($detalle as $i => $row) {
			$flag= $this->queryFrecuencia($encabezado,$row,$fecha[$i]);
			if($flag){
				$res->detalle[$i] 	= 	$row;
				$res->fecha[$i] 	=	$fecha[$i];
				$res->fr[$i]		=	$flag[0]->frecuencia;
			}
		}
		return $res;
	}

}

?>