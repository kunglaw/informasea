<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  	
	$css = !empty($css) ? $css : ""; // tambahan css 
	$data['css'] = $css;
	
	$this->load->view('head.php',$data);
	$this->load->view('javascript');
	 
  ?>
</head>

<body>
<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>

<h2> Welcome to Informasea </h2>
<hr />
<ul>
	<li><a href="<?php base_url("home/bootswatch"); ?>">home</a></li>
    <li><a href="#">profile</a></li>  
</ul>
<hr class="clear" />

<p> Percobaan pengiriman data melalui AJAX </p>
<form action="" method="post" >
	<input name="upload_path" value=""/>
	<input type="button" value="submit" id="btn"/>

</form>

<span id="info">


</span>

<hr />

<?php
  
  /*$begin = new DateTime( '2012-08-01' );
  $end = new DateTime( '2012-08-31' );
  $end = $end->modify( '+6 month' );
  
  $interval = new DateInterval('P1D');
  echo $interval."<br>"; 
  $daterange = new DatePeriod($begin, $interval ,$end);
  
  /*foreach($daterange as $date){
	  echo $date->format("Y-m-d") . "<br>";
  }
  */
?>

<hr />



</body>
</html>