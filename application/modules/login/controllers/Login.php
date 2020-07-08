<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Halo
 *
 * Function index
 *
 * Function getPerson
 *
 */
 
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}
	
	public function index()
	{
	
		$this->data["title"] = "Login";

		$this->template->load('v_login', $this->data); 
	}

	public function validateUser(){
		$email = $_POST["Email"];
		$password = $_POST["Password"];

		$url = "http://appdev.kmn.kompas.com/gmmsapi/user/login";
        $data = '{"Email": "'.$email.'", "Password" : "'.$password.'"}';

        
        $header = array('Content-Type: application/json','Content-Length: '.strlen($data));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $obj = substr($response, $header_size);
        $err = curl_error($curl);

        curl_close($curl);

        $row = json_decode($response);


        if(strlen($response) > 40){
			redirect(base_url());
        }else{
	        $_SESSION["username"] = $email;
         	redirect(base_url());
        }

        // if($response){
        // 	 $_SESSION["username"] = $email;
        // 	$this->template->load('v_home');
        // }

       
	}

	public function UnsetSession(){
		unset($_SESSION["username"]);
		redirect(base_url());
	}

}
