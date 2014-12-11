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
		//Nota: la explicacion del primer metodo de insert es la misma para todas los otros metodos
		//aqui comienzan los metodos para insertar a los catalogos
		public function insert_catalogobd($frm)//metodo que inserta los datos a la bd y recive un vector
		{
				$data = array('prog_nombre' => $frm->nombpro);//creo el arreglo para el insert 'nombpro' es el name q tiene el campo en la vista
				$this->db->trans_start();//inicia la transaccion
					$this->db->insert('prog_programa', $data);//inseta los datos a la bd
				$this->db->trans_complete();//finaliza la transaccion
				if ($this->db->trans_status() === true) {
					$mensaje = "Programa guardado con exito";
				}else{
					$mensaje = "Se ha producido un Error";
				}
				
				return $mensaje;//retorna el mensaje
		}
		public function add_precio($vect)
		{
			$data = array('pre_precio' => $vect->precio);
			$this->db->trans_start();
				$this->db->insert('pre_precio', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$mensaje = "Precio guardado con exito";
			}else{
				$mensaje = "Se ha producido un Error";
			}
			
			return $mensaje;
		}
		public function add_servicio($vect)
		{
			$data = array('serv_nombre' => $vect->servicio);
			$this->db->trans_start();
				$this->db->insert('serv_servicio', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$mensaje = "Servicio guardado con exito";
			}else{
				$mensaje = "Se ha producido un Error";
			}
			
			return $mensaje;
		}
		public function add_radio($form)
		{
			$data = array('rad_nombre' => $form->txtnombradio);
			$this->db->trans_start();
				$this->db->insert('rad_radio', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$mensaje = "Datos guardados con exito";
			}else{
				$mensaje = "Se ha producido un Error";
			}
			return $mensaje;
		}
		public function add_cliente($frm)
		{
			$data = array('cli_nombres' => $frm->txtnombcliente, 'cli_apellidos ' => $frm->txtapellido);
			$this->db->trans_start();
				$this->db->insert('cli_cliente', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$mensaje = "Datos guardados con exito";
			}else{
				$mensaje = "Se ha producido un Error";
			}
			return $mensaje;
		}
		//aqui comienzan los metodos para extraer y mostrar los datos de la bd
		public function get_catalogobd()//metodo que extrae los datos de la bd para la tabla programa
		{
			$this->db->trans_start();
			$query = $this->db->get('prog_programa');
			$this->db->trans_complete();
			$get_datos = $query->result();
			$retornar = "";
			foreach ($get_datos as $row) {
				$retornar .="<tr>
							<td style='display:none'><input value='".$row->prog_id."' class='inputProgramId'></td>
							<td class='tdProgramNombre'>".$row->prog_nombre."</td>
							<td>
								<button class='btnEditar'>
									Editar
								</button>
							</td>
						</tr>";
			}
			return $retornar;
		}
		public function get_preciodb()//metodo que extrae los datos de la bd para la tabla precio
		{
			$this->db->trans_start();
				$query = $this->db->get('pre_precio');
			$this->db->trans_complete();
			$get_precio = $query->result();
			$retorno = "";
			foreach ($get_precio as $row) {
				$retorno .= "<tr>
								<td style='display:none'><input value='".$row->pre_id."' /></td>
								<td>$ ".$row->pre_precio."</td>
								<td><button class='Editradio'>Editar</button></td>
							</tr>";
			}
			return $retorno;
		}
		public function get_serviciodb()//metodo que extrae los datos de la bd para la tabla servicio
		{
			$this->db->trans_start();
				$query = $this->db->get('serv_servicio');
			$this->db->trans_complete();
			$get_servicio = $query->result();
			$retorno = "";
			foreach ($get_servicio as $row) {
				$retorno .= "<tr>
								<td style='display:none'><input value='".$row->serv_id."' /></td>
								<td>".$row->serv_nombre ."</td>
								<td><button class='Editservicio'>Editar</button></td>
							</tr>";
			}
			return $retorno;
		}
		public function get_radiodb()//metodo que extrae los datos de la bd para la tabla radio
		{
			$this->db->trans_start();
				$query = $this->db->get('rad_radio');
			$this->db->trans_complete();
			$get_radio = $query->result();
			$retorno = "";
			foreach ($get_radio as $row) {
				$retorno .= "<tr>
								<td style='display:none'><input value='".$row->rad_id."' /></td>
								<td>".$row->rad_nombre."</td>
								<td><button class='Editradio'>Editar</button></td>
							</tr>";
			}
			return $retorno;
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
		public function update_programadb($dato)
		{
			$data 		= array('prog_nombre' => $dato->txtNombrePrograma);
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$this->db->where('prog_id', $dato->txtidprograma);
				$this->db->update('prog_programa', $data);
			$this->db->trans_complete();
			if($this->db->trans_status() === true){
				$retorno->estado 	= true;
				$retorno->mensaje 	= "Modificado correctamente";
			}else{
				$retorno->estado = false;
			}
			//$mensaje = "Dato modificado con exito";
			return $retorno;
		}
	}
 ?>