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

		public function getCat(){
			$sql="SELECT  * FROM cat_categoria_contribuyente";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}


		public function getProductosFromCliente($clienteId){
			$sql = "SELECT * FROM `pro_producto` where pro_cli_id = ".$clienteId.";";
			$this->db->trans_start();
				$query = $this->db->query($sql);
			$this->db->trans_complete();
			$retorno = $query->result();
			return $retorno;
		}
		public function insertCliente($data){
			$this->db->trans_start();
				$flag = $this->db->insert_batch("pro_producto",$data);
			$this->db->trans_complete();
			return $flag;
		}

		public function deleteProductosClientes($idCliente){
			$this->db->trans_start();
				$data = array('pro_cli_id' => $idCliente );
				$this->db->delete("pro_producto",$data);
			$this->db->trans_complete();
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
		//funcion para modificar a la bd recibe los nuevos datos, estructura de la tabla y el name de los campos 
		public function update_programadb($dato, $tablabd, $namefrm, $tabla)
		{
			$data 		= array($tablabd[0] => $dato->$namefrm[0]);
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$this->db->where($tablabd[1], $dato->$namefrm[1]);
				$flag = $this->db->update($tabla, $data);
			$this->db->trans_complete();
			if($this->db->trans_status() === true){
				if($flag){
					$retorno->estado = true;
					$retorno->mensaje = "Modificado con exito";
					$retorno->dato = $dato->$namefrm[0];//retorno el nuevo valor	
				}else{
					$retorno->estado = false;
					$msg = $this->db->_error_message();
					$retorno->mensaje = $msg;
				}
			}else{
				$retorno->estado = false;
				$retorno->mensaje = "Se ha producido un Error al modificar";
			}
			return $retorno;
		}
		public function update_clientedb($dato)
		{
			$data 	= array(
							'cli_nombres' 		=> $dato->txtNombre, 
							'cli_razon_social' 	=> $dato->txtApellido,
							'cli_nrc'			=> $dato->txtNRC,
							'cli_nit'			=> $dato->txtNIT,
							'cli_direccion'		=> $dato->txtDireccion,
							'cli_telefono'		=> $dato->txtTelefono,
							'cli_contacto'		=> $dato->txtContacto,
							'cli_correo'		=> $dato->txtCorreo,
							'cli_titulo'		=> $dato->txtTitulo,
							'cli_giro'			=> $dato->txtGiro,
							'cli_cat_id'		=> $dato->cat
							);
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$this->db->where('cli_id', $dato->txtidcliente);
				$flag = $this->db->update('cli_cliente', $data);
			$this->db->trans_complete();
			if($this->db->trans_status() === true){
				if($flag){
					$retorno->estado = true;
					$retorno->mensaje = "Modificado con exito";
					$retorno->dato1 = $dato->txtNombre;//retorno el nuevo valor	
					$retorno->dato2 = $dato->txtApellido;
					$retorno->dato3 = $dato->txtNRC;
					$retorno->dato4 = $dato->txtNIT;
					$retorno->dato5 = $dato->txtDireccion;
					$retorno->dato6 = $dato->txtTelefono;
					$retorno->dato7 = $dato->txtContacto;
					$retorno->dato8 = $dato->txtCorreo;
				}else{
					$retorno->estado = false;
					$msg = $this->db->_error_message();
					$retorno->mensaje = $msg;
				}
			}else{
				$retorno->estado = false;
				$retorno->mensaje = "Se ha producido un Error al modificar";
			}
			return $retorno;
		}
	
		//genera los tr para progama, precio, servicio y radio
	public function GenerarRetorno($consult, $clases, $campo)
		{
			$retornar="";
			foreach ($consult as $row) {
				$retornar .="<tr class='styleTR alt'>
								<td style='display:none'><input value='".$row->$campo[0]."' class='".$clases['class1']."'></td>
								<td class='".$clases['class2']."'>".$row->$campo[1]."</td>
								<td>
									<center>
										<a class='".$clases['class3']."'>Editar</a>
									</center>
								</td>
							</tr>";
			}
			return $retornar;
		}
		//Inicia Metodos que muestran los datos
		public function datos_programa()//retorna los datos del programa
		{
			$this->load->model('cotizacionm/cotizacionm');//cargamos el modelo
			$cotizacionm = new cotizacionm();//instancia al modelo
			$consulta = $cotizacionm->getProgramas();//LLamamos la funcion q retorna el resultado de la query
			$clases = array('class1' => "inputProgramId", 'class2' => "tdProgramNombre", 'class3' => "btnEditar btn btn-primary btn-sm");
			$campos = array('prog_id', 'prog_nombre');
			$retorno = $this->GenerarRetorno($consulta, $clases, $campos);
			return $retorno;
		}
		public function DatosPrecio()//obtiene los datos de precio
		{
			$this->load->model('cotizacionm/cotizacionm');//cargamos el modelo
			$cotizacionm = new cotizacionm();//instancia al modelo
			$consulta = $cotizacionm->queryPrecios();//LLamamos la funcion q retorna el resultado de la query
			$clases = array('class1' => "inputPrecioId", 'class2' => "tdPrecio", 'class3' => "btnEditPrecio btn btn-sm btn-primary");
			$campos = array('pre_id', 'pre_precio');
			$retorno = $this->GenerarRetorno($consulta, $clases, $campos);
			return $retorno;
		}
		public function GetServicio()//ejecuta la consulta y la retorna
		{
			$this->db->trans_start();//inicia la transaccion
				$query = $this->db->get('serv_servicio');//
			$this->db->trans_complete();//finaliza la transaccion
			$query = $query->result();
			return $query;
		}
		public function DatosServicio()
		{
			$consulta = $this->GetServicio();
			$clases = array('class1' => "inputServId", 'class2' => "tdServicio", 'class3' => "btnEdtserv btn btn-sm btn-primary");
			$campos = array('serv_id', 'serv_nombre');
			$retorno = $this->GenerarRetorno($consulta, $clases, $campos);
			return $retorno;
		}
		public function GetRadio()
		{
			$this->db->trans_start();//inicia la transaccion
				$query = $this->db->get('rad_radio');//
			$this->db->trans_complete();//finaliza la transaccion
			$query = $query->result();
			return $query;
		}
		public function DatosRadio()
		{
			$consulta = $this->GetRadio();
			$clases = array('class1' => "inputRadioId", 'class2' => "tdRadioNomb", 'class3' => "btnEdtRadio btn btn-sm btn-primary");
			$campos = array('rad_id', 'rad_nombre');
			$retorno = $this->GenerarRetorno($consulta, $clases, $campos);;
			return $retorno;
		}
		public function selectCliente($idcliente)//extraer cliente para update
		{
			$this->db->trans_start();//inicia la transaccion
				$query = $this->db->query("SELECT * FROM cli_cliente WHERE cli_id =  ".$idcliente) ;//
			$this->db->trans_complete();//finaliza la transaccion
			$query = $query->result();
			return $query[0];
		}
		public function getCat1($id){
			$sql="SELECT  * FROM cat_categoria_contribuyente";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			$res ="";
			foreach ($query as $valor) {
				if($valor->cat_id==$id){
					$s='selected';
				}else{
					$s='';
				}
				$res.= "<option value='".$valor->cat_id."' ".$s.">".$valor->cat_categoria."</option>";
			}
			return $res;
		}
		public function RetornarUpdate($idcliente)
		{
			$consulta = $this->selectCliente($idcliente);
			$retorno = new stdClass();
			$retorno->idcliente 	= $consulta->cli_id;
			$retorno->nombre 		= $consulta->cli_nombres;
			$retorno->razonsocial 	= $consulta->cli_razon_social;
			$retorno->nit 			= $consulta->cli_nit;
			$retorno->nrc 			= $consulta->cli_nrc;
			$retorno->direccion 	= $consulta->cli_direccion;
			$retorno->telefono 		= $consulta->cli_telefono;
			$retorno->contacto 		= $consulta->cli_contacto;
			$retorno->correo 		= $consulta->cli_correo;
			$retorno->titulo 		= $consulta->cli_titulo;
			$retorno->giro 			= $consulta->cli_giro;
			$retorno->cat 			= $this->getCat1($consulta->cli_cat_id);
			
			return $retorno;
		}

		public function DatosClientes($iduser)
		{
			$this->load->model('mainm/mainm');//cargamos el modelo
			$mainm = new mainm();//instancia al modelo
			$consulta = $mainm->get_clientedb($iduser);//LLamamos la funcion q retorna el resultado de la query
			$retorno = "";
			foreach ($consulta as $row) {
				$retorno .= "<tr class='styleTR'>
								<td class='ocultar'><input value='".$row->cli_id."' class='inputClienteId'></td>
								<td class='tdNombCliente'>".$row->cli_nombres."</td>
								<td class='tdApellidoCliente'>".$row->cli_razon_social."</td>
								<td class='tdNRC ocultar'>".$row->cli_nrc."</td>
								<td class='tdNIT'>".$row->cli_nit."</td>
								<td class='tdTitulo'>".$row->cli_titulo."</td>
								<td class='tdDireccion ocultar'>".$row->cli_direccion."</td>
								<td class='tdTelefono ocultar'>".$row->cli_telefono."</td>
								<td class='tdContacto ocultar'>".$row->cli_contacto."</td>
								<td class='tdCorreo ocultar'>".$row->cli_correo."</td>
								<td><a class='EditCliente btn btn-sm btn-primary button' data-type='zoomout'>Editar</a>
								</td>
							</tr>";
			}
			return $retorno;
		}//Finaliza metodos para mostrar datos





		public function delete_catalogo($tabla, $idbd, $name)
		{
			$retorno 	= new stdClass();
			$this->db->trans_start();
			 	$this->db->where($idbd,$name);
        		$flag = $this->db->delete($tabla);
			$this->db->trans_complete();
			if($this->db->trans_status() === true){
				if($flag){
					$retorno->estado 	= true;
					$retorno->mensaje 	= "Eliminado con exito";
				}else{
					$retorno->estado 	= false;
					$msg 				= $this->db->_error_message();
					$retorno->mensaje 	= $msg;
				}
			}else{
				$retorno->estado = false;
				$retorno->mensaje = "Se ha producido un Error al Eliminar";
			}
			return $retorno;
		}

	}
?>	