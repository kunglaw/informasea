<?php

class Contract_offer_model extends CI_model{
	
	 // current database object used
    private $_current_db = NULL;
    private $_primary_table = "pelaut_ms";
	
	private $db;

    /**
     * Load database with database name options
     * @param string $database_name
     */
    public function __construct() {

		parent::__construct();
		
		$this->db = $this->load->database("infr6975_informasea_admin",true);
       
    }

    function get_detail_contract($id)
    {
    	# code...
    	$q = "select * from admin_offer_contract where id_contract = '$id'";
		$exec = $this->db->query($q);
		return $exec->row_array();
    }
	
	function validate_contract($id, $token)
	{
		# code...
		$q = "select * from admin_offer_contract where id_contract = '$id' and token = '$token'";
		$exec = $this->db->query($q);
		return $exec->num_rows();
	}

	function increase_click_from_email($idnya, $btn = "negotiable")
	{
		# code...
		$kolom = "negotiable_click";
		if($btn != "negotiable") $kolom = "agreed_click";

		$q = "update admin_offer_contract set $kolom = $kolom + 1, last_update = now() where id_contract = '$idnya'";
		$this->db->query($q);
	}

	function update_clausul_contract($idnya, $content)
	{
		# code...
		
		$q = "update admin_offer_contract set content = '$content', last_update = now() where id_contract = '$idnya'";
		$this->db->query($q);
	}

	function __destruct()
	{
		# code...
	}
	
	
}