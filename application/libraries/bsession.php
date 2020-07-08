<?php

class bsession {

	public $_valueBSession = [];


	public function register($token, $uniqueID){

        $url = "http://appdev.kmn.kompas.com/gmmsapi/BSession/register";
        $data = '{"Token": "'.$token.'","uniqueID" : "'.$uniqueID.'"}';
        
        $header = array('Content-Type: application/json','Content-Length: ' . strlen($data));
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
        
        //header('Content-Type: application/json');
        $data = json_decode($response);

        if($data->{'status'} < 0){
        	redirect(base_url());
        }else{
        	return $this->getcontext($token, $uniqueID);
        }
	}


	public function getcontext($token, $uniqueID){

		$url = "http://appdev.kmn.kompas.com/gmmsapi/BSession/getcontext";
        $data = '{"Token": "'.$token.'" , "uniqueID" : "'.$uniqueID.'"}';
        
        $header = array('Content-Type: application/json','Content-Length: ' . strlen($data));
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

        //header('Content-Type: application/json');
        $row = json_decode($response);

       // $valid = $row->{"rows"}[0]->{"Valid"};
        $this->_valueBSession['Valid'] = $row->{"rows"}[0]->{"Valid"};
        $this->_valueBSession['Expired'] = $row->{"rows"}[0]->{"Expired"};
        $this->_valueBSession['Token'] = $row->{"rows"}[0]->{"Token"};
        $this->_valueBSession['UserID'] = $row->{"rows"}[0]->{"UserID"};
        $this->_valueBSession['UserName'] = $row->{"rows"}[0]->{"UserName"};
        $this->_valueBSession['UserObjects'] = $row->{"rows"}[0]->{"UserObjects"};
       	

        // foreach ($this->_valueBSession as $key => $value) {
        // 	echo "{$value}";
        // }

        // // echo "<pre>";
        // // var_dump($this->_valueBSession['UserName']);
        //  die();

	}

	public function logout($token,$uniqueID){

	}




}