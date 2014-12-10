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
				$mensaje = "Datos insertados con exito";
				return $mensaje;//retorna el mensaje
		}
		public function add_precio($vect)
		{
			$data = array('pre_precio' => $vect->precio);
			$this->db->trans_start();
				$this->db->insert('pre_precio', $data);
			$this->db->trans_complete();
			$mensaje = "Precio guardado con exito";
			return $mensaje;
		}
		public function add_servicio($vect)
		{
			$data = array('serv_nombre' => $vect->servicio);
			$this->db->trans_start();
				$this->db->insert('serv_servicio', $data);
			$this->db->trans_complete();
			$mensaje = "Servicio guardado con exito";
			return $mensaje;
		}
		public function add_radio($form)
		{
			
		}
		//aqui comienzan los metodos para extraer y mostrar los datos de la bd
		public function get_catalogobd()//metodo que extrae los datos de la bd
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