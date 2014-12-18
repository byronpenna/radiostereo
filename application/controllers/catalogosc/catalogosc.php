<?php 
	include_once(APPPATH.'controllers/padre.php');
	class Catalogosc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
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
				$frm = json_decode($_POST["form"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('pre_precio' => $frm->precio);
			$mensaje = $Catalogosm->add_catalogos('pre_precio',$data);
			echo json_encode($mensaje);
		}
		public function insert_servicio()
		{
			//vars
				$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('serv_nombre' => $form->servicio);
			$mensaje = $Catalogosm->add_catalogos('serv_servicio',$data);

			echo json_encode($mensaje);
		}
		public function insert_radio()
		{
			//vars
				$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('rad_nombre' => $form->txtnombradio);
			$mensaje = $Catalogosm->add_catalogos('rad_radio',$data);
			echo json_encode($mensaje);
		}
		public function insert_cliente()
		{
			//vars
				$form = json_decode($_POST["form"]);
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
			$tabla = 'prog_programa';
			$tablabd = array('prog_nombre', 'prog_id');
			$nameform = array('txtNombrePrograma', 'txtidprograma');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_precio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'pre_precio';
			$tablabd = array('pre_precio', 'pre_id');
			$nameform = array('txtPrecio', 'txtidprecio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_servicio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'serv_servicio';
			$tablabd = array('serv_nombre', 'serv_id');
			$nameform = array('txtServicio', 'txtidservicio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_radio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'rad_radio';
			$tablabd = array('rad_nombre', 'rad_id');
			$nameform = array('txtRadio', 'txtidRadio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_cliente()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->update_clientedb($updatfrm);
			echo json_encode($mensaje);
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->programas = $Catalogosm->datos_programa();//carga la tabla programas
			$tabla->precio =  $Catalogosm->DatosPrecio();//carga la tabla precios
			$tabla->servicio =  $Catalogosm->DatosServicio();//carga la tabla servicios
			$tabla->radio = $Catalogosm->DatosRadio();//carga la tabla radios
			$tabla->clientes = $Catalogosm->DatosClientes();//carga la tabla clientes
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('catalogosv/catalogosv.php', $datos);

		}
	}
 ?>