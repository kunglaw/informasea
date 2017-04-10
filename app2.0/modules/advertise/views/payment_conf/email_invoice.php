<?php 
  $due_intr = "2 hours";
  
  $create_date= $order['create_date'];
  
  $effectiveDate = strtotime("+".$due_intr, strtotime($create_date));
  
  $due_date = date("Y-m-d H:i:s",$effectiveDate);
  $data["base_url"] = "https://www.informasea.com/infrasset/img/asset_email"; //img
?>


<body style="background-color:#eeebeb;">
<center><a href='<?=base_url()?>'><img src="<?=LOGO_INFORMASEA_BIG?>"></a></center>
<br>
<div class="z-depth-1 wrapper">
  <div class="">
      <div class="invoice-box" style="padding: 10px;border: 1px solid #eee;box-shadow: 0 0 5px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;width: 45%;margin-left: auto;margin-right: auto;background-color: #FFF;">
      	  
          <center> 
          	<h2> Thanks  </h2> 
          	
          </center>
      	  
          <span>you already requested an Ad in <a href="<?=base_url()?>"><b>Informasea.com</b></a></span>
            <span> Please Confirm the payment after you Transfer the payment in accordance with the Bank listed </span>
          
          <hr>
          
          <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
              <tr class="top">
                  <td colspan="2" style="padding: 5px;vertical-align: top;">
                      <table style="width: 100%;line-height: inherit;text-align: left;">
                          <tr>
                          	  
                              <td class="ffff" style="padding: 5px;vertical-align: top;padding-bottom: 20px;">

                                  <b> <span class="header1" style="width: 100px;float: left;">Invoice #</span><span class="row1" style="width: 200px;">:
								  <?=$order["id_ad"]?> </span></b><br>
                                  <b> <span class="header1" style="width: 100px;float: left;">Created</span><span class="row1" style="width: 200px;">: 
                                  <?=$create_date?> </span></b><br>
                                  <b> <span class="header1" style="width: 100px;float: left;">Due</span><span class="row1" style="width: 200px;">: 
								  <?=$due_date?> (<?=$due_intr?>)</span></b>
                              </td>
                              
                              <td class="information" style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">
                                  <?=$user_ad["name"]?> .<br>
                                             
                                  <?=$user_ad["email"]?>             
                              </td>
                              
                              
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr class="heading">
                  <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                      Payment Method
                  </td>
                  
                  <!-- <td>
                      Check #
                  </td> -->
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
                  </td> -->
              </tr>
              
              <tr class="heading">
                  <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                      Item
                  </td>
                  
                  <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                      Price
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
                     Area : <?=$area["title"]?> for <?php echo "(".$diff->format("%m months").")";?>               
                  </td>
                  
                  <td class="subtotal" style="font-size: 18px;padding: 5px;vertical-align: top;text-align: right;border-bottom: none;">
                     <?=$area["currency"]." ".number_format($area["price"] * $month)?>                  
                  </td>
              </tr>       
             
              
              <tr class="total" style="font-size: 18px;color: #6C0;">
                  
                  
                  <td colspan="2" align="right" style="padding: 5px;vertical-align: top;">
                     Total: <span class="total">IDR <?=number_format($total["total"])?></span>
                  </td>
              </tr>
              
              <tr>
              	 <td colspan="2" align="center" style="padding: 5px;vertical-align: top;">
                 
                    <a href="<?=base_url("advertise/payment_confirmation/?id_order=$order[id_ad]")?>" target="_blank" class="btn-link" style="background-color: #3093E4;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px; ">
                          <b>Confirm </b>
                      
                    </a>
                 </td>
              </tr>
              
          </table>
          
          
      </div>
      <div style="width:46%; margin-left:auto; margin-right:auto; box-shadow: 0 0 5px rgba(0, 0, 0, .15); border: 1px solid #eee;">
      	<?php $this->load->view("template_email2016/footer",$data);?>
      </div>
  </div>
</div>
<br>
</body>

<center> <a href="<?=base_url("advertise/test/?id_order=OAD011220001&send")?>"> Send email </a> </center>
