<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class perfilc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$this->load->model('usuariom/usuariom');
			$usuariom = new Usuariom();
			$tabla = new stdClass();
			$tabla->id = $_SESSION['iduser'];
			$tabla->usuario = $usuariom->getPerfil($tabla->id);
			$datos['tabla'] = $tabla;
			$datos['Titulo']="Perfil | Grupo Radio Stereo";
			$this->load->view('usuariov/perfilv', $datos);
		}
		public function updatefirma()
		{
			//vars
				$form = json_decode($_POST["form"]);
				$this->load->model('usuariom/usuariom');
				$usuariom = new Usuariom();
				$mensaje = $usuariom->updatefirma($form);
				echo json_encode($mensaje);
		}
	}
 ?>