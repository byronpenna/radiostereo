<?php
	include_once(APPPATH.'controllers/padre.php');
	Class cotizacion extends padre{
		public function __construct(){
			parent:: __construct();

		}
		public function crearCotizacion($id){
			// load 
				$this->load->model("cotizacionm/cotizacionm");
			$cotizacionModel 	= new cotizacionm(); 
			$data['Titulo']		= 'Cotizacion';
			$data["cliente"] 	= $cotizacionModel->getDatosCliente($id);
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}
	}
?>