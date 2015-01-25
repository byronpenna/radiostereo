<?php 
include_once(APPPATH.'controllers/padre.php');
class ordencompra extends padre
{
	private $ordenCompraModel;
	function __construct()
	{
		parent::__construct();
		$this->load->model("Ordencompram");
		$ordenCompraModel = new Ordencompram();
	}
	public function index($id){
		$data = array(
			'tablaFrecuencia' => $ordenCompraModel->getCalendarFrecuencia();
		);
		$this->load->view("ordencomprav/index.php");

	}
}