<?php 
	/**
	* 
	*/
	class catalogosc extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}
<<<<<<< HEAD
=======
		public function insert_programa(){
			echo "esto proviene de php";
		}
>>>>>>> origin/InertarDatos
		public function index()
		{
			$this->load->view('catalogosv/catalogosv.php');
		}
	}
 ?>