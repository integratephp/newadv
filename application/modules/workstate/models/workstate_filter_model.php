<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Workstate_Filter_Model extends CI_Model {

	  	public $PageSize ;
        public $StartRow ;
        public $SelectedIndexRow ;
        public $RowCount ;

        // Search
        public $Search ;

        // Filter
        public $WorkstateTypeID ;
}