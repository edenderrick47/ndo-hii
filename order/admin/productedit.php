<?php

include('header.php');
if(isset($_GET['id']))
{
	$id=base64_decode($_GET['id']);

	$product=$prodObj->getProductById($id);
}
else
{
	header("location:categorylist.php");
}
$catlist=$catObj-> getCategoryList();
$optionslist=$optObj-> getOptionsList();
$prodOptions=$prodObj-> getProductOptions($id);

$updateArray=array();$prodoptions=array();$prodOptionsArr=array();

$errMsg="";$succMsg="";$err=0;

	$updateArray['idCategory']=isset($_POST['category'])?cleanInputField($_POST['category']):$product[0]['idCategory'];

	$updateArray['productName']=isset($_POST['name'])?cleanInputField($_POST['name']):$product[0]['productName'];

	$updateArray['productDesc']=isset($_POST['desc'])?cleanInputField($obj->replaceTextareaContent($_POST['desc'])):str_replace(array("\\r","\\n"), array("\r","\n"), $product[0]['productDesc']);

	//$updateArray['productImage']=$product[0]['productImage'];
	$updateArray['is_image']=isset($_POST['is_image'])?cleanInputField($_POST['is_image']):$product[0]['is_image'];
	
	if($updateArray['is_image']==1 && $product[0]['is_image']==1){
	$updateArray['productImage']=!empty($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):$product[0]['productImage'];
	}
	if($updateArray['is_image']==1 && $product[0]['is_image']==0){
	$updateArray['productImage']=!empty($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):'';
	}
	if($updateArray['is_image']==1 && $product[0]['is_image']==2){
	$updateArray['productImage']=!empty($_FILES['image']['name'])?cleanInputField($_FILES['image']['name']):'';
	}
	if($updateArray['is_image']==2){
	$updateArray['productImage']=isset($_POST['prod_icon'])?cleanInputField($obj->replaceTextareaContent($_POST['prod_icon'])):$product[0]['productImage'];
	}
	if($updateArray['is_image']==0){
		$updateArray['productImage']='';
	}
	$updateArray['productPrice']=isset($_POST['price'])?cleanInputField($_POST['price']):$product[0]['productPrice'];

	//$updateArray['purchaseSummary']=isset($_POST['summary'])?cleanInputField($obj->replaceTextareaContent($_POST['summary'])):$obj->replaceTextareaContent($product[0]['purchaseSummary']);

	$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');

	$prodoptions=isset($_POST['options'])?$_POST['options']:'';

	if(!empty($prodOptions))

	{

		for($prodopt=0;$prodopt<count($prodOptions);$prodopt++)

		{

			$prodOptionsArr[] = $prodOptions[$prodopt]['idOption'];

		}

	}

if(isset($_POST['submit']))

