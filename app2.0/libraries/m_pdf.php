<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once '../informasea_assets/plugin/mpdf/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }

    public function generate_pdf($content, $output_name)
    {
    	$CI =& get_instance();
    	// $header_file = $CI->load->view("print_template/header_print", array(), true);
    	$footer_file = $CI->load->view("resume/footer-print", array(), true);
    	// $this->pdf->SetHTMLHeader($header_file);
    	$this->pdf->SetHTMLFooter($footer_file);
		$this->pdf->AddPage('', // L - landscape, P - portrait 
        	'', '', '', '',
            10, // margin_left
            10, // margin right
            15, // margin top
            30, // margin bottom
            0, // margin header
            5
        ); // margin footer
        $this->pdf->WriteHTML($content);
        // $this->pdf->keepColumns = true;
                   
                          //download it.
		echo $this->pdf->Output("$output_name", "I");
    }
}
?>