<?php // new email activation code for agentsea ?>
<!-- 
bg-primary : #337AB7
bg-success: #DFF0D8
bg-info   : #D9EDF7
bg-warning : #FCF8E3
bg-danger: #F2DEDE
-->

    <div>
    	<!-- body -->
        <center> <h2 style="font-size:36px; color:#337AB7"> Welcome on board !</h2> </center>
		
        <div style="line-height:20px">
        	<p>Dear Mr/Mrs <?=$contact_person?> , Your company  have been registered at <?=TITLE?>.</p>
            <p> You can login by our <b>login form </b> in the future using : </p>
        	<div>
            	<ul style="line-height:20px; font-weight:bold">
                	<li> Username: <?=$username?></li>
                	<li> Password: <?=$password?></li>
                </ul>
            </div>
            <div> you should changed the password Immediately </div>
            
        </div>
        
	
</div>