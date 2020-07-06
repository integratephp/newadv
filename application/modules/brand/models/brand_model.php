<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_model extends CI_Model
{
		
	public $ID;
	public $Name;
	public $BrandProduct;
	public $Description;

	public $DropDownParentName = [];

    public $CategoryList = [];
    public $ParentID;
    public $ParentName;


    public $CategoryPopulateCheckBox ;
    public $CategoryID;
    public $CategoryName;
    public $CategoryLevel;
    public $CategorySelect;
    public $CheckX;
    

	// token
    public $token;

    // order
    public $RowNumber;
    

	function __construct()
	{
		parent::__construct();
	}

	public function Listing($objForm){
        $url = $objForm->Form->url;
        //getApi($url);

        $data = getDataAPI($url);

        if($data == NULL){
            $data = [];
            $data["rows"] = [];
        }
        // return $obj;        

        // Create Object List
        $models = [];
        // Default Paging Value
        $objForm->Form->RowCount = 0;
        $objForm->Form->PageCount = 0;
        
        
        // Deserialize Data
        for($i=0; $i < count($data["rows"]); $i++){
            $item = new brand_model();
            $item->ID = $data["rows"][$i]["ID"];
            $item->Name = $data["rows"][$i]["Name"];
            $item->ParentName = $data["rows"][$i]["ParentName"];
            $item->BrandProduct = $data["rows"][$i]["BrandProduct"];
            $item->Description = $data["rows"][$i]["Description"];
            $item->RowNumber = $data["rows"][$i]["RowNumber"];
            $objForm->Form->RowCount = $data["rows"][$i]["RowCount"];
            $models[] = $item;
        } 
        // return $models;
        return $models;
    }

    public function PopulateDDParentName(){
        $url = $this->URLClass->BrandUrl()."/search/";

        $data = getDataAPI($url);

        if($data == NULL){
            $data = [];
            $data["rows"] = [];
        }
        // return $obj;

        // Create Object List
        $models = []; 


        $item = new brand_model();
        $item->ParentID = 0;
        $item->ParentName = "--- Select ---";
        $models[] = $item;

    
        // Deserialize Data
        for($i=0; $i < count($data["rows"]); $i++){
            $Item = new brand_model();
            $Item->ParentID = $data["rows"][$i]["ID"];
            $Item->ParentName = $data["rows"][$i]["Name"];
            $models[] = $Item;

        } 

        return $models;
    }

    public function PopulateCheckBoxCategory(){
        $url = "http://api.kmn.kompas.com/newadvdev/Category/list?f=all";
        $data = getDataAPI($url);

        if($data == NULL){
            $data = [];
            $data["rows"] = [];
        }
        // return $obj;

        // Create Object List
        $models = []; 

    
        // Deserialize Data
        for($i=0; $i < count($data["rows"]); $i++){
            $Item = new brand_model();
            $Item->CategoryID = $data["rows"][$i]["ID"];
            $Item->CategoryName = $data["rows"][$i]["Name"];
            $Item->CategoryLevel = $data["rows"][$i]["Level"];
            $models[] = $Item;
        } 

        return $models;
    }

    public function read($id)
    {
        $url = $this->URLClass->BrandUrl()."list?ID=" . $id ."&f=all";
        $data = getDataAPI($url);

        $model = new brand_model() ;
        $model->ID = $data["rows"][0]["ID"];
        $model->ParentID = $data["rows"][0]["ParentID"];
        $model->ParentName = $data["rows"][0]["ParentName"];
        $model->Name = $data["rows"][0]["Name"];
        $model->BrandProduct = $data["rows"][0]["BrandProduct"];
        $model->Description = $data["rows"][0]["Description"];
        

        $url2 = "http://api.kmn.kompas.com/newadvdev/Brand/brandCategoryList?ID=" . $id;

        $data2 = getDataAPI($url2);

        for($i = 0; $i < count($data2["rows"]); $i++){
            if ($data2["rowcount"] != 0){          
                $model->CheckX = true;
                $model->CategoryID = $data2["rows"][$i]["CategoryID"];
                $model->CategoryName = $data2["rows"][$i]["CategoryName"];

                $CategoryList[] = ['CategoryID' => $model->CategoryID, 'CategoryName' => $model->CategoryName];


                $model->CategoryList = $CategoryList;
            };   
        }

        // echo "<pre>";
        // die(print_r($model));
       
        return $model;
    }

}