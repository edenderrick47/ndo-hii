<?php

include('header.php');

if(isset($_GET['typ']))
{
	if($_GET['typ']=="mail")
	{
		$orderlist=$prodObj-> getOrderListByType($_GET['typ']);
	}
	if($_GET['typ']=="paypal")
	{
		$orderlist=$prodObj-> getOrderListByType($_GET['typ']);
	}
}
else
{
	$orderlist=$prodObj-> getOrderList();
}

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$prodObj->deleteOrderById($id);

		header("location:orders.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Orders</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Orders

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables">

                                    <thead> 

                                    <tr>

                                            <th>Sl No:</th>

                                            <th>Email ID</th>

                                            <th>Items</th>

                                            <th>Total Price</th>
                                            
                                            <th>Order Type</th>

                                            <th>Payment Status</th>
                                            
                                             <th>Mail Status</th>
                                            
                                             <th>Date</th>

                                            <th>Delete</th>
                                            
                                             <th>View</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($orderlist)){

												$list=1;

												for($cpn=0;$cpn<count($orderlist);$cpn++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $orderlist[$cpn]['customer_email'];?></td>

                                            <td><?php echo $orderlist[$cpn]['Items'];?></td>

                                            <td><?php echo $orderlist[$cpn]['total'];?></td>

                                            <td><?php echo $orderlist[$cpn]['orderType'];?></td>
                                            
 											<td><?php echo $orderlist[$cpn]['payment_status'];?></td>
                                           
                                            <td><?php echo $orderlist[$cpn]['mailStatus'];?></td>
                                            
											<td><?php echo $orderlist[$cpn]['date'];?></td>
                                            
                                            <td>

                                            <a href="orders.php?act=del&id=<?php echo base64_encode($orderlist[$cpn]['idOrder']);?>">

                                            <i class="fa fa-times"></i> 

                                            </a>

                                            </td>
                                             <td>

                                            <a href="order.php?id=<?php echo base64_encode($orderlist[$cpn]['idOrder']);?>">

                                            View 

                                            </a>

                                            </td>

                                        </tr>

                                             <?php $list++;} } ?>

                                    </tbody>

                                </table>

                            </div>

                            <!-- /.table-responsive -->

                            

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

         

        </div>

        <!-- /#page-wrapper -->



    </div>

    <!-- /#wrapper -->



    <!-- DataTables JavaScript -->



 <?php include('footer.php');?>

  <link href="<?php echo $siteLink;?>/public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

 <link href="<?php echo $siteLink;?>/public/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

     <script src="<?php echo $siteLink;?>/public/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo $siteLink;?>/public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>



  

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    <script>

    $(document).ready(function() {

        $('#dataTables').DataTable({
"aoColumnDefs": [
          		{ 'bSortable': false, 'aTargets': [ 8,9 ] }
       		   ],
                responsive: true

        });

    });

	

    </script>



