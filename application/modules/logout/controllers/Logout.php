<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Halo
 *
 * Function index
 *
 * Function getPerson
 *
 */

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $valuesession = $this->bsession->unregister($_SESSION["username"]["Params"]);
        unset($_SESSION["username"]);
        redirect(base_url());
    }
}
