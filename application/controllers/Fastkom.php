<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fastkom extends CI_Controller {
	/*
	public function __construct() {
		parent::__construct();
		//check_session(); // jika session habis, redirect ke logout

	}
	*/
	
	public function index() {
		$data["sales"] 	= $this->getSales();
		$data["client"] = $this->getClient();
		$data["agency"] = $this->getAgency();
		
		//var_dump($data);
		//die();
		$this->load->view("fastkom_order",$data);
	}
	
	public function getAgency(){
		
		$url = "http://api.kmn.kompas.com/newadvdev/BP/isAgency";
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

		$data = json_decode($obj);
		
		$option = '';
		foreach ($data->rows as $row) {
		  $option .= '<option value="'.$row->ID.'">'.$row->Name.'</option>';
		}
		
		return $option;		
	}	
	
	public function getSales(){
		
		$url = "http://api.kmn.kompas.com/newadvdev/BP/isSales";
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

		$data = json_decode($obj);
		
		$option = '';
		foreach ($data->rows as $row) {
		  $option .= '<option value="'.$row->ID.'">'.$row->Name.'</option>';
		}
		
		return $option;		
	}
	public function getclientx(){

		$search = $this->input->post("search");
		
		if(empty($search)){
			$search = "";
		}
		
		$url = "http://api.kmn.kompas.com/newadvdev/BP/isClient?search=".urlencode($search);

		
        $curl = curl_init();
        curl_setopt_array($curl, array(

            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            //CURLOPT_HEADER => true,
            //CURLOPT_POSTFIELDS => "",
        ));
        $response = curl_exec($curl);
        //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        //$obj = substr($response, $header_size);
        $err = curl_error($curl);

        curl_close($curl);  
		
		
	}	
	
	public function getClient(){
		/*
		$search = $this->input->post("search");
		
		if(empty($search)){
			$search = "";
		}
		*/
		
		$url = "http://api.kmn.kompas.com/newadvdev/BP/isClient?search=";
		
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

		$data = json_decode($obj);
		
		$option = '';
		foreach ($data->rows as $row) {
		  $option .= '<option value="'.$row->ID.'">'.$row->Name.'</option>';
		}
		
		return $option;		
	}	
	
	public function tes(){
		//header('Content-Type: text/html; charset=utf-8');
		var_dump ("HelloW".  CI_VERSION);
	}
	
	public function order(){
		
		$agency = $this->input->post("agency");
		$sales = $this->input->post("sales");
		$client = $this->input->post("client");
		$description = $this->input->post("description");
		$product = $this->input->post("product");

		$url = "http://api.kmn.kompas.com/newadvdev/Order/New";
		
		$data = '<?xml version="1.0" encoding="utf-8"?>
				<Order ID="1">
				  <Offer ID="1">
					<Type ID="1">Type1</Type>
					<Name>1</Name>
					<Description>'.$description.'</Description>
					<Issued ID="1" Date="1900-01-01T01:01:01+07:00">Issued1</Issued>
				  </Offer>
				  <PurchaseOrder>NoOrderDariKlien</PurchaseOrder>
				  <Reference>NoPaketAMS</Reference>
				  <Source>Source1</Source>
				  <ClientBookingCode>ClientBookingCode1</ClientBookingCode>
				  <TransactionDate>1900-01-01T01:01:01+07:00</TransactionDate>
				  <Agency ID="1">'.$agency.'</Agency>
				  <AgencyType ID="1">AgencyType1</AgencyType>
				  <Client ID="1">'.$client.'</Client>
				  <Sales ID="1">'.$sales.'</Sales>
				  <ContactCreative ID="1">ContactCreative1</ContactCreative>
				  <ContactBilling ID="1">ContactBilling1</ContactBilling>
				  <Product ID="1">'.$product.'</Product>
				  <SalesOrg ID="1">SalesOrg1</SalesOrg>
				  <Company ID="1">Company1</Company>
				  <Description>Description1</Description>
				  <Workstate ID="1">301</Workstate>
				  <WorkstateColor>WorkstateColor1</WorkstateColor>
				  <Items>
					<Item ID="1" MainComponent="1" Code="Code1">
					  <Product ID="1" Code="Code1" ComponentID="1">Product1</Product>
					  <ProductType ID="1">ProductType1</ProductType>
					  <Company ID="1">Company1</Company>
					  <Share Percentage="1">
						<NettBefore>1</NettBefore>
						<VAT Percentage="1">1</VAT>
						<NettAfter>1</NettAfter>
						<CommissionBefore>1</CommissionBefore>
						<IncomeTax Percentage="1">1</IncomeTax>
						<CommissionAfter>1</CommissionAfter>
						<ItemBasePrice Percentage="1">1</ItemBasePrice>
					  </Share>
					  <Width>
						<Value>1</Value>
						<UOM ID="1">UOM1</UOM>
					  </Width>
					  <Height>
						<Value>1</Value>
						<UOM ID="1">UOM1</UOM>
					  </Height>
					  <Size ID="1">
						<Name>Name1</Name>
						<Value>1</Value>
						<UOM ID="1">UOM1</UOM>
					  </Size>
					  <Color ID="1">Color1</Color>
					  <Position ID="1" Locked="1">
						<Name>Name1</Name>
						<Section ID="1">Section1</Section>
						<Publication ID="1">Publication1</Publication>
						<Inner Locked="1">1</Inner>
						<String>String1</String>
					  </Position>
					  <Category ID="1">Category1</Category>
					  <Attribute>
						<IDList>IDList1</IDList>
						<NameList>NameList1</NameList>
					  </Attribute>
					  <Classification ID="1">Classification1</Classification>
					  <Title>Title1</Title>
					  <Metadata>Metadata1</Metadata>
					  <PreviewURL>PreviewURL1</PreviewURL>
					  <Description>Description1</Description>
					  <Quantity>1</Quantity>
					  <Consecutive>1</Consecutive>
					  <PrintCopy>1</PrintCopy>
					  <Schedules>
						<Schedule ID="1">
						  <DateBegin>1900-01-01T01:01:01+07:00</DateBegin>
						  <DateEnd>1900-01-01T01:01:01+07:00</DateEnd>
						  <Description>Description1</Description>
						  <Workstate ID="1">Workstate1</Workstate>
						  <WorkstateColor>WorkstateColor1</WorkstateColor>
						</Schedule>
						<Schedule ID="-79228162514264337593543950335">
						  <DateBegin>0001-01-01T00:00:00+07:00</DateBegin>
						  <DateEnd>0001-01-01T00:00:00+07:00</DateEnd>
						  <Description>Description2</Description>
						  <Workstate ID="-79228162514264337593543950335">Workstate2</Workstate>
						  <WorkstateColor>WorkstateColor2</WorkstateColor>
						</Schedule>
						<Schedule ID="79228162514264337593543950335">
						  <DateBegin>9999-12-31T23:59:59.9999999+07:00</DateBegin>
						  <DateEnd>9999-12-31T23:59:59.9999999+07:00</DateEnd>
						  <Description>Description3</Description>
						  <Workstate ID="79228162514264337593543950335">Workstate3</Workstate>
						  <WorkstateColor>WorkstateColor3</WorkstateColor>
						</Schedule>
					  </Schedules>
					  <Production ID="1">Production1</Production>
					  <Job ID="1">Job1</Job>
					  <ProductionDeadline>01:01:01</ProductionDeadline>
					  <ProductionOffsetDay>1</ProductionOffsetDay>
					  <Materials>
						<Material OrderItemMaterialID="1" ProductMaterialID="1">
						  <Name>Name1</Name>
						  <Description>Description1</Description>
						  <MaterialType ID="1" FinalArtwork="1" Attachment="1">MaterialType1</MaterialType>
						  <Optional>1</Optional>
						  <ContentXML>ContentXML1</ContentXML>
						  <ContentText>ContentText1</ContentText>
						  <Metadata>Metadata1</Metadata>
						  <PreviewURL>PreviewURL1</PreviewURL>
						  <Workstate ID="1">Workstate1</Workstate>
						  <WorkstateColor>WorkstateColor1</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="-79228162514264337593543950335" ProductMaterialID="-79228162514264337593543950335">
						  <Name>Name2</Name>
						  <Description>Description2</Description>
						  <MaterialType ID="-79228162514264337593543950335" FinalArtwork="-79228162514264337593543950335" Attachment="-79228162514264337593543950335">MaterialType2</MaterialType>
						  <Optional>-79228162514264337593543950335</Optional>
						  <ContentXML>ContentXML2</ContentXML>
						  <ContentText>ContentText2</ContentText>
						  <Metadata>Metadata2</Metadata>
						  <PreviewURL>PreviewURL2</PreviewURL>
						  <Workstate ID="-79228162514264337593543950335">Workstate2</Workstate>
						  <WorkstateColor>WorkstateColor2</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="79228162514264337593543950335" ProductMaterialID="79228162514264337593543950335">
						  <Name>Name3</Name>
						  <Description>Description3</Description>
						  <MaterialType ID="79228162514264337593543950335" FinalArtwork="79228162514264337593543950335" Attachment="79228162514264337593543950335">MaterialType3</MaterialType>
						  <Optional>79228162514264337593543950335</Optional>
						  <ContentXML>ContentXML3</ContentXML>
						  <ContentText>ContentText3</ContentText>
						  <Metadata>Metadata3</Metadata>
						  <PreviewURL>PreviewURL3</PreviewURL>
						  <Workstate ID="79228162514264337593543950335">Workstate3</Workstate>
						  <WorkstateColor>WorkstateColor3</WorkstateColor>
						</Material>
					  </Materials>
					  <Workstate ID="1">Workstate1</Workstate>
					  <WorkstateColor>WorkstateColor1</WorkstateColor>
					  <Created ID="1" Date="1900-01-01T01:01:01+07:00">Created1</Created>
					  <Modified ID="1" Date="1900-01-01T01:01:01+07:00">Modified1</Modified>
					</Item>
					<Item ID="-9223372036854775807" MainComponent="-79228162514264337593543950335" Code="Code2">
					  <Product ID="-79228162514264337593543950335" Code="Code2" ComponentID="-79228162514264337593543950335">Product2</Product>
					  <ProductType ID="-79228162514264337593543950335">ProductType2</ProductType>
					  <Company ID="-79228162514264337593543950335">Company2</Company>
					  <Share Percentage="-79228162514264337593543950335">
						<NettBefore>-79228162514264337593543950335</NettBefore>
						<VAT Percentage="-79228162514264337593543950335">-79228162514264337593543950335</VAT>
						<NettAfter>-79228162514264337593543950335</NettAfter>
						<CommissionBefore>-79228162514264337593543950335</CommissionBefore>
						<IncomeTax Percentage="-79228162514264337593543950335">-79228162514264337593543950335</IncomeTax>
						<CommissionAfter>-79228162514264337593543950335</CommissionAfter>
						<ItemBasePrice Percentage="-79228162514264337593543950335">-79228162514264337593543950335</ItemBasePrice>
					  </Share>
					  <Width>
						<Value>-79228162514264337593543950335</Value>
						<UOM ID="-79228162514264337593543950335">UOM2</UOM>
					  </Width>
					  <Height>
						<Value>-79228162514264337593543950335</Value>
						<UOM ID="-79228162514264337593543950335">UOM2</UOM>
					  </Height>
					  <Size ID="-79228162514264337593543950335">
						<Name>Name2</Name>
						<Value>-79228162514264337593543950335</Value>
						<UOM ID="-79228162514264337593543950335">UOM2</UOM>
					  </Size>
					  <Color ID="-79228162514264337593543950335">Color2</Color>
					  <Position ID="-79228162514264337593543950335" Locked="-79228162514264337593543950335">
						<Name>Name2</Name>
						<Section ID="-79228162514264337593543950335">Section2</Section>
						<Publication ID="-79228162514264337593543950335">Publication2</Publication>
						<Inner Locked="-79228162514264337593543950335">-79228162514264337593543950335</Inner>
						<String>String2</String>
					  </Position>
					  <Category ID="-79228162514264337593543950335">Category2</Category>
					  <Attribute>
						<IDList>IDList2</IDList>
						<NameList>NameList2</NameList>
					  </Attribute>
					  <Classification ID="-79228162514264337593543950335">Classification2</Classification>
					  <Title>Title2</Title>
					  <Metadata>Metadata2</Metadata>
					  <PreviewURL>PreviewURL2</PreviewURL>
					  <Description>Description2</Description>
					  <Quantity>-79228162514264337593543950335</Quantity>
					  <Consecutive>-79228162514264337593543950335</Consecutive>
					  <PrintCopy>-79228162514264337593543950335</PrintCopy>
					  <Schedules>
						<Schedule ID="0">
						  <DateBegin>1899-11-30T01:01:01+07:00</DateBegin>
						  <DateEnd>1899-11-30T01:01:01+07:00</DateEnd>
						  <Description>Description4</Description>
						  <Workstate ID="0">Workstate4</Workstate>
						  <WorkstateColor>WorkstateColor4</WorkstateColor>
						</Schedule>
						<Schedule ID="2">
						  <DateBegin>1900-02-02T01:01:01+07:00</DateBegin>
						  <DateEnd>1900-02-02T01:01:01+07:00</DateEnd>
						  <Description>Description5</Description>
						  <Workstate ID="2">Workstate5</Workstate>
						  <WorkstateColor>WorkstateColor5</WorkstateColor>
						</Schedule>
						<Schedule ID="-79228162514264337593543950334">
						  <DateBegin>0001-02-02T00:00:00+07:00</DateBegin>
						  <DateEnd>0001-02-02T00:00:00+07:00</DateEnd>
						  <Description>Description6</Description>
						  <Workstate ID="-79228162514264337593543950334">Workstate6</Workstate>
						  <WorkstateColor>WorkstateColor6</WorkstateColor>
						</Schedule>
					  </Schedules>
					  <Production ID="-79228162514264337593543950335">Production2</Production>
					  <Job ID="-79228162514264337593543950335">Job2</Job>
					  <ProductionDeadline>00:00:00</ProductionDeadline>
					  <ProductionOffsetDay>-79228162514264337593543950335</ProductionOffsetDay>
					  <Materials>
						<Material OrderItemMaterialID="0" ProductMaterialID="0">
						  <Name>Name4</Name>
						  <Description>Description4</Description>
						  <MaterialType ID="0" FinalArtwork="0" Attachment="0">MaterialType4</MaterialType>
						  <Optional>0</Optional>
						  <ContentXML>ContentXML4</ContentXML>
						  <ContentText>ContentText4</ContentText>
						  <Metadata>Metadata4</Metadata>
						  <PreviewURL>PreviewURL4</PreviewURL>
						  <Workstate ID="0">Workstate4</Workstate>
						  <WorkstateColor>WorkstateColor4</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="2" ProductMaterialID="2">
						  <Name>Name5</Name>
						  <Description>Description5</Description>
						  <MaterialType ID="2" FinalArtwork="2" Attachment="2">MaterialType5</MaterialType>
						  <Optional>2</Optional>
						  <ContentXML>ContentXML5</ContentXML>
						  <ContentText>ContentText5</ContentText>
						  <Metadata>Metadata5</Metadata>
						  <PreviewURL>PreviewURL5</PreviewURL>
						  <Workstate ID="2">Workstate5</Workstate>
						  <WorkstateColor>WorkstateColor5</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="-79228162514264337593543950334" ProductMaterialID="-79228162514264337593543950334">
						  <Name>Name6</Name>
						  <Description>Description6</Description>
						  <MaterialType ID="-79228162514264337593543950334" FinalArtwork="-79228162514264337593543950334" Attachment="-79228162514264337593543950334">MaterialType6</MaterialType>
						  <Optional>-79228162514264337593543950334</Optional>
						  <ContentXML>ContentXML6</ContentXML>
						  <ContentText>ContentText6</ContentText>
						  <Metadata>Metadata6</Metadata>
						  <PreviewURL>PreviewURL6</PreviewURL>
						  <Workstate ID="-79228162514264337593543950334">Workstate6</Workstate>
						  <WorkstateColor>WorkstateColor6</WorkstateColor>
						</Material>
					  </Materials>
					  <Workstate ID="-79228162514264337593543950335">Workstate2</Workstate>
					  <WorkstateColor>WorkstateColor2</WorkstateColor>
					  <Created ID="-79228162514264337593543950335" Date="0001-01-01T00:00:00+07:00">Created2</Created>
					  <Modified ID="-79228162514264337593543950335" Date="0001-01-01T00:00:00+07:00">Modified2</Modified>
					</Item>
					<Item ID="9223372036854775807" MainComponent="79228162514264337593543950335" Code="Code3">
					  <Product ID="79228162514264337593543950335" Code="Code3" ComponentID="79228162514264337593543950335">Product3</Product>
					  <ProductType ID="79228162514264337593543950335">ProductType3</ProductType>
					  <Company ID="79228162514264337593543950335">Company3</Company>
					  <Share Percentage="79228162514264337593543950335">
						<NettBefore>79228162514264337593543950335</NettBefore>
						<VAT Percentage="79228162514264337593543950335">79228162514264337593543950335</VAT>
						<NettAfter>79228162514264337593543950335</NettAfter>
						<CommissionBefore>79228162514264337593543950335</CommissionBefore>
						<IncomeTax Percentage="79228162514264337593543950335">79228162514264337593543950335</IncomeTax>
						<CommissionAfter>79228162514264337593543950335</CommissionAfter>
						<ItemBasePrice Percentage="79228162514264337593543950335">79228162514264337593543950335</ItemBasePrice>
					  </Share>
					  <Width>
						<Value>79228162514264337593543950335</Value>
						<UOM ID="79228162514264337593543950335">UOM3</UOM>
					  </Width>
					  <Height>
						<Value>79228162514264337593543950335</Value>
						<UOM ID="79228162514264337593543950335">UOM3</UOM>
					  </Height>
					  <Size ID="79228162514264337593543950335">
						<Name>Name3</Name>
						<Value>79228162514264337593543950335</Value>
						<UOM ID="79228162514264337593543950335">UOM3</UOM>
					  </Size>
					  <Color ID="79228162514264337593543950335">Color3</Color>
					  <Position ID="79228162514264337593543950335" Locked="79228162514264337593543950335">
						<Name>Name3</Name>
						<Section ID="79228162514264337593543950335">Section3</Section>
						<Publication ID="79228162514264337593543950335">Publication3</Publication>
						<Inner Locked="79228162514264337593543950335">79228162514264337593543950335</Inner>
						<String>String3</String>
					  </Position>
					  <Category ID="79228162514264337593543950335">Category3</Category>
					  <Attribute>
						<IDList>IDList3</IDList>
						<NameList>NameList3</NameList>
					  </Attribute>
					  <Classification ID="79228162514264337593543950335">Classification3</Classification>
					  <Title>Title3</Title>
					  <Metadata>Metadata3</Metadata>
					  <PreviewURL>PreviewURL3</PreviewURL>
					  <Description>Description3</Description>
					  <Quantity>79228162514264337593543950335</Quantity>
					  <Consecutive>79228162514264337593543950335</Consecutive>
					  <PrintCopy>79228162514264337593543950335</PrintCopy>
					  <Schedules>
						<Schedule ID="79228162514264337593543950334">
						  <DateBegin>9999-11-29T23:59:59.9999999+07:00</DateBegin>
						  <DateEnd>9999-11-29T23:59:59.9999999+07:00</DateEnd>
						  <Description>Description7</Description>
						  <Workstate ID="79228162514264337593543950334">Workstate7</Workstate>
						  <WorkstateColor>WorkstateColor7</WorkstateColor>
						</Schedule>
						<Schedule ID="-1">
						  <DateBegin>1899-10-29T01:01:01+07:00</DateBegin>
						  <DateEnd>1899-10-29T01:01:01+07:00</DateEnd>
						  <Description>Description8</Description>
						  <Workstate ID="-1">Workstate8</Workstate>
						  <WorkstateColor>WorkstateColor8</WorkstateColor>
						</Schedule>
						<Schedule ID="3">
						  <DateBegin>1900-03-06T01:01:01+07:00</DateBegin>
						  <DateEnd>1900-03-06T01:01:01+07:00</DateEnd>
						  <Description>Description9</Description>
						  <Workstate ID="3">Workstate9</Workstate>
						  <WorkstateColor>WorkstateColor9</WorkstateColor>
						</Schedule>
					  </Schedules>
					  <Production ID="79228162514264337593543950335">Production3</Production>
					  <Job ID="79228162514264337593543950335">Job3</Job>
					  <ProductionDeadline>23:59:59</ProductionDeadline>
					  <ProductionOffsetDay>79228162514264337593543950335</ProductionOffsetDay>
					  <Materials>
						<Material OrderItemMaterialID="79228162514264337593543950334" ProductMaterialID="79228162514264337593543950334">
						  <Name>Name7</Name>
						  <Description>Description7</Description>
						  <MaterialType ID="79228162514264337593543950334" FinalArtwork="79228162514264337593543950334" Attachment="79228162514264337593543950334">MaterialType7</MaterialType>
						  <Optional>79228162514264337593543950334</Optional>
						  <ContentXML>ContentXML7</ContentXML>
						  <ContentText>ContentText7</ContentText>
						  <Metadata>Metadata7</Metadata>
						  <PreviewURL>PreviewURL7</PreviewURL>
						  <Workstate ID="79228162514264337593543950334">Workstate7</Workstate>
						  <WorkstateColor>WorkstateColor7</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="-1" ProductMaterialID="-1">
						  <Name>Name8</Name>
						  <Description>Description8</Description>
						  <MaterialType ID="-1" FinalArtwork="-1" Attachment="-1">MaterialType8</MaterialType>
						  <Optional>-1</Optional>
						  <ContentXML>ContentXML8</ContentXML>
						  <ContentText>ContentText8</ContentText>
						  <Metadata>Metadata8</Metadata>
						  <PreviewURL>PreviewURL8</PreviewURL>
						  <Workstate ID="-1">Workstate8</Workstate>
						  <WorkstateColor>WorkstateColor8</WorkstateColor>
						</Material>
						<Material OrderItemMaterialID="3" ProductMaterialID="3">
						  <Name>Name9</Name>
						  <Description>Description9</Description>
						  <MaterialType ID="3" FinalArtwork="3" Attachment="3">MaterialType9</MaterialType>
						  <Optional>3</Optional>
						  <ContentXML>ContentXML9</ContentXML>
						  <ContentText>ContentText9</ContentText>
						  <Metadata>Metadata9</Metadata>
						  <PreviewURL>PreviewURL9</PreviewURL>
						  <Workstate ID="3">Workstate9</Workstate>
						  <WorkstateColor>WorkstateColor9</WorkstateColor>
						</Material>
					  </Materials>
					  <Workstate ID="79228162514264337593543950335">Workstate3</Workstate>
					  <WorkstateColor>WorkstateColor3</WorkstateColor>
					  <Created ID="79228162514264337593543950335" Date="9999-12-31T23:59:59.9999999+07:00">Created3</Created>
					  <Modified ID="79228162514264337593543950335" Date="9999-12-31T23:59:59.9999999+07:00">Modified3</Modified>
					</Item>
				  </Items>
				  <Price>
					<Parameters>
					  <BillToClient>1</BillToClient>
					  <QuotedBase>1</QuotedBase>
					  <QuotedGross>1</QuotedGross>
					  <QuotedDiscount>QuotedDiscount1</QuotedDiscount>
					  <QuotedSurcharge>QuotedSurcharge1</QuotedSurcharge>
					  <QuotedNetto>1</QuotedNetto>
					  <QuotedTotal>1</QuotedTotal>
					  <TaxFree>1</TaxFree>
					  <CommissionTax>1</CommissionTax>
					</Parameters>
					<Dockets>
					  <Method ID="1" Name="Name1" ForBilling="1" ForClient="1">
						<PriceElement Index="1" Code="Code1" Name="Name1" InPercent="1" ShowPercent="1" ShowColumn="1">1</PriceElement>
						<PriceElement Index="-79228162514264337593543950335" Code="Code2" Name="Name2" InPercent="-79228162514264337593543950335" ShowPercent="-79228162514264337593543950335" ShowColumn="-79228162514264337593543950335">-79228162514264337593543950335</PriceElement>
						<PriceElement Index="79228162514264337593543950335" Code="Code3" Name="Name3" InPercent="79228162514264337593543950335" ShowPercent="79228162514264337593543950335" ShowColumn="79228162514264337593543950335">79228162514264337593543950335</PriceElement>
					  </Method>
					  <Method ID="-79228162514264337593543950335" Name="Name2" ForBilling="-79228162514264337593543950335" ForClient="-79228162514264337593543950335">
						<PriceElement Index="0" Code="Code4" Name="Name4" InPercent="0.9" ShowPercent="0" ShowColumn="0">0.9</PriceElement>
						<PriceElement Index="2" Code="Code5" Name="Name5" InPercent="1.1" ShowPercent="2" ShowColumn="2">1.1</PriceElement>
						<PriceElement Index="-79228162514264337593543950334" Code="Code6" Name="Name6" InPercent="-79228162514264337593543950335" ShowPercent="-79228162514264337593543950334" ShowColumn="-79228162514264337593543950334">-79228162514264337593543950335</PriceElement>
					  </Method>
					  <Method ID="79228162514264337593543950335" Name="Name3" ForBilling="79228162514264337593543950335" ForClient="79228162514264337593543950335">
						<PriceElement Index="79228162514264337593543950334" Code="Code7" Name="Name7" InPercent="79228162514264337593543950335" ShowPercent="79228162514264337593543950334" ShowColumn="79228162514264337593543950334">79228162514264337593543950335</PriceElement>
						<PriceElement Index="-1" Code="Code8" Name="Name8" InPercent="0.8" ShowPercent="-1" ShowColumn="-1">0.8</PriceElement>
						<PriceElement Index="3" Code="Code9" Name="Name9" InPercent="1.2" ShowPercent="3" ShowColumn="3">1.2</PriceElement>
					  </Method>
					</Dockets>
				  </Price>
				  <BillingPlan>
					<Agreement>
					  <TermOfPayment>1</TermOfPayment>
					  <ContainBarter>1</ContainBarter>
					  <Manual>1</Manual>
					</Agreement>
					<Description>
					  <Description1>Description11</Description1>
					  <Description2>Description21</Description2>
					  <Description3>Description31</Description3>
					  <Description4>Description41</Description4>
					  <Description5>Description51</Description5>
					  <Description6>Description61</Description6>
					  <Description7>Description71</Description7>
					  <Description8>Description81</Description8>
					  <Description9>Description91</Description9>
					  <Description10>Description101</Description10>
					  <Description11>Description111</Description11>
					  <Description12>Description121</Description12>
					  <Description13>Description131</Description13>
					  <Description14>Description141</Description14>
					  <Description15>Description151</Description15>
					</Description>
					<Schedules>
					  <Schedule ID="1" Index="1" Percentage="1">
						<DueDate>1900-01-01</DueDate>
						<Description>Description1</Description>
						<Workstate ID="1">Workstate1</Workstate>
						<WorkstateColor>WorkstateColor1</WorkstateColor>
					  </Schedule>
					  <Schedule ID="-79228162514264337593543950335" Index="-79228162514264337593543950335" Percentage="-79228162514264337593543950335">
						<DueDate>0001-01-01</DueDate>
						<Description>Description2</Description>
						<Workstate ID="-79228162514264337593543950335">Workstate2</Workstate>
						<WorkstateColor>WorkstateColor2</WorkstateColor>
					  </Schedule>
					  <Schedule ID="79228162514264337593543950335" Index="79228162514264337593543950335" Percentage="79228162514264337593543950335">
						<DueDate>9999-12-31</DueDate>
						<Description>Description3</Description>
						<Workstate ID="79228162514264337593543950335">Workstate3</Workstate>
						<WorkstateColor>WorkstateColor3</WorkstateColor>
					  </Schedule>
					</Schedules>
				  </BillingPlan>
				  <Created ID="1" Date="1900-01-01T01:01:01+07:00">Created1</Created>
				  <Modified ID="1" Date="1900-01-01T01:01:01+07:00">Modified1</Modified>
				</Order>';
		
		$header = array('Content-Type: application/xml','Content-Length: ' . strlen($data));
		
        $curl = curl_init();
        curl_setopt_array($curl, array(

            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            //CURLOPT_HEADER => true,
			CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        //$obj = substr($response, $header_size);
        $err = curl_error($curl);

        curl_close($curl);		
		
		//header('Content-Type: application/json');
		//echo json_encode($response);
		
		echo $agency;

	}

}
?>