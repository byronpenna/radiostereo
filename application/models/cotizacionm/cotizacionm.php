<?php 

	Class cotizacionm extends CI_Model{

		public function __construct(){
			parent:: __construct();
		}

		public function getDatosCliente($id){
			$datos = new stdClass();
			$datos->validacion=false;
		}

	}
?>