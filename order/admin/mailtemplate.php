<?php
include('header.php');
$insertArray=array();
$errMsg="";$succMsg="";$err=0;
	
	$insertArray['templateName']=isset($_POST['templateName'])?cleanInputField($_POST['templateName']):'';
	$insertArray['subject']=isset($_POST['subject'])?cleanInputField($_POST['subject']):'';
	$insertArray['mailContent']=isset($_POST['mailContent'])?cleanInputField($_POST['mailContent']):'';

	if(isset($_POST['submit']))
	{
		if($insertArray['templateName']=="" || $insertArray['subject']=="" || $insertArray['mailContent']=="")
		{
			$errMsg="Please enter all mandatory fields";
		}
		else
		{
			$ins=$tempObj->insertTemplate($insertArray,"mailtemplate");
			$insertArray['templateName']='';
			$insertArray['subject']='';
			$insertArray['mailContent']='';
			$succMsg="Data inserted successfully";
		}
	}
?>
        
       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mail Template</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add mail template
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" enctype="multipart/form-data" name="templateform" id="templateform">
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
                                            <label>Template name <span class="error">*</span></label>
                                             <input class="form-control" name="templateName" id="templateName" value="<?php echo $insertArray['templateName'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Subject <span class="error">*</span></label>
                                            <input class="form-control" name="subject" id="subject" value="<?php echo $insertArray['subject'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Mail Content <span class="error">*</span></label>
                                            <textarea class="form-control" rows="15" name="mailContent" id="mailContent"> <?php echo trim($obj->replaceTextareaContent($insertArray['mailContent']));?></textarea>
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