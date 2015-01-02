<?php 
 /**
 * 
 */
 class Usuariosm extends CI_Model
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
			$retorno .= "<tr class='styleTR'>
							<td style='display:none'><input value='".$row->usu_id."' class='inputUserId'></td>
							<td class='tdNombreUser'>".$row->usu_nombre."</td>
							<td class='tdPasswordUser'>".$row->usu_password."</td>
							<td style='display:none'><input value='".$row->usu_com_id."' class='inputCompaniaId'></td>
							<td>
								<button class='EditUser btn btn-sm btn-primary'>Editar</button>
								<button class='btn btn-sm btn-danger'>Eliminar</button>
							</td>
					    </tr>";
		}
		return $retorno;
	}
 }
 ?>