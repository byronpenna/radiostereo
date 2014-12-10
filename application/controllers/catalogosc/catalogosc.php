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
				$frm = json_decode($_POST["form2"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->add_precio($frm);
			echo $mensaje;
		}
		public function insert_servicio()
		{
			//vars
				$form = json_decode($_POST["form3"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->add_servicio($form);

			echo $mensaje;
		}
		public function insert_radio()
		{
			//vars
				$form = json_decode($_POST["form4"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->add_radio($form);
			echo "Radio guardado con exito";
		}
		//aqui comienzan los metodos q me mandaran al modelo los datos a modificar
		public function update_programa()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->update_programadb($updatfrm);
			echo json_encode($mensaje);
			//echo $mensaje;
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->programas = $Catalogosm->get_catalogobd(); 
			$datos['tabla'] = $tabla; 
			$this->load->view('catalogosv/catalogosv.php',$datos);
		}
	}
 ?>