<?php

/*Author : responsiveexperts

Date: 20 / 02 /2015*/

class template
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

	public function getTemplateList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."mailtemplate";

		$Templatelist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $Templatelist;

	}

	public function insertTemplate($TemplateArr,$table)

	{

		$this->db->connect();

		$insid=$this->db->insertRecord(TABLE_PREFIX.$table, $TemplateArr);

		$this->db->close();

		return $insid;

	}

	public function deleteTemplateById($TemplateId)

	{

		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."mailtemplate WHERE idTemplate='$TemplateId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

	public function getTemplateById($TemplateId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."mailtemplate WHERE idTemplate='$TemplateId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function updateTemplateById($updarray,$TemplateId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."mailtemplate",$updarray,$condition="idTemplate='$TemplateId'");

		$this->db->close();

		return $res;

	}

}

?>