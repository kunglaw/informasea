<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('head')?>
<title><?php //echo $title ?></title>
<?php
	
	echo $isi."<br>"; 
?>
</head>

<body>
<?php
	// query untuk menampilkan data user 1 ( dimas ) 
	
	$p = $this->db->query("select * from pelaut_ms where pelaut_id = 1");
	$data = $p->row_array();

?>
	<div class="user-title"> daftar teman
    <?php 
		// tampilkan nama user 1
		echo $data['nama_depan']." ".$data['nama_belakang']
	?>
    </div>
    
	<ul id="member" class="">    
    <?php
		
	//$dt = $this->db->query("select * from pelaut_ms where");
		$array_teman = $data['array_teman'];
		
		if(!empty($array_teman))
		{
			$array_teman2 = explode(",",$array_teman);
			foreach ($array_teman2 as $key => $value)
			{
				
				  $kk = $this->db->query("select * from pelaut_ms where pelaut_id = '$value' LIMIT 1");
				  $rw = $kk ->row_array();
				if(!empty($rw))
				{  
				  echo "<li id='list-$rw[pelaut_id]' >";
				  
				  echo "<a href='#'>$rw[nama_depan] $rw[nama_belakang]</a></li>";
				}
				else
				{
					echo "<li> unknown user </li>";	
				}
				
			}
			
		}
		else
		{
			echo "<li class='user-title'> belum memiliki teman</li>";
			
		}
		
	?> 
    </ul>
</body>
</html>