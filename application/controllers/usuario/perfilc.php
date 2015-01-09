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
			$tabla->clientes = $usuariom->getPerfil($tabla->id);
			$datos['tabla'] = $tabla;
			$datos['Titulo']="..::Perfil usuario::..";
			$this->load->view('usuariov/perfilv', $datos);
		}
	}
 ?>