<?php
$session_data = $this->session->userdata('logged_in');
?>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="profile">
            <?php
            echo "Hello <b id='welcome'><i>" . $session_data['username'] . "</i> !</b>";
            echo "<br/>";
            echo "<br/>";
            echo "Welcome to Admin Page";
			
			$session_set_value = $this->session->all_userdata();
			if($session_set_value['remember_me'] == 1)
			{
				echo "<p> REMEMBER ME : <b> ACTIVE / $session_set_value[remember_me]  </b> </p>";
			}
			else
			{
				echo "<p> REMEMBER ME : $session_set_value[remember_me] </p>";	
			}
            ?>
            
            <pre>
				
				<?php print_r($session_set_value); ?>
			</pre>
            
        </div>
        <b id="logout"><a href="logout">Logout</a></b>
    </body>
</html>
