<?php

class Brand extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('brand_model');
		$this->load->model('brand_view_model');
		$this->load->model('brand_filter_model');
	}

	public function index()
	{
		$objForm = new brand_view_model();

		// Paging Variable
		$pagesize = 0;
		$rowcount = 0;
		$selectedindexrow = 1;

        // Filter Variable
		$search;
		$parentid;

		   // Detect From Postback
		$FilterSubmit = isset($_POST["FilterSubmit"]) ? $_POST["FilterSubmit"] : 0;

		// Get Data Form Postback
		if ($FilterSubmit == 1){

			// Get Filter Parameter
			if (strlen($_POST["SearchTextBox"]) != 0)
			{
				$search = $_POST["SearchTextBox"];
			}else{
				$search = "";
			}

			if (strlen($_POST["ParentID"]) != 0)
			{
				$parentid = $_POST["ParentID"];
			}else{
				$parentid = 0;
			}

			// Get Paging Parameter
			if ($_POST["PageSize"] != 0)
			{
				$pagesize = $_POST["PageSize"];
			}

			if ($_POST["RowCount"] != 0)
			{
				$rowcount = $_POST["RowCount"];
			}

			if ($_POST["SelectedIndexRow2"] != 0)
			{
				$selectedindexrow = $_POST["SelectedIndexRow2"];
			}
			if (isset($_POST["First2"]))
			{
				$selectedindexrow = $_POST["First2"];
			}
			if (isset($_POST["Prev2"]))
			{
				$selectedindexrow = $_POST["Prev2"];
			}
			if (isset($_POST["Next2"]))
			{
				$selectedindexrow = $_POST["Next2"];
			}
			if (isset($_POST["Last2"]))
			{
				$selectedindexrow = $_POST["Last2"];
			}

		}else{
			$search = "";
			$parentid = 0;
		}


		// Instance Class Form
		$objForm->Form = new FormModel();


        // Default PageSize
		$objForm->Form->PageSize = 20;
		$objForm->Form->RowCount = 0;


		// Get PageSize
		if ($pagesize != 0)
		{
			$objForm->Form->PageSize = $pagesize;
		}

		// Get RowCount
		if ($rowcount != 0)
		{
			$objForm->Form->RowCount = $rowcount;
		}

		// Order
		$objForm->Form->SortOrder = $objForm->Form->SortOrder == null ? "Name" : $objForm->Form->SortOrder;


		// Declare URL
		$objForm->Form->urlBase = $this->URLClass->BrandUrl()."search/";
		$objForm->Form->url = $this->URLClass->BrandUrl()."search/";

		// Determine StartRow By Selected Index
		$objForm->Form->SelectedIndexRow = $selectedindexrow;
		if ($selectedindexrow > 0)
		{
			$temp = $selectedindexrow - 1;
			$objForm->Form->StartRow = ($temp * $objForm->Form->PageSize) + 1;
			if ($objForm->Form->url == $objForm->Form->urlBase)
			{
				$objForm->Form->url = $objForm->Form->url . "?StartRow=" . $objForm->Form->StartRow;
			}
			else
			{
				$objForm->Form->url = $objForm->Form->url . "&StartRow=" . $objForm->Form->StartRow;
			}
		}

		// Determine StartRow Out of Row Count
		if ($objForm->Form->RowCount <= $objForm->Form->PageSize)
		{
			$objForm->Form->url = $objForm->Form->urlBase;
			$objForm->Form->StartRow = 1;

			if ($objForm->Form->url == $objForm->Form->urlBase)
			{
				$objForm->Form->url = $objForm->Form->url . "?StartRow=" . $objForm->Form->StartRow;
			}
			else
			{
				$objForm->Form->url = $objForm->Form->url . "&StartRow=" . $objForm->Form->StartRow;
			}
		}
		
		// Determine EndRow
		if ($objForm->Form->PageSize != 0)
		{
			$objForm->Form->EndRow = $objForm->Form->StartRow + $objForm->Form->PageSize - 1;
			if ($objForm->Form->url == $objForm->Form->urlBase)
			{
				$objForm->Form->url = $objForm->Form->url . "?EndRow=" . $objForm->Form->EndRow;
			}
			else
			{
				$objForm->Form->url = $objForm->Form->url . "&EndRow=" . $objForm->Form->EndRow;
			}
		}

		// Search Starting from Selected Index
		$objForm->Form->Search = trim($search);
		if (strlen($objForm->Form->Search) != 0)
		{
			if ($objForm->Form->url == $objForm->Form->urlBase)
			{
				$objForm->Form->url = $objForm->Form->url . "?Search=" . $objForm->Form->Search;
			}
			else
			{
				$objForm->Form->url = $objForm->Form->url . "&Search=" . $objForm->Form->Search;
			}
		}

		//Populate DropdownParentName
		$objForm->Obj = new brand_model();


		$objForm->Obj->ParentID = $parentid;
		//////////////////// Filter ////////////////////
		if ($parentid != 0)
		{
			$objForm->Form->url = $objForm->Form->url . "&ParentID=" . $objForm->Obj->ParentID;
		}


		$objForm->Obj->DropDownParentName = $objForm->Obj->PopulateDDParentName();


		// Get Data
		$objForm->ObjList = $this->brand_model->Listing($objForm);


		// Page Count
		$tempCount = $objForm->Form->RowCount / $objForm->Form->PageSize;
		$objForm->Form->PageCount = ceil($tempCount);


		if ($objForm->Form->PageCount == 0)
		{
			$objForm->Form->PageCount = 1;
		}

        // Set End Row
		if ($objForm->Form->EndRow > $objForm->Form->RowCount)
		{
			$objForm->Form->EndRow = $objForm->Form->RowCount;
		}


		// echo "<pre>";
		// die(print_r($objForm));

		$this->template->load('v_brand',$objForm);
	}

	public function detail($id)
	{
		$objForm = new brand_view_model();
		$objForm->Obj = $this->brand_model->read($id);
		$objForm->Form = new FormModel();

		$this->template->load('v_brand_detail', $objForm);
	}

	public function addedit($id)
	{
		$objForm = new brand_view_model();
		$objForm->Form = new FormModel();


		$objForm->Obj = $this->brand_model->read($id);

		$objForm->Form->FormName = "Edit";

		// Instance DropDown Filter 
		$objForm->Obj->DropDownParentName = $objForm->Obj->PopulateDDParentName();

		$objForm->Obj->CategoryPopulateCheckBox = $objForm->Obj->PopulateCheckBoxCategory();

		$CategoryList = $objForm->Obj->CategoryList;
		$CategoryCheckBox = $objForm->Obj->CategoryPopulateCheckBox;


		for($i = 0; $i < count($CategoryList); $i++) {
			
			for($a = 0; $a < count($CategoryCheckBox); $a++){

			  //['CategoryID'] cara mengakses properti array dan {'CategoryID'} cara mengakses properti object			
			  if($CategoryList[$i]['CategoryID'] == $CategoryCheckBox[$a]->{'CategoryID'})
			  {
			  	 $CategoryCheckBox[$a]->CategorySelect = true;
			  }
			}
		}


		// echo "<pre>";
		// die(print_r($objForm->Obj->CategoryPopulateCheckBox));

		$this->template->load('v_brand_addedit', $objForm);

	}
}

?>