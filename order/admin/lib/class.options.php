<?php

/*Author : responsiveexperts

Date: 20 / 02 /2015*/

class options

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

	public function getOptionsList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."options";

		$optlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $optlist;

	}

	public function deleteOptionById($optId)

	{

		$this->db->connect();
		
		$query3 = "DELETE from ".TABLE_PREFIX."product_options WHERE idOption='$optId'";

		$this->db->query($query3);

		$query2 = "DELETE from ".TABLE_PREFIX."options WHERE idOption='".$optId."'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

	public function getOptionById($optId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."options WHERE idOption='$optId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function updateOptionById($updarray,$optId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."options",$updarray,$condition="idOption='$optId'");

		$this->db->close();

		return $res;

	}

}

?>