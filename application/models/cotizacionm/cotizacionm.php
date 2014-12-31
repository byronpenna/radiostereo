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
			$r= "<select name='tipo_cot' class='form-control input-sm pequenios' >";
			if($datos->validacion===true){
				foreach ($query as $key => $valor) {
					$r.="<option value='".$valor->tip_id."'>".$valor->tip_tipo."</option>";
				}
				$r.="</select>";	
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
			$r= "<select name='estado_cot' class='form-control input-sm pequenios' onload='this.selectedIndex = '-1'' >";
			if($datos->validacion===true){
				foreach ($query as $key => $valor) {
					$r.="<option value='".$valor->est_id."'>".$valor->est_estado."</option>";
				}
				$r.="</select>";	
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
			$res= "<select name='programa' class='form-control input-sm' style='width:240px;height:28px;padding:0px;' >";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->prog_id."'>".$valor->prog_nombre."</option>";
			}
			$res.="</select>";
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
			$res= "<select name='precio' class='form-control input-sm mpequenios precios blur'>";
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
                                <td><input type='text' name='txtCantidad'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
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
                                <td><input type='text' name='txtCantidad'  class='form-control input-sm inAddCot SoloNumero txtCantidad blur'></td>
                                <td><input type='text' name='txtDuracion'  placeholder='Segundos' class='form-control input-sm inAddCot SoloNumero txtDuracion blur' ></td>
                                <td><input type='text' name='txtSubTotal'  class='form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
			}	
			return $res;	
		}

		//Funcion para insertar datos en la cotizacion
		public function insertCotizacion($frm){
			$header 		= $frm->headerCot;
			$seccion 		= $frm->secCot;
			$retorno 		= new stdClass();
			$this->db->trans_start();
			$flag 	= $this->insertHeaderCot($header);
			$this->db->trans_complete();
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

		public function insertEncBloq($obj){
				$tabla		= array(
				'enc_cot_id' => $idEnCot,
				'enc_prog_id'	=> $obj->programa,
				'enc_precio_venta' => $obj->pventa,
				'enc_fecha_inicio' => $obj->txtFechaInicio,
				'enc_fecha_fin' => $obj->txtFechaFin,
				'enc_sec_id' => $obj->txtIdSec
				);
		}
	}
?>