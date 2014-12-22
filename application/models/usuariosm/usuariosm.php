<?php 
 /**
 * 
 */
 class Usuariom extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}
 	public function SelectUser()
	{
		$this->db->trans_start();//inicia la transaccion
			$query = $this->db->get('usu_usuario');//
		$this->db->trans_complete();//finaliza la transaccion
		$query = $query->result();
		return $query;
	}
	public function getUser()
	{
		$datos = $this->SelectUser();
		$retorno = "";
		foreach ($datos as $row) {
			$retorno = "<tr>
							<td>".."</td>
							<td>".."</td>
							<td>".."</td>
							<td>".."</td>
					    </tr>";
		}
	}
 }
 ?>