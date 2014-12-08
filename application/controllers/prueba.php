<?php 
	
	Class prueba extends CI_Controller{

		public function prueba(){
			parent:: __construct();
		}



		public function index(){
			
			$this->load->helper("url");
			$data["Titulo"] = "Titulo";
			$this->load->view("index.php",$data);
		}
	}
	
?>