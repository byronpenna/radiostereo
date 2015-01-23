<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class clientesc extends padre
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
			$tabla->clientes = $Catalogosm->DatosClientes($tabla->id);//carga la tabla clientes
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('catalogosv/clientesv/clientesv', $datos);
		}
	}
 ?>