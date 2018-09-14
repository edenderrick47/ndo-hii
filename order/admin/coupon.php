<?php
include('header.php');
$prodlist=$prodObj-> getproductList();
$insertArray=array();
$couponprods=array();
$errMsg="";$succMsg="";$err=0;
	
	$insertArray['couponCode']=isset($_POST['code'])?cleanInputField($_POST['code']):'';
	$insertArray['discountType']=isset($_POST['discType'])?cleanInputField($_POST['discType']):'C';
	$insertArray['discountValue']=isset($_POST['value'])?cleanInputField($_POST['value']):'';
	$date=isset($_POST['date'])?cleanInputField($_POST['date']):'';
	$insertArray['status']=isset($_POST['status'])?cleanInputField($_POST['status']):1;

	$image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');
if(isset($_POST['submit']))
{
	if(isset($_POST['products']))
	{
		$couponprods=$_POST['products'];
	}
	if($insertArray['couponCode']=="" || $insertArray['discountValue']=="" || $date=="")
	{
		$errMsg="Please enter all mandatory fields";
	}
	else
	{
	
		 $daterange=explode('-',$date);
		 $from=$daterange[0];
		 $to=$daterange[1];
		 $insertArray['dateFrom']=date('y-m-d',strtotime($from));
		 $insertArray['dateTo']=date('y-m-d',strtotime($to));
		 
		$ins=$couponObj->insertcoupon($insertArray,"coupon");
		if($ins && isset($_POST['products']))
		{
			if(!empty($couponprods))
			{
			  $insArry['idCoupon']=$ins;
			  for($cpn=0;$cpn<count($couponprods);$cpn++)
			  {
				  if($couponprods[$cpn]!="")
				  {
				  	$insArry['idProduct']=$couponprods[$cpn];
				  	$couponObj->insertcoupon($insArry,"coupon_products");
				  }
			  }
			}
		}
		$insertArray['couponCode']='';
		$insertArray['discountType']='';
		$insertArray['discountValue']='';
		$date='';
		$insertArray['status']='';
		$couponprods=array("");
		$succMsg="Data inserted successfully";
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
                           Add Coupon
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
                                            <input class="form-control" name="code" id="code" value="<?php echo $insertArray['couponCode'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Discount type</label><br />
                                            <input type="radio" name="discType" id="discType" value="C" <?php if($insertArray['discountType']=='C'){?> checked="checked" <?php } ?> /> Price
                                            <input type="radio" name="discType" id="discType" value="P" <?php if($insertArray['discountType']=='P'){?> checked="checked" <?php } ?> /> %
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Value <span class="error">*</span></label>
                                            <input class="form-control" name="value" id="value" value="<?php echo $insertArray['discountValue'];?>">
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
												if(!empty($prodlist)){
												for($prod=0;$prod<count($prodlist);$prod++){
												?>
<option value="<?php echo $prodlist[$prod]['idproduct'];?>" <?php if(in_array($prodlist[$prod]['idproduct'],$couponprods)){?> selected="selected" <?php } ?>><?php echo $prodlist[$prod]['productName'];?> </option>
                                                <?php
												}}
												?>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label>Status <span class="error">*</span></label>
                                          <select class="form-control" id="status" name="status">
                                                <option value="1" <?php if($insertArray['status']==1){?> selected="selected"<?php } ?>>Active</option>
                                                <option value="0" <?php if($insertArray['status']==0){?> selected="selected"<?php } ?>>Inactive</option>
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
