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
		public function insert_programa(){
			// vars 
				$frm = json_decode($_POST["form"]);//decodificamos el objeto json
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->insert_catalogobd($frm);
			echo $mensaje;
			// print_r($frm);
		}
		public function index()
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$datos['array'] = $Catalogosm->get_catalogobd();
			$this->load->view('catalogosv/catalogosv.php',$datos);
		}
	}
 ?>