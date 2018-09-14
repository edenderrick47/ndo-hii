<?php

include('header.php');

$currencylist=$curObj-> getCurrencyList();

$admin=$adminObj->getAdmin();



	$updateArray=array();

	$errMsg="";$succMsg="";$err=0;



	$updateArray['Name']=isset($_POST['Name'])?cleanInputField($_POST['Name']):$admin[0]['Name'];

	$updateArray['email']=isset($_POST['email'])?cleanInputField($_POST['email']):$admin[0]['email'];
	
	$updateArray['order_mail_to']=isset($_POST['order_mail_to'])?cleanInputField($_POST['order_mail_to']):$admin[0]['order_mail_to'];
	
	
	$updateArray['paypal_business_mail']=isset($_POST['paypal_business_mail'])?cleanInputField($_POST['paypal_business_mail']):$admin[0]['paypal_business_mail'];

	$updateArray['idCurrency']=isset($_POST['currency'])?cleanInputField($_POST['currency']):$admin[0]['idCurrency'];
	
	$updateArray['paypal_link']=isset($_POST['paypal_link'])?cleanInputField($_POST['paypal_link']):$admin[0]['paypal_link'];
	
	$updateArray['is_smtp']=isset($_POST['is_smtp'])?cleanInputField($_POST['is_smtp']):$admin[0]['is_smtp'];
	
	$updateArray['is_paypal']=isset($_POST['is_paypal'])?cleanInputField($_POST['is_paypal']):$admin[0]['is_paypal'];
	
	$updateArray['show_price']=isset($_POST['show_price'])?cleanInputField($_POST['show_price']):$admin[0]['show_price'];
	
	$updateArray['smtp_host']=isset($_POST['smtp_host'])?cleanInputField($_POST['smtp_host']):$admin[0]['smtp_host'];
	
	$updateArray['smtp_password']=isset($_POST['smtp_password'])?cleanInputField($_POST['smtp_password']):$admin[0]['smtp_password'];
	
	$updateArray['smtp_user']=isset($_POST['smtp_user'])?cleanInputField($_POST['smtp_user']):$admin[0]['smtp_user'];
	
	$updateArray['smtp_port']=isset($_POST['smtp_port'])?cleanInputField($_POST['smtp_port']):$admin[0]['smtp_port'];

	$user=$admin[0]['username'];

	$password=$admin[0]['password'];
	
	$updateArray['page_bottom_content']=isset($_POST['page_bottom_content'])?cleanInputField($obj->replaceTextareaContent($_POST['page_bottom_content'])):$obj->replaceTextareaContent($admin[0]['page_bottom_content']);

	

if(isset($_POST['submit']))

{
	if(isset($_POST['is_smtp']))
		{
			$checked=1;
		}
		else
		{
			$checked=0;
		}
		if(isset($_POST['is_paypal']))
		{
			$pay=1;
		}
		else
		{
			$pay=0;
		}
		if(isset($_POST['show_price']))
		{
			$show=1;
		}
		else
		{
			$show=0;
		}
	
	if($updateArray['Name']=="" || $updateArray['email']=="" || $updateArray['idCurrency']==""){

		$errMsg="Please enter all mandatory fields";

	}
	else if($pay==1 && ($updateArray['order_mail_to']=="" || $updateArray['paypal_business_mail']=="" || $updateArray['paypal_link']==""))
	{
		$errMsg="Please enter paypal details";
	}
	else if($checked==1 && ($updateArray['smtp_host']=="" || $updateArray['smtp_user']=="" || $updateArray['smtp_password']=="" ||$updateArray['smtp_password'] ==""))
	{
		$errMsg="Please enter SMTP details";
	}
	else if(filter_var($updateArray['email'],FILTER_VALIDATE_EMAIL)==false)
	{
		$errMsg="Please enter a valid Email ID";
	}
	else if($checked==1 && $updateArray['smtp_user']!=$updateArray['email'])
	{
		$errMsg="SMTP Username and Email must be same";
	}
	else if($updateArray['order_mail_to']!="" && filter_var($updateArray['order_mail_to'],FILTER_VALIDATE_EMAIL)==false)
	 {
		 $errMsg="Please enter a valid 'Order to Email ID'";
	 }
	else if($updateArray['paypal_business_mail']!="" && filter_var($updateArray['paypal_business_mail'],FILTER_VALIDATE_EMAIL)==false)
	{
		$errMsg="Please enter a valid 'Paypal business Email' ID";
	}

	else
	{
		
		$updateArray['is_smtp']=$checked;
		
		$updateArray['is_paypal']=$pay;
		
		$updateArray['show_price']=$show;
		
		$upd=$adminObj->updateAdminById($updateArray,$admin[0]['idAdmin']);
		
		$admin=$adminObj->getAdmin();

		$updateArray['page_bottom_content']=$obj->replaceTextareaContent($admin[0]['page_bottom_content']);
		
		$succMsg="Data updated successfully";
	}

}

