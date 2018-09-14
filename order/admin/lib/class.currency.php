<?php

/*Author : responsiveexperts

Date: 20 / 02 /2015*/

class currency

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

	public function getCurrencyList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."currency";

		$Currencylist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $Currencylist;

	}

	public function insertCurrency($CurrencyArr,$table)

	{

		$this->db->connect();

		$insid=$this->db->insertRecord(TABLE_PREFIX.$table, $CurrencyArr);

		$this->db->close();

		return $insid;

	}

	public function deleteCurrencyById($CurrencyId)

	{

		$this->db->connect();

		$query2 = "DELETE from ".TABLE_PREFIX."currency WHERE idCurrency='$CurrencyId'";

		$res = $this->db->query($query2);

		$this->db->close();

		return $res;

	}

	public function getCurrencyById($CurrencyId)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."currency WHERE idCurrency='$CurrencyId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function updateCurrencyById($updarray,$CurrencyId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."currency",$updarray,$condition="idCurrency='$CurrencyId'");

		$this->db->close();

		return $res;

	}

}

?>