<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class usuariosc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			$tabla = new stdClass(); //instanciamos la clase stdClass() 
			$datos['Titulo']="..::Usuarios::..";
			$this->load->view('usuariosv/usuariosv',$datos);
		}
	}
 ?>