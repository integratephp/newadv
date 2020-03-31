<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workstate extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('workstate_model');
		$this->load->model('workstate_view_model');
		$this->load->model('workstate_filter_model');

	}
	public function index()
	{	
		$objForm = new workstate_view_model();
		
		// Paging Variable
        $pagesize = 0;
        $rowcount = 0;
        $selectedindexrow = 1;

        // Filter Variable
        $search;
        $workstatetypeid;
		
        // Detect From Postback
        $FilterSubmit = isset($_POST["FilterSubmit"]) ? $_POST["FilterSubmit"] : 0;

        // Get Data Form Postback
        if ($FilterSubmit == 1){
	        // Get Filter Parameter
            if ($objForm->Form == null)
            {
                $search = "";
                $workstatetypeid = 0;
            }else{
				if(strlen($objForm->Form->Search) != 0){
					$search = $objForm->Form->Search;
				}else{
					$search = "";
				}
				$workstatetypeid = $objForm->Obj->WorkstateTypeID;
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

			if ($_POST["First2"] != 0)
			{
				$selectedindexrow = $_POST["First2"];
			}

			if ($_POST["Prev2"] != 0)
			{
				$selectedindexrow = $_POST["Prev2"];
			}

			if ($_POST["Next2"] != 0)
			{
				$selectedindexrow = $_POST["Next2"];
			}

			if ($_POST["Last2"] != 0)
			{
				$selectedindexrow = $_POST["Last2"];
			}
		}
		else{
			$search = "";
			$workstatetypeid = 0;
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
		$objForm->Form->urlBase = $this->URLClass->WorkstateUrl()."search/";
		$objForm->Form->url = $this->URLClass->WorkstateUrl()."search/";

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
		
		// Instance Object
		$objForm->Obj = new workstate_model();
				
		// Instance DropDown Filter 
		$objForm->Obj->DropDownWorkstateType = $objForm->Obj->PopulateDDWorkstateType();

		$objForm->Obj->WorkstateTypeID = $workstatetypeid;
		//////////////////// Filter ////////////////////
		if ($workstatetypeid != 0)
		{
			$objForm->Form->url = $objForm->Form->url . "&WorkstateTypeID=" . $objForm->Obj->WorkstateTypeID;
		}
		//////////////////// End Filter ////////////////////

		// Get Data
		$objForm->ObjList = $this->workstate_model->Listing($objForm);

		// Search Purpose
        // Recompose Url with StartRow = 1
        if ((count($objForm->ObjList) == 0) && ($objForm->Form->StartRow != 1))
        {
            $objForm->Form->StartRow = 1;
            $objForm->Form->EndRow = $objForm->Form->StartRow + $objForm->Form->PageSize - 1;
            $objForm->Form->url = $objForm->Form->urlBase;
            $objForm->Form->Search = $objForm->Form->Search == null ? "" : $objForm->Form->Search;
            if ($objForm->Form->Search != "")
            {
                $objForm->Form->url = $objForm->Form->url . "?Search=" . $objForm->Form->Search . "&StartRow=" . $objForm->Form->StartRow . "&EndRow=" . $objForm->Form->EndRow;
            }
            else
            {
                $objForm->Form->url = $objForm->Form->url . "?StartRow=" . $objForm->Form->StartRow . "&EndRow=" . $objForm->Form->EndRow;
            }

            //////////////////// Filter ////////////////////
            if ($workstatetypeid != 0)
            {
                $objForm->Obj->WorkstateTypeID = $workstatetypeid;
                $objForm->Form->url = $objForm->Form->url . "&WorkstateTypeID=" . $objForm->Obj->WorkstateTypeID;
            }
            //////////////////// End Filter ////////////////////
            // Get Data
            $objForm->ObjList = $this->workstate_model->Listing($objForm);
		}
		
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
		// Model.Form.SelectedIndexRow
		// Model.Form.PageCount
		// model.Obj.WorkstateTypeID
		// Model.Obj.DropDownWorkstateType
		// Model.Form.PageSize
		// Model.ObjList.Count
		// Model.ObjList []
		// Model.Form.StartRow
		// Model.Form.EndRow
		// Model.Form.RowCount
		$this->template->load('v_workstate', $objForm);
	}

	public function detail($id)
	{
		$objForm = new workstate_view_model();
		$objForm->Obj = $this->workstate_model->read($id);
        $objForm->Form = new FormModel();
          
        $this->template->load('v_workstate_detail', $objForm);
	}
}