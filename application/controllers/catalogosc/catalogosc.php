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
		public function index()
		{
			$this->load->view('catalogosv/catalogosv.php');
		}
	}
 ?>