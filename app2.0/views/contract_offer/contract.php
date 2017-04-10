<?php 
	// $rule = "<ol><li>informasea.com membantu $dt_contract[nama_perusahaan] dengan cara mem-posting lowongan di informasea.com atas nama $dt_contract[nama_perusahaan].</li><li>Lowongan yang di-posting di informasea.com hanya lowongan yang telah $dt_contract[nama_perusahaan] buat di gotoseajobs ataupun job portal crewing lainnya.</li><li>informasea.com akan melakukan marketing untuk lowongan tersebut melalui social media yang ada (facebook, twitter, linkedin, g+)</li><li>$dt_contract[nama_perusahaan] dapat memantau applicant yang telah melamar lowongan tersebut dengan mengakses informasea.com ataupun melalui email.</li><li>$dt_contract[nama_perusahaan] dapat langsung melihat CV dan resume pelamar melalui informasea.com dan dapat dengan mudah melakukan validasi sertifikat.</li><li>Penawaran ini tidak dipungut biaya demi meningkatkan kebermanfaatan informasea.com sebagai komunitas pelaut dan job portal</li></ol>";
	// $rule_to_ckEditor = htmlentities($rule);
$rule = $dt_contract['content'];
$rule_to_ckEditor = preg_replace( "/\r|\n/", "", $rule);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contract Offer</title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
		<div style="
	margin:0 auto; 
	margin-top: 30px;
	margin-bottom: 50px;
	padding:0; 
	font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;
	width:80%;
	font-size:14px; 
	border:1px solid black; ">
		<!-- Header -->
		
	    <?php include_once 'header_templates.php'; ?>
	    <!-- End Header -->

	    <div style="min-height:200px;
	    padding:10px 20px 10px 20px;
	    ">
	    	<!-- body -->
	        <!-- <center> 
	        	<h2 style="font-size:36px; color:#337AB7"> Hello Seatizen !</h2>
	        	<h4 style="font-size:24px; color:#337AB7; margin-top:-30px;"> Find your preferable vacantsea and networking with seafarers or agentsea. </h4> 
	        </center> -->
	        
	        <br>
	        <br>
	        <br>
	        <div style="line-height:20px; font-size:16px;"> 
	        <!-- <form id="frm-contract-nego"> -->
	        	<div id="frm-nego">
	        	<p><b style="font-size:18px; color:#337AB7;" > Yth <?=$dt_contract['nama_pic']?> </b></p>
	            <br>
	            <p> di Tempat </p>
	            <p>Semoga email ini menemui anda dalam keadaan sehat. Aamiin</p>
	            <br>
	            <p>Kami dari tim informasea.com berharap dapat membantu para pelaut untuk menemukan pekerjaan dan juga memfasilitasi manning agent untuk menemukan kandidat crew yang tepat dan kompeten.</p>
	            <br>
	            <p>Berdasarkan pantauan saya di gotoseajobs.com terkait kebutuhan crew <?php echo $dt_contract['nama_perusahaan'] ?>, saya ingin menawarkan kerjasama antara informasea.com  dengan <?php echo $dt_contract['nama_perusahaan'] ?></p>
	            <br>
	            <p>Mengingat bahwa <?php echo $dt_contract['nama_perusahaan'] ?> sendiri telah memiliki akun di informasea.com, maka penawaran minimal yang dapat kami ajukan sebagai berikut :</p>
	            <br>
	            <?php if(isset($agree)){ echo $rule ?>
	            
	            <?php }else{
	            	?>
	            	<div class="form-group">
	            		<textarea name='rule_kerjasama' class='form-control' id="rule_kerjasama"></textarea>
	            	</div>
	            	<input type="hidden" id="isi_kerja_sama">
	            	<?php
	            } ?>
	            <br>
	            <br>
	            <p>Kami yakin dapat memberikan <?php echo $dt_contract['nama_perusahaan'] ?> lebih banyak pilihan dalam proses hiring crew sehingga <?php echo $dt_contract['nama_perusahaan'] ?> memiliki peluang yang lebih besar untuk menemukan crew yang kompeten.</p>
	            <br>
	            <p>Saya harap dapat mendengar respon baik dari <?php echo $dt_contract['nama_pic'] ?> sehingga bisa kita diskusikan lebih lanjut untuk pembuatan kontraknya.</p>
	            <br>
	            <br>
	            <br>
	            <!-- <span style="text-align:right"> -->
	                <p>Salam Sukses</p>
	                <br>
	                <br>
	                <br>
	                <br>
	                <p>Rifal Qori Kurniawan</p>
	                <p>Founder Informasea.com</p>
	            <!-- </span> -->
	            <!-- <ul style="line-height:20px; list-style-type:lower-alpha; ">
	            	<li> 
	                	<div><b style="color:#337AB7; font-size:18px;"> Find preferable job </b> </div> 
	                    
	                    <div> Apply any vacantsea based on your qualification. </div>
	                    <div> After apply, you can monitor your status, got accepted or rejected. </div> 
	                    <div>&nbsp;</div>
	                </li>
	                <li> 
	                	<div><b style="color:#337AB7; font-size:18px;"> Impressive Resume </b></div> 
	                    
	                    <div> Keep your resume up to date! </div>
	                    <div> Agentsea will be able to view your complete resume after applying the vacantsea. </div> 
	                    <div> upload all your scan certified and apprisal / performance report. </div>
	                    <div> only agentsea with applied vacantsea can view your complete resume. </div>
	                    <div>&nbsp;</div>
	                </li>
	                <li> 
	                	<div><b style="color:#337AB7; font-size:18px;"> Networking with other seatizen or agentsea  </b></div> 
	                    
	                    <div> chat and get connected with all your colleague. </div>
	                    <div> Agentsea will be able to view your complete resume after applying the vacantsea. </div> 
	                    <div> Chat with any preferable agentsea. </div>
	                   
	                    <div>&nbsp;</div>
	                </li>
	                
	            </ul> -->
	            <br>
		        <br>
		        <br>
		        <center>
		        <?php //if(isset($id_contract)) $tambahan = "$id_contract/$token"; else $tambahan = ""; ?>
		        <!-- <a href="#" style="font-size: 13pt; color: #ffffff; width: 50%; background-color: #3399ff; padding: 15px 40px 15px 40px; text-decoration : none">Negotiable</a> -->
		        <?php if(isset($agree)){ ?>
		        <button style="font-size: 13pt; color: #000000; width: 50%; background-color: #66ff66; padding: 15px 40px 15px 40px; text-decoration : none">Print and Send</button>
		        <?php }else{
		        	?>
		        	<button id="save-update" class="btn btn-primary" style="font-size: 16pt;">Save and Show Contract</button>
		        	<?php
		        } ?>
		        </center>
	            </div>
	            <div id="form-fix"></div>
	        <!-- </form> -->
	        </div>
	        
	        <br>
	        <br>
	        <br>
	        <!-- <center>
	        	<?php //include "list-template-agentsea.php";?>
	        </center> -->
	        
	        <?php //include ("email_info.php") ?>
	        
	    
	    </div>
	    <?php //include "footer_email_template.php" ?>
		
	</div>
	<script type="text/javascript" src="<?php echo asset_url('js/jquery-1.11.2.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset_url('bootstrap/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset_url('plugin/ckeditor/ckeditor.js') ?>"></script>
	 <script>
	 $("#frm-nego").hide();
	 <?php 
	 	if(isset($agree)) echo "show_agree_form();\n";
	 	else echo "show_negotiate_form();\n";
	  ?>

	function show_negotiate_form() {
		// body...
		$("#frm-nego").show();
	}
	 function show_agree_form() {
	 	// body...
	 	var data = "agree=1&x=1&id=<?php echo $dt_contract['id_contract'] ?>";
	 	$.ajax({
	 		type: "POST",
	 		data: data,
	 		url : "<?php echo base_url('contract/show_agree_form') ?>",
	 		success:function(output){
	 			fill_and_show(output);
	 		}
	 	});
	 }



	 function fill_and_show(content) {
	 	// body...
	 	$("#form-fix").html(content);
        $("#frm-nego").hide('fast');
        $("#form-fix").show('fast');
	 }
	 $("#save-update").click(function(){
	 	var ec = CKEDITOR.instances.rule_kerjasama.getData(); // CKEDITOR.instances.editor1.getData();
           $("#isi_kerja_sama").val(ec);
           var data = "x=1&id=<?php echo $dt_contract['id_contract'] ?>&klausul="+$("#isi_kerja_sama").val();
           $.ajax({
           		type:"POST",
           		url : "<?php echo base_url('contract/preview_contract') ?>",
           		data: data,
           		success:function (output) {
           			fill_and_show(output);
           		}
           })
	 })
        var editor = CKEDITOR.replace( 'rule_kerjasama' )/*.on( 'instanceReady', function( evt ) {
                evt.editor.insertText(<?php //echo $rule_to_ckEditor ?>)*/;
                editor.on('instanceReady', function (evt) {
                	evt.editor.insertHtml('<?php echo $rule_to_ckEditor ?>');
                })
    </script>
</body>
</html>