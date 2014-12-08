<?php 
	Class welcome extends CI_Controller{
		public function __construct(){
			parent:: __construct();
		}

		public function index(){
			$this->load->helper("url");
			$data["Titulo"] = "Login";
			$this->load->view("login.php",$data);
		}
	}
?>