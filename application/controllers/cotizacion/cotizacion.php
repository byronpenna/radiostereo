<?php
	include_once(APPPATH.'controllers/padre.php');
	Class cotizacion extends padre{
		public function __construct(){
			parent:: __construct();
		}
		public function crearCotizacion($id){
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionModel 	= new cotizacionm();
			$data['Titulo']		= 'Cotizacion';
			$data["cliente"] 	= $cotizacionModel->getDatosCliente($id);
			$data["TipoCot"] 	= $cotizacionModel->getTipoCotizacion();
			$data["EstadoCot"] 	= $cotizacionModel->getEstadoCotizacion();
			$data["Prog"] 	= $cotizacionModel->getProgramas();
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}
	}
?>