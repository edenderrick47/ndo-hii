<?php
include('header.php');

// if customer name not exist then return to homepage
if(!isset($_POST['customer_name']))

{

	header('Location: index.php');

}

else

{
	$discount			=0;
	
	$currency 			= $_POST['currency'];

	$type 				= $_POST['customer_choice'];
	
	$quantity			=$_POST['product_quantity'];

	$customer_message 	= $_POST['customer_message'];

	$customer_contact 	= $_POST['customer_contact'];

	$name 		  		= $_POST['customer_name'];

	$email 		   	   = $_POST['customer_email'];

	$coupon_text   		 = $_POST['coupon_text'];

	$upres ="";

	$type_title = $type; 

	$html_options 	='';
	
	$items=array();

	// select additional option values

	if(isset($_POST['html_options']))

	{

	if(!empty($_POST['html_options']))

	{

		$html_options 	= $_POST['html_options'];

		foreach ($html_options as $options){

			$tot_options.=$options."<br />";
			$itemdata=explode("[".$currency,$options);
			$itemname=explode("<span>",$itemdata[0]);
			$itemcost=explode("]",$itemdata[1]);
			$items[] = array(
   			 'item_name' => $itemname[0],
   			 'item_cost' => $itemcost[0]
 			 );
		 }

		 }

	} 


	$type_cost     = $_POST['type_cost'];

	$actual_cost   = $_POST['actual_amt'];

	$total_cost    = $_POST['order_total_amt'];	
	
	$discount		   = isset($_POST['reduction'])?$_POST['reduction']:0;

}

