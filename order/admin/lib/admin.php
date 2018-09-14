<?php
/*Author :responsiveexperts

Date: 19 / 02 /2015*/
class admin

{

	function __construct()

	{
      if (phpversion() > '5.0')
	  {
		$this->db	     = new mysql2();
	  }
	  else
	  {
		$this->db	     = new mysql(); 
	  }
	}

	 function isLogged()

	 {

		 if(isset($_SESSION['msg_admin_id']))

		 {

			if($_SESSION['msg_admin_id']>0)

				return true;

			else

				return false;

		}

		else

		{

			return false;

		}

	 }

	 function terminateLoggin(){

	

		$userId = $_SESSION['msg_admin_id'];

		$_SESSION['msg_admin_id'] ='';

        unset($_SESSION['msg_admin_id']);

		unset($_SESSION['msg_admin_fullname']);

		unset($_SESSION['msg_admin_name']);

		unset($_SESSION['msg_admin_email']);
		if(isset($_SESSION['msg_admin_id']))

		 {

			
				return true;

		}
		else
		{
		      return false;
		}

    }

	function isLogginDetailsCurrect($userName,$password){

		//$password = md5($password);

		$sql = "select * from ".TABLE_PREFIX."administrator where username  = '$userName' and password  = '$password'";

		$this->db->connect();

		$results = $this->db->fetchArray($this->db->query($sql));
        print_r($results);
		$this->db->close();

		if(count($results)>0){			

			$userId = $results[0]['idAdmin'];

			$_SESSION['msg_admin_id'] = $results[0]['idAdmin'];

			$_SESSION['msg_admin_fullname'] = $results[0]['firstName'].' '.$results[0]['lastName'];	

			$_SESSION['msg_admin_name'] = $results[0]['firstName'];		

			$_SESSION['msg_admin_email'] = $results[0]['email'];	

			$returnResult['code']=1;

		}else{

			$returnResult['msg']="Invalid login";

		}

		return 	$returnResult;

	}  

	public function getAdmin()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."administrator";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function updateAdminById($updarray,$adminId)

	{

		$this->db->connect();

		$res=$this->db->updateQuery(TABLE_PREFIX."administrator",$updarray,$condition="idAdmin='$adminId'");

		$this->db->close();

		return $res;

	} 

	function getAdminDetails($admin_id){

		$sql = "select * from ".TABLE_PREFIX."administrator where idAdmin = '$admin_id'";

		$this->db->connect();

		$results = $this->db->fetchArray($this->db->query($sql));

		$this->db->close();

		return $results;

	}

	function updatePassword($password)

   {

   		$this->db->connect();

  	    $updateQuery = "update ".TABLE_PREFIX."administrator set password = '$password' where idAdmin = '".$_SESSION['msg_admin_id']."'";

		$this->db->query($updateQuery);

   }

}

?>