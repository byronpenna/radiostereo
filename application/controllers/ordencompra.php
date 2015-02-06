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

		$this->load->model("cotizacionesm/cotizacionesm");
		$this->cotizacionesModel = new Cotizacionesm();
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
			$data['id'] = $id;
			$data['datosEnc'] = $this->ordenCompraModel->getDatosCli($id);
			$data['detalleP'] = $this->ordenCompraModel->getDatosDetalle($id);
			$this->load->view("fpdf/fpdf");
			$this->load->view("ordencomprav/ReporteOrdenCompra/datosReporte", $data);

	}

	public function printFrecuencia($id){
			$data['id'] = $id;
			//$data['datosEnc'] = $this->ordenCompraModel->getDatosCli($id);
			//$data['detalleP'] = $this->ordenCompraModel->getDatosDetalle($id);
			$data['dataServicio'] = $this->ordenCompraModel->getServicios($id);
			$this->load->view("fpdf/fpdf");
			$this->load->view("ordencomprav/ReporteOrdenCompra/reporteFrecuencias", $data);		
	}



}