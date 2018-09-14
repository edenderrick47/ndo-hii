<?php 
include('header.php');
	$msg_suc = '';
	$items="";$ins="";
	$orderArr=array();
	if(isset($_POST))
	{
		$ins=$obj->submitOrder($_POST);
		
		if($ins=='err')
		{
		 header('Location: index.php');	
		}
		
	}
	else
	{
		header('Location: index.php');
	}	
	
	?>
<!-- Success message section start -->
    <section class="order-form">
    	<div class="container text-center">
			<?php if($ins==1) {?>
			<h2>Your order placed successfully!</h2>
            <p>Our team will analyze your order and send you order confirmation mail asap.<br/> Thank you.</p>
            <?php } ?>    
		 </div>   
</section>
<!-- Success message section end -->
<!-- Footer Area Start 
    ====================================================== -->
    <footer class="footer-area text-center">
        <a href="../index.html"><img src="img/f-logo.png" alt=""></a>
        <p>&copy;2018 <a href="http://www.pvaluewriters.com/" target="_blank">PValueWriters</a> All right reserved.</p>
    </footer>
    <!-- =================================================
    Footer Area End -->
    
    <!-- JavaScript Files -->
    <script type="text/javascript" src="js/jquery.js"></script><!-- jquery -->
    <script type="text/javascript" src="js/bootstrap.js"></script><!-- Bootstrap js -->
    <script type="text/javascript" src="js/core.js"></script><!-- Core js -->
    <script>
	setTimeout(function()
	{
    window.location.href = "index.php";
},10000)
	</script>
</body>
</html>
