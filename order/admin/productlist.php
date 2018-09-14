<?php

include('header.php');

$prodlist=$prodObj-> getproductList();

if(isset($_GET['act']))

{

	if($_GET['act']=="del")

	{

		$id=base64_decode($_GET['id']);

		$prodObj->deleteProductById($id);

		header("location:productlist.php");

	}

}

?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Product</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           All Products

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

                                            <th>category</th>

                                            <th>Price</th>

                                             <th>Edit</th>

                                             <th>Delete</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                     <?php

												if(!empty($prodlist)){

												$list=1;

												for($prod=0;$prod<count($prodlist);$prod++){

												?>

                                      

                                        <tr class="gradeA">

                                            <td><?php echo $list;?></td>

                                            <td><?php echo $prodlist[$prod]['productName'];?></td>

                                            <td>
											  <?php if($prodlist[$prod]['productImage']){
											if($prodlist[$prod]['is_image']==1){	
											?>

                                            <img src="../public/uploads/products/<?php echo $prodlist[$prod]['productImage'];?>" width="50" height="50">

                                            <?php }
											if($prodlist[$prod]['is_image']==2){ ?>
                                            
											<i class="<?php echo $obj->replaceTextareaContent($prodlist[$prod]['productImage']);?>"></i>
                                            
                                            <?php } }?>
                                            

                                            </td>

                                            <td><?php 

											if($prodlist[$prod]['idCategory']!=0)

											{

												$parent=$catObj->getCategoryById($prodlist[$prod]['idCategory']);

												echo $parent[0]['catName'];

											}

											?></td>

                                            <td ><?php echo $prodlist[$prod]['productPrice'];?></td>

                                            <td >

                                            <a href="productedit.php?id=<?php echo base64_encode($prodlist[$prod]['idproduct']);?>">

                                            <i class="fa fa-edit"></i>

                                            </a>

                                            </td>

                                            <td>

                                            <a href="productlist.php?act=del&id=<?php echo base64_encode($prodlist[$prod]['idproduct']);?>">

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
          		{ 'bSortable': false, 'aTargets': [ 2,5,6 ] }
       		   ],
                responsive: true

        });

    });

	

    </script>



