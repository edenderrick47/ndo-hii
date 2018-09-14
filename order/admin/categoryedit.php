<?php

include('header.php');

if(isset($_GET['id']))

{

	$id=base64_decode($_GET['id']);

	$category=$catObj->getCategoryById($id);

}

else

{

	header("location:categorylist.php");

}

$catlist=$catObj-> getCategoryList();

$updateArray=array();

$errMsg="";$succMsg="";$err=0;



	$updateArray['idParent']=0;

	$updateArray['catName']=isset($_POST['name'])?cleanInputField($_POST['name']):$category[0]['catName'];

	$updateArray['catDescription']=isset($_POST['desc'])?cleanInputField($_POST['desc']):$category[0]['catDescription'];

	//$updateArray['catImage']=$category[0]['catImage'];$updateArray['is_image']=$category[0]['is_image'];
	
	$updateArray['is_image']=isset($_POST['is_image'])?cleanInputField($_POST['is_image']):stripslashes($category[0]['is_image']);
	
	if($updateArray['is_image']==1 && $category[0]['is_image']==1){
	$updateArray['catImage']=!empty($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):$category[0]['catImage'];
	}
	if($updateArray['is_image']==1 && ($category[0]['is_image']==2 || $category[0]['is_image']==0)){
	$updateArray['catImage']=!empty($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):"";
	}		
	if($updateArray['is_image']==2){
	$updateArray['catImage']=isset($_POST['cat_icon'])?cleanInputField($obj->replaceTextareaContent($_POST['cat_icon'])):$category[0]['catImage'];
	}
	if($updateArray['is_image']==0){
	$updateArray['catImage']='';
	}
	$updateArray['catPrice']=0;//isset($_POST['price'])?cleanInputField($_POST['price']):$category[0]['catPrice'];

	$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');

	

if(isset($_POST['submit']))

{

	if($updateArray['catName']==""){

		$errMsg="Please enter all mandatory fields";

	}
	else if($updateArray['is_image']==1 && $updateArray['catImage']=="")
	{
		$errMsg="Please select category Image";
	}
	else if($updateArray['is_image']==2 && $updateArray['catImage']=="")
	{
		$errMsg="Please enter category icon";
	}
	else

	{

		if($_POST['is_image']==1 && !empty($_FILES['image']['tmp_name']))

		{

		 $type= $_FILES['image']['type'];

	     $ext = strtolower(substr(strrchr($_FILES['image']['name'], "."), 1));

		 	if(!in_array($ext, $image_extensions_allowed))

		 	{

				$err=1;

		    	$errMsg="Invalid Image Format";

			}

			else

			{

				$updateArray['catImage']="cat_".date('dmyhis').$_FILES['image']['name'];

				$move=move_uploaded_file ($_FILES['image']['tmp_name'],'../public/uploads/category/'.$updateArray['catImage']);

				if($move=="")

				{

				 	$err=1;

			 	 	$errMsg="Failed to upload image";

			 	}

			}

		}

		

		if($err==0)

		{

		$ins=$catObj->updateCategoryById($updateArray,$id);

		$succMsg="Data updated successfully";

		$upcategory=$catObj->getCategoryById($id);

		$updateArray['catDescription']=stripslashes($upcategory[0]['catDescription']);

		}

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

                           Edit Category

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">

                                    <form role="form" method="post" enctype="multipart/form-data" name="catform" id="catform">

                                    <?php if($errMsg!=""){?>

                                   <div class="alert alert-danger">

                                            <label><?php echo $errMsg;?></label>

                                        </div>

                                    <?php } ?>

                                     <?php if($succMsg!=""){?>

                                  <div class="alert alert-success">

                                            <label><?php echo $succMsg;?></label>

                                        </div>

                                    <?php } ?>

                                    

                                    

                                        <div class="form-group">

                                            <label>Category Name <span class="error">*</span></label>

                                            <input class="form-control" name="name" id="name" value="<?php echo $updateArray['catName'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea class="form-control" rows="3" name="desc" id="desc"> <?php echo stripslashes($updateArray['catDescription']);?></textarea>

                                        </div>

                                         <div class="form-group">
										<input type="radio" name="is_image" id="is_image" value="0" <?php if($updateArray['is_image']=="0"){?>checked="checked"<?php } ?> /><label>&nbsp;None</label>
										<input type="radio" name="is_image" id="is_image" value="1"  <?php if($updateArray['is_image']=="1"){?>checked="checked"<?php } ?>/><label>&nbsp;Image</label>
                                        <input type="radio" name="is_image" id="is_image" value="2" <?php if($updateArray['is_image']=="2"){?>checked="checked"<?php } ?>/><label>&nbsp;Icon</label>
                                        
                         <input type="file" name="image" id="image" <?php if($updateArray['is_image']=="1"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?>>
                          <?php if($updateArray['catImage']!="" && $updateArray['is_image']=="1"){?>

                                            <img src="../public/uploads/category/<?php echo $updateArray['catImage'];?>" width="50" height="50" id="imagesrc">										

                                            <?php } ?>
                         <input class="form-control" name="cat_icon" id="cat_icon"  <?php if($updateArray['is_image']=="2"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?> value="<?php if($updateArray['is_image']=="2"){ echo nl2br($updateArray['catImage']);}?>" />

                                        </div> 


                                        <!-- <div class="form-group">

                                            <label>Price <span class="error">*</span></label>

                                            <input class="form-control" name="price" id="price" value="<?php echo $updateArray['catPrice'];?>">

                                        </div>-->

                                         <div class="form-group">

                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

                                        </div>

                                   </form>

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

  <script>
 $(document).ready(function () {
 $("input[name=is_image]").click(function(e) {
    if($(this).val()==2)
	{ 
		 $("#image").hide();
		 $("#imagesrc").css("display","none");
		 $("#cat_icon").show();
	}
	if($(this).val()==1)
	{
		$("#cat_icon").hide();
		$("#imagesrc").css("display","block");
		$("#image").show();
	}
	if($(this).val()=="0")
	{
		$("#image").hide();$("#cat_icon").hide();
		$("#imagesrc").css("display","none");
		
	}
});
});
 </script>

  