<?php
	include_once(APPPATH.'controllers/padre.php');
	Class cotizacion extends padre{
		public function __construct(){
			parent:: __construct();

		}
		public function crearCotizacion($id){
			
			$data['Titulo']='Cotizacion';
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}
	}
?>