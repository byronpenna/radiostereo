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
			$datos['Titulo']	=	 "..::Cotizaciones::..";
			$this->load->view('cotizacion/cotizacionesv/cotizacionesv', $datos);
		}

		public function editarCotizacion($idCot){
			$this->load->model('cotizacionesm/cotizacionesm');
			$Cotizacionesm 			= 	new Cotizacionesm();
			$data 					= 	new stdClass();
			$data->encCot 			= 	$Cotizacionesm->getHeaderCot($idCot);
			$data->valAgregado 		= 	$Cotizacionesm->getValorAgregado($idCot);
			$data->encProg			= 	$Cotizacionesm->encProg($idCot);
			$data->encRadios		= 	$Cotizacionesm->encRadios($idCot);
			$datos['Titulo']		=	"Editando Cotizacion";
			$datos['data']			=	$data;
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
			$sec					=	$cotizacionm->getSec($idCot);
			$datos['prog']			=	$prog;
			$datos['sec']			=	$sec;
			$this->Reporte('cotizacion/ReporteCotizacion/datosReporte',$datos);
		}

		public function Reporte($vista,$obj){
			include_once(APPPATH.'plugins/pdf/html2pdf.class.php');
			ob_start();
			$this->load->view($vista, $obj);
			$html=ob_get_clean();
			$pdf = new HTML2PDF('P','A4','es', array(0, 0,0,0));  
			$pdf->WriteHTML($html);
			// $pdf->pdf->IncludeJS("print(true);");
			$pdf->Output('cotizacion.pdf');	
		}
	}
 ?>