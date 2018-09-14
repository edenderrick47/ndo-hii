<?php 
include("header-login.php");
$errorMsg ='';
if(isset($_POST['login'])){
	if($_POST['login']){
		$userName = $_POST['username'];
		$password = $_POST['password'];
		
		$userName = cleanInputField($userName);
		$password = cleanInputField($password);
		if($userName == '' || $password == ''){
			$errorMsg ='Invalid user name and password';
		}else {		
			$result = $adminObj->isLogginDetailsCurrect($userName,$password);
			if(isset($result['code'])){
				header('location:index.php');
			}else{
				$errorMsg =$result['msg'];
			}
		}
	}
}
?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                       
                    </div>
                    <div class="panel-body">
                     <?php if($errorMsg!=""){?>
                         <div class="alert alert-danger">
						 <label><?php echo $errorMsg;?></label>
						 </div>
                        <?php } ?>
                       <form action="" name="admin_login" id="admin_login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" id="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="username" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->
                                <input type="submit" class="btn bg-olive btn-block" name="login" id="login" value="Sign in">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
<?php include("footer.php");?>
<script src="public/validation/js/jquery.js" type="text/javascript"></script>
<script src="public/validation/js/jquery.validate.js" type="text/javascript"></script>
 <script type="text/javascript">
$(document).ready(function() {	
	// validate signup form on keyup and submit
	$("#admin_login").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Please enter username"
			},
			password: {
				required: "Please provide a password"
			}
		}
	});
});
</script>  