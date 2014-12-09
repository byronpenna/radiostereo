<?php 
	Class solicitud extends CI_Controller{
		public function __construct(){
			parent:: __construct();
		}

		public function crearSolicitud(){
			$this->load->helper("url");
			$data['Titulo']="Solicitudes";
			$this->load->view("solicitud/crearSolicitud.php",$data);
		}
	}
?>