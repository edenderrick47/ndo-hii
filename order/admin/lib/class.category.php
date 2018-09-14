<?php

/*Author :responsiveexperts

Date: 19 / 02 /2015*/

class category

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

	public function getCategoryList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."category";

		$catlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $catlist;

	}

	public function insertcategory($catArr,$table)

	{

		$this->db->connect();

		$insid=$this->db->insertRecord(TABLE_PREFIX.$table, $catArr);

		$this->db->close();

		return $insid;

	}

	public function getCategoryById($catId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."category WHERE idCategory='$catId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function deleteCategoryById($catId)

	{

		$this->db->connect();

		$query1 = "SELECT * from ".TABLE_PREFIX."category WHERE idCategory='$catId'";

		$catlist = $this->db->fetchArray($this->db->query($query1));

		$image=$catlist[0]['catImage'];

		$query2 = "DELETE from ".TABLE_PREFIX."category WHERE idCategory='$catId'";

		$res = $this->db->query($query2);

		if($res)

		{

			if(file_exists("../public/uploads/category/".$image))

			{

			unlink("../public/uploads/category/".$image);	

			}

		}

		$this->db->close();

		return $res;

	}

	public function updateCategoryById($updarray,$catId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."category",$updarray,$condition="idCategory='$catId'");

		$this->db->close();

		return $res;

	}

	

}

?>