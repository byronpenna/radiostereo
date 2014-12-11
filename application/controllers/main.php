<?php 
	
	Class main extends CI_Controller{

		public function main(){
			parent:: __construct();
			$this->load->helper("url");
		}

		public function index(){
			//$this->load->helper("url");
			$this->load->model('mainm');
			$mainm = new mainm();
			$tabla = new stdClass();
			$tabla->clientes = $mainm->get_clientedb();
			$data["tabla"] = $tabla;
			$this->load->view("index.php",$data);
		}
	}
	
?>