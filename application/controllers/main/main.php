<?php 
	include_once(APPPATH.'controllers/padre.php');
	Class main extends padre{

		public function main(){
			parent:: __construct();
		}

		public function index(){
				$this->load->model('mainm/mainm');
				$mainm = new mainm();
				$tabla = new stdClass();
				$IdUser = $_SESSION['iduser'];
				$tabla->clientes = $mainm->DatosCliente($IdUser);
				$data['tabla'] = $tabla;
				$data["Titulo"] = "Principal";
				$this->load->view("index/index.php",$data);
		}
	}	
?>