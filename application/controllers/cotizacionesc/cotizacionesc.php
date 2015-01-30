<?php 
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
			$Cotizacionesm 		=	 new Cotizacionesm();
			$tabla 				=	 new stdClass();
			$tabla->cotizacion 	=	 $Cotizacionesm->getCotizacion();
			$datos['tabla'] 	= 	 $tabla;			
			$datos['Titulo']	=	 "Cotizaciones | Grupo Radio Stereo";
			$this->load->view('cotizacion/cotizacionesv/cotizacionesv', $datos);
		}

		public function aprobarCot(){
			$this->load->model('cotizacionesm/cotizacionesm');
			$Cotizacionesm 		=	 new Cotizacionesm();
			$tabla 				=	 new stdClass();
			$tabla->cotizacion 	=	 $Cotizacionesm->obtenerCotizacionesAprobar();
			$datos['tabla'] 	= 	 $tabla;			
			$datos['Titulo']	=	 "Aprobar Cotizaciones | Grupo Radio Stereo";
			$this->load->view('cotizacion/aprobarCot', $datos);	
		}

		public function recibeAprobados(){
			$this->load->model("cotizacionesm/cotizacionesm");
			$form 				= json_decode($_POST['form']);
			$retorno 			= new stdClass();
			$cotizacionm 		= new cotizacionesm();
			$retorno 			= $cotizacionm->aprobarCotizaciones($form);
			echo json_encode($retorno);
		}

		public function editarCotizacion($idCot){
			$this->load->model('cotizacionesm/cotizacionesm');
			$Cotizacionesm 			= 	new Cotizacionesm();
			$data 					= 	new stdClass();
			$data->encCot 			= 	$Cotizacionesm->getHeaderCot($idCot);
			$data->valAgregado 		= 	$Cotizacionesm->getValorAgregado($idCot);
			$data->encProg			= 	$Cotizacionesm->encProg($idCot);
			$data->encRadios		= 	$Cotizacionesm->encRadios($idCot);
			$data->botones			= 	$Cotizacionesm->getBotones($idCot);
			$datos['Titulo']		=	"Editando Cotizacion | Grupo Radio Stereo";
			$datos['data']			=	$data;
			$this->load->view('cotizacion/cotizacionesv/editarCot', $datos);
		}


		public function getEstadoCot(){
			$this->load->model("cotizacionesm/cotizacionesm");
			$form 				= json_decode($_POST['form']);
			$cotizacionm 		= new cotizacionesm();
			$retorno 			= $cotizacionm->verificarEstadoCot($form);
			echo json_encode($retorno);
		}


		public function recibeDatosEdit(){
			$this->load->model("cotizacionesm/cotizacionesm");
			$form 				= json_decode($_POST['form']);
			$retorno 			= new stdClass();
			$cotizacionm 		= new cotizacionesm();
			$retorno 			= $cotizacionm->editarCotizacion($form);
			echo json_encode($retorno);
		}

		public function eliminarCotizacion($idCot){
			$this->load->model("cotizacionesm/cotizacionesm");
			$cotizacionm = new cotizacionesm();
			$cotizacionm->eliminarCot($idCot);
			$this->index();
		}


		public function printCotizacion($idCot){
			$this->load->model("cotizacionesm/cotizacionesm");
			$cotizacionm 			= 	new Cotizacionesm();
			$prog 					=	$cotizacionm->getProg($idCot);
			$datos['prog']			=	$prog;
			$this->Reporte('cotizacion/ReporteCotizacion/datosReporte',$datos);
		}

		public function Reporte($vista,$obj){
			include_once(APPPATH.'plugins/dompdf/dompdf_config.inc.php');
			ob_start();
			$this->load->view($vista, $obj);
			$html=ob_get_clean();
			$mipdf = new DOMPDF();
			$mipdf ->set_paper("A4", "portrait");
			$mipdf ->load_html($html);
			$mipdf ->render();
			$mipdf ->stream('Cotizacion.pdf' ,array("Attachment" => 0));
		}
	}
 ?>