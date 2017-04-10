<?php 
  
  $data["base_url"] = "https://www.informasea.com/infrasset/img/asset_email"; //img
  
  $status = $order["status"];
  $paid_status = $order["paid_status"];
  
  if($status == "on")
  {
	  $status_e = " <i style='color:#9F0'> ACTIVE ( ON AIR ) </i>";
	  $header   = "<h1 align='center' style='color:#9F0'> Thanks for Confirmation </h1>";
	  $header_txt = "<h4> Your Ad has been Activate, your Ad will be ON AIR based on Start Date </h4> ";
  }
  else
  {
	  if($paid_status == "pending_confirm")
	  {
		$status_e = "Pending Confirm";  
	  }
	  else
	  {
		$status_e = $paid_status;  
	  }
	  
	  $header   = "<h2 align='center'> Thanks for Confirmation </h2>";
	  $header_txt = "Thanks for the Confirmation, you can track your Ad status for using No. Order <b> $order[id_ad]</b>. <br>";
	  
  }
  
?>
  <?=$header?>
  <p align="center"> 
    <?=$header_txt?>
    You can request another ad by Clicking "Request Ad" button 
  </p>
<br>
<div class="z-depth-1 wrapper">
  <div class="">
      <div class="invoice-box" style="padding: 10px;border: 1px solid #eee;box-shadow: 0 0 5px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;width: 55%;margin-left: auto;margin-right: auto;background-color: #FFF;">
      	  
          <h3>Ad Status : <?=$status_e?></h3>
      	  <?php 
		  	$size = $area["size"];
			$se = explode(" x ",$size);
			
			$width = $se[0];
			$height = $se[1];
			
		  ?>
          <center>
          <img src="<?=base_url("infrasset/advertise/$order[media]")?>" width="<?=$width?>" height="<?=$height?>" >
          </center>
          
          <hr>
          
          <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
              <tr class="top">
                  <td colspan="2" style="padding: 5px;vertical-align: top;">
                      <table style="width: 100%;line-height: inherit;text-align: left;">
                          <tr>
                          	  
                              <td class="ffff" style="padding: 5px;vertical-align: top;padding-bottom: 20px;">

                                  <b> <span class="header1" style="width: 100px;float: left;">Invoice #</span><span class="row1" style="width: 200px;">:
								  <?=$order["id_ad"]?> </span></b><br>
                                  <b> <span class="header1" style="width: 100px;float: left;">Name</span><span class="row1" style="width: 200px;">: 
                                  <?=$user_ad["name"]?> </span></b><br>
                                  <b> <span class="header1" style="width: 100px;float: left;">Email</span><span class="row1" style="width: 200px;">: 
								  <?=$user_ad["email"]?></span></b>
                              </td>
                              
                              <td class="information" style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">&nbsp;
                                
                                             
                                              
                              </td>
                              
                              
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <!-- <tr class="heading">
                  <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                      Payment Method
                  </td>
                  
                  <!-- <td>
                      Check #
                  </td>
              </tr>
              
              <tr class="details">
                  <td style="padding: 5px;vertical-align: top;padding-bottom: 20px;">
					 <?php
					 	if($order["purpose_bank"] == "Mandiri")
						{
							$no_rekening = MANDIRI;	
							$an = MANDIRI_AN;
						}
						else if($order["purpose_bank"] == "BCA")
						{
							$no_rekening = BCA;	
							$an = BCA_AN;
						}
						else if($order["purpose_bank"] == "BRI")
						{
							$no_rekening = BRI;
							$an = BRI_AN;	
						}
					 ?>
                     <b> <?=$order["purpose_bank"]?> Transfer ( <?=$no_rekening?> a/n <?=$an?>) </b>                  </td>
                  
                  <!-- <td>
                      1000
                  </td> 
              </tr> -->
              
              <tr class="heading">
                  <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                      Detail Ad
                  </td>
                  
                 
              </tr>
              
              <!-- <tr class="item">
                  <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">
                      Page: <?=$page["page"]?>                
                  </td>
                  
                  <td class="subtotal" style="font-size: 18px;padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
                      <?=$page["currency"]." ".number_format($page["price"])?>                  
                  </td>
              </tr> -->
              
               <tr class="item last">
               	  <?php
				  	$date1 = date_create($order["start_date"]);
					$date2 = date_create($order["expired_date"]);
					$diff = date_diff($date1,$date2);
					
					$month =  $diff->format("%m");
					    
					//$total_periode = $month * $periode["price"];
				  ?>
                  <td style="padding: 5px;vertical-align: top;border-bottom: none;">
                     <b> Area : <?=$area["title"]?> for <?php echo "(".$diff->format("%m months").")";?> </b>             
                  </td>
                  
                 
              </tr>       
             
              
           
              
              
              
          </table>
          
          
      </div>
      
     
      
  </div>
</div>

<br>

<center>
 <a href="<?=base_url("advertise")?>" target="_blank" class="btn-link" style="background-color: #3093E4;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px; ">
                          <b> << Request Ad </b>
                      
                    </a>
</center>                  
                    <br>



