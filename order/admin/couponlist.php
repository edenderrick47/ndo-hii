<?php

include('header.php');

$couponlist=$couponObj-> getCouponList();

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$couponObj->deleteCouponById($id);

		header("location:couponlist.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Coupons</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Coupons

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables">

                                    <thead> 

                                    <tr>

                                            <th>Sl No:</th>

                                            <th>Coupon code</th>

                                            <th>Discount Type</th>

                                            <th>Discount</th>

                                            <th>Date</th>

                                            <th>Status</th>

                                             <th>Edit</th>

                                             <th>Delete</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($couponlist)){

												$list=1;

												for($cpn=0;$cpn<count($couponlist);$cpn++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $couponlist[$cpn]['couponCode'];?></td>

                                            <td><?php if($couponlist[$cpn]['discountType']=="P") echo "Percentage";else echo "Cash";?></td>

                                            <td> <?php echo $couponlist[$cpn]['discountValue'];?></td>

                                            <td ><?php echo $couponlist[$cpn]['dateFrom'];?> <b>to</b> <?php echo $couponlist[$cpn]['dateTo'];?></td>

                                            <td> 

										<?php if($couponlist[$cpn]['status']==1){?>

                                        <span class="s1 act" style="cursor:pointer;"><img src="public/img/active.png" /></span>

                                        <?php }if($couponlist[$cpn]['status']==0){?>

                                        <span class="s2 act" style="cursor:pointer;"><img src="public/img/inactive.gif" /></span>

                                        <?php } ?>

                                            </td>

                                            <td >

                                            <a href="couponedit.php?id=<?php echo base64_encode($couponlist[$cpn]['idCoupon']);?>">

                                            <i class="fa fa-edit"></i>

                                            </a>

                                            </td>

                                            <td>

                                            <a href="couponlist.php?act=del&id=<?php echo base64_encode($couponlist[$cpn]['idCoupon']);?>">

                                            <i class="fa fa-times"></i> 

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
          		{ 'bSortable': false, 'aTargets': [ 5,6,7] }
       		   ],
                responsive: true

        });

    });

	

    </script>



