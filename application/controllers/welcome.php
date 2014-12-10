<?php 
	Class welcome extends CI_Controller{
		public function __construct(){
			parent:: __construct();
		}

		public function index(){
			$this->load->helper("url");
			$data["Titulo"] = "Login";
			$this->load->view("login/login.php",$data);
		}

		public function login(){
			$frm=json_decode($_POST['form']);
			$retorno = new stdClass();
			$retorno->mensaje="logeado correctamente";
			echo json_encode($retorno);
		}
	}
?>