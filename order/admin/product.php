<?php

include('header.php');

$catlist=$catObj-> getCategoryList();

$optionslist=$optObj-> getOptionsList();

$insertArray=array();$options=array();

$errMsg="";$succMsg="";$err=0;

	$insertArray['idCategory']=isset($_POST['category'])?cleanInputField($_POST['category']):'';

	$insertArray['productName']=isset($_POST['name'])?cleanInputField($_POST['name']):'';

	$insertArray['productDesc']=isset($_POST['desc'])?cleanInputField($_POST['desc']):'';
	
	$insertArray['is_image']=isset($_POST['is_image'])?cleanInputField($_POST['is_image']):'0';
	
	if($insertArray['is_image']==1){
	$insertArray['productImage']=isset($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):'';
	}
	if($insertArray['is_image']==2){
	$insertArray['productImage']=isset($_POST['cat_icon'])?cleanInputField($obj->replaceTextareaContent($_POST['cat_icon'])):'';
	}

	$insertArray['productPrice']=isset($_POST['price'])?cleanInputField($_POST['price']):0;

	$insertArray['purchaseSummary']=isset($_POST['summary'])?cleanInputField($_POST['summary']):'';

	

	

	$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');

if(isset($_POST['submit']))

{

	if(isset($_POST['options']))

	{

		$options=$_POST['options'];

	}

	if($insertArray['productName']==""){

		$errMsg="Please enter all mandatory fields";

	}
	else if($insertArray['is_image']==1 && $insertArray['productImage']=="")
	{
		$errMsg="Please select product Image";
	}
	else if($insertArray['is_image']==2 && $insertArray['productImage']=="")
	{
		$errMsg="Please enter product icon";
	}

	else

	{
		if($insertArray['is_image']==1 && $insertArray['productImage']!="")
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

				$insertArray['productImage']="prod_".date('dmyhis').$_FILES['image']['name'];

				$move=move_uploaded_file ($_FILES['image']['tmp_name'],'../public/uploads/products/'.$insertArray['productImage']);

				if($move=="")

				{

				 	$err=1;

			 	 	$errMsg="Failed to upload image";

			 	}

			}

		}

		if($err==0)

		{

		

		$prodId=$prodObj->insertproduct($insertArray,"product");

		if($prodId && isset($_POST['options']))

		{

			if(!empty($options))

			{

			  $insArry['idProduct']=$prodId;

			  for($op=0;$op<count($options);$op++)

			  {

				  if($options[$op]!="")

				  {

				  	$insArry['idOption']=$options[$op];

				  	$prodObj->insertproduct($insArry,"product_options");

				  }

			  }

			}

		}

		$insertArray['idCategory']=0;

		$insertArray['productName']='';

		$insertArray['productDesc']='';
		
		$insertArray['is_image']=0;

		$insertArray['productImage']='';

		$insertArray['productPrice']=0;

		$insertArray['purchaseSummary']='';

		$options=array("");

		$succMsg="Data inserted successfully";

		}

	}

}

?>

        

       <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Products</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Add Product

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

                                            <label>Product Name <span class="error">*</span></label>

                                            <input class="form-control" name="name" id="name" value="<?php echo $insertArray['productName'];?>">

                                        </div>

                                    <div class="form-group">

                                            <label>Category <span class="error">*</span></label>

                                            <select class="form-control" name="category" id="category">

                                                <?php

												if(!empty($catlist)){

												for($cat=0;$cat<count($catlist);$cat++){

												?>

                                                <option value="<?php echo $catlist[$cat]['idCategory'];?>" <?php if($catlist[$cat]['idCategory']==$insertArray['idCategory']){?> selected="selected" <?php } ?>><?php echo $catlist[$cat]['catName'];?> </option>

                                                <?php

												}}

												?>

                                            </select>

                                        </div>

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea class="form-control" rows="3" name="desc" id="desc"> <?php echo trim($obj->replaceTextareaContent(trim($insertArray['productDesc'])));?></textarea>

                                        </div>
										<div class="form-group">
										<input type="radio" name="is_image" id="is_image" value="0" <?php if($insertArray['is_image']=="0"){?>checked="checked"<?php } ?> /><label>&nbsp;None</label>
										<input type="radio" name="is_image" id="is_image" value="1"  <?php if($insertArray['is_image']=="1"){?>checked="checked"<?php } ?>/><label>&nbsp;Image</label>
                                        <input type="radio" name="is_image" id="is_image" value="2" <?php if($insertArray['is_image']=="2"){?>checked="checked"<?php } ?>/><label>&nbsp;Icon</label>
                                        
                         <input type="file" name="image" id="image" <?php if($insertArray['is_image']=="1"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?>>
                         <input class="form-control" name="cat_icon" id="cat_icon"  <?php if($insertArray['is_image']=="2"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?> value="<?php echo nl2br($insertArray['productImage']);?>" />

                                        </div>
                                        <!--<div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="image" id="image">

                                        </div>--> 

                                         <div class="form-group">

                                            <label>Product Options</label>

                                            <select class="form-control" name="options[]" id="options[]" multiple="multiple">

                                                <option value="">None</option>

                                                <?php

												if(!empty($optionslist)){

												for($opt=0;$opt<count($optionslist);$opt++){

												?>

<option value="<?php echo $optionslist[$opt]['idOption'];?>" <?php if(in_array($optionslist[$opt]['idOption'],$options)){?> selected="selected" <?php } ?>><?php echo $optionslist[$opt]['optionname'];?> </option>

                                                <?php

												}}

												?>

                                            </select>

                                        </div>

                                         <div class="form-group">

                                            <label>Price <span class="error">*</span></label>

                                            <input class="form-control" name="price" id="price" value="<?php echo $insertArray['productPrice'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>Purchase summary</label>

                                            <textarea class="form-control" rows="3" name="summary" id="summary"> <?php echo trim($obj->replaceTextareaContent(trim($insertArray['purchaseSummary'])));?></textarea>

                                        </div>

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
  

  