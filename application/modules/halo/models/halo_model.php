<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Halo_Model extends CI_Model {
    
	function __construct() 
	{
        parent::__construct();
		$this->load->database();
    }
	
	function getListPerson($limit){
		return $this->db->get('dbo.PersonnelTable', $limit);
	}

	function getPerson($nik){
		return $this->db->get_where('dbo.PersonnelTable', array('code' => $nik));
	}	
}