<?php 
	
	Class main extends CI_Controller{

		public function main(){
			parent:: __construct();
			$this->load->helper("url");
		}

		public function index(){
			//$this->load->helper("url");
			if(session_start()==null){
				session_start();
			}
			if(isset($_SESSION['iduser'])){
			$data["Titulo"] = "Principal";
			$this->load->view("index.php",$data);	
			}else{
				header("Location:welcome");
			}
			
		}
	}
	
?>