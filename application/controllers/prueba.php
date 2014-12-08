<?php 
	
	Class prueba extends CI_Controller{

		public function prueba(){
			parent:: __construct();
		}



		public function index(){
			$this->load->model("pruebam");
			$this->load->helper("url");
			$prueba = new pruebam();

			$data['head']=$prueba->cargarContent();
			$data['Titulo']='Titulo Dinamico';

			$this->load->view("estructura/head.php",$data);
			$this->load->view("index.php",$data);
		}
	}
	
?>