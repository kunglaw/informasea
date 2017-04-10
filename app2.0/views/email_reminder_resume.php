

        <div style="line-height:20px">

          <!-- text -->

          <div> <p style="font-size: 12pt;">

            Hello <b><?php echo $nama ?></b>

            <br>

            <?php if($two_months) echo "It has been a while since your last login.";

                  else echo "Other seatizen has update and complete their resume for getting best job offers. ";

             ?>

          

            <br>

            <br>

            Our system notice that your resume has not completed yet.

            <br>

            <br>

            Complete your resume by clicking this button below or send us your CV and our team will do it for you.



           </p>

           <!-- <p> if your resume is complete you can&nbsp; : </p>

<ul>

  <li>ini list1</li>

  <li>ini list 2</li>

  <li>ini list 3</li>

  <li>dan seterusnya</li>

</ul>

if you bla bla bla click <a href="http://informasea.com/seaman/resume" target="_blank">here </a>for complete your resume<br>

for your attention .. thank you

  

                  <p>Thank You,<br>  -->

                  <br>

                  <br>

            <center><a href="<?php echo BASE_URL."/seaman/resume" ?>" style="background-color:#f5774e;color:#ffffff;display:inline-block;font-family:'Source Sans Pro', Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:45px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">View Resume</a></center>
				
            </div>

          

        </div>

  		<br>
		
        <?php include "list_data_email/list-template-seatizen.php"; ?>

		<br>

		<?php if($dt_vacantsea != null){ ?>


		<?php include "list_data_email/list-template-vacantsea.php"; ?>	
 

 		<?php } ?>

        <br>

        <div style="clear:both"></div>