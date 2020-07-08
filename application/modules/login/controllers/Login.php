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

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $this->data["title"] = "Login";
        if (!isset($_POST["Email"]) && !isset($_POST["Password"])) {
            if (isset($_SESSION["username"])) {
                redirect(base_url());
            }
            $this->template->load('v_login', $this->data);
        } else {
            $email = $_POST["Email"];
            $password = $_POST["Password"];
            $url = userUrl() . "login";
            $data = '{"Email": "' . $email . '", "Password" : "' . $password . '"}';
            $postAPI = postDataAPI($url, $data);
            $response = $postAPI["response"];
            $row = $postAPI["row"];

            if (strlen($response) > 40) {
                $this->data["message"] = $row->{"message"};
                $this->template->load('v_login', $this->data);
            } else {
                $valuesession = $this->bsession->register(getToken(), $response);
                $_SESSION["username"] = $valuesession;
                // echo "<pre>";
                // var_dump();
                // die();
                redirect(base_url());
            }
        }
    }
}
