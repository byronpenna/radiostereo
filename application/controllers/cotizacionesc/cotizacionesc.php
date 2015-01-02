<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class cotizacionesc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{
			$this->load->model('cotizacionesm/cotizacionesm');
			$Cotizacionesm = new Cotizacionesm();
			$tabla = new stdClass();
			$tabla->cotizacion = $Cotizacionesm->getCotizacion();
			$datos['tabla'] = $tabla;			
			$datos['Titulo']="..::Cotizaciones::..";
			$this->load->view('cotizacion/cotizacionesv/cotizacionesv', $datos);
		}
	}
 ?>