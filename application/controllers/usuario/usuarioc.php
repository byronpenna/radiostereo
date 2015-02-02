<?php 
/**
* 
*/
	include_once(APPPATH.'controllers/padre.php');
	class Usuarioc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function insert_user()
		{
			//vars
			$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$password = sha1($form->txtpassword);
			$data = array('usu_nombre' => $form->txtuser, 'usu_password'=> $password, 'usu_com_id'=> $form->txtIdCompania);
			$mensaje = $Catalogosm->add_catalogos('usu_usuario',$data);

			echo json_encode($mensaje);
		}
		public function update_user()
		{
			//vars
			$frm = json_decode($_POST["form"]);
			$this->load->model('usuariom/usuariom');
			$Usuariom = new Usuariom();
			$mensaje = $Usuariom->update_userdb($frm);
			echo json_encode($mensaje);
		}
		public function delete_user()
		{
			//vars
				$frm = json_decode($_POST["form"]);
			$this->load->model('usuariom/usuariom');
			$Usuariom = new Usuariom();
			$mensaje = $Usuariom->delete_userdb($frm);
			echo json_encode($mensaje);
		}
		public function index()
		{
			$this->load->model('usuariom/usuariom');
			$usuariom = new Usuariom();
			$tabla = new stdClass();
			$tabla->usuario = $usuariom->getTablaUser();
			$datos['tabla'] = $tabla;
			$datos['Titulo']="Usuarios | Grupo Radio Stereo";
			$this->load->view('usuariov/usuariov', $datos);
		}
	}
 ?>