<?php 
	Class cotizacion extends CI_Controller{
		public function __construct(){
			parent:: __construct();
		}
		public function crearCotizacion(){
			if(session_start()==null){
				session_start();
			}
			if(isset($_SESSION['iduser'])){
			$this->load->helper("url");
			$data['Titulo']="Cotizaciones";
			$this->load->view("cotizacion/crearCotizacion.php",$data);
		}else{
				header("Location:../../welcome");
			}
		}
	}
?>