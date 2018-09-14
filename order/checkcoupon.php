<?php
include("settings.php");
$couponcode=$_POST['coupon'];
$productId=$_POST['product'];
$couponArr=$obj->checkCouponCode($productId,$couponcode);
if(!empty($couponArr))
{
$discountType=$couponArr[0]['discountType'];
$discountVal=$couponArr[0]['discountValue'];
echo $discountVal."|".$discountType;
}
else
{
echo 0;
}
?>