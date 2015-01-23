<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class Radiosc extends padre
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
			$tabla->radio = $Catalogosm->DatosRadio();//carga la tabla radios
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('radiosv/radiosv', $datos);
		}
	}
 ?>