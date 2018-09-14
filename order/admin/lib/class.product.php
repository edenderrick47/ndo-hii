<?php

/*Author : responsiveexperts

Date: 19 / 02 /2015*/

class product

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

	public function getproductList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product";

		$productlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $productlist;

	}

	public function getOrderList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."orders ORDER BY date DESC";

		$orderlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $orderlist;

	}

	public function insertproduct($productArr,$table)

	{

		$this->db->connect();

		$insid=$this->db->insertRecord(TABLE_PREFIX.$table, $productArr);

		$this->db->close();

		return $insid;

	}

	public function getProductById($productId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product WHERE idProduct='$productId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}
	public function getOrderById($orderId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."orders WHERE idOrder='$orderId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}
	public function getOrderListByType($typ)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."orders WHERE orderType='$typ' ORDER BY date DESC";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function getProductOptions($productId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product_options WHERE idProduct='$productId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function deleteProductById($productId)

	{

		$this->db->connect();

		$query1 = "SELECT * from ".TABLE_PREFIX."product WHERE idProduct='$productId'";

		$productlist = $this->db->fetchArray($this->db->query($query1));

		$image=$productlist[0]['productImage'];

		$query3 = "DELETE from ".TABLE_PREFIX."product_options WHERE idProduct='$productId'";

		$this->db->query($query3);

		$query2 = "DELETE from ".TABLE_PREFIX."product WHERE idProduct='$productId'";

		$res = $this->db->query($query2);

		if($res)

		{

			if(file_exists("../public/uploads/products/".$image))

			{

			unlink("../public/uploads/products/".$image);	

			}

		}

		$this->db->close();

		return $res;

	}

	public function deleteOrderById($orderId)

	{

		$this->db->connect();

		$query3 = "DELETE from ".TABLE_PREFIX."orders WHERE idOrder='$orderId'";

		$this->db->query($query3);

		$this->db->close();

		return $res;

	}

	public function updateProductById($updarray,$productId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."product",$updarray,$condition="idproduct='$productId'");

		$this->db->close();

		return $res;

	}

	public function deleteProductOptionsById($productId)

	{
		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."product_options WHERE idProduct='$productId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;
	}

	public function deleteProductOptionsByoptId($optId,$productId)

	{

		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."product_options WHERE idOption='".$optId."' AND idProduct='$productId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

}

?>