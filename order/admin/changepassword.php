<?php
include('header.php');
	$updateArray=array();
	$errMsg="";$succMsg="";$err=0;
	$admin=$adminObj->getAdminDetails($_SESSION['msg_admin_id']);
	$pwd=$admin[0]['password'];
	$oldpass=isset($_POST['oldpass']) ? cleanInputField($_POST['oldpass'])  : '';
	$newpass=isset($_POST['newpass']) ? cleanInputField($_POST['newpass'])  : '';
	$confirmpass=isset($_POST['confirmpass']) ? cleanInputField($_POST['confirmpass'])  : '';
	
if(isset($_POST['submit']))
{
	if($oldpass=="" || $newpass=="" || $confirmpass=="")	
	{
		$err=1;
		$errMsg="Please enter all mandatory fields";
	}
	else if($oldpass!=$pwd)
	{
		$err=1;
		$errMsg='Old password is not correct';
	}
	else if($newpass!=$confirmpass)
	{
		$err=1;
		$errMsg='New password and confirm password must be same';
	}
	else
	{
		if($err==0)
		{
			$up=$adminObj->updatePassword($confirmpass);
			$oldpass='';
			$newpass='';
			$confirmpass='';
			$succMsg="Data updated successfully";
		}
	}
}
?>
        
       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Change Password
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" enctype="multipart/form-data" name="pswdform" id="pswdform">
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
                                            <label>Old password <span class="error">*</span></label>
                                            <input class="form-control" name="oldpass" id="oldpass" type="password" value="<?php echo $oldpass;?>" autocomplete="off">
                                        </div>
                                         <div class="form-group">
                                            <label>New password <span class="error">*</span></label>
                                            <input class="form-control" name="newpass" id="newpass" type="password" value="<?php echo $newpass;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm password <span class="error">*</span></label>
                                            <input class="form-control" name="confirmpass" id="confirmpass" type="password" value="<?php echo $confirmpass;?>">
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
  
  