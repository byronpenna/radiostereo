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

	}
?>