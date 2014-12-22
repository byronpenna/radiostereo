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
			$this->load->model('usuariosm/usuariosm');//cargamos el modelo
			$Usuariom = new Usuariosm();//instancia al modelo
			$tabla = new stdClass(); //instanciamos la clase stdClass() 
			$tabla->usuarios = $Usuariom->getUser();
			$datos['Titulo']="..::Usuarios::..";
			$datos['tabla'] = $tabla;
			$this->load->view('usuariosv/usuariosv',$datos);
		}
	}
 ?>