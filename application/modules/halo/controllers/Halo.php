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
 
class Halo extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('halo_model');
	}
	
	public function index()
	{
		echo "Halo ".CI_VERSION;
	}
	
	/**
	 * getListPerson()
	 *
	 * Returns JSON List Person
	 *
	 * @param   int 	$limit 	Berapa baris data
	 *
	 * @return  json
	 */	
	
	public function getListPerson($limit){
		$query = $this->halo_model->getListPerson($limit);
		
		$table = "";
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				//echo $row->Code;
				//echo $row->Name;
				$table .= "<tr><td>".$row->Code."</td><td>".$row->Name."</td></tr>";
				
			}
		}		
		$this->data["table"] = $table;
		
		$this->load->view('v_halo', $this->data);
		//echo json_encode($query->result());
		
	}	
	
	/**
	 * getPerson($id)
	 *
	 * Returns JSON Person Detail.
	 *
	 * @param   int   $nik   Nomor Induk Karyawan (NIK)
	 *
	 * @return  json
	 */	
	
	public function getPerson($nik){
		$data = $this->halo_model->getPerson($nik);
		
		echo json_encode($data->result());
	}

	public function getagency(){

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
	echo $obj;

	// // $option = '';
	// // foreach ($data->rows as $row) {
	// //  $option .= '<option value="'.$row->ID.'">'.$row->Name.'</option>';
	// // }

	// return $option;
	}

	public function order(){


		$agency = '16262'; //$this->input->post("agency");
		$sales = '23025'; //$this->input->post("sales");
		$client = '17072'; //$this->input->post("client");
		$description = 'deskripsi' ; //$this->input->post("description");
		$product = 'KCM Banner'; // $this->input->post("product");
		$no_po = '77'.rand(10,1000) ; // $this->input->post("no_po");
		$no_paket = 'P10232'.rand(10,100) ; //$this->input->post("no_paket");
		$tgl_tayang_banner = '2020-02-02';
		$tgl_akhir_banner = '2020-03-01';

		$url = "http://api.kmn.kompas.com/newadvdev/Order/New";

		$xml1 = "<?xml version='1.0' encoding='UTF-8'?>
		<Order ID='0'>
		<Offer ID='0'>Offer1</Offer>
		<PurchaseOrder>".$no_po."</PurchaseOrder>
		<Reference>".$no_paket."</Reference>
		<Source>AMS</Source>
		<ClientBookingCode />
		<TransactionDate>".date('c')."</TransactionDate>
		<Agency ID='".$agency."' />
		<Client ID='".$client."' />
		<Sales ID='".$sales."' />
		<ContactCreative ID='0' />
		<ContactBilling ID='0' />
		<Product ID='574' />
		<SalesOrg ID='9' />
		<Company ID='2'>Company1</Company>
		<Description />
		<Workstate ID='1'>Workstate1</Workstate>
		<Items>
		<Item ID='1' MainComponent='1'>
		<Product ID='486' Code='C-KCM-BNR' ComponentID='658' />
		<Company ID='2' />
		<Share Percentage='100'>
		<NettBefore>0</NettBefore>
		<VAT Percentage='0'>0</VAT>
		<NettAfter>0</NettAfter>
		<CommissionBefore>0</CommissionBefore>
		<IncomeTax Percentage='0' />
		<CommissionAfter>0</CommissionAfter>
		<ItemBasePrice Percentage='0' />
		</Share>
		<Width>
		<Value>1</Value>
		<UOM ID='16' />
		</Width>
		<Height>
		<Value>0</Value>
		<UOM ID='12' />
		</Height>
		<Size ID='71'>
		<Name>0</Name>
		<Value>0</Value>
		<UOM ID='0'>UOM1</UOM>
		</Size>
		<Position ID='77' Locked='0'>
		<Name>Name1</Name>
		<Section ID='12'>Section1</Section>
		<Publication ID='14'>Publication1</Publication>
		<Inner Locked='0'>-1</Inner>
		</Position>
		<Category ID='2' />
		<Attribute>
		<IDList />
		<NameList />
		</Attribute>
		<Classification ID='0' />
		<Title>Paket dari AMS</Title>
		<Metadata>Metadata1</Metadata>
		<PreviewURL>PreviewURL1</PreviewURL>
		<Description />
		<Quantity>0</Quantity>
		<Consecutive>0</Consecutive>
		<Schedules>
		<Schedule ID='0'>
		<DateBegin>".$tgl_tayang_banner."</DateBegin>
		<DateEnd>".$tgl_akhir_banner."</DateEnd>
		<Description />
		<Workstate ID='0' />
		</Schedule>
		</Schedules>
		<Production ID='11' />
		<Job ID='35' />
		<Materials />
		<Workstate ID='0'>Workstate2</Workstate>
		<Created ID='0' Date='".date('c')."'>Created2</Created>
		<Modified ID='0' Date='".date('c')."'>Modified2</Modified>
		</Item>
		<Item ID='1' MainComponent='1'>
		<Product ID='572' Code='KCM-PKG' ComponentID='658' />
		<Company ID='2' />
		<Share Percentage='100'>
		<NettBefore>0</NettBefore>
		<VAT Percentage='0'>0</VAT>
		<NettAfter>0</NettAfter>
		<CommissionBefore>0</CommissionBefore>
		<IncomeTax Percentage='0' />
		<CommissionAfter>0</CommissionAfter>
		<ItemBasePrice Percentage='0' />
		</Share>
		<Width>
		<Value>1</Value>
		<UOM ID='16' />
		</Width>
		<Height>
		<Value>0</Value>
		<UOM ID='12' />
		</Height>
		<Size ID='71'>
		<Name>0</Name>
		<Value>0</Value>
		<UOM ID='0'>UOM1</UOM>
		</Size>
		<Position ID='77' Locked='0'>
		<Name>Name1</Name>
		<Section ID='12'>Section1</Section>
		<Publication ID='14'>Publication1</Publication>
		<Inner Locked='0'>-1</Inner>
		</Position>
		<Category ID='2' />
		<Attribute>
		<IDList />
		<NameList />
		</Attribute>
		<Classification ID='0' />
		<Title>Paket dari AMS</Title>
		<Metadata>Metadata1</Metadata>
		<PreviewURL>PreviewURL1</PreviewURL>
		<Description />
		<Quantity>0</Quantity>
		<Consecutive>0</Consecutive>
		<Schedules>
		<Schedule ID='0'>
		<DateBegin>".$tgl_tayang_banner."</DateBegin>
		<DateEnd>".$tgl_akhir_banner."</DateEnd>
		<Description />
		<Workstate ID='0' />
		</Schedule>
		</Schedules>
		<Production ID='11' />
		<Job ID='35' />
		<Materials />
		<Workstate ID='0'>Workstate2</Workstate>
		<Created ID='0' Date='".date('c')."'>Created2</Created>
		<Modified ID='0' Date='".date('c')."'>Modified2</Modified>
		</Item>
		</Items>
		<Price>
		<Parameters>
		<BillToClient>0</BillToClient>
		<QuotedBase>-1</QuotedBase>
		<QuotedGross>-1</QuotedGross>
		<QuotedDiscount>-1</QuotedDiscount>
		<QuotedSurcharge>-1</QuotedSurcharge>
		<QuotedNetto>-1</QuotedNetto>
		<QuotedTotal>50000000</QuotedTotal>
		<TaxFree>0</TaxFree>
		<CommissionTax>-1</CommissionTax>
		</Parameters>
		<Dockets>
		<Method ID='2' Name='Tagihan Penerbit Detail' ForBilling='1' ForClient='0'>
		<PriceElement Index='1' Code='BASERATE' Name='Base Rate' InPercent='0' ShowPercent='0' ShowColumn='0'>999999999</PriceElement>
		<PriceElement Index='2' Code='BASESURCHARGE' Name='Base Surcharge' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='3' Code='BASEDISCOUNT' Name='Base Discount' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='4' Code='GROSS' Name='Tarif' InPercent='0' ShowPercent='0' ShowColumn='0'>999999999</PriceElement>
		<PriceElement Index='5' Code='QUOTEDCOST' Name='Quoted Cost' InPercent='0' ShowPercent='0' ShowColumn='1'>56818181.8182</PriceElement>
		<PriceElement Index='6' Code='QUOTEDADJ' Name='Quoted Adjustment' InPercent='0' ShowPercent='0' ShowColumn='0'>943181817.1818</PriceElement>
		<PriceElement Index='7' Code='OVERIDEADDITIONALSERVICE' Name='Overide Additional Service' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='8' Code='OVERIDEAGENCYDISCOUNT' Name='Overide Agency Discount' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='9' Code='SURCHARGE' Name='Extra' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='10' Code='BEFOREDISCOUNT' Name='Before Discount' InPercent='0' ShowPercent='0' ShowColumn='1'>56818181.8182</PriceElement>
		<PriceElement Index='11' Code='CLIENTDISCOUNT' Name='Client Discount' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='12' Code='AGENCYDISCOUNT' Name='Agency Discount' InPercent='1' ShowPercent='1' ShowColumn='1'>11363636.3636</PriceElement>
		<PriceElement Index='13' Code='PROMO' Name='Promo' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='14' Code='DISCOUNT' Name='Total Disc' InPercent='1' ShowPercent='1' ShowColumn='1'>11363636.3636</PriceElement>
		<PriceElement Index='15' Code='NETTBEFORE' Name='' InPercent='0' ShowPercent='0' ShowColumn='1'>45454545.4546</PriceElement>
		<PriceElement Index='16' Code='VAT' Name='PPN' InPercent='1' ShowPercent='1' ShowColumn='1'>4545454.5455</PriceElement>
		<PriceElement Index='17' Code='NETTAFTER' Name='Jumlah' InPercent='0' ShowPercent='0' ShowColumn='1'>50000000</PriceElement>
		</Method>
		</Dockets>
		</Price>
		<BillingPlan>
		<Agreement>
		<TermOfPayment>30</TermOfPayment>
		<ContainBarter>1</ContainBarter>
		<Manual>2</Manual>
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
		<Schedule ID='0' Index='1' Percentage='100'>
		<DueDate>".date('Y-m-d', strtotime($tgl_akhir_banner. ' + 1 days'))."</DueDate>
		<Description />
		<Workstate ID='0' />
		</Schedule>
		</Schedules>
		</BillingPlan>
		<Created ID='1' Date='".date('c')."'>Created1</Created>
		<Modified ID='1' Date='".date('c')."'>Modified1</Modified>
		</Order>";

		$xml2 = "<?xml version='1.0' encoding='UTF-8'?>
		<Order ID='0'>
		<Offer ID='0'>Offer1</Offer>
		<PurchaseOrder>".$no_po."</PurchaseOrder>
		<Reference>".$no_paket."</Reference>
		<Source>AMS</Source>
		<ClientBookingCode />
		<TransactionDate>".date('c')."</TransactionDate>
		<Agency ID='".$agency."' />
		<Client ID='".$client."' />
		<Sales ID='".$sales."' />
		<ContactCreative ID='0' />
		<ContactBilling ID='0' />
		<Product ID='574' />
		<SalesOrg ID='9' />
		<Company ID='2'>Company1</Company>
		<Description>'".$description."'<Description />
		<Workstate ID='1'>Workstate1</Workstate>
		<Items>
		<Item ID='1' MainComponent='1'>
		<Product ID='572' Code='KCM-PKG' ComponentID='658' />
		<Company ID='2' />
		<Share Percentage='100'>
		<NettBefore>0</NettBefore>
		<VAT Percentage='0'>0</VAT>
		<NettAfter>0</NettAfter>
		<CommissionBefore>0</CommissionBefore>
		<IncomeTax Percentage='0' />
		<CommissionAfter>0</CommissionAfter>
		<ItemBasePrice Percentage='0' />
		</Share>
		<Width>
		<Value>1</Value>
		<UOM ID='16' />
		</Width>
		<Height>
		<Value>0</Value>
		<UOM ID='12' />
		</Height>
		<Size ID='71'>
		<Name>0</Name>
		<Value>0</Value>
		<UOM ID='0'>UOM1</UOM>
		</Size>
		<Position ID='77' Locked='0'>
		<Name>Name1</Name>
		<Section ID='12'>Section1</Section>
		<Publication ID='14'>Publication1</Publication>
		<Inner Locked='0'>-1</Inner>
		</Position>
		<Category ID='2' />
		<Attribute>
		<IDList />
		<NameList />
		</Attribute>
		<Classification ID='0' />
		<Title>Paket dari AMS</Title>
		<Metadata>Metadata1</Metadata>
		<PreviewURL>PreviewURL1</PreviewURL>
		<Description />
		<Quantity>0</Quantity>
		<Consecutive>0</Consecutive>
		<Schedules>
		<Schedule ID='0'>
		<DateBegin>".$tgl_tayang_banner."</DateBegin>
		<DateEnd>".$tgl_akhir_banner."</DateEnd>
		<Description />
		<Workstate ID='0' />
		</Schedule>
		</Schedules>
		<Production ID='11' />
		<Job ID='35' />
		<Materials />
		<Workstate ID='0'>Workstate2</Workstate>
		<Created ID='0' Date='".date('c')."'>Created2</Created>
		<Modified ID='0' Date='".date('c')."'>Modified2</Modified>
		</Item>
		</Items>
		<Price>
		<Parameters>
		<BillToClient>0</BillToClient>
		<QuotedBase>-1</QuotedBase>
		<QuotedGross>-1</QuotedGross>
		<QuotedDiscount>-1</QuotedDiscount>
		<QuotedSurcharge>-1</QuotedSurcharge>
		<QuotedNetto>-1</QuotedNetto>
		<QuotedTotal>50000000</QuotedTotal>
		<TaxFree>0</TaxFree>
		<CommissionTax>-1</CommissionTax>
		</Parameters>
		<Dockets>
		<Method ID='2' Name='Tagihan Penerbit Detail' ForBilling='1' ForClient='0'>
		<PriceElement Index='1' Code='BASERATE' Name='Base Rate' InPercent='0' ShowPercent='0' ShowColumn='0'>999999999</PriceElement>
		<PriceElement Index='2' Code='BASESURCHARGE' Name='Base Surcharge' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='3' Code='BASEDISCOUNT' Name='Base Discount' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='4' Code='GROSS' Name='Tarif' InPercent='0' ShowPercent='0' ShowColumn='0'>999999999</PriceElement>
		<PriceElement Index='5' Code='QUOTEDCOST' Name='Quoted Cost' InPercent='0' ShowPercent='0' ShowColumn='1'>56818181.8182</PriceElement>
		<PriceElement Index='6' Code='QUOTEDADJ' Name='Quoted Adjustment' InPercent='0' ShowPercent='0' ShowColumn='0'>943181817.1818</PriceElement>
		<PriceElement Index='7' Code='OVERIDEADDITIONALSERVICE' Name='Overide Additional Service' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='8' Code='OVERIDEAGENCYDISCOUNT' Name='Overide Agency Discount' InPercent='0' ShowPercent='0' ShowColumn='0'>0</PriceElement>
		<PriceElement Index='9' Code='SURCHARGE' Name='Extra' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='10' Code='BEFOREDISCOUNT' Name='Before Discount' InPercent='0' ShowPercent='0' ShowColumn='1'>56818181.8182</PriceElement>
		<PriceElement Index='11' Code='CLIENTDISCOUNT' Name='Client Discount' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='12' Code='AGENCYDISCOUNT' Name='Agency Discount' InPercent='1' ShowPercent='1' ShowColumn='1'>11363636.3636</PriceElement>
		<PriceElement Index='13' Code='PROMO' Name='Promo' InPercent='0' ShowPercent='0' ShowColumn='1'>0</PriceElement>
		<PriceElement Index='14' Code='DISCOUNT' Name='Total Disc' InPercent='1' ShowPercent='1' ShowColumn='1'>11363636.3636</PriceElement>
		<PriceElement Index='15' Code='NETTBEFORE' Name='' InPercent='0' ShowPercent='0' ShowColumn='1'>45454545.4546</PriceElement>
		<PriceElement Index='16' Code='VAT' Name='PPN' InPercent='1' ShowPercent='1' ShowColumn='1'>4545454.5455</PriceElement>
		<PriceElement Index='17' Code='NETTAFTER' Name='Jumlah' InPercent='0' ShowPercent='0' ShowColumn='1'>50000000</PriceElement>
		</Method>
		</Dockets>
		</Price>
		<BillingPlan>
		<Agreement>
		<TermOfPayment>30</TermOfPayment>
		<ContainBarter>1</ContainBarter>
		<Manual>2</Manual>
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
		<Schedule ID='0' Index='1' Percentage='100'>
		<DueDate>2020-01-31</DueDate>
		<Description />
		<Workstate ID='0' />
		</Schedule>
		</Schedules>
		</BillingPlan>
		<Created ID='1' Date='".date('c')."'>Created1</Created>
		<Modified ID='1' Date='".date('c')."'>Modified1</Modified>
		</Order>";


		$data = '{ "XMLParameter": "'.$xml1.'", "Token": "|uzZdybS6BUCMIUxCnqyHG|" }';

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
		        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		        $obj = substr($response, $header_size);
		        $err = curl_error($curl);

		        curl_close($curl);

		//header('Content-Type: application/json');
		$row = json_decode($obj);
		//echo $row->status."<br>";
		//echo $row->Message."<br>";
		echo $data;
		//echo $err;

	}
}
