<?php 
include_once(APPPATH.'controllers/padre.php');
class ordencompra extends padre
{
	private $ordenCompraModel;
	function __construct()
	{
		parent::__construct();
		$this->load->model("ordencompram/ordencompram");
		$this->ordenCompraModel = new Ordencompram();
	}
	public function index($id){
		$data = array(
			'res' 		=> 	$this->ordenCompraModel->getCalendarFrecuencia($id),
			'Titulo'	=>	'Frecuencia'
		);
		$this->load->view("ordencomprav/index.php",$data);

	}

	public function addFrecuencia(){
		$frm 		= json_decode($_POST["frm"]);
		$encabezado = json_decode($_POST["encabezado"]);
		$retorno 	= new stdClass();
		if(isset($frm) && !empty($frm)){
			$retorno = $this->ordenCompraModel->addFrecuencia($frm,$encabezado);
		}else{
			$retorno->estado 	= false;
			$retorno->mensaje  	= "No se pudieron guardar las frecuencias";
		}
		echo json_encode($retorno);
	}


	public function printOrdenCompra($id){
		/*$this->load->model("cotizacionesm/cotizacionesm");
			$cotizacionm 			= 	new Cotizacionesm();
			$prog 					=	$cotizacionm->getProg($idCot);
			$datos['prog']			=	$prog;*/
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
			$mipdf ->stream('OrdendeCompra.pdf' ,array("Attachment" => 0));
	}
}