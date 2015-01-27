<?php 
include_once(APPPATH.'controllers/padre.php');
class ordencompra extends padre
{
	function __construct()
	{
		parent::__construct();
		
	}
	public function index($id){
		$this->load->model("ordencompram/ordencompram");
		$ordenCompraModel = new Ordencompram();
		$data = array(
			'res' 	=> 	$ordenCompraModel->getCalendarFrecuencia($id),
			'Titulo'			=>	'Frecuencia'
		);
		$this->load->view("ordencomprav/index.php",$data);

	}
}