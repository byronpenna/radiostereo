<?php 
	Class cotizacionm extends CI_Model{

		public function __construct(){
			parent:: __construct();
		}

		public function getDatosCliente($id){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM cli_cliente WHERE cli_id=".$id."";
			$this->db->trans_start();
				$query=$this->db->query($sql);
				if($query->num_rows()>0){
					$datos->validacion=true;
				}
				$query=$query->result();
			$this->db->trans_complete();
			return $query[0];
		}

		public function getTipoCotizacion(){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM tip_tipo";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			$r="";
			if($datos->validacion===true){
				foreach ($query as $key => $valor) {
					$r.="<option value='".$valor->tip_id."'>".$valor->tip_tipo."</option>";
				}	
			}
			return $r;
		}


		public function getEstadoCotizacion(){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM est_estado";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			if($datos->validacion===true){
					$r ="<input type='text' value='".$query[0]->est_estado."' class='form-control input-sm pequenios' readonly='true'  />
						<input type='hidden' value='".$query[0]->est_id."' name='estado_cot' />
						";
			}
			return $r;
		}

		public function getProgramas(){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM prog_programa";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		public function getProgAddCot(){
			$query=$this->getProgramas();
			$res= "";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->prog_id."'>".$valor->prog_nombre."</option>";
			}
			$res.="";
			return $res;
		}


		public function queryPrecios(){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM pre_precio";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}


		public function getPrecios(){
			$query=$this->queryPrecios();
			$res= "<select name='precio' class='form-control input-sm mpequenios precios  blur'>
					<option value='-1'></option>";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->pre_id."'>$ ".$valor->pre_precio."</option>";
			}
			$res.="</select>";
			return $res;
		}

		public function getServiciosCot(){
			$this->load->model('catalogosm/catalogosm');
			$catalogosm = new Catalogosm();
			$query=$catalogosm->GetServicio();
			$res="";
			foreach ($query as $valor) {
				$res.="<tr>
						<td><input type='hidden' value='".$valor->serv_id."' name='txtIdServ' />".$valor->serv_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='txtCantidad' value='&nbsp;'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='&nbsp;'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='&nbsp;' placeholder='$'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
			}	
			return $res;	
		}

		public function getRadios(){
			$this->load->model('catalogosm/catalogosm');
			$catalogosm = new Catalogosm();
			$query=$catalogosm->GetRadio();
			$res="";
			foreach ($query as $valor) {
				$res.="<tr>
						<td><input type='hidden' name='txtIdRadio' value='".$valor->rad_id."' />".$valor->rad_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='txtCantidad' value='&nbsp;'  class='form-control input-sm inAddCot SoloNumero txtCantidad blur'></td>
                                <td><input type='text' name='txtDuracion' value='&nbsp;'  placeholder='Segundos' class='form-control input-sm inAddCot SoloNumero txtDuracion blur' ></td>
                                <td><input type='text' name='txtSubTotal' value='&nbsp;'  class='form-control input-sm inAddCot subTotal' placeholder='$' readonly='true'></td>
					</tr>";
			}	
			return $res;	
		}
		
		//Funcion para insertar datos en la cotizacion
		public function insertCotizacion($frm){
			$header 		= 	$frm->headerCot;
			$seccion 		= 	$frm->secCot;
			$retorno 		= new stdClass();
			$this->db->trans_start();
			$flag 	= $this->insertHeaderCot($header);
			$retorno->header = $flag;
			if($flag){
				$idEncCot = $this->db->insert_id();
				foreach ($seccion as $i  => $valor) {
					$replace = str_replace("$","",$valor->total);
					$total = str_replace(" ", "", $replace);
					if($total > 0){
						$calculo = $valor->descuento/$total;
						if($calculo  < 0.30){
							$this->load->model("cotizacionesm/cotizacionesm");
							$cotizacionesm = new Cotizacionesm();
							$cotizacionesm->updateEstadoCot($idEncCot);
						}
					}
					if(!isset($valor->programa)){
						$valor->programa 	= 	null;
					}
					if(!isset($valor->txtIdSec)){
						$valor->txtIdSec 	= 	null;
					}
					if(!isset($valor->txtIdServ)){
						$valor->txtIdServ	=	null;
					}
					if(!isset($valor->txtIdRadio)){
						$valor->txtIdRadio	=	null;
					}
					//if($valor->pventa!=null && $valor->txtFechaFin!=null){
						$flag 		=	 $this->insertEncBloq($valor,$idEncCot);
						$retorno->encBloq = $flag;
						$idEncBloq	=	 $this->db->insert_id();
						for ($i=0; $i < count($valor->precio); $i++) {
						//if($valor->precio!=-1){
						if($valor->precio[$i]==-1){
							$valor->precio[$i]="";
						}
							if(!isset($valor->txtIdRadio[$i])){
								$valor->txtIdRadio[$i] 	= null;
							}else if(!isset($valor->txtIdServ[$i])){
								$valor->txtIdServ[$i] 	= null;
							}else if(!isset($valor->txtIdSec[$i])){
								$valor->txtIdSec[$i] 	= null;
							}
					//		if($valor->txtCantidad[$i]!=null && $valor->txtDuracion[$i] != null && $valor->txtSubTotal[$i]!= null){
								@$obj = $this->getObjDetalle($idEncBloq,$valor->txtIdServ[$i],$valor->txtIdRadio[$i],$valor->precio[$i],$valor->txtCantidad[$i],$valor->txtDuracion[$i],$valor->txtSubTotal[$i],$valor->txtIdSec[$i]);
							$retorno->detBloq = $this->insertDetBloque($obj);
							//}
					 //	}
					}
					//}
				}

				$cli = $this->getDatosCliente($header->txtidCliente);
				if(!$cli->cli_usu_id){
					$this->asignarCliUsu($header->txtidCliente,$header->idUsuario);	
				}
			}

			$this->db->trans_complete();

			return $retorno;
		}

		public function getObjDetalle($idEncBloq,$idServ,$idRadio,$precio,$cantidad,$duracion,$subTotal,$secId){
			$obj = new stdClass();
			$obj->det_enc_id 	= $idEncBloq;
			$obj->det_serv_id 	= $idServ;
			$obj->det_rad_id 	= $idRadio;
			$obj->det_pre_id 	= $precio;
			$obj->det_cantidad 	= $cantidad;
			$obj->det_duracion 	= $duracion;
			$obj->det_subtotal 	= $subTotal;
			$obj->det_sec_id 	= $secId;

			return $obj;
		}

		public function asignarCliUsu($idCli,$idUsu){
			$tabla 			= array(
				'cli_usu_id'	=> $idUsu
				);
			$this->db->where('cli_id',$idCli);
			$res=$this->db->update('cli_cliente',$tabla);
			return $res;
		}

		public function insertHeaderCot($obj){
				$tabla 			= array(
				'cot_fecha_elaboracion'	=> $obj->txtFechaCreacionCot,
				'cot_valor_agregado'	=> $obj->txtValorAgregado,
				'cot_cli_id'			=> $obj->txtidCliente,
				'cot_tip_id'			=> $obj->tipo_cot,
				'cot_est_id'			=> $obj->estado_cot,
				'cot_usu_id'			=> $obj->idUsuario
				);	

				$res = $this->db->insert('cot_encabezado_cotizacion',$tabla);
				
				return $res;
		}

		public function insertEncBloq($obj,$idEnCot){
				$tabla		= array(
					'enc_cot_id' 		=> $idEnCot,
					'enc_prog_id'		=> $obj->programa,
					'enc_precio_venta' 	=> $obj->pventa,
					'enc_fecha_inicio' 	=> $obj->txtFechaInicio,
					'enc_fecha_fin' 	=> $obj->txtFechaFin,
					'enc_sec_id' 		=> $obj->txtIdSec
				);

				$res = $this->db->insert('enc_encabezado_bloque',$tabla);
				
				return $res;
		}

		public function insertDetBloque($obj){
			$tabla = array(
				'det_enc_id' 	=> $obj->det_enc_id,
				'det_serv_id' 	=> $obj->det_serv_id,
				'det_rad_id' 	=> $obj->det_rad_id,
				'det_pre_id'	=> $obj->det_pre_id,
				'det_cantidad' 	=> $obj->det_cantidad,
				'det_duracion' 	=> $obj->det_duracion,
				'det_subtotal' 	=> $obj->det_subtotal,
				'det_sec_id'	=> $obj->det_sec_id
				);
			$res = $this->db->insert('det_detalle_bloque',$tabla);
			
			return $res;
		}
	}
?>