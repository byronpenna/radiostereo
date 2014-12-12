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
				$retorno .= "<tr style='background:rgba(144, 240, 139, 0.8);'>
								<td>".$row->cli_id."</td>
								<td>".$row->cli_nombres."</td>
								<td>".$row->cli_apellidos."</td>
								<td><a href='".site_url('cotizacion/cotizacion/crearCotizacion?id='.$row->cli_id.'&nombre='.$row->cli_nombres.'&apellido='.$row->cli_apellidos.'') ."' style='text-decoration:none;color:#FFFFFF;'><button class='btn btn-sm btn-primary' >Cotizacion</button></a></td>
							</tr>";
			}
			return $retorno;
		}
	}
?>