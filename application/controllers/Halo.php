<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halo extends CI_Controller {

	public function index()
	{
		echo "Halo CI ". CI_VERSION;
	}
	
	public function nama($name)
	{
		echo "Halo ".$name;
	}
}
