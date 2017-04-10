<?php
	//$str_url;
	//$pelaut;
	
?>

<?php // new email activation code for agentsea ?>
<!-- 
bg-primary : #337AB7
bg-success: #DFF0D8
bg-info   : #D9EDF7
bg-warning : #FCF8E3
bg-danger: #F2DEDE
-->

<div style="
margin:0 auto; 
padding:0; 
font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; 
width:80%;
font-size:14px; 
border:1px solid black; ">
	
    <div style="
    background-color:#2ab8e7;
    margin-top:0px;
    height:100px;
    padding:20px 20px 0px 20px;
    display:block;
    " >
    	<!-- header -->
        <div style="clear:both"></div>
        <center>
          <a href="<?=base_url()?>" style="text-decoration:none;display:block; "> 
          	  <img src="<?=LOGO_INFORMASEA_WHITE?>" alt="informasea" style="line-height:100px" 
              title="<?=TITLE." - ".INFORMASEA_SLOGAN?>" >
              <!-- <h1 style="color:#FFF; font-size:48px"><?=TITLE?></h1>--> 
          </a>
          
        </center>
    </div>
    
    <div style="min-height:200px;
    padding:10px 20px 10px 20px;
    ">
    	<!-- body -->
        		
        <div style="line-height:20px">
        	<p>Hi, <?=$contact_person ?></p>
            <p>We already reset your password : </p>
            
            <p>username : <?php echo $username; ?> </p>
            <p>password : <?=$password?></p>
            
            <p>we strongly recomended to change the password after login. </p>
            
            
            
        </div>
        
        <center>
        <div style="
              background-color:#337AB7;
              width:250px;
              height:50px;
              line-height:50px; 
              margin-top:50px;
              margin-bottom:50px;
          ">
          	  <a href="<?=base_url("users/login/agentsea")?>" style="text-decoration:none">
              <!-- button --> 
              <h2 style="color:#FFF; vertical-align:middle">Login</h2>    
          	  </a>
              
          </div>
          </center>
        
        <!-- info -->
        <hr>
        <div>
        	<div>Have fun on board.</div>
            <div><b style="color:#337AB7">Informasea</b> team, </div>
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b>
            
            <p>This Email was sent to <b><?=$email_to?></b> from 
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b> 
            in accordance with 
            <a href="<?=base_url("our-policy")?>" style="text-decoration:none">our policy</a> </p>
            
            <p>* please, do not reply any kind of message to this email </p>
        </div>
        
    
    </div>
    <div style="background-color:#CCC; height:30px; line-height:30px;
    padding:10px 20px 10px 20px; display:block">
    	<!-- footer -->
     
        <b style="float:left"> <a href="<?=base_url("about")?>" style="text-decoration:none"> About </a> </b>
        <span style="float:right"> <?=COPYRIGHT?> </span>
        
        
    </div>
	
</div>