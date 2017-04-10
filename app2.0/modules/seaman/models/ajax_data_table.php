<?php

class ajax_data_table extends CI_model{
	
	function get_data_profiency()
	{
		$table = 'profiency';	
		$primaryKey = 'id_sertifikat';
	 	$columns = array(
		
		array( 'db' => 'sertifikat_stwc', 'dt' => 0 ),
		array( 'db' => 'no_sertifikat',  	 'dt' => 1 ),
		array( 'db' => 'place_issue',  'dt' => 2 ),
		//array( 'db' => 'date_issue',  	'dt' => 3 ),
		array(
			'db'        => 'date_issue',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return date( 'jS M y', strtotime($d));
			}
		),
		);
	
		// SQL server connection information
		$sql_details = array(
			'user' => 'infr6975_uk2014',
			'pass' => '1-#r*fSAxuT(',
			'db'   => 'infr6975_informaseadb2014',
			'host' => 'localhost'
		);
		
	
		json_encode(
			
			$this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns)
		);
		
		
	}
	
	function get_data_competency()
	{
		$table = 'nationality';	
		$primaryKey = 'id';
	 	$columns = array(
		
		array( 'db' => 'grade_license', 	'dt' => 0 ),
		array( 'db' => 'no_license',  	   'dt' => 1 ),
		array( 'db' => 'place_issued',    'dt' => 2 ),
		//array( 'db' => 'date_issued',     'dt' => 3 ),
		array(
			'db'        => 'date_issued',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return date( 'jS M y', strtotime($d));
			}
		),
		);
	
		// SQL server connection information
		$sql_details = array(
			'user' => 'infr6975_uk2014',
			'pass' => '1-#r*fSAxuT(',
			'db'   => 'infr6975_informaseadb2014',
			'host' => 'localhost'
		);
		
		json_encode(
			$this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns)
		);
		
	}
	
	function get_data_experience()
	{
		
		
		
	}
	
}

?>