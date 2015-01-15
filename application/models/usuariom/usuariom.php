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
		public function selectUser($tabla)
		{
			$this->db->trans_start();
				$query = $this->db->get($tabla);
			$this->db->trans_complete();
			$query = $query->result();
			return $query;
		}
		public function getTablaUser()
		{
			$datos = $this->selectUser('usu_usuario');
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .="<tr class='styleTR'>
								<td style='display:none'><input value='".$row->usu_id."' class='inputUserID'></td>
								<td class='tdNombreUser'>".$row->usu_nombre."</td>
								<td class='tdContraUser'>".$row->usu_password."</td>
								<!--<td class='tdFirmaUser'>".$row->usu_firma."</td>-->
								<td style='display:none' class='tdCopaniaId'>".$row->usu_com_id."</td>
								<td><button class='EditUsuario btn btn-sm btn-primary'>Editar</button></td>
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
			$datos = $this->selectUser('usu_usuario');
			$retorno = "";
			foreach ($datos as $row) {
				$retorno .= "<input type='text' value='".$row->usu_id."' class='InputUserId' name='txtIdUser' style='display:none'>
							<input type='checkbox' value='".$row->usu_nombre."' name='txtUser' class='InputUser'>".$row->usu_nombre."
							<br>";
			}
			return $retorno;
		}
		public function get_rol()
		{
			$datos = $this->selectUser('rol_usuario');
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
								$retorno.="<td><button class='EditFirma btn btn-sm btn-primary'>Agregar Firma</button></td>";
							}elseif ($mensaje != "Aun no posee firma") {
								$retorno.="<td><button class='EditFirma btn btn-sm btn-primary'>Editar</button></td>";
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
	}
 ?>