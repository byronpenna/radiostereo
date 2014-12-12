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
		public function obtenerDatosLogin(){
			$this->load->model("welcomem");
			$frm=json_decode($_POST['form']);
			$retorno = new stdClass();
			$login=new welcomem();
			$retorno=$login->login($frm);
			// $retorno->mensaje=$res;
			echo json_encode($retorno);
		}

		public function logOut(){
			if(session_start()==null){
				session_start();
			}
			session_destroy();
			$retorno=new stdClass();
			$retorno="Cierre de Sesion exitoso";
			echo json_encode($retorno);
		}
	}
?>