{

		if($updateArray['productName']==""){

			$errMsg="Please enter all mandatory fields";

		}
		else if($updateArray['is_image']==1 && $updateArray['productImage']=="")
		{
			$errMsg="Please select product Image";
		}
		else if($updateArray['is_image']==2 && $updateArray['productImage']=="")
		{
			$errMsg="Please enter product icon";
		}
		else

		{

			if(isset($_FILES['image']['tmp_name']) && $updateArray['is_image']==1)
			{

				if($_FILES['image']['tmp_name']!="")

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

						$updateArray['productImage']="prod_".date('dmyhis').$_FILES['image']['name'];

						$move=move_uploaded_file ($_FILES['image']['tmp_name'],'../public/uploads/products/'.$updateArray['productImage']);

						if($move=="")

						{

							$err=1;

							$errMsg="Failed to upload image";

						}

					}

				}

			}

			if($err==0)

			{

				$prodId=$prodObj->updateProductById($updateArray,$id);

				if($prodId)

				{	
					if(!empty($prodOptions))
					{	
					$del=$prodObj->deleteProductOptionsById($id);
					}
						if(!empty($prodoptions))//new options

						{

							for($op=0;$op<count($prodoptions);$op++)

							{
								if($prodoptions[$op]!="")
								{
									$insArry['idProduct']=$id;

									$insArry['idOption']=$prodoptions[$op];

									$prodObj->insertproduct($insArry,"product_options");
								}

							}

						}
					

				}

		

		$succMsg="Data updated successfully";

		$upproduct=$prodObj->getProductById($id);

		$updateArray['productDesc']=$obj->replaceTextareaContent($upproduct[0]['productDesc']);

		//$updateArray['purchaseSummary']=$obj->replaceTextareaContent($upproduct[0]['purchaseSummary']);

		$updateArray['productImage']=$upproduct[0]['productImage'];

		$prodOptions=$prodObj-> getProductOptions($id);

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

                           Edit Product

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

                                            <input class="form-control" name="name" id="name" value="<?php echo $updateArray['productName'];?>">

                                        </div>

                                    <div class="form-group">

                                            <label>Category <span class="error">*</span></label>

                                            <select class="form-control" name="category" id="category">

                                                <option>0</option>

                                                <?php

												if(!empty($catlist)){

												for($cat=0;$cat<count($catlist);$cat++){

												?>

                                                <option value="<?php echo $catlist[$cat]['idCategory'];?>" <?php if($catlist[$cat]['idCategory']==$updateArray['idCategory']){?> selected="selected" <?php } ?>><?php echo $catlist[$cat]['catName'];?> </option>

                                                <?php

												}}

												?>

                                            </select>

                                        </div>

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea class="form-control" rows="3" name="desc" id="desc"> <?php echo stripslashes($updateArray['productDesc']);?></textarea>

                                        </div>

                                        <!--<div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="image" id="image">

                                            <?php if($updateArray['productImage']){?>

                                            <img src="../public/uploads/products/<?php echo $updateArray['productImage'];?>" width="50" height="50">

                                            <?php } ?>

                                        </div>--> 
                                        <div class="form-group">
										<input type="radio" name="is_image" id="is_image" value="0" <?php if($updateArray['is_image']=="0"){?>checked="checked"<?php } ?> /><label>&nbsp;None</label>
										<input type="radio" name="is_image" id="is_image" value="1"  <?php if($updateArray['is_image']=="1"){?>checked="checked"<?php } ?>/><label>&nbsp;Image</label>
                                        <input type="radio" name="is_image" id="is_image" value="2" <?php if($updateArray['is_image']=="2"){?>checked="checked"<?php } ?>/><label>&nbsp;Icon</label>
                                        
                         <input type="file" name="image" id="image" <?php if($updateArray['is_image']=="1"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?>>
                          <?php if($updateArray['productImage'] && $updateArray['is_image']=="1"){?>

                                            <img src="../public/uploads/products/<?php echo $updateArray['productImage'];?>" width="50" height="50" id="imagesrc">

                                            <?php } ?>
                         <input class="form-control" name="prod_icon" id="prod_icon"  <?php if($updateArray['is_image']=="2"){?>style="display:block;"<?php } else{?> style="display:none;" <?php } ?> value="<?php if($updateArray['is_image']=="2"){ echo nl2br($updateArray['productImage']);}?>" />

                                        </div>

                                         <div class="form-group">

                                            <label>Product Options</label>

                                            <select class="form-control" name="options[]" id="options[]" multiple="multiple">

                                                <option value="">None</option>

                                                <?php

												if(!empty($optionslist))

												{

													for($opt=0;$opt<count($optionslist);$opt++)

													{$selected="";

														for($prodopt=0;$prodopt<count($prodOptions);$prodopt++)

														{

															

															if($optionslist[$opt]['idOption']==$prodOptions[$prodopt]['idOption'])

															{

																$selected="selected=selected";

													 		} 

														}

												?>

<option value="<?php echo $optionslist[$opt]['idOption'];?>" <?php echo $selected;?>><?php echo $optionslist[$opt]['optionname'];?> </option> 

                                                <?php

													}

												}

												?>

                                            </select>

                                        </div>

                                         <div class="form-group">

                                            <label>Price <span class="error">*</span></label>

                                            <input class="form-control" name="price" id="price" value="<?php echo $updateArray['productPrice'];?>">

                                        </div>

                                        <!--<div class="form-group">

                                            <label>Purchase summary</label>

                                            <textarea class="form-control" rows="3" name="summary" id="summary"> 
											<?php echo trim($updateArray['purchaseSummary']);?>
                                            </textarea>

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
		 $("#prod_icon").show();
	}
	if($(this).val()==1)
	{
		$("#prod_icon").hide();
		$("#imagesrc").css("display","block");
		$("#image").show();
	}
	if($(this).val()=="0")
	{
		$("#image").hide();$("#prod_icon").hide();
		$("#imagesrc").css("display","none");
		
	}
});
});
 </script>
  

  