<?php 
class Padrem extends CI_Model()
{
	
	function __construct()
	{
		
	}
	function getResultset($sql){
		$this->db->query($sql)
	}
}