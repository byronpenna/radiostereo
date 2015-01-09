<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class perfil extends padre
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
			$datos['tabla'] = $tabla;
			$datos['Titulo']="..::Perfil usuario::..";
			$this->load->view('usuariov/perfil', $datos);
		}
	}
 ?>