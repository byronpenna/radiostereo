<?php 
	Class cotizacion extends CI_Controller{
		public function __construct(){
			parent:: __construct();
		}

		public function crearCotizacion(){
			$this->load->helper("url");
			$data['Titulo']="Cotizaciones";
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}
	}
?>