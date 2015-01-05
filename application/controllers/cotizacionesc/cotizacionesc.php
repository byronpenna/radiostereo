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

		public function editarCotizacion($idCot){
			$this->load->model('cotizacionesm/cotizacionesm');
			$Cotizacionesm = new Cotizacionesm();
			$data = new stdClass();
			$data->encCot = $Cotizacionesm->getHeaderCot($idCot);
			$data->valAgregado 	= 	$Cotizacionesm->getValorAgregado($idCot);
			$data->encProg		= 	$Cotizacionesm->encProg($idCot);
			$data->encRadios		= 	$Cotizacionesm->encRadios($idCot);
			$datos['Titulo']="Editando Cotizacion";
			$datos['data']=$data;
			$this->load->view('cotizacion/cotizacionesv/editarCot', $datos);
		}


		public function recibeDatosEdit(){
			$this->load->model("cotizacionesm/cotizacionesm");
			$form 				= json_decode($_POST['form']);
			$retorno 			= new stdClass();
			$cotizacionm 		= new cotizacionesm();
			$retorno 			= $cotizacionm->editarCotizacion($form);
			echo json_encode($retorno);
		}
	}
 ?>