?>

	<section class="order-form">

        <div class="container text-center">

            <div class="col-md-12">

                <!-- Revise order contents start-->

                <div class="addi-opts">

                    <h2 align="center">Please revise your order</h2>

                    <hr>

                    <ul class="list-opt clearfix">

                        <li><strong>Name :</strong> <?php echo $name; ?>  </li>

                        <li><strong>Email :</strong> <?php echo $email; ?> </li>

                        <li><strong>Contact :</strong> <?php echo $customer_contact; ?></li>

                        <li><strong>Description :</strong> <?php echo $customer_message; ?> </li>

                    </ul>
                    <h2 align="center">Summary Details</h2>
                    
						<?php
						if($show_price==1){
					    $cart='<table width="80%" border="1" cellspacing="0" style="margin-left:3%;"><tr><td><strong>Sl No.</strong></td><td><strong>Item name</strong></td><td><strong>Quantity</strong></td><td><strong>Unit Price</strong></td><td><strong>Total Price</strong></td></tr>';
						$cart.='<tr><td>1</td><td>'.$type.'</td><td>'.$quantity.'</td><td>'.$currency.$type_cost.'</td><td>'.$currency.($type_cost*$quantity).'</td></tr>';
						$itemcount=count($items)+1;
						if(!empty($items)){
						$i=2;
					    foreach($items as $item)
						{
							$cart.='<tr><td>'.$i.'</td><td>'.$item['item_name'].'</td><td>1</td><td>'.$currency.$item['item_cost'].'</td><td>'.$currency.($item['item_cost']*1).'</td></tr>';
							$i++;
						}
						}
						
					  $cart.='<tr>
					  <td colspan="3" rowspan="3">&nbsp;</td>
					  <td><b>Subtotal</b></td>
					  <td>'.$currency.number_format(($total_cost+$discount),2).'</td>
					</tr>
					<tr>
					  <td><b>Discount</b></td>
					  <td>'.$currency.$discount.'</td>
					</tr>
					<tr>
					  <td><b>Total</b></td>
					  <td>'.number_format(($total_cost),2).' '.$currencycode.'</td>
					</tr></table>';
						}
						else
						{
							$cart='<table width="80%" border="1" cellspacing="0" style="margin-left:3%;"><tr><td><strong>Sl No.</strong></td><td><strong>Item name</strong></td><td><strong>Quantity</strong></td></tr>';
						$cart.='<tr><td>1</td><td>'.$type.'</td><td>'.$quantity.'</td></tr>';
						$itemcount=count($items)+1;
						if(!empty($items)){
						$i=2;
					    foreach($items as $item)
						{
							$cart.='<tr><td>'.$i.'</td><td>'.$item['item_name'].'</td><td>1</td></tr>';
							$i++;
						}
						}
						
					  $cart.='</table>';
						}
						echo $cart;
                        ?>

                    <hr>

                    <div class="price-final">

                    	<!-- Start: Final Price -->
						
						
                    

                    	<!-- End: Final Price -->

                    </div>

                </div>

                <!-- Revise order contents end-->

                <!-- Button area start-->

                <div class="order-btn-cont pay-page">

                    <!-- Mail sending button area start-->

                    <form action="thankyou.php" method="post">
					
                    <input type="hidden" name="customer_name" value="<?php echo $name; ?>">

                    <input type="hidden" name="customer_email" value="<?php echo $email; ?>">

                    <input type="hidden" name="customer_contact" value="<?php echo $customer_contact; ?>">

                    <input type="hidden" name="customer_message" value="<?php echo $customer_message; ?>">

                    <input type="hidden" name="type_cost" value="<?php echo $type_cost; ?>">

                    <input type="hidden" name="tot_options" value="<?php echo $tot_options; ?>">

                    <input type="hidden" name="customer_choice" value="<?php echo $type; ?>">

                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">

                    <input type="hidden" name="coupon_text" value="<?php echo $coupon_text; ?>">

                    <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>">
                    
                     <input type="hidden" name="item_name_1" value="<?php echo $type; ?>"> 
                     <input type="hidden" name="product" value="<?php echo $type; ?>"> 
                     
                       <input type="hidden" name="quantity_1" value="<?php echo $quantity; ?>">
                       
                      <input type="hidden" name="amount_1" value="<?php echo $type_cost; ?>">
                      
                      <input type="hidden" name="discount" value="<?php echo $discount; ?>">
                      
                      <?php
					  if(!empty($items)){
						  
						  $i=2;
						  
						  foreach($items as $item)
						  {
							?>
							 <input type="hidden" name="item_name_<?php echo $i?>" value="<?php echo $item['item_name']; ?>">
							 <input type="hidden" name="amount_<?php echo $i?>" value="<?php echo $item['item_cost']; ?>">
							 <input name = "quantity_<?php echo $i?>" value = "1" type = "hidden">
							<?php  
							$i++;
						  }
					  }
					  ?>
                     <input type="hidden" name="count" value="<?php echo count($items)+1; ?>">

                    <input type="submit" class="button" name="mailus" value="Mail Me !" id="order-mail-id">
			
                    </form>

                    <!-- Mail sending button area end-->

                    <!-- Pay now button area start-->
					<?php if($show_price==1 && $is_paypal==1){?>
                    <form action="<?php echo $paypal_link;?>" method="post" target="_top" id="order_frm">
                    
					 <input type="hidden" name="cmd" value="_cart" />
                     
 					 <input type="hidden" name="upload" value="1">
                     
                     <input type="hidden" value="<?php echo $paypal_businessmail;?>" name="business">
                     
                     <input type="hidden" value="IN" name="lc">
                     
					 <input type="hidden" value="2" name="rm">
                    
                     <input type="hidden" name="item_name_1" value="<?php echo $type; ?>"> 
                      <input type="hidden" name="product" value="<?php echo $type; ?>"> 
                      
                     <input type="hidden" name="quantity_1" value="<?php echo $quantity; ?>">
                       
                     <input type="hidden" name="amount_1" value="<?php echo $type_cost; ?>">
                      
                      <?php
					  $i=1;
					  if(!empty($items)){
						  $i=2;
						  foreach($items as $item)
						  {
							?>
							 <input type="hidden" name="item_name_<?php echo $i?>" value="<?php echo $item['item_name']; ?>">
                             
							 <input type="hidden" name="amount_<?php echo $i?>" value="<?php echo $item['item_cost']; ?>">
                             
							 <input name = "quantity_<?php echo $i?>" value = "1" type = "hidden">
                             
							<?php  
							$i++;
						  }
					  }
					  ?>
                     
                       <input type="hidden" id="custom" name="custom" value='name=<?php echo $name?>&email=<?php echo $email?>&contact=<?php echo $customer_contact?>&items=<?php echo $i; ?>&message=<?php echo $customer_message?>'>
                       
                     <input type="hidden" name="discount_amount_cart" value="<?php echo $discount; ?>">
                     
                     <input type="hidden" name="currency_code" value="<?php echo $currencycode?>"/>
                     
                     <input type="hidden" name="amount" value="<?php echo $total_cost; ?>">
                     <input name="notify_url" value="thankyou.php" type="hidden"> 
                    <!-- <input type="hidden" name="return" value="thankyou.php">
                     <input type="hidden" name="cancel_return" value="index.php">    -->                 
                     <input type="submit" class="button" name="submit" value="Pay Now !" alt="PayPal – The safer, easier way to pay online.">

                    </form>	
					<?php } ?>
                    <!-- Pay now button area end-->

                </div>

                <!-- Button area end-->

            </div>

        </div>

	</section>

    <!-- Footer Area Start 

    ====================================================== -->

    <footer class="footer-area text-center">

        <a href="../index.html"><img src="img/f-logo.png" alt=""></a>

        <p>&copy;2018 <a href="http://www.pvaluewriters.com/" target="_blank">PValueWriters</a> All right reserved.</p>

    </footer>

    <!-- =================================================

    Footer Area End -->

    

    <!-- JavaScript Files -->

    <script type="text/javascript" src="js/jquery.js"></script><!-- jquery -->

    <script type="text/javascript" src="js/bootstrap.js"></script><!-- Bootstrap js -->

    <script type="text/javascript" src="js/core.js"></script><!-- Core js -->

	<script type="text/javascript">

	$('#order_confirm_id').click(function(e)

	{

	 e.preventDefault();

	 $('#order_frm').submit();

	});

	</script>

</body>

</html>

