<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class roluserc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{
			$this->load->model('usuariom/usuariom');
			$Usuariom = new Usuariom();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->id = $_SESSION['iduser'];
			$tabla->usuario = $Usuariom->get_user_rol();
			$tabla->rol 	= $Usuariom->get_rol();
			$datos['tabla'] = $tabla;
			$datos['Titulo']="..::Rol Usuario::..";
			$this->load->view('usuariov/roluserv',$datos);
		}
	}
 ?>