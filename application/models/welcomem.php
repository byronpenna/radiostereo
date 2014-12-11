<?php 
	Class welcomem extends CI_Model{
		public function __construct(){
			parent:: __construct();
		}


		public function login($frm){
			$datos=new stdClass();
			$datos->validacion=false;
			$contra=sha1($frm->txtContra);
			$sql="SELECT COUNT(*) AS login,usu_id FROM usu_usuario WHERE  usu_nombre='".$frm->txtUsuario."' AND  usu_password='".$contra."'";
			//iniciar transaccion para validar la consulta 
			$this->db->trans_start();
				$query = $this->db->query($sql);
			$this->db->trans_complete();
			//transaccion finalizada
			if($this->db->trans_status()===true){
				$query=$query->result();
				if($query[0]->login == 1){
					$datos->validacion 	= true;
				}else{
					$datos->validacion 	= false;
					$datos->mensaje 	= "Usuario o Contraseña Incorrecta";
				}
			}else{
				$datos->validacion 	= false;
				$datos->mensaje 	= "Error Interno del Servidor,Intente de Nuevo";
			}
			if ($datos->validacion===true) {
				foreach ($query as $key => $valor) {
					if(session_start()==null){
				session_start();
			}
					$_SESSION['iduser']=$valor->usu_id;
				}
			}
			return $datos;
		}
		
	}
?>