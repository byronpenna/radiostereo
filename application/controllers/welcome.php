<?php 
	
	Class welcome extends CI_Controller{

		public function welcome(){
			parent:: __construct();
		}



		public function index(){
			$this->load->helper("url");
			$data["Titulo"] = "Titulo";
			$this->load->view("index.php",$data);
		}
	}
	
?>