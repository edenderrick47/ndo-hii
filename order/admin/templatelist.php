<?php

include('header.php');

$templatelist=$tempObj-> getTemplateList();

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$tempObj->deleteTemplateById($id);

		header("location:templatelist.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Mail Template</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Templates

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables">

                                    <thead> 

                                    <tr>

                                            <th>Sl No:</th>

                                            <th>Template Name</th>

                                            <th>Subject</th>

                                             <th>Edit</th>

                                             <th>Delete</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($templatelist)){

												$list=1;

												for($cpn=0;$cpn<count($templatelist);$cpn++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $templatelist[$cpn]['templateName'];?></td>

                                            <td><?php echo $templatelist[$cpn]['subject'];?></td>

                                            <td >

                                            <a href="templateedit.php?id=<?php echo base64_encode($templatelist[$cpn]['idTemplate']);?>">

                                            <i class="fa fa-edit"></i>

                                            </a>

                                            </td>

                                            <td>

                                            <a href="templatelist.php?act=del&id=<?php echo base64_encode($templatelist[$cpn]['idTemplate']);?>">

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
          		{ 'bSortable': false, 'aTargets': [ 3,4 ] }
       		   ],
                responsive: true

        });

    });

	

    </script>



