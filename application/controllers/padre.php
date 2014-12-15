<?php 
	Class padre extends CI_Controller{
		public function __construct(){
			parent:: __construct();
			$this->load->helper("url");
			if(session_start()==null){
				session_start();
			}
			if(!isset($_SESSION['iduser'])){
				header("Location:".site_url("welcome")."");
			}
		}
	}
?>