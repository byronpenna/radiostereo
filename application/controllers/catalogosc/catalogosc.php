<?php 
	/**
	* 
	*/
	class Catalogosc extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}
		//aqui comienzan las funciones que capturan los datos de los catalogos
		public function insert_programa(){//captura los datos del form y los pasa al mododelo
			// vars 
				$frm = json_decode($_POST["form"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->insert_catalogobd($frm);
			echo $mensaje;
			// print_r($frm);
		}
		public function insert_precio()
		{
			//vars
			$frm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->add_precio($frm);
			echo $mensaje;
		}
		public function update_programa($id)
		{
			echo "vamos a modificar el id ". $id;
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$datos['array'] = $Catalogosm->get_catalogobd();
			$this->load->view('catalogosv/catalogosv.php',$datos);
		}
	}
 ?>