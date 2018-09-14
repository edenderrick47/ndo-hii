<?php

include('header.php');

$currencylist=$curObj-> getCurrencyList();

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$curObj->deleteCurrencyById($id);

		header("location:currencylist.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Currency</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Currencies

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables">

                                    <thead> 

                                    <tr>

                                            <th>Sl No:</th>

                                            <th>Country</th>

                                            <th>Currency code</th>

                                            <th>Currency name</th>

                                            <th>Symbol</th>

                                             <th>Edit</th>

                                             <th>Delete</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($currencylist)){

												$list=1;

												for($cpn=0;$cpn<count($currencylist);$cpn++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $currencylist[$cpn]['country'];?></td>

                                            <td><?php echo $currencylist[$cpn]['currency_code'];?></td>

                                            <td> <?php echo $currencylist[$cpn]['currency_name'];?></td>

                                            <td ><?php echo $currencylist[$cpn]['currrency_symbol'];?></td>

                                            <td >

                                            <a href="currencyedit.php?id=<?php echo base64_encode($currencylist[$cpn]['idCurrency']);?>">

                                            <i class="fa fa-edit"></i>

                                            </a>

                                            </td>

                                            <td>

                                            <a href="currencylist.php?act=del&id=<?php echo base64_encode($currencylist[$cpn]['idCurrency']);?>">

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
          		{ 'bSortable': false, 'aTargets': [ 5,6 ] }
       		   ],
                responsive: true

        });

    });

	

    </script>



