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
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->id = $_SESSION['iduser'];
			$datos['Titulo']="..::Rol Usuario::..";
			$this->load->view('usuariov/roluserv',$datos);
		}
	}
 ?>