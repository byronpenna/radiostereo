<?php 
	include_once(APPPATH.'controllers/padre.php');
	class clientesc extends padre
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
			$tabla->id = $_SESSION['iduser'];
			$tabla->clientes = $Catalogosm->DatosClientes($tabla->id);//carga la tabla clientes
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="Catalogos | Grupo Radio Stereo";
			$this->load->view('catalogosv/clientesv/clientesv', $datos);
		}


		public function delete_cliente()
		{
			//vars
				$frm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$id_tablabd = 'cli_id';
			$nameform = $frm->txtidcliente;
			$tabla='cli_cliente';
			$mensaje = $Catalogosm->delete_catalogo($tabla, $id_tablabd, $nameform);
			echo json_encode($mensaje);
		}


		public function getCat(){
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$res = $Catalogosm->getCat();
			echo json_encode($res);
		}
	}
 ?>