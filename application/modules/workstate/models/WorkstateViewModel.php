<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WorkstateViewModel extends CI_Model {
    public $Form;
    public $Obj;
    public $ObjList = [];
    
	function __construct() 
	{
        parent::__construct();
		// $this->load->database();
    }
}

?>