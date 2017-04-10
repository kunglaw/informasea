<style>
    .invoice-box{
 		
		padding:10px;
        /* border:1px solid #eee; */
        /* box-shadow:0 0 10px rgba(0, 0, 0, .15); */
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
</style>

<?php 
	
	$no_order = $_GET['id_order'];
	
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
                          	  
                              <td>
                                  Invoice #:<?=$order["id_ad"]?> <br>
                                  Created: <?=date_format(date_create($order['create_date']),"M d, Y H:i:s")?><br>
                                  Due: <?=date_format(date_create($order['create_date']),"M d, Y H:i:s")?>
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
                              <td>
                              	&nbsp;
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
              
              <tr class="item">
                  <td>
                      Website design
                  </td>
                  
                  <td>
                      $300.00
                  </td>
              </tr>
              
              <tr class="item">
                  <td>
                      Hosting (3 months)
                  </td>
                  
                  <td>
                      $75.00
                  </td>
              </tr>
              
              <tr class="item last">
                  <td>
                      Domain name (1 year)
                  </td>
                  
                  <td>
                      $10.00
                  </td>
              </tr>
              
              <tr class="total">
                  <td></td>
                  
                  <td>
                     Total: $385.00
                  </td>
              </tr>
          </table>
      </div>
      
  </div>
</div>