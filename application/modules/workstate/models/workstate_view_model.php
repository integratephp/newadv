<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workstate_View_Model extends CI_Model {
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