<style>
	#third-section{
		
		/* max-height:480px; */
		
	}
	
	#third-section .row{
		
		/* height:90px; */
		
	}
	
	#third-section #ul li div #nat img{
		width:16px !important;
		height:16px;
	}
	
	#third-section #agentsea-list{
		
		border:1px solid-black;
		
	}
	
	#third-section #agentsea-list h2{
		
		text-transform:uppercase;
		margin-bottom:30px;	
			
		
	}
	
	#third-section #agentsea-list ul{
		
		text-transform:uppercase;
		list-style-type:none;
		text-decoration:none;
		margin-left:-40px;	
			
		
	}
	
	#third-section #agentsea-list ul li{
		
		margin-bottom:10px;
		
	}
	
	#third-section #agentsea-list ul li img#aaaz{
		
		
		text-transform:uppercase;	
		width:59px;
		height:62px;
		float:left;
		
		background-color:#3093e4;
			
		
	}
	
	#third-section #agentsea-list ul li div{
		
		text-transform:uppercase;	
		margin-left:10px;
		
		margin-left:20px;
		float:left;
			
		
	}
	
	#third-section #agentsea-list ul li div span{
		
		display:block;
			
		
	}
	
	#third-section #seatizen-list{
		
		
			
	}
	
	#third-section #seatizen-list ul{
		
		list-style-type:none;
		text-decoration:none;
		margin-left:-40px;
			
	}
	
	#third-section #seatizen-list h2{
		
		text-transform:uppercase;
		margin-bottom:30px;	
			
		
	}
	
	#third-section #seatizen-list ul li{
		
		margin-bottom:10px;
			
	}
	
	#third-section #seatizen-list ul li #nat span{
		
		float:left;
			
	}
	
	#third-section #seatizen-list ul li #nat img{
		
		float:left;
		margin-right:10px;
			
	}
	
	#third-section #seatizen-list ul li #nat a{
		
		color:#FFF;
			
	}
	
	#third-section #seatizen-list ul li img#aaa{
		
		text-transform:uppercase;	
		width:59px;
		height:62px;
		float:left;
		
		background-color:#3093e4;
			
	}
	
	#third-section #seatizen-list ul div{
		
		
		margin-left:10px;
		/* margin-bottom:40px; */
		margin-left:20px;
		float:left;
			
	}
	
	#third-section #seatizen-list ul span{
		text-transform:capitalize;
		display:block;
		
	}

	#contactdepan {
		color:white;
	}

	.col-sm-10 #contactdepan {
		width:5%;
	}

	@media screen and (max-width: 1000px){
		.text-center{
			text-align: left;
		}

		#agentsea-list {
			float:left;
		}

		#seatizen-list{
			float:right;
		}
	}

