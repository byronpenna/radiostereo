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
			$r= "<select name='tipo_cot' class='form-control input-sm pequenios'>";
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
			$res= "<select name='programa' class='largos' style='width:250px;' >";
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
			$res= "<select name='precio' class='form-control input-sm mpequenios' >";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->pre_id."'> $ ".$valor->pre_precio."</option>";
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
						<td>".$valor->serv_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='".$valor->serv_nombre."txtCantidad' value='' class='form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='".$valor->serv_nombre."txtDuracion' value='' placeholder='Segundos' class='form-control input-sm inAddCot SoloNumero txtDuracion' ></td>
                                <td><input type='text' name='txtSubTotal' value='' class='form-control input-sm inAddCot' disabled></td>
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
						<td>".$valor->rad_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='txtCantidad' value='' class='form-control input-sm inAddCot SoloNumero'></td>
                                <td><input type='text' name='txtDuracion' value='' placeholder='Segundos' class='form-control input-sm inAddCot SoloNumero' ></td>
                                <td><input type='text' name='txtSubTotal' value='' class='form-control input-sm inAddCot' disabled></td>
					</tr>";
			}	
			return $res;	
		}
	}
?>