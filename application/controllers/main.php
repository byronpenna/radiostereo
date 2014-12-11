<?php 
	
	Class main extends CI_Controller{

		public function main(){
			parent:: __construct();
			$this->load->helper("url");
		}

		public function index(){
			//$this->load->helper("url");
			$data["Titulo"] = "Principal";
			$this->load->view("index.php",$data);
		}
	}
	
?>