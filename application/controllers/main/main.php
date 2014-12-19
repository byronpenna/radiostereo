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
				$tabla->clientes = $mainm->DatosCliente();
				$data['tabla'] = $tabla;
				$data["Titulo"] = "Principal";
				$this->load->view("index/index.php",$data);
		}
	}	
?>