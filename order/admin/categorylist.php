<?php

include('header.php');

$catlist=$catObj-> getCategoryList();

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$catObj->deleteCategoryById($id);

		header("location:categorylist.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Category</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Categories

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables">

                                    <thead> 

                                    <tr>

                                            <th>Sl No:</th>

                                            <th>Name</th>

                                            <th>Image</th>                                           

                                            <th>Edit</th>

                                             <th>Delete</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($catlist)){

												$list=1;

												for($cat=0;$cat<count($catlist);$cat++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $catlist[$cat]['catName'];?></td>

                                            <td>

                                            <?php if($catlist[$cat]['catImage']){
											if($catlist[$cat]['is_image']==1){	
											?>

                                            <img src="../public/uploads/category/<?php echo $catlist[$cat]['catImage'];?>" width="50" height="50">

                                            <?php }
											if($catlist[$cat]['is_image']==2){ ?>
                                            
											<i class="<?php echo $obj->replaceTextareaContent($catlist[$cat]['catImage']);?>"></i>
                                            
                                            <?php } }?>       
                                            </td>
                                            <td >

                                            <a href="categoryedit.php?id=<?php echo base64_encode($catlist[$cat]['idCategory']);?>">

                                            <i class="fa fa-edit"></i>

                                            </a>

                                            </td>

                                            <td>

                                            <a href="categorylist.php?act=del&id=<?php echo base64_encode($catlist[$cat]['idCategory']);?>">

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
          		{ 'bSortable': false, 'aTargets': [ 2,4 ] }
       		   ],
                responsive: true

        });

    });

	

    </script>



