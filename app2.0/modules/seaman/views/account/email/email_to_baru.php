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
        <center> <h2 style="font-size:36px; color:red"> Primary email has been changed </h2> </center>
    
        <div style="line-height:20px">
          <!-- text -->
          <h2> Hi <?=$this->session->userdata('username'); ?> </h2>

          <div> <h2> Your primary email has been changed on <?php echo date('Y-m-d H:i:s'); ?>
          </h2> 
            
            <br>
            <h3> <strong> Don't recognize this activity ? </strong> </h3>

            <h3> Click <a href="#"> here </a> for more information on how to recover   your account </h3>
        
            
            </div>
          
        </div>
        <br>
        <h4> <a href="http://informasea.com" target="_blank"> Informasea.com </a> team. <br>
          info@informasea.com </a> </h4>
        
        
    
    </div>
    <div style="background-color:#CCC; height:30px; line-height:30px;
    padding:10px 20px 10px 20px; display:block">
      <!-- footer -->
     
        <b style="float:left"> <a href="<?=base_url("about")?>" style="text-decoration:none"> About </a>
          <a href="<?=base_url('our-policy');?>"> privacy policy </a>
         </b>
        <span style="float:right"> copyright @ 2014 - <?=WEBSITE?> . All right reserved </span>
        
        
    </div>
  
</div>