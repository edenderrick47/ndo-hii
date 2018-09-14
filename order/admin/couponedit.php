<?php

include('header.php');

if(isset($_GET['id']))

{

	$id=base64_decode($_GET['id']);

	$coupon=$couponObj->getCouponById($id);

}

else

{

	header("location:couponlist.php");

}



	$productlist=$prodObj-> getProductlist();

	$prodCoupons=$couponObj-> getCouponProductsById($id);



	$updateArray=array();$prodoptions=array();$prodCouponsArr=array();

	$selcouponprods=array();

	$errMsg="";$succMsg="";$err=0;

	

	$updateArray['couponCode']=isset($_POST['code'])?cleanInputField($_POST['code']):$coupon[0]['couponCode'];

	$updateArray['discountType']=isset($_POST['discType'])?cleanInputField($_POST['discType']):$coupon[0]['discountType'];

	$updateArray['discountValue']=isset($_POST['value'])?cleanInputField($_POST['value']):$coupon[0]['discountValue'];

	$updateArray['discountValue']=isset($_POST['value'])?cleanInputField($_POST['value']):$coupon[0]['discountValue'];

	$from=date('m/d/Y',strtotime($coupon[0]['dateFrom']));

	$to=date('m/d/Y',strtotime($coupon[0]['dateTo']));

	$date=isset($_POST['date'])?$_POST['date']:($from.' - '.$to);

	$updateArray['status']=isset($_POST['status'])?cleanInputField($_POST['status']):$coupon[0]['status'];

	

	$selprods=isset($_POST['products'])?$_POST['products']:'';//selected coupon products

	if(!empty($prodCoupons))//old coupon products

	{

		for($prod=0;$prod<count($prodCoupons);$prod++)

		{
			if($prodCoupons[$prod]['idProduct']!="")
			{
				$prodCouponsArr[] = $prodCoupons[$prod]['idProduct'];
			}

		}

	}
	if(!empty($selprods))//selected coupon products
	{
		foreach($selprods as $sel)
		{
			if($sel!="")
			{
				$selcouponprods[]=$sel;
			}
		}
	}
	

if(isset($_POST['submit']))

{ 		

		if($updateArray['couponCode']=="" || $updateArray['discountValue']=="" || $date=="")

		{

			$errMsg="Please enter all mandatory fields";

		}

		else

		{

				 $daterange=explode('-',$date);

				 $from=$daterange[0];

				 $to=$daterange[1];

				 $updateArray['dateFrom']=date('y-m-d',strtotime($from));

				 $updateArray['dateTo']=date('y-m-d',strtotime($to));

				 $upId=$couponObj->updateCouponById($updateArray,$id);

				if($upId)

				{
					$del=$couponObj->deleteCouponProductBycpnId($id);
					if($del)
					{
						if(!empty($selcouponprods)){
						for($cpn=0;$cpn<count($selcouponprods);$cpn++)

							{

									$insArry['idProduct']=$selcouponprods[$cpn];

									$insArry['idCoupon']=$id;

									$couponObj->insertcoupon($insArry,"coupon_products");


							}
						}
					}
					
					
					
					
					

				}

		

		$succMsg="Data updated successfully";

		$prodCoupons=$couponObj-> getCouponProductsById($id);

	}

}

?>

        <link href="public/less/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />    

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

                           Edit Coupon

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">

                                    <form role="form" method="post" enctype="multipart/form-data" name="couponform" id="couponform">

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

                                            <label>Code <span class="error">*</span></label>

                                            <input class="form-control" name="code" id="code" value="<?php echo $updateArray['couponCode'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>Discount type</label><br />

                                            <input type="radio" name="discType" id="discType" value="C" <?php if($updateArray['discountType']=='C'){?> checked="checked" <?php } ?> /> Price

                                            <input type="radio" name="discType" id="discType" value="P" <?php if($updateArray['discountType']=='P'){?> checked="checked" <?php } ?> /> %

                                            

                                        </div>

                                        <div class="form-group">

                                            <label>Value <span class="error">*</span></label>

                                            <input class="form-control" name="value" id="value" value="<?php echo $updateArray['discountValue'];?>">

                                        </div>

                                        

                                         <div class="form-group">

                                            <label>Date <span class="error">*</span></label>

                                            <input type="text" class="form-control" id="date" name="date" value="<?php echo $date;?>"/>

                                        </div>

                                         <div class="form-group">

                                            <label>Products <span class="error"></span></label>

                                            <select class="form-control" name="products[]" id="products[]" multiple="multiple">

                                                <option value="">None</option>

                                                <?php

												if(!empty($productlist))

												{

													for($opt=0;$opt<count($productlist);$opt++)

													{$selected="";

														for($prodopt=0;$prodopt<count($prodCoupons);$prodopt++)

														{

															

															if($productlist[$opt]['idproduct']==$prodCoupons[$prodopt]['idProduct'])

															{

																$selected="selected=selected";

													 		} 

														}

												?>

<option value="<?php echo $productlist[$opt]['idproduct'];?>" <?php echo $selected;?>><?php echo $productlist[$opt]['productName'];?> </option> 

                                                <?php

													}

												}

												?>

                                            </select>

                                        </div>

                                         <div class="form-group">

                                            <label>Status <span class="error">*</span></label>

                                          <select class="form-control" id="status" name="status">

                                                <option value="1" <?php if($updateArray['status']==1){?> selected="selected"<?php } ?>>Active</option>

                                                <option value="0" <?php if($updateArray['status']==0){?> selected="selected"<?php } ?>>Inactive</option>

                                                </select>

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

<script src="public/js/daterangepicker/daterangepicker.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() {	

	//Date range picker

	  $('#date').daterangepicker();

});

</script>  

