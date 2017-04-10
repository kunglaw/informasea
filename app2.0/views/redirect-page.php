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
width:50%;
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
          	  <img src="<?=LOGO_INFORMASEA_BIG?>" alt="informasea" style="line-height:100px" 
              title="<?=TITLE." - ".INFORMASEA_SLOGAN?>" >
              <!-- <h1 style="color:#FFF; font-size:48px"><?=TITLE?></h1>--> 
          </a>
          <div style="color:#FFF; display:block; "><?=INFORMASEA_SLOGAN?></div>
        </center>
    </div>
    
    <div style="min-height:200px;
    padding:10px 20px 10px 20px;
    ">
    	<!-- body -->
        <!-- <center> <h2 style="font-size:36px; color:#337AB7"> Welcome on board !</h2> </center> -->
		
        <center>
        <div style="line-height:20px">
        	<p> please wait a moment , we will redirecting ....  </p>
        	
            <p> If this page doesn't redirecting please <a href="<?=$redirect?>">click here</a> </p>
        </div>
        </center>
        
        
        <!-- info -->
        <div>
        	
        </div>
        
    
    </div>
    <div style="background-color:#CCC; height:30px; line-height:30px;
    padding:10px 20px 10px 20px; display:block">
    	<!-- footer -->
     
        <b style="float:left"> <a href="<?=base_url("about")?>" style="text-decoration:none"> About </a> </b>
        <span style="float:right"> copyright @ 2014 - <?=WEBSITE?> . All right reserved </span>
        
        
    </div>
	
</div>