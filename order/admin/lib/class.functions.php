<?php
/*Author :responsiveexperts

Date: 19 / 02 /2015*/
class functions {

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

	/**

	* Function to get client tickets list

	*/

	function replaceTextareaContent($text)

	{

		return str_replace(array("\\r","\\n"), array("\r","\n"), $text);

	}

	function changeStatus($uniqueId,$status,$table,$field){

            

            $this->db->open();

            $query   = "update $table set isActive = '$status' where $field = '$uniqueId'";

            $results = $this->db->query($query);

	    $this->db->close();

            return $results;

            

        }

		function changeUserStatus($uniqueId,$status,$table,$field){

            

            $this->db->open();

            $query   = "update $table set isActive = '$status',dateOfActivation='".date('y-m-d h:i:s')."' where $field = '$uniqueId'";

            $results = $this->db->query($query);

	    $this->db->close();

            return $results;

            

        }

		function deletedata($uniqueId,$table,$field){

            

            $this->db->open();

            $query   = "DELETE FROM $table WHERE $field = '$uniqueId'";

            $results = $this->db->query($query);

	    	$this->db->close();

            return $results;

            

        }

	function getContentList($table){

		$this->db->open();

		$query_pag_data = "SELECT * from $table";

		$cmcList = $this->db->fetchArray($this->db->query($query_pag_data));

		$this->db->close();

		return $cmcList;

	}

	 function getComboValuesWithQuery($query,$curvalue,$caption="")

    {

        	$this->db->open();

        $result    = mysql_query($query);

        if ($caption) {

               $option = "<option value=''>$caption</option>";

        } else {

            $option = "";

        }



        if(mysql_num_rows($result)) {        

            while ($row=mysql_fetch_object($this->$result)) {

                if ($curvalue==$this->$row->f2) {

                    

                    $option .= "<option value='$this->$row->f2' selected=\"selected\">". 

                    stripslashes($this->$row->f1)."</option>";   

					/* $option .= "<option value='$row->f2' selected=\"selected\"><strong>". 

                    stripslashes($row->f1)."</strong></option>";   */  

                } else {

                    $option .= "<option value='$this->$row->f2'>". 

                    stripslashes($this->$row->f1)."</option>";

                }

            }

        }

			$this->db->close();

         return $option;

    }

	function getComboValues(

        $name,$value,$curvalue,$table,$condition="",$caption=""

    ) {

	$this->db->open();

        $query    = "SELECT DISTINCT $name as f1,$value as f2 

        FROM $table $condition";

        //echo     $query;

        

        $result    = mysql_query($query);

        $option ="";    

        if (mysql_num_rows($result)) {

            

            if ($caption<>1) {

                if ($caption=="nocaption") {

                        $option ="";

                } elseif ($caption!="") {

                        $option ="<option value='0'>$caption</option>";

                } else {

                     

                        $option ="<option value=''>Select one</option>";

                }

            }

            while ($row=mysql_fetch_object($result)) {

                if ($curvalue==$row->f2) {

                    //echo "<br>$curvalue:" . $row->f2;

                    $option .= "<option value='$row->f2' selected>". 

                    ($row->f1) . "</option>";    //strtolower//ucwords(

                } else {

                    $option .= "<option value='$row->f2'>". ($row->f1) .

                     "</option>";    //strtolower    

                }

            }

        }

		$this->db->close();

         return $option;

    }

	function delete_id($id, $field, $table)

	{

		$this->db->open();

		if( is_array($id) )

		{

			foreach( $id AS $i )

			{

				$this->db->query("DELETE FROM $table WHERE $field = '$i'");

			}

		}

		else

		{

			$this->db->query("DELETE FROM $table WHERE $field = '$id'");

		}

		$this->db->close();

	}

	function getContentById($table,$field,$template_id){

	$sql = "select * from $table where $field = '$template_id'";

		$this->db->open();

		$results = $this->db->fetchArray($this->db->query($sql));

		$this->db->close();

		if(count($results)>0){

			return $results;

		}

	

	}

	function addContent($array,$table)

	{

	$this->db->open();



		while( @list($key,$value) = @each($array) )



		{



			$value=$value;



			$field_names[] = "$key";



			if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false) )



			$field_values[] = "'$value'";



			else



			$field_values[] = "$value";



		}



		$query = "INSERT INTO $table (";



		$query .= implode(', ', $field_names);



		$query .= ') VALUES (' . implode(',', $field_values) . ')';



		$this->db->query($query);



		return true;

		}

		function updateContent($array, $table, $field, $id)

	   {

	    $this->db->open();

		$query = "UPDATE $table SET ";

		while(@list($key,$value) = @each($array))

		{

		if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false))

			{

				$fields[] = "$key='$value'";

			}

			else

			{

				$fields[] = "$key=$value";

			}

		}

		$query .= implode(', ', $fields);

		$query .= " WHERE ".$field." = '$id'";

		$this->db->query($query);

		return true;

	}

	function updateStatus($table,$field,$status,$id)

	{

	$this->db->open();

	if($status=='act')

	{

	$sql = "update $table set `active`='1' where $field = '$id'";

	}

	else

	{

	$sql = "update $table set `active`='0' where $field = '$id'";

	}

	$results = $this->db->query($sql);

	$this->db->close();

	}

	public function getRowsCount($tablename, $condition="")

	{

	     $this->db->open();

		$result = $this->db->SelectQuery("SELECT COUNT(*) AS rows FROM `".$tablename."` WHERE $condition");

		$resCount=(int) $result[0]['rows'];

		return $resCount;

		$this->db->close();

	}

	/*

	function updateCMS($id_cms_language,$name,$content,$idlanguage){

		$sql = "update `cms_language` set `pageTitle`='$name',`content` ='$content' where `id_cms_language` = '$id_cms_language' and idlanguage='$idlanguage'";

		$this->db->open();

		$results = $this->db->query($sql);

		$this->db->close();

	}

	function getmaxId()

	{

	  $this->db->open();

	    $sql1 = "select max(id_cms_language) from `cms_language`";

		$idcms=$this->db->fetchArray($this->db->query($sql1));

		$idcms=$idcms[0]['max(id_cms_language)'];

		$this->db->close();

		return $idcms;

	}

	function addCMS($name,$content,$idlanguage,$idcms){	

	   $this->db->open();

		$sql="insert into `cms_language` (`pageTitle`,`content`,`idlanguage`) values ('$name','$content','$idlanguage')";

		$results = $this->db->query($sql);

		$this->db->close();

	}

	function getCmsIdForLanguageWithPageId($id_cms_language,$languageId){

		$sql = "select * from `cms_language` where `id_cms_language` = '$id_cms_language' and idlanguage ='$languageId'";

		$this->db->open();

		$results = $this->db->fetchArray($this->db->query($sql));

		$this->db->close();

		if(count($results)>0){

			return $results[0]['id_cms_language'];

		}

	}

	

	

	function getCMSNew($id_cms_language,$idlanguage){

		$sql = "select * from `cms_language` where `id_cms_language` = '$id_cms_language' and idlanguage='$idlanguage'";

		$this->db->open();

		$results = $this->db->fetchArray($this->db->query($sql));

		$this->db->close();

		if(count($results)>0){

			return $results;

		}

	}*/

	//THEME SHOWCASE

	function check_email_address($email) 

	{

	 return filter_var($email, FILTER_VALIDATE_EMAIL);

	}

}

?>

