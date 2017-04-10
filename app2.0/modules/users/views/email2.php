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
    height:100px;
    margin-top:0px;
    padding:20px 20px 0px 20px;
    display:block;
    " >
      <!-- header -->
        <div style="clear:both"></div>
        <center>
          <a href="<?=base_url()?>" style="text-decoration:none;display:block; "> 
              <img src="<?=LOGO_INFORMASEA_WHITE?>" alt="informasea" style="line-height:100px" 
              title="<?=TITLE." - ".INFORMASEA_SLOGAN?>" >
              <!-- <h1 style="color:#FFF; font-size:48px"><?php//TITLE?></h1>--> 
          </a>
          <!-- <div style="color:#FFF; display:block; "><?php //INFORMASEA_SLOGAN?></div> -->
        </center>
    </div>
    
    <div style="min-height:200px;
    padding:10px 20px 10px 20px;
    ">
      <!-- body -->
        <center> <h2 style="font-size:36px; color:#337AB7"> Welcome on board !</h2> </center>
    
        <div style="line-height:20px">
          <!-- text -->
          <div> <h2> Informasea helps you to find your preferable vacantsea based on your qualification and expectation .</h2> 
            
            <ul style="line-height:20px; font-weight:bold">
              <li> build your network from our seafarers and company database </li>
                <li> complete your resume to make yourself noticeable by agentsea </li>
                <li> aplly any preferable vacantsea </li>
                <li> promote yourself to impress agentsea </li>
            </ul>
            
            </div>
          
        </div>
        
        <center>
        <a href="<?=$str_url?>" style="text-decoration:none">
          <div style="
              background-color:#337AB7;
              width:250px;
              height:50px;
              line-height:50px; 
              margin-top:50px;
              margin-bottom:50px;
          ">
              <!-- button --> 
              <h2 style="color:#FFF; vertical-align:middle">Activate Account</h2>    
          
          </div>
        </a>
        </center>
        
        <!-- info -->
        <div>
          <div>Have fun on board.</div>
            <div><b style="color:#337AB7">Informasea</b> team, </div>
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b>
            
            <p>This Email was sent to <b><?=$email?></b> from 
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b> 
            in accordance with 
            <a href="<?=base_url("our_policy")?>" style="text-decoration:none">our policy</a> </p>
            
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