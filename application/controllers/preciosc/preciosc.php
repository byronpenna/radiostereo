<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class preciosc extends padre
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
			$tabla->precio =  $Catalogosm->DatosPrecio();//carga la tabla precios
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('catalogosv/preciosv/preciosv', $datos);
		}
	}
 ?>