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
		public function insert_catalogobd($frm)//metodo que inserta los datos a la bd
		{
			try {
				$data = array('prog_nombre' => $frm->nombpro);
				$this->db->trans_start();//inicia la transaccion
					$this->db->insert('prog_programa', $data);
				$this->db->trans_complete();//finaliza la transaccion
				$mensaje = "Datos insertados con exito";
				return $mensaje;
			} catch (Exception $e) {
				$mensaje = "Error:";
				return $mensaje + "" + $e;
			}
			
		}
		public function get_catalogobd()//metodo que extrae los datos de la bd
		{
			$this->db->trans_start();
			$query = $this->db->get('prog_programa');
			$this->db->trans_complete();
			$get_datos = $query->result();
			$retornar = "";
			foreach ($get_datos as $row) {
				$retornar .="<tr>
							<td>".$row->prog_id."</td>
							<td>".$row->prog_nombre."</td>
							<td><button><a href='".site_url("catalogosc/catalogosc/update_programa/".$row->prog_id."")."'>Editar</a></button></td>
						</tr>";
			}
			return $retornar;
		}
		public function update_catalogosdb()
		{
			# code...
		}
	}
 ?>