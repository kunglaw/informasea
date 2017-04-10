<?php // new email activation code for agentsea ?>



    <div>

    	<!-- body -->

        <center> <h2 style="font-size:36px; color:#337AB7">New Agentsea has been register</h2> </center>

		  <br>

        <div style="line-height:20px; font-size: 16pt">

        	<!-- text -->

        	<center>

        	<table>

          <tr>

             <td>Company Name</td>

             <td>&nbsp;:&nbsp;</td>

             <td><?php echo $company_name ?></td>

           </tr> 

           <tr>

             <td>Username</td>

             <td>&nbsp;:&nbsp;</td>

             <td><?php echo $username_company ?></td>

           </tr> 

           <tr>

             <td colspan="3">&nbsp;</td>

           </tr>

           <tr>

             <td>Email</td>

             <td>&nbsp;:&nbsp;</td>

             <td><?php echo $email_company ?></td>

           </tr> 

          </table>

          </center>

        </div>

        <br>

        <br>

        <!-- <center>

        <a href="<?php echo base_url("users/company_process/admin_decission/$idnya/approve") ?>" style="border: 1px solid black; padding :10px 30px 10px 30px; background-color: #337AB7; color: white; font-size: 16pt; cursor: pointer; text-decoration: none">Approve</a>

        <a href="<?php echo base_url('users/company_process/admin_decission/$idnya/reject') ?>" style="border: 1px solid black; padding :10px 30px 10px 30px; background-color: #d26122; color: white; font-size: 16pt; cursor: pointer; text-decoration: none">Reject</a>

          <!-- <div style="background-color:#337AB7;

              width:250px;

              height:50px; ">

                <a href="#" style="color: white; "><h3>Approve</h3></a>

              </div>



              <div style="background-color:#d26122;

              width:250px;

              height:50px; ">

                <a href="#" style="color: white; "><h3>Reject</h3></a>

              </div>

          <div style="

              background-color:#337AB7;

              width:250px;

              height:50px;

              line-height:50px; 

              margin-top:50px;

              margin-bottom:50px;

          ">

          	  <a href="<?=$str_url?>" style="text-decoration:none">

              <!-- button --

              <h2 style="color:#FFF; vertical-align:middle">Approve Account</h2>    

          	  </a>



          </div>

          <div style="

              background-color:#337AB7;

              width:250px;

              height:50px;

              line-height:50px; 

              margin-top:50px;

              margin-bottom:50px;

          ">

              <a href="<?=$str_url?>" style="text-decoration:none">

              <!-- button --

              <h2 style="color:#FFF; vertical-align:middle">Reject Account</h2>    

              </a>

              

          </div> --

        </center>-->

        
        <!-- info -->

        <!-- <div>

        	<div>Have fun on board.</div>

            <div><b style="color:#337AB7">Informasea</b> team, </div>

            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b>

            

            <p>This Email was sent to <b><?=$email_to?></b> from 

            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b> 

            in accordance with 

            <a href="<?=base_url("our_policy")?>" style="text-decoration:none">our policy</a> </p>

            

            <p>* please, do not reply any kind of message to this email </p>

        </div> -->

        <br>

        <br>


    </div>

  