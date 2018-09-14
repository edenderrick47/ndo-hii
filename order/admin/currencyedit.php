<?php
include('header.php');
if(isset($_GET['id']))
{
	$id=base64_decode($_GET['id']);
	$currency=$curObj->getCurrencyById($id);
}
else
{
	header("location:currencylist.php");
}
	$updateArray=array();
	$errMsg="";$succMsg="";$err=0;

	$updateArray['country']=isset($_POST['country'])?cleanInputField($_POST['country']):$currency[0]['country'];
	$updateArray['currency_code']=isset($_POST['currency_code'])?cleanInputField($_POST['currency_code']):$currency[0]['currency_code'];
	$updateArray['currency_name']=isset($_POST['currency_name'])?cleanInputField($_POST['currency_name']):$currency[0]['currency_name'];
	$updateArray['currrency_symbol']=isset($_POST['currrency_symbol'])?cleanInputField($_POST['currrency_symbol']):$currency[0]['currrency_symbol'];
	
if(isset($_POST['submit']))
{
	if($updateArray['country']=="" || $updateArray['currency_code']=="" || $updateArray['currency_name']==""){
		$errMsg="Please enter all mandatory fields";
	}
	else
	{
		$upd=$curObj->updatecurrencyById($updateArray,$id);
		$succMsg="Data updated successfully";
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
                           Edit currency
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" enctype="multipart/form-data" name="currencyform" id="currencyform">
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
                                            <label>Country <span class="error">*</span></label>
                                            <input class="form-control" name="country" id="country" value="<?php echo $updateArray['country'];?>">
                                        </div>
                                         <div class="form-group">
                                            <label>Currency code <span class="error">*</span></label>
                                            <input class="form-control" name="currency_code" id="currency_code" value="<?php echo $updateArray['currency_code'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Currency Name <span class="error">*</span></label>
                                            <input class="form-control" name="currency_name" id="currency_name" value="<?php echo $updateArray['currency_name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Currency Symbol <span class="error"></span></label>
                                            <input class="form-control" name="currrency_symbol" id="currrency_symbol" value="<?php echo $updateArray['currrency_symbol'];?>">
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
  
  