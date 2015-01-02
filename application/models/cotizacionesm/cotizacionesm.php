<?php 
	/**
	* 
	*/
	class Cotizacionesm extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function SelectCotizacion()
		{
			$this->db->trans_start();
				$consulta = "SELECT * FROM cot_encabezado_cotizacion join cli_cliente on cli_id=cot_cli_id";
				$query = $this->db->query($consulta);
			$this->db->trans_complete();
			$datos = $query->result();
			return $datos;
		}
		public function getCotizacion()
		{
			$datos = $this->SelectCotizacion();
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .= "<tr class='styleTR'>
								<td style='display:none'>".$row->cot_id."</td>
								<td style='display:none'>".$row->cli_id."</td>
								<td>".$row->cli_nombres."</td>
								<td>".$row->cli_razon_social."</td>
								<td>".$row->cli_nit."</td>
								<td>".$row->cot_fecha_elaboracion."</td>
								<td><button class='btn btn-sm btn-primary' >Editar</button></td>
							 </tr>";
			}
			return $retorno;
		}
	}
 ?>