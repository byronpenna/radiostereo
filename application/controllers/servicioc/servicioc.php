<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class servicioc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->servicio =  $Catalogosm->DatosServicio();//carga la tabla servicios
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="..::Catalogos::..";
			$this->load->view('catalogosv/serviciov/serviciov', $datos);
		}



		public function delete_servicio()
		{
			//vars
				$frm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$id_tablabd = 'serv_id';
			$nameform = $frm->txtidservicio;
			$tabla='serv_servicio';
			$mensaje = $Catalogosm->delete_catalogo($tabla, $id_tablabd, $nameform);
			echo json_encode($mensaje);
		}

	}
 ?>