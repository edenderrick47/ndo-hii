<?php

include('header.php');
if(isset($_GET['id']))
{
	$id=base64_decode($_GET['id']);
	$orderDetails=$prodObj->getOrderById($id);
}
else
{
	header("location:orders.php");
}
?>

        

       <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Order Details</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           View Order

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">
                                
                                 <div class="form-group">
									<label><u>Order Type:</u></label>
                                    <?php echo $orderDetails[0]['orderType'];?>
                                  </div>
                                   <div class="form-group">
									<label><u>Date:</u></label>
                                    <?php echo $orderDetails[0]['date'];?>
                                  </div>
                                  
                                 <div class="form-group">
									<label><u>User Details</u></label><br />
									<?php echo $orderDetails[0]['customer_details'];?>
                                  </div>
								 <div class="form-group">
									<label><u>Order Details</u></label>
									<?php echo $orderDetails[0]['cart'];?>
                                  </div>
                                    
                                    <div class="form-group">
									<label><u>Payment Details</u></label>
                                    <br />
									<label>Payment Status:</label><?php echo $orderDetails[0]['payment_status'];?><br />
                                    <label>Transaction ID:</label><?php echo $orderDetails[0]['txn_id'];?><br />
                                    <label>Mail Status:</label><?php echo $orderDetails[0]['mailStatus'];?>
                                  </div>
                                   

                                </div>

                                <!-- /.col-lg-6 (nested) -->

                                

                                <!-- /.col-lg-6 (nested) -->

                            </div>

                            <!-- /.row (nested) -->

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

        </div>

</div>





   <?php include('footer.php');?>

  

  