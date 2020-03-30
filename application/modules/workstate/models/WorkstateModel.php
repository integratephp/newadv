<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WorkstateModel extends CI_Model {
	
	// main class
    public $ID;
    public $Name;
    public $Description;

    public $Finalized;
    public $Level;
    public $BackwardAllow;
    public $Color;

    public $DropDownWorkstateType = [];
    public $WorkstateTypeID;
    public $WorkstateTypeName;

    // token
    public $token;

    // order
	public $RowNumber;
	
	function __construct() 
	{
        parent::__construct();
		// $this->load->database();
    }

    public function Listing($objForm){
        $url = $objForm->Form->url;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HEADER => true,
            CURLOPT_POSTFIELDS => "",
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $obj = substr($response, $header_size);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($obj, true);
        // return $obj;

        // Create Object List
        $models = [];
        // Default Paging Value
        $objForm->Form->RowCount = 0;
        $objForm->Form->PageCount = 0;

        // Deserialize Data
        for($i=0; $i < count($data["rows"]); $i++){
            $item = new WorkstateModel();
            $item->ID = $data["rows"][$i]["ID"];
            $item->Name = $data["rows"][$i]["Name"];
            $item->Description = $data["rows"][$i]["Description"];
            $item->WorkstateTypeID = $data["rows"][$i]["WorkstateTypeID"];
            $item->WorkstateTypeName = $data["rows"][$i]["WorkstateTypeName"];
            $item->Finalized = $data["rows"][$i]["Finalized"];
            $item->Level = $data["rows"][$i]["Level"];
            $item->BackwardAllow = $data["rows"][$i]["BackwardAllow"];
            $item->Color = $data["rows"][$i]["Color"];
            $item->RowNumber = $data["rows"][$i]["RowNumber"];
            $objForm->Form->RowCount = $data["rows"][$i]["RowCount"];
            $models[] = $item;
        } 
        return $models;
    }
    public function PopulateDDWorkstateType(){
        $url = "http://api.kmn.kompas.com/newadvdev/workstatetype/list/";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HEADER => true,
            CURLOPT_POSTFIELDS => "",
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $obj = substr($response, $header_size);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($obj, true);
        // return $obj;

        // Create Object List
        $models = [];        

        $item = new WorkstateModel();
        $item->WorkstateTypeID = 0;
        $item->WorkstateTypeName = "--- Select ---";
        $models[] = $item;

        // Deserialize Data
        for($i=0; $i < count($data["rows"]); $i++){
            $Item = new WorkstateModel();
            $Item->WorkstateTypeID = $data["rows"][$i]["ID"];
            $Item->WorkstateTypeName = $data["rows"][$i]["Name"];
            $models[] = $Item;
        } 
        return $models;
    }
}