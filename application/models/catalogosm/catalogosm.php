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
		//metodo que genera las filas de cada dato
		public function generar_retorno($datos, $clases, $campo)
		{
			$retornar="";
			foreach ($datos as $row) {
				$retornar .="<tr>
								<td style='display:none'><input value='".$row->$campo[0]."' class='".$clases['class1']."'></td>
								<td class='".$clases['class2']."'>".$row->$campo[1]."</td>
								<td><button class='".$clases['class3']."'>Editar</button></td>
							</tr>";
			}
			return $retornar;
		}
		public function get_catalogo($tabla)//metodo que extrae los datos de la bd
		{
			$this->db->trans_start();
			$query = $this->db->get($tabla);
			$this->db->trans_complete();
			$get_datos = $query->result();
			switch ($tabla) {
				case 'prog_programa':
						$clases = array('class1' => "inputProgramId", 'class2' => "tdProgramNombre", 'class3' => "btnEditar");
						$campos = array('prog_id', 'prog_nombre');
						$retorno = $this->generar_retorno($get_datos, $clases, $campos);//por cada dato obtenido se manda a llamar a la funcion
					break;
				case 'pre_precio':
						$clases = array('class1' => "inputPrecioId", 'class2' => "tdPrecio", 'class3' => "btnEditPrecio");
						$campos = array('pre_id', 'pre_precio');
						$retorno = $this->generar_retorno($get_datos, $clases, $campos);
					break;
				case 'serv_servicio':
						$clases = array('class1' => "inputServId", 'class2' => "tdServicio", 'class3' => "btnEdtserv");
						$campos = array('serv_id', 'serv_nombre');
						$retorno = $this->generar_retorno($get_datos, $clases, $campos);
					break;
				case 'rad_radio':
						$clases = array('class1' => "inputRadioId", 'class2' => "tdRadioNomb", 'class3' => "btnEdtRadio");
						$campos = array('rad_id', 'rad_nombre');
						$retorno = $this->generar_retorno($get_datos, $clases, $campos);
					break;
				default:
					$retorno = "Table dosn't exist";
					break;
			}
			return $retorno;
		}
		//aqui comienzan los metodos para extraer y mostrar los datos de la bd
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
				$retorno->estado = true;
				$retorno->mensaje = "Modificado con exito";
				$retorno->dato = $dato->txtNombrePrograma;//retorno el nuevo valor
			}else{
				$retorno->estado = false;
				$retorno->mensaje = "Se ha producido un Error al modificar";
			}
			return $retorno;
		}
	}
 ?>