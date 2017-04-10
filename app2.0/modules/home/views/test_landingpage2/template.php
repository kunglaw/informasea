<?php // template ?>


<?php $this->load->view('modal-login'); ?>
<?php 
	
	//header

	$this->load->view("header",$dt_header);

	// statistic - login btn
	// $this->load->view("section1",$dt_section1);

	$this->load->view("section2",$dt_section2);

	$this->load->view("section3",$dt_section3);


	$this->load->view("section4",$dt_section4);


	$this->load->view("section5",$dt_section5);


	$this->load->view("section6",$dt_section6);
	

	// $this->load->view("section7",$dt_section7);
	$this->load->view("statistics");

?>

