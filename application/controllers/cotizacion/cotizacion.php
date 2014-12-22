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
			$data["Radios"]		= $cotizacionModel->getRadios();
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}

		public function recibeDatosAdd(){
			$this->load->model("cotizacionm/cotizacionm");
			$form 			= json_decode($_POST['form']);
			$header 		= $form->headerCot;
			$seccion 		= $form->secCot;
			$retorno 		= new stdClass();
			$cotizacionm 	= new cotizacionm();
			/*$tabla 			= array(
				'cot_id'				=> '',
				'cot_fecha_elaboracion'	=> $header->txtFechaCreacionCot,
				'cot_valor_agregado'	=> $header->txtValorAgregado,
				'cot_cli_id'			=> $header->txtidCliente,
				'cot_tip_id'			=> $header->tipo,
				'cot_est_id'			=> $header->estado,
				'cot_usu_id'			=> $header->idUsuario

				);*/
			// $retorno					= $cotizacionm->insertHeadCot($head);
			echo json_encode($form->secCot);
		}
	}
?>