</style>
<div id="third-section" class="container-fluid landing-container" style="background-color:#207EC8">
    	<div class="row block">
        	<div class="pull-left col-md-4 col-sm-6" id="agentsea-list">
            
            	<h2 class="text-white"> Latest Agentsea </h2>
                <ul>
                <?php
					$this->load->model("company/company_model","cm");
					$where = " WHERE activation_code = 'ACTIVE' and tampil = 1 ORDER BY a.id_perusahaan DESC LIMIT 4";
					$agentsea_list = $this->cm->get_company($where)->result_array();
					
					
				?>
                <?php foreach($agentsea_list as $row ){ 
						$path_img = check_logo_agentsea_thumb($row["username"]);
				?>
                	<li>
                    	<a class="text-white" href="<?=base_url("agentsea/$row[username]/home")?>" >
                        	<img src="<?=$path_img?>"  id="aaaz"></a>
                            
                        <div class="text-white">
                        	<span>
								<a class="text-white" href="<?=base_url("agentsea/$row[username]/home")?>"><?=$row['nama_perusahaan']?></a>
                            </span> 
                            <span id="nat"> <?=flag_nationality($row['id_nationality'])?> </span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                <?php } ?>
                </ul>
                
                <a class="btn btn-filled" href="<?=base_url("agentsea")?>"> View More </a>
                
            </div>
            
            <div class="pull-left col-md-4 col-sm-6" id="seatizen-list">
            	<h2 class="text-white"> Latest Seatizen </h2>
                <ul>
                <?php
					$this->load->model("seatizen/seatizen_model","sm");
					$this->load->model("seaman/resume_model","rm");
					//$where = " WHERE activation_code = 'ACTIVE' ORDER BY id_perusahaan DESC LIMIT 5";
					$seatizen_list = $this->sm->list_seatizen_panel(4);
					
					
				?>
                <?php foreach($seatizen_list as $rowi ){ 
						
						$path_img = check_profile_seaman($rowi["username"]);
						$profile_resume = $this->rm->get_profile_resume($rowi['pelaut_id']);
				?>
                	<li>
                    	<a class="text-white" href="<?=base_url("profile/$rowi[username]")?>" >
                        	<img src="<?=$path_img?>" id="aaa">
                        </a>
                        <div class="text-white">
                        	<span >
                            	<a class="text-white" href="<?=base_url("profile/$rowi[username]")?>"><?=$rowi['nama_depan']." ".$rowi["nama_belakang"] ?></a>
                            </span>
                            <i class="clearfix"></i> 
                            <span id="nat"><?=flag_nationality($rowi["kebangsaan"])?></span>
                            <i class="clearfix"></i>
                            <span id="nat">
								<?=format_rank($profile_resume['rank']);?>
                            </span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                   
            	
                <?php } ?>
                </ul>
                
                <a class="btn btn-filled" href="<?=base_url("seatizen")?>"> View More </a>
                
            </div>

            <div class="col-md-4 col-sm-10 col-xs-12" id="contactdepan"> 

            	<h2 class="text-white text-center"> CONTACT US </h2>
    			
        <form role="form" action="<?php echo base_url("home/send_mail_depan")?>" method="post">

            <div class="form-group">
                <!-- <label for="">Name: </label> --> 
                <input type="text" class="form-control" id="name" name="nama" placeholder="Name" required>

            </div>

            <div class="form-group">
                <!-- <label for="">Email:
                <span style="font:10px;font-weight:lighter;color:#CCC">(Your email address will not be published) </span>
                </label> -->
                <input type="text" class="form-control" id="email" name="email" placeholder="Email (Your email address will not be published)" required>

            </div>

            <div class="form-group">
                <!-- <label for="">Subject: </label> -->
                <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" required>

            </div>

            <div class="form-group">
                <!-- <label for="">Message: </label> -->
                <textarea class="form-control" id="password" name="message" cols="10" rows="1" style="resize:none;" placeholder="Message" required> </textarea>

            </div>
                         <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div>

            <br>

            <div class="form-group">

                <button type="submit" name="" style="margin-top:-5px" class="btn btn-filled"> Send </button>

            </div>

            <br>

            	  <?php if(!empty($info['email']) || !empty($info['nama']) || !empty($ve)){ ?>
           <div style="margin:0px 0 0px 0" class="alert alert-warning row">
           <?php // nilai variabel ini dari users/register.php ?>
             <p> <div id="" class="glyphicon glyphicon-exclamation-sign">

             </div> Error </p>

             <div class="">
                <?php //echo validation_errors(); ?>
                <?php echo $ve; ?>
             </div>

             <?php if(!empty($info['email'])){ ?>
                <div>
                    <?php echo $info['email']; ?>
                </div>

             <?php } ?>
             <?php if(!empty($info['nama'])){ ?>
                <div>
                    <?php echo $info['nama']; ?>
                </div>

             <?php } ?>


          </div><br />
          <?php }
            else if ( !empty($success) )
            {
                echo $success;

            }?>
        <br><br><br><br><br>
        </form>


            </div>


            
            <span class="clearfix"></span>
        </div>
    </div>