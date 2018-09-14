<?php

/*Author : responsiveexperts

Date: 20 / 02 /2015*/

class coupons

{

	function __construct(){

	  if (phpversion() > '5.0')
	  {
		$this->db	     = new mysql2();
	  }
	  else
	  {
		$this->db	     = new mysql(); 
	  }

	}	

	public function getCouponList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."coupon";

		$couponlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $couponlist;

	}

	public function insertcoupon($couponArr,$table)

	{

		$this->db->connect();

		$insid=$this->db->insertRecord(TABLE_PREFIX.$table, $couponArr);

		$this->db->close();

		return $insid;

	}

	public function deleteCouponById($couponId)

	{

		$this->db->connect();

		$query3 = "DELETE from ".TABLE_PREFIX."coupon_products WHERE idCoupon='$couponId'";

		$this->db->query($query3);

		$query2 = "DELETE from ".TABLE_PREFIX."coupon WHERE idCoupon='$couponId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

	public function getCouponById($couponId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."coupon WHERE idCoupon='$couponId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function updateCouponById($updarray,$couponId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."coupon",$updarray,$condition="idCoupon='$couponId'");

		$this->db->close();

		return $res;

	}

	public function getCouponProductsById($couponId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."coupon_products WHERE idCoupon='$couponId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function deleteCouponProductById($productId,$couponId)

	{

		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."coupon_products WHERE idProduct='$productId' AND idCoupon='$couponId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}
	public function deleteCouponProductBycpnId($couponId)

	{

		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."coupon_products WHERE idCoupon='$couponId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

}

?>