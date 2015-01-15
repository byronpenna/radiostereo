<?php
	include_once(APPPATH.'controllers/padre.php');
	Class cotizacion extends padre{
		public function __construct(){
			parent:: __construct();
		}
		public function crearCotizacion($id){
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionModel 	= new cotizacionm();
			$data['Titulo']		= 'Crear Cotizacion';
			$data["cliente"] 	= $cotizacionModel->getDatosCliente($id);
			$data["TipoCot"] 	= $cotizacionModel->getTipoCotizacion();
			$data["EstadoCot"] 	= $cotizacionModel->getEstadoCotizacion();
			$data["Prog"] 		= $cotizacionModel->getProgAddCot();
			$data["Servicios"]	= $cotizacionModel->getServiciosCot();
			$data["Secciones"]	= $cotizacionModel->getSeccionesAdd();
			$data["Producto"]	= $cotizacionModel->getProdCliente($id);
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}

		public function recibeDatosAdd(){
			$this->load->model("cotizacionm/cotizacionm");
			$form 			= json_decode($_POST['form']);
			$retorno 		= new stdClass();
			$cotizacionm 	= new cotizacionm();
			$retorno		= $cotizacionm->insertCotizacion($form);
			echo json_encode($retorno);
		}
	}
?>