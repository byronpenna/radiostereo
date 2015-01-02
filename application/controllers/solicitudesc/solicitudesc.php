<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class solicitudesc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{
			$datos['Titulo']="..::Solicitudes::..";
			$this->load->view('solicitudesv/solicitudesv', $datos);
		}
	}
 ?>