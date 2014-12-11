<?php 

	Class mainm extends CI_Model{

		public function mainm(){
			parent:: __construct();
		}
		public function get_clientedb()
		{
			$this->db->trans_start();
				$query = $this->db->get('cli_cliente');
			$this->db->trans_complete();
			$get_radio = $query->result();
			$retorno = "";
			foreach ($get_radio as $row) {
				$retorno .= "<tr>
								<td style='display:none'><input value='".$row->cli_id."' /></td>
								<td>".$row->cli_nombres."</td>
								<td>".$row->cli_apellidos."</td>
								<td><button class='Editcliente'>Editar</button></td>
							</tr>";
			}
			return $retorno;
		}
	}
?>