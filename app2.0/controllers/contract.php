<?php 

class Contract extends CI_Controller{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("contract_offer_model", "com");
	}

	private function validating_process()
	{
		# code...
		$idnya = $this->uri->segment(3);
		$tokennya = $this->uri->segment(4);
		// echo "$idnya dan $tokennya"; //exit;
		// echo "<br>".$this->com->validate_contract($idnya, $tokennya); exit;
		if($this->com->validate_contract($idnya, $tokennya) <= 0) show_404();
		else return $idnya;
	}

	function show_agree_form()
	{
		$ajax = $this->input->post('x');
		if($ajax){
			$idnya = $this->input->post('id');
			$data['agree'] = $this->input->post('agree');
			// echo "$idnya dan $klausul";
			// $this->com->update_clausul_contract($idnya,$klausul);
			$data['dt_contract'] = $this->com->get_detail_contract($idnya);
			$this->load->view("contract_offer/contract-fixed",$data);
		}
		else show_404();
	}
	
	function contract_agree()
	{
		# code...
		$idnya = $this->validating_process();
		$this->com->increase_click_from_email($idnya, "agree");
		$data['agree'] = 1;
		
			$data['dt_contract'] = $this->com->get_detail_contract($idnya);
			$this->load->view('contract_offer/contract', $data);
	}
	
	function update_contract()
	{
		# code...
	}

	function preview_contract()
	{
		# code...
		$ajax = $this->input->post('x');
		if($ajax){
		
			$idnya = $this->input->post('id');
			$klausul = $this->input->post('klausul');
			// echo "$idnya dan $klausul";
			$this->com->update_clausul_contract($idnya,$klausul);
			$data['dt_contract'] = $this->com->get_detail_contract($idnya);
			//$data["t"] = $t= $this->uri->segment(4);
			$this->load->view("contract_offer/contract-fixed",$data);
		}
		else show_404();
	}

	function negotiate_contract()
	{
		// error_reporting(E_ALL);
		# code...
		$idnya = $this->validating_process();
			$this->com->increase_click_from_email($idnya);
			$data['dt_contract'] = $this->com->get_detail_contract($idnya);
			$this->load->view('contract_offer/contract', $data);
		
	}
	
	function print_contract()
	{
	   ob_end_clean();
	  
	   //$this->load->library('MPDF56/mpdf');
	   include "../class/mpdf/mpdf.php";
	   
	   $paper = "A4";
	   $mpdf=new mPDF('utf-8', $paper );
	   
	   	 
	   $idnya = $this->input->get("id");
	   $data['dt_contract'] = $this->com->get_detail_contract($idnya);
	   $html = $this->load->view('contract_offer/print_contract', $data,TRUE);// content
	   
	   
	   $mpdf->debug = true;
	   $mpdf->WriteHTML($html);
	   $mpdf->Output();
			
	}
	
	function test_pdf()
	{
		 
		 ob_end_clean();
		
		 //$this->load->library('MPDF56/mpdf');
		 include "../class/mpdf/mpdf.php";
		 
		 $paper = "A4";
		 $mpdf=new mPDF('utf-8', $paper );
		
		$idnya = 5;
		$data['dt_contract'] = $this->com->get_detail_contract($idnya);
		$html = $this->load->view('contract_offer/print_contract', $data,TRUE);
		//$html = "why ? ";
		 
		 $mpdf->debug = true;
		 $mpdf->WriteHTML($html);
		 $mpdf->Output();
			
	}

	function __destruct(){ }
}
?>