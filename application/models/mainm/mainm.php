<?php 

	Class mainm extends CI_Model{

		public function mainm(){
			parent:: __construct();
		}
		public function get_clientedb($iduser)
		{
			$this->db->trans_start();
				$sql = "SELECT * FROM cli_cliente WHERE cli_usu_id =".$iduser." or cli_usu_id = 0";
				$query=$this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}
		public function DatosCliente($iduser)
		{
			$datos = $this->get_clientedb($iduser);
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .= "<tr style='background:rgba(144, 240, 139, 0.8);'>
								<td>".$row->cli_id."</td>
								<td>".$row->cli_nombres."</td>
								<td>".$row->cli_apellidos."</td>
								<td style='display:none'>".$row->cli_usu_id."</td>
								<td><a href='".site_url('cotizacion/cotizacion/crearCotizacion/'.$row->cli_id.'') ."' style='text-decoration:none;color:#FFFFFF;'><button class='btn btn-sm btn-primary' >Cotizacion</button></a></td>
							</tr>";
			}
			return $retorno;
		}
	}
?>