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
        <center> <h2 style="font-size:36px; color:#337AB7"> Hi <?php echo $nama; ?> !</h2> </center>
    
        <div style="line-height:20px">
          <!-- text -->
          <div> <p>

            Your resume is not complete&nbsp; please complete your resume for get bla blab alb alb albbla blab bla blab Your resume is not complete&nbsp; please complete your resume for get bla blab alb alb albbla blab bla bla

           </p>
           <p> if your resume is complete you can&nbsp; : </p>
<ul>
  <li>ini list1</li>
  <li>ini list 2</li>
  <li>ini list 3</li>
  <li>dan seterusnya</li>
</ul>
if you bla bla bla click <a href="http://informasea.com/seaman/resume" target="_blank">here </a>for complete your resume<br>
for your attention .. thank you
  
                  <p>Thank You,<br> 
            
            </div>
          
        </div>
   
        
        <!-- info -->
        <div>
          <div>Have fun on board.</div>
            <div><b style="color:#337AB7">Informasea</b> team, </div>
            
            <p>This Email was sent to <b><?=$email_to?></b> from 
            in accordance with 
            <a href="<?=base_url("our_policy")?>" style="text-decoration:none">our policy</a> </p>
            
            <p>* please, do not reply any kind of message to this email </p>
        </div>
        
    
    </div>
    <div style="background-color:#CCC; height:30px; line-height:30px;
    padding:10px 20px 10px 20px; display:block">
      <!-- footer -->
     
        <b style="float:left"> <a href="<?=base_url("about")?>" style="text-decoration:none"> About </a> </b>
        <span style="float:right"> copyright @ 2014 - <?=WEBSITE?> . All right reserved </span>
        
        
    </div>
  
</div>