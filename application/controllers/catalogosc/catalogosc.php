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
		//public function inser_catalogos()
		//{
		//	$frm = json_decode($_POST["form"]);
		//	$this->load->model('catalogosm/catalogosm');
		//	$Catalogosm = new Catalogosm();

		//}
		//aqui comienzan las funciones que capturan los datos de los catalogos
		public function insert_programa(){//captura los datos del form y los pasa al mododelo
			// vars 
				$frm = json_decode($_POST["form"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('prog_nombre' => $frm->nombpro);
			$mensaje = $Catalogosm->add_catalogos('prog_programa',$data);
			echo json_encode($mensaje);
			// print_r($frm);
		}
		public function insert_precio()
		{
			//vars
				$frm = json_decode($_POST["form2"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('pre_precio' => $frm->precio);
			$mensaje = $Catalogosm->add_catalogos('pre_precio',$data);
			echo json_encode($mensaje);
		}
		public function insert_servicio()
		{
			//vars
				$form = json_decode($_POST["form3"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('serv_nombre' => $form->servicio);
			$mensaje = $Catalogosm->add_catalogos('serv_servicio',$data);

			echo json_encode($mensaje);
		}
		public function insert_radio()
		{
			//vars
				$form = json_decode($_POST["form4"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('rad_nombre' => $form->txtnombradio);
			$mensaje = $Catalogosm->add_catalogos('rad_radio',$data);
			echo json_encode($mensaje);
		}
		public function insert_cliente()
		{
			//vars
				$form = json_decode($_POST["form5"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('cli_nombres' => $form->txtnombcliente, 'cli_apellidos ' => $form->txtapellido);
			$mensaje = $Catalogosm->add_catalogos('cli_cliente',$data);
			echo json_encode($mensaje);
		}
		//aqui comienzan los metodos q me mandaran al modelo los datos a modificar
		public function update_programa()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tablabd = array('prog_nombre', 'prog_id', 'prog_programa');
			$nameform = array('txtNombrePrograma', 'txtidprograma');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform);
			echo json_encode($mensaje);
		}
		public function update_precio()
		{
			//vars
				$updtfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tablabd = array('pre_precio', 'pre_id', 'pre_precio');
			$nameform = array('txtPrecio', 'txtidprecio');
			$mensaje = $Catalogosm->update_programadb($updtfrm, $tablabd, $nameform);
			echo json_encode($mensaje);
		}
		public function update_servicio()
		{
			//vars
				$updtfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tablabd = array('serv_nombre', 'serv_id', 'serv_servicio');
			$nameform = array('txtservicio', 'txtidservicio');
			$mensaje = $Catalogosm->update_programadb($updtfrm, $tablabd, $nameform);
			echo json_encode($mensaje);
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->programas = $Catalogosm->get_catalogo('prog_programa');//carga la tabla programas
			$tabla->radios =  $Catalogosm->get_catalogo('pre_precio');//carga la tabla precios
			$tabla->servicio =  $Catalogosm->get_catalogo('serv_servicio');//carga la tabla servicios
			$tabla->radio = $Catalogosm->get_catalogo('rad_radio');//carga la tabla radios
			$tabla->clientes = $Catalogosm->get_clientedb();//carga la tabla clientes
			$datos['tabla'] = $tabla; 
			$this->load->view('catalogosv/catalogosv.php',$datos);

		}
	}
 ?>