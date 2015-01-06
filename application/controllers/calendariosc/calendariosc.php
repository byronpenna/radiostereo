<?php 
	/**
	* 
	*/
	include_once(APPPATH.'controllers/padre.php');
	class calendariosc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$datos['Titulo']="..::Calendario::..";
			$this->load->view('calendariosv/calendariosv',$datos);
		}
	}
 ?>