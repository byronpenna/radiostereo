<?php 
	include_once(APPPATH.'controllers/padre.php');
	class Catalogosc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->programas = $Catalogosm->get_catalogos('prog_programa');//carga la tabla programas
			//$tabla->radios =  $Catalogosm->get_catalogo('pre_precio');//carga la tabla precios
			//$tabla->servicio =  $Catalogosm->get_catalogo('serv_servicio');//carga la tabla servicios
			//$tabla->radio = $Catalogosm->get_catalogo('rad_radio');//carga la tabla radios
			//$tabla->clientes = $Catalogosm->get_clientedb();//carga la tabla clientes
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('catalogosv/catalogosv.php', $datos);

		}
	}
 ?>