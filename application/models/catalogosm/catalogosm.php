<?php 
	/**
	* 
	*/
	class Catalogosm extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		
		//inicio insert catalogos
		public function add_catalogos($tabla,$vect)//recibe el nombre de la tabla y un vector con los satos
		{
			$retorno = new stdClass();
				$this->db->trans_start();//inicia la transaccion
					$this->db->insert($tabla, $vect);//inseta los datos a la bd
					$retorno->last_id = $this->db->insert_id();
				$this->db->trans_complete();//finaliza la transaccion
				if ($this->db->trans_status() === true) {
					$retorno->mensaje 	= "guardado con exito";
					$retorno->estado	= true;
				}else{
					$retorno->mensaje 	= "Se ha producido un Error al Guardar";
					$retorno->estado 	= false;
				}
			return $retorno;
		}//fin insert catalogos
		public function get_catalogos($tabla)
		{
			$this->db->trans_start();//inicia la transaccion
					$query = $this->db->get($tabla);//inseta los datos a la bd
			$this->db->trans_complete();//finaliza la transaccion
			$get_datos = $query->result();
			$retorno = "";
			foreach ($get_datos as $row) {
				$retorno .="<tr>
								<td style='display:none'><input value='".$row->prog_id."' class=''></td>
								<td class='algo'>".$row->prog_nombre."</td>
								<td><button class=''>Editar</button></td>
							</tr>";
			}
			return $retorno;
		}
	}
?>	