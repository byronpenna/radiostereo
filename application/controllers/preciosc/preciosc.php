<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class preciosc extends padre
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
			$tabla->precio =  $Catalogosm->DatosPrecio();//carga la tabla precios
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="Catalogos | Grupo Radio Stereo";
			$this->load->view('catalogosv/preciosv/preciosv', $datos);
		}



				public function delete_precio()
		{
			//vars
				$frm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$id_tablabd = 'pre_id';
			$nameform = $frm->txtidprecio;
			$tabla='pre_precio';
			$mensaje = $Catalogosm->delete_catalogo($tabla, $id_tablabd, $nameform);
			echo json_encode($mensaje);
		}

	}
 ?>