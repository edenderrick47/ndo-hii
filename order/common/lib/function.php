<?php
/*Author :responsiveexperts

Date: 19 / 02 /2015*/

function curPageName() {

	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

}

function cleanInputArray($arrRecord){

	$inputArray = array();

	foreach ($arrRecord as $fieldName => $fieldValue) {

		if (is_string($fieldValue))

			$inputArray[$fieldName] = cleanInputField($fieldValue);

		else

			$inputArray[$fieldName] = $fieldValue;

	}

	return $inputArray;

}

function cleanInputField($value){
	
	 if (phpversion() > '5.0')
	  {
		$db		     = new mysql2();
	  }
	  else
	  {
		$db	     = new mysql(); 
	  }
	$db->connect();

    if (phpversion() > '5.0')
	{
	  $value = mysqli_real_escape_string($db->connection,$value);
	}
	else
	{
	  $value = mysql_real_escape_string($value);
	}
     $db->close();

	return $value;	

}

function checkUploadedImagesAreCorrectOrNot($totalFiles,$allowedimagetype)

{

	$errorReturn = 0;

	for($f=1;$f<=$totalFiles;$f++){

		if(isset($_FILES['file_'.$f]['name'])){ 

			if($_FILES['file_'.$f]['name']){

				$imageName = $_FILES['file_'.$f]['name'];

				$imgExp    = explode('.', $imageName);

				$imageType = end($imgExp);						

				if(($imageName =='')||(!in_array($imageType, $allowedimagetype))) {

					$errorReturn = 1;	

				}

			}

		}

	}

	return $errorReturn;

}



function clearTextArea($ticketDetails){

	$ticketDetails = str_replace('\n', "<br>", $ticketDetails);

	$ticketDetails = str_replace('\r', " ", $ticketDetails);

	$ticketDetails = stripslashes($ticketDetails);

	$ticketDetails = stripslashes($ticketDetails);

	$ticketDetails = stripslashes($ticketDetails);

	return $ticketDetails;

}



 function getHowLongAgo($date, $display = array('year', 'month', 'day', 'hour', 'minute', 'second'), $ago = 'ago')

{

    $date = getdate(strtotime($date));

    $current = getdate();

    $p = array('year', 'mon', 'mday', 'hours', 'minutes', 'seconds');

    $factor = array(0, 12, 30, 24, 60, 60);



    for ($i = 0; $i < 6; $i++) {

        if ($i > 0) {

            $current[$p[$i]] += $current[$p[$i - 1]] * $factor[$i];

            $date[$p[$i]] += $date[$p[$i - 1]] * $factor[$i];

        }

        if ($current[$p[$i]] - $date[$p[$i]] > 1) {

            $value = $current[$p[$i]] - $date[$p[$i]];

            return $value . ' ' . $display[$i] . (($value != 1) ? 's' : '') . ' ' . $ago;

        }

    }



    return '';

}



function thumbnailCreation($sourceDirectory,$destinationDirectory,$fileName,$width,$height){

    

             /* Opening the thumbnail directory and looping through all the thumbs: */

            $dir_handle = @opendir($sourceDirectory); //Open Full image dirrectory

            if ($dir_handle > 1){ //Check to make sure the folder opened

            $allowed_types=array('jpg','jpeg','gif','png');

            $file_parts=array();

            $ext='';

            $title='';

            $i=0;



            $file = $fileName;

            

                /* Skipping the system files: */

                if($file=='.' || $file == '..') continue;



                $file_parts = explode('.',$file);    //This gets the file name of the images

                $ext = strtolower(array_pop($file_parts));



                /* Using the file name (withouth the extension) as a image title: */

                $title = implode('.',$file_parts);

                $title = htmlspecialchars($title);



                /* If the file extension is allowed: */

                if(in_array($ext,$allowed_types))

                {



                    /* If you would like to inpute images into a database, do your mysql query here */



                    /* The code past here is the code at the start of the tutorial */

                    /* Outputting each image: */



                    $nw = 150;

                    $nh = 100;

                    

                    $source = "$sourceDirectory{$file}";

                    $stype = explode(".", $source);

                    $stype = $stype[count($stype)-1];

                    $dest  = "$destinationDirectory{$file}";



                    $size = getimagesize($source);

                    $w = $size[0];

                    $h = $size[1];



                    switch($stype) {

                        case 'gif':

                            $simg = imagecreatefromgif($source);

                            break;

                        case 'jpg':

                            $simg = imagecreatefromjpeg($source);

                            break;

                        case 'png':

                            $simg = imagecreatefrompng($source);

                            break;

                    }



                    $dimg = imagecreatetruecolor($nw, $nh);

                    $wm = $w/$nw;

                    $hm = $h/$nh;

                    $h_height = $nh/2;

                    $w_height = $nw/2;



                    if($w> $h) {

                        $adjusted_width = $w / $hm;

                        $half_width = $adjusted_width / 2;

                        $int_width = $half_width - $w_height;

                        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);

                    } elseif(($w <$h) || ($w == $h)) {

                        $adjusted_height = $h / $wm;

                        $half_height = $adjusted_height / 2;

                        $int_height = $half_height - $h_height;



                        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);

                    } else {

                        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);

                    }

                        imagejpeg($dimg,$dest,100);

                    }

            



            /* Closing the directory */

            @closedir($dir_handle);



            }

}



function deleteImage($original,$thumb,$fileName){

    

    $original = $original.$fileName;

    $thumb    = $thumb.$fileName;

    

    if(file_exists($original)){

        unlink($original);

    }

    

    if(file_exists($thumb)){

        unlink($thumb);

    }

}



function shortenTxt($string, $limit, $break=".", $pad="...")

{



  if(strlen($string) <= $limit) return $string;

  if(false !== ($breakpoint = strpos($string, $break, $limit))) {

    if($breakpoint < strlen($string) - 1) {

      $string = substr($string, 0, $breakpoint) . $pad;

    }

  }



  return $string;

}



function check_email($email) {

       if (preg_match("/^(\w+((-\w+)|(\w.\w+))*)\@(\w+((\.|-)\w+)*\.\w+$)/",$email))

        {

        return true;

        }

        else 

        {

        return false;

        }

}

//Function to encode a given string...

function encode($str) {



	$re_str=base64_encode($str);

	

	$re_str=base64_encode($re_str);

	

	$re_str=base64_encode($re_str);

	

	return $re_str;



 } //End of function to encode a given string.





//Function to decode a given string...

function decode($str) {



	$re_str=base64_decode($str);

	

	$re_str=base64_decode($re_str);

	

	$re_str=base64_decode($re_str);

	

	return $re_str;



}

 function check_email_address($email) 

	{

	 return filter_var($email, FILTER_VALIDATE_EMAIL);

	}     

