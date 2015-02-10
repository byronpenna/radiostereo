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
		public function selectUser($tabla,$condicion){
			$this->db->trans_start();
			if($condicion!=""){
				$this->db->where($condicion);	
			}
			$query = $this->db->get($tabla);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}

		public function getTablaUser(){
			$condicion  = array(
				'usu_rol_id <>' => 1
				);
			$datos = $this->selectUser('usu_usuario',$condicion);
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .="<tr class='styleTR'>
								<td style='display:none'><input value='".$row->usu_id."' class='inputUserID'></td>
								<td class='tdNombreUser'>".$row->usu_nombre."</td>
								<td style='display:none' class='tdCopaniaId'>".$row->usu_com_id."</td>
								<td></td>
								<td><a class='EditUsuario btn btn-sm btn-primary'>Editar</a></td>
							</tr>";
			}
			return $retorno;
		}
		public function getUser($id)
		{
			$query = "SELECT * FROM usu_usuario WHERE usu_id=".$id;
			$this->db->trans_start();
				$query = $this->db->query($query);
			$this->db->trans_complete();
			$dato = $query->result();
			return $dato;
		}

		public function get_user_rol()
		{
			$condicion  = array(
				'usu_rol_id <>' => 1
				);
			$datos = $this->selectUser('usu_usuario',$condicion);
			$retorno = "";
			$tablita = 0;
			foreach ($datos as $row) {
				if ($tablita == 0) {
					$retorno .= "
					<tr><td>
					<span class='button-checkbox'>
						<button type='button' class='btn  btn-xs' data-color='info'><i class='glyphicon glyphicon-user'></i></button>
						<input type='checkbox' class='hidden' value='".$row->usu_id."' name='txtUser' class='InputUser'>".$row->usu_nombre."
					</span> </td>	
					";
					$tablita++;
				}else{
					$retorno .= "
					<td>
					<span class='button-checkbox'>
						<button type='button' class='btn  btn-xs' data-color='info'><i class='glyphicon glyphicon-user'></i></button>
						<input type='checkbox' class='hidden' value='".$row->usu_id."' name='txtUser' class='InputUser'>".$row->usu_nombre."
					</span> </td></tr>
					";
					$tablita = 0;
				}
			}
			return $retorno;
		}
		public function get_rol()
		{
			$condicion = array(
				'rol_id <>' => 1
				);
			$datos = $this->selectUser('rol_usuario',$condicion);
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .= "<option value='".$row->rol_id."'>".$row->rol_nombre."</option>";
			}
			return $retorno;
		}
		public function getPerfil($id)
		{
			$dato = $this->getUser($id);
			$retorno ="";
			if($dato[0]->usu_firma==null){
				$mensaje="Aun no posee firma";
			}else{
				$mensaje=$dato[0]->usu_firma;
			}
			foreach ($dato as $row) {
				$retorno.="<tr>
							<td style='display:none'><input value='".$row->usu_id."' class='InputIdUser'></td>
							<td class='tdNombreUser'>".$row->usu_nombre."</td>
							<td class='tdAlgoUser'>".nl2br($mensaje)."</td>";
							if($mensaje == "Aun no posee firma"){
								$retorno.="<td><a class='EditFirma btn btn-sm btn-block btn-primary'>Agregar Firma</a></td>";
							}elseif ($mensaje != "Aun no posee firma") {
								$retorno.="<td><a class='EditFirma btn btn-sm  btn-block btn-primary'>Editar</a></td>";
							}
						  	$retorno.= "</tr>";
			}
			
			return $retorno;
		}
		public function update_userdb($dato)
		{
			$encirpt = sha1($dato->txtPsw);
			$data 		= array('usu_nombre' => $dato->txtNombUser, 'usu_password' => $encirpt);
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$this->db->where('usu_id', $dato->txtIdUser);
				$flag = $this->db->update('usu_usuario', $data);
			$this->db->trans_complete();
			$firma = $this->getUser($dato->txtIdUser);
			$algo = $firma[0]->usu_firma;
			if($this->db->trans_status() === true){
				if($flag){
					$retorno->estado = true;
					$retorno->mensaje = "Modificado con exito";
					$retorno->dato1 = $dato->txtNombUser;//retorno el nuevo valor	
					$retorno->dato2 = $encirpt;
					$retorno->dato3 = $algo;
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
		public function delete_userdb($datos)
		{
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$consulta = "DELETE FROM usu_usuario WHERE usu_id=".$datos->txtIdUser;
				$flag = $this->db->query($consulta);
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
		public function updatefirma($datos)
		{
			$data 		= array('usu_firma' => $datos->txtfirma);
			$retorno 	= new stdClass();
			$this->db->trans_start();
				$this->db->where('usu_id', $datos->txtIdUser);
				$flag = $this->db->update('usu_usuario', $data);
			$this->db->trans_complete();
			$nombre = $this->getUser($datos->txtIdUser);;
			if($this->db->trans_status() === true){
				if($flag){
					$retorno->estado 	= true;
					$retorno->mensaje	= "Modificado con exito";
					$retorno->dato1 	= $nombre[0]->usu_nombre;//retorno el nuevo valor	
					$retorno->dato2 	= $datos->txtfirma;
				}else{
					$retorno->estado 	= false;
					$msg 				= $this->db->_error_message();
					$retorno->mensaje 	= $msg;
				}
			}else{
				$retorno->estado = false;
				$retorno->mensaje = "Se ha producido un Error al modificar";
			}
			return $retorno;
		}

		

		public function putRol($idUSer,$idRol){
			$tabla = array(
				'usu_rol_id' => $idRol
				);
			$this->db->where('usu_id',$idUSer);
			$res = $this->db->update('usu_usuario',$tabla);

			return $res;
		}

		public function asignarRol($frm){
			$usuarios 	= $frm->txtUser;
			$rol 		= $frm->txtRol;
			$res = false;
			if(is_array($usuarios)){
				foreach ($usuarios as $row) {
				$flag 	= 	$this->putRol($row,$rol);
				if($flag){
					$res 	= 	true;
				}
			}		
			}else{
				$flag 	= 	$this->putRol($usuarios,$rol);
				if($flag){
					$res 	= 	true;
				}
			}
			return $res;
		}

		public function obtenerNombreRol($idrol){
			$sql="
					SELECT * FROM 	rol_usuario
					WHERE rol_id='".$idrol."'";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}


		public function queryUsuario(){
			$this->db->trans_start();
			$sql="SELECT * FROM usu_usuario
			ORDER BY usu_rol_id DESC";
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}


		public function consultaRolesAsignados(){
			$datos = $this->queryUsuario();
			$res="";
			foreach ($datos as $row) {
				$rol = $this->obtenerNombreRol($row->usu_rol_id);
				if($rol){
					$rol = $rol[0]->rol_nombre;
				}else{
					$rol = "Sin rol";
				}
				if($row->usu_rol_id!=1){
					$res.="<tr>
							<td>".$row->usu_nombre."</td>
							<td>".$rol."</td>
					</tr>";
				}
				
			}
			return $res;
		}
	}
 ?>