
<style>
    .invoice-box{
 		
		padding:10px;
        border:1px solid #eee;
		margin-right:13px;
        box-shadow:0 0 5px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
	.ffff .header1{
		
		width:200px;
		float:left;
			
	}
	
	.ffff .row1{
		
		width:200px;
			
	}
</style>

<?php 
	$due_intr = "2 hours";
  
  $create_date= $order['create_date'];
  
  $effectiveDate = strtotime("+".$due_intr, strtotime($create_date));
  
  $due_date = date("Y-m-d H:i:s",$effectiveDate);
?>
<h2 class="center"> Invoice  #<?=$order["id_ad"]?> </h2>

<div class="row z-depth-1" >
  <div class="">
      <div class="invoice-box">
          <table cellpadding="0" cellspacing="0">
              <tr class="top">
                  <td colspan="2">
                      <table>
                          <tr>
                          	  
                              <td class="ffff">
                              
                              	<b>
                              	  <div class="row"><div class="col-md-4">Invoice #</div> <div class="col-md-7">:<?=$order["id_ad"]?></div></div>
                                  <div class="row"><div class="col-md-4">Created</div><div class="col-md-7">: <?=$create_date?></div></div>
                                  <div class="row"><div class="col-md-4">Due</div><div class="col-md-7">: <?=$due_date?> (<?=$due_intr?>) </div></div>
                                </b>
                                  <!-- <b> <div class="header1">Invoice #</div><div class="row1">:<?=$order["id_ad"]?> </div></b><br>
                                  <b> <div class="header1">Created</div><div class="row1">: <?=$create_date?> </div></b><br>
                                  <b> <div class="header1">Due</div><div class="row1">: <?=$due_date?></div></b> -->
                              </td>
                              
                              <td class="title">
                                  <img src="<?=LOGO_INFORMASEA_BIG?>" style="width:100%; max-width:300px;">
                              </td>
                              
                              
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr class="information">
                  <td colspan="2">
                      <table>
                          <tr>
                              <td>&nbsp;
                              	
                              </td>
                              
                              <td>
                                  <?=$user_ad["name"]?> .<br>
                                 
                                  <?=$user_ad["email"]?>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr class="heading">
                  <td>
                      Payment Method
                  </td>
                  
                  <!-- <td>
                      Check #
                  </td> -->
              </tr>
              
              <tr class="details">
                  <td>
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
                     <b> <?=$order["purpose_bank"]?> Transfer ( <?=$no_rekening?> a/n <?=$an?>) </b>
                  </td>
                  
                  <!-- <td>
                      1000
                  </td> -->
              </tr>
              
              <tr class="heading">
                  <td>
                      Item
                  </td>
                  
                  <td>
                      Price
                  </td>
              </tr>
              
              <!-- <tr class="item">
                  <td>
                  <?php 
				  	//
				  ?>
                      Page: <?=$page["page"]?>
                  </td>
                  
                  <td>
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
              
             
              
              <tr class="total">
                  <td></td>
                  
                  <td>
                     Total: IDR <?=number_format($total["total"])?>
                  </td>
              </tr>
          </table>
      </div>
      
  </div>
</div>