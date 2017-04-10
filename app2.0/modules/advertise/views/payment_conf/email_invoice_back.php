<style>
	body
	{
		background-color:#eeebeb;	
	}
	
    .invoice-box{
 		
		padding:10px;
        border:1px solid #eee;
		
        box-shadow:0 0 5px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
		width:40%;
		
		margin-left:auto;
		margin-right:auto;
		background-color:#FFF;
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
	
	.subtotal
	{
		font-size:18px;	
	}
	
	.total
	{
		font-size:18px;
		color:#6C0;	
	}
	
	.btn-link
	{
		
		background-color: #3093E4; /* blue infr */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
			
	}
</style>

<?php 
  $due_intr = "2 hours";
  
  $create_date= $order['create_date'];
  
  $effectiveDate = strtotime("+".$due_intr, strtotime($create_date));
  
  $due_date = date("Y-m-d H:i:s",$effectiveDate);
?>
<center><img src="<?=LOGO_INFORMASEA_BIG?>"></center>
<br>
<div class="z-depth-1 wrapper" >
  <div class="">
      <div class="invoice-box">
      	  
          <center > 
          	<h2> Thanks  </h2> 
          	
          </center>
      	  
          <span>you already requested an Ad in Informasea.com</span>
            <span> Please Confirm the payment after you Transfer the payment in accordance with the Bank listed </span>
          
          <hr>
          
          <table cellpadding="0" cellspacing="0">
              <tr class="top">
                  <td colspan="2">
                      <table>
                          <tr>
                          	  
                              <td class="ffff">

                                  <b> <span class="header1">Invoice #</span><span class="row1">:<?=$order["id_ad"]?> </span></b><br>
                                  <b> <span class="header1">Created</span><span class="row1">: <?=$create_date?> </span></b><br>
                                  <b> <span class="header1">Due</span><span class="row1">: <?=$due_date?> (<?=$due_intr?>)</span></b>
                              </td>
                              
                              <td class="information">
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
                  <?php 
				  	//
				  ?>
                      Page: <?=$page["page"]?>
                  </td>
                  
                  <td class="subtotal">
                      <?=$page["currency"]." ".number_format($page["price"])?>
                  </td>
              </tr>
              
               <tr class="item last">
                  <td>
                      Area : <?=$area["title"]?>
                  </td>
                  
                  <td class="subtotal">
                      <?=$area["currency"]." ".number_format($area["price"])?>
                  </td>
              </tr>
              
              <tr class="item">
              	  <?php
				  	$date1 = date_create($order["start_date"]);
					$date2 = date_create($order["expired_date"]);
					$diff = date_diff($date1,$date2);
				  ?>
                  <td>
                      Periode : <?=date_format(date_create($order["start_date"]),"d M Y")?> -
                       <?=date_format(date_create($order["expired_date"]),"d M Y")?>
                      <?php echo  "(".$diff->format("%m months").")";?>
                  </td>
                  
                  <td class="subtotal">
                  	  <?php 
					  	//
					  	$month =  $diff->format("%m");
					    
						$total_periode = $month * $periode["price"];
						
						echo $periode["currency"]." ".number_format($total_periode);					
					  ?>
                     
                  </td>
              </tr>
              
             
              
              <tr class="total">
                  
                  
                  <td colspan="2" align="right">
                     Total: <span class="total">IDR <?=number_format($total["total"])?></span>
                  </td>
              </tr>
              
              <tr>
              	 <td colspan="2" align="center">
                 	<a>
                      <button class="btn-link">
                          <b>Confirm </b>
                      </button>
                    </a>
                 </td>
              </tr>
              
          </table>
      </div>
      
  </div>
</div>