?>

        

       <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Administrator</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Edit

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">

                                    <form role="form" method="post" enctype="multipart/form-data" name="adminform" id="adminform">

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

                                    <h3 class="page-header">Personal Details</h3>

                                    <div class="form-group">

                                            <label>Name <span class="error">*</span></label>

                                             <input class="form-control" name="Name" id="Name" value="<?php echo $updateArray['Name'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>Email <span class="error">*</span></label>

                                            <input class="form-control" name="email" id="email" value="<?php echo $updateArray['email'];?>">
                                            (Used as 'From' email for order mails.)

                                        </div>
                                        <div class="form-group">

                                            <label>Order to Email <span class="error">*</span></label>

                                            <input class="form-control" name="order_mail_to" id="order_mail_to" value="<?php echo $updateArray['order_mail_to'];?>">

                                        </div>
                                          <div class="form-group">

                                            <label>Currency <span class="error">*</span></label>

                                            <select class="form-control" name="currency" id="currency">

                                                <option>0</option>

                                                <?php

												if(!empty($currencylist)){

												for($cur=0;$cur<count($currencylist);$cur++){

												?>

                                                <option value="<?php echo $currencylist[$cur]['idCurrency'];?>" <?php if($currencylist[$cur]['idCurrency']==$updateArray['idCurrency']){?> selected="selected" <?php } ?>><?php echo $currencylist[$cur]['country'];?> </option>

                                                <?php

												}}

												?>

                                            </select>

                                        </div>
                                         <div class="form-group">

                                            <input type="checkbox" name="show_price" id="show_price" value="<?php echo $updateArray['show_price'];?>" <?php if($updateArray['show_price']==1){?> checked="checked"<?php } ?> /><label>&nbsp;Show product price <span class="error"></span></label>


                                        </div>
										 <div class="form-group">

                                            <label>Username <span class="error"></span></label>

                                            <input class="form-control" name="username" id="username" readonly="readonly" value="<?php echo $user;?>">

                                        </div>

                                         <div class="form-group">

                                            <label>Password <span class="error"></span></label>

                                            <input class="form-control" name="password" id="password" type="password" readonly="readonly" value="<?php echo $password;?>">

                                        </div>
 										<h3 class="page-header">Paypal Details</h3>
                                        <div class="form-group">

                                            <input type="checkbox" name="is_paypal" id="is_paypal" value="<?php echo $updateArray['is_paypal'];?>" <?php if($updateArray['is_paypal']==1){?> checked="checked"<?php } ?> /><label>&nbsp;Use Paypal <span class="error"></span></label>


                                        </div>
                                        <div id="show_paypal" <?php if($updateArray['is_paypal']!=1){?> style="display:none;" <?php } ?>>
                                          
                                         <div class="form-group">

                                            <label>Paypal Link <span class="error">*</span></label>

                                            <select class="form-control" name="paypal_link" id="paypal_link">
												<option value="https://www.paypal.com/in/cgi-bin/webscr" <?php if($updateArray['paypal_link']=="https://www.paypal.com/in/cgi-bin/webscr"){?> selected="selected" <?php } ?>>Paypal - [https://www.paypal.com/in/cgi-bin/webscr]</option>
                                                <option value="https://www.sandbox.paypal.com/cgi-bin/webscr" <?php if($updateArray['paypal_link']=="https://www.sandbox.paypal.com/cgi-bin/webscr"){?> selected="selected" <?php } ?>>Sandbox Test - [https://www.sandbox.paypal.com/cgi-bin/webscr]</option>
                                                 
                                                </select>
                                         </div>
                                         <div class="form-group">

                                            <label>Paypal business Email <span class="error">*</span></label>

                                            <input class="form-control" name="paypal_business_mail" id="paypal_business_mail" value="<?php echo $updateArray['paypal_business_mail'];?>">

                                        </div>
</div>
                                         <h3 class="page-header">Mail settings</h3>
									
                                     <div class="form-group">

                                            <input type="checkbox" name="is_smtp" id="is_smtp" value="<?php echo $updateArray['is_smtp'];?>" <?php if($updateArray['is_smtp']==1){?> checked="checked"<?php } ?> /><label>&nbsp;Use SMTP <span class="error"></span></label>


                                        </div>
                                    <div id="smtp" <?php if($updateArray['is_smtp']!=1){?> style="display:none;" <?php } ?>>
                                    <div class="form-group">

                                            <label>SMTP Host <span class="error">*</span></label>

                                             <input class="form-control" name="smtp_host" id="smtp_host" value="<?php echo $updateArray['smtp_host'];?>">

                                        </div>

                                        <div class="form-group">

                                            <label>SMTP Username <span class="error">*</span></label>

                                            <input class="form-control" name="smtp_user" id="smtp_user" value="<?php echo $updateArray['smtp_user'];?>">

                                        </div>
                                        <div class="form-group">

                                            <label>SMTP Password <span class="error">*</span></label>

                                            <input class="form-control" name="smtp_password" id="smtp_password" value="<?php echo $updateArray['smtp_password'];?>">

                                        </div>
                                        <div class="form-group">

                                            <label>SMTP Port <span class="error">*</span></label>

                                            <input class="form-control" name="smtp_port" id="smtp_port" value="<?php echo $updateArray['smtp_port'];?>">

                                        </div>
                                        
                                        

                                       </div>
										 <h3 class="page-header">Page settings</h3>
                                        <div class="form-group">

                                            <label>Bottom Content</label>

                                            <textarea class="form-control" rows="10" name="page_bottom_content" id="page_bottom_content"> 
											<?php echo trim($updateArray['page_bottom_content']);?>
                                            </textarea>

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
$("#is_smtp").click(function(e) {
    if (!$(this).is(':checked')) 
	{
		$("#smtp").css("display","none");
		$("#is_smtp").val(0);
	}
	else
	{
		$("#smtp").css("display","block");
		$("#is_smtp").val(1);
	}
});
$("#is_paypal").click(function(e) {
    if (!$(this).is(':checked')) 
	{
		$("#show_paypal").css("display","none");
		$("#is_paypal").val(0);
	}
	else
	{
		$("#show_paypal").css("display","block");
		$("#is_paypal").val(1);
	}
});
</script>
  