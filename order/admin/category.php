<?php

include('header.php');

$catlist=$catObj-> getCategoryList();

$insertArray=array();

$errMsg="";$succMsg="";$err=0;

	

	$insertArray['idParent']=0;

	$insertArray['catName']=isset($_POST['name'])?cleanInputField($_POST['name']):'';

	$insertArray['catDescription']=isset($_POST['desc'])?cleanInputField($_POST['desc']):'';
	
	$insertArray['is_image']=isset($_POST['is_image'])?cleanInputField($_POST['is_image']):'0';
	
	if($insertArray['is_image']==1){
	$insertArray['catImage']=isset($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):'';
	}
	if($insertArray['is_image']==2){
	$insertArray['catImage']=isset($_POST['cat_icon'])?cleanInputField($obj->replaceTextareaContent($_POST['cat_icon'])):'';
	}

	$insertArray['catPrice']=0;//isset($_POST['price'])?cleanInputField($_POST['price']):'';

	$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');

if(isset($_POST['submit']))

{

	if($insertArray['catName']==""){

		$errMsg="Please enter all mandatory fields";

	}
	else if($insertArray['is_image']==1 && $insertArray['catImage']=="")
	{
		$errMsg="Please select category Image";
	}
	else if($insertArray['is_image']==2 && $insertArray['catImage']=="")
	{
		$errMsg="Please enter category icon";
	}

	else

	{

		if($insertArray['is_image']==1 && $insertArray['catImage']!="")

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

				$insertArray['catImage']="cat_".date('dmyhis').$_FILES['image']['name'];

				$move=move_uploaded_file ($_FILES['image']['tmp_name'],'../public/uploads/category/'.$insertArray['catImage']);

				if($move=="")

				{

				 	$err=1;

			 	 	$errMsg="Failed to upload image";

			 	}

			}

		}

		if($err==0)

		{

		$ins=$catObj->insertcategory($insertArray,"category");

		$insertArray['idParent']='';

		$insertArray['catName']='';

		$insertArray['catDescription']='';

		$insertArray['catImage']='';

		$insertArray['catPrice']=0;

		$succMsg="Data inserted successfully";

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

                           Add Category

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

                                            <input class="form-control" name="name" id="name" value="<?php echo $insertArray['catName'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea class="form-control" rows="3" name="desc" id="desc"> <?php echo trim($obj->replaceTextareaContent($insertArray['catDescription']));?></textarea>

                                        </div>

                                        <div class="form-group">
										<input type="radio" name="is_image" id="is_image" value="0" <?php if($insertArray['is_image']=="0"){?>checked="checked"<?php } ?> /><label>&nbsp;None</label>
										<input type="radio" name="is_image" id="is_image" value="1"  <?php if($insertArray['is_image']=="1"){?>checked="checked"<?php } ?>/><label>&nbsp;Image</label>
                                        <input type="radio" name="is_image" id="is_image" value="2" <?php if($insertArray['is_image']=="2"){?>checked="checked"<?php } ?>/><label>&nbsp;Icon</label>
                                        
                         <input type="file" name="image" id="image" <?php if($insertArray['is_image']=="1"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?>>
                         <input class="form-control" name="cat_icon" id="cat_icon"  <?php if($insertArray['is_image']=="2"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?> value="<?php echo nl2br($insertArray['catImage']);?>" />

                                        </div> 

                                        

                                         <!--<div class="form-group">

                                            <label>Price <span class="error">*</span></label>

                                            <input class="form-control" name="price" id="price" value="<?php echo $insertArray['catPrice'];?>">

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
		 $("#cat_icon").show();
	}
	if($(this).val()==1)
	{
		$("#cat_icon").hide();
		$("#image").show();
	}
	if($(this).val()=="0")
	{
		$("#image").hide();$("#cat_icon").hide();
		
	}
});
});
 </script>