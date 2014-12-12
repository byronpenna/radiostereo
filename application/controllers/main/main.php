<?php 
	Class main extends CI_Controller{

		public function main(){
			parent:: __construct();
			$this->load->helper("url");
			if(session_start()==null){
				session_start();
			}
		}

		public function index(){
			//$this->load->helper("url");
			if(isset($_SESSION['iduser'])){
				$this->load->model('mainm/mainm');
				$mainm = new mainm();
				$tabla = new stdClass();
				$tabla->clientes = $mainm->get_clientedb();
				$data['tabla'] = $tabla;
				$data["Titulo"] = "Principal";
				$this->load->view("index/index.php",$data);
			}else{
				header("Location:../welcome");
			}			
		}
	}
	
?>