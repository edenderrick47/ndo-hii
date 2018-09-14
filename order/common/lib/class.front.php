<?php

/*Author :responsiveexperts

Date: 19 / 02 /2015*/

class front

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
		//$this->mail = new PHPMailer(true);

	}	

	public function getCategoryList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."category";

		$categories = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $categories;

	}

	public function getproductList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product ORDER BY idCategory";

		$productlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $productlist;

	}

	public function getproductByCategory($categoryid)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product WHERE idCategory='$categoryid'";

		$categorylist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $categorylist;

	}

	public function getProductOptions()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product_options ORDER BY idProduct";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}

	public function getProductOptionsById($idoption)

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."options WHERE idOption='$idoption'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res[0];

	}
	public function checkCouponCode($productId,$code)

	{

		$this->db->connect();
		$res =array();
		$query="SELECT a. * , b.idProduct
				FROM `".TABLE_PREFIX."coupon` a
				LEFT JOIN `".TABLE_PREFIX."coupon_products` b ON a.`idCoupon` = b.`idCoupon`
				AND a.`status` = '1'
				WHERE a.`dateFrom` <= '".date('Y-m-d')."'
				AND a.`dateTo` >= '".date('Y-m-d')."'
				AND a.`couponCode` = '$code' AND b.`idProduct`='$productId'";
		$res = $this->db->fetchArray($this->db->query($query));
		return $res;
	}
	
	public function getAdminData()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."administrator ORDER BY idAdmin ASC";

		$admindata = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $admindata;

	}
	public function getCurrencyById($CurrencyId)
	{
		$this->db->connect();
		$query = "SELECT * from ".TABLE_PREFIX."currency WHERE idCurrency='$CurrencyId'";
		$res = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $res;
	}
	public function getCustomerMailTemplate()
	{
		$this->db->connect();
		$query = "SELECT * from ".TABLE_PREFIX."mailtemplate WHERE idTemplate='1'";
		$res = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $res;
	}
	public function getAdminMailTemplate()
	{
		$this->db->connect();
		$query = "SELECT * from ".TABLE_PREFIX."mailtemplate WHERE idTemplate='2'";
		$res = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $res;
	}
	public function getuserRequestTemplate()
	{
		$this->db->connect();
		$query = "SELECT * from ".TABLE_PREFIX."mailtemplate WHERE idTemplate='3'";
		$res = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $res;
	}
	public function insertorder($orderArr)
	{
		$this->db->connect();
		$insid=$this->db->insertRecord(TABLE_PREFIX."orders", $orderArr);
		$this->db->close();
		return $insid;
	}

	public function getOrderList()

	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."orders ORDER BY date DESC";

		$orderlist = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $orderlist;

	}

	
	public function getProductById($productId)
	{

		$this->db->connect();

		$query = "SELECT * from ".TABLE_PREFIX."product WHERE idProduct='$productId'";

		$res = $this->db->fetchArray($this->db->query($query));

		$this->db->close();

		return $res;

	}
    public function submitOrder($postdata)
	{
		$admindata=$this->getAdminData();
		//Admin Email ID
		$adminEmail=$admindata[0]['email'];
		$smtphost=$admindata[0]['smtp_host'];
		$smtpuser=$admindata[0]['smtp_user'];
		$smtppass=$admindata[0]['smtp_password'];
		$smtpport=$admindata[0]['smtp_port'];
		$currencyId=$admindata[0]['idCurrency'];
		$show_price=$admindata[0]['show_price'];
		
		//Get currency details
		$currencydata=$this->getCurrencyById($currencyId);
		//currency symbol
		$currency=$currencysymbol=$currencydata[0]['currrency_symbol'];
		//currency code
		$currencycode=$currencydata[0]['currency_code'];
		//Admin Email ID
		$sellerfrom =$adminEmail;
		//Orde mail to
		$ordermailto=$admindata[0]['order_mail_to'];

		//Get order confirmation mail templates
		$customerTemplate=$this->getCustomerMailTemplate();
		$adminTemplate=$this->getAdminMailTemplate();
		$userRequestTemplate=$this->getuserRequestTemplate();
		//Order confirmation mail template to customer
		$customermail=$customerTemplate[0]['mailContent'];
		$customermailsubject=$customerTemplate[0]['subject'];
		
		//Order confirmation mail template to admin
		$adminmail=$adminTemplate[0]['mailContent'];
		$adminmailsubject=$adminTemplate[0]['subject'];
		
		$customeremail="";$items="";
		
		//Order through paypal
		if(isset($postdata['payment_status']))
		{
			if($postdata['payment_status']=="Completed")
			{ 
				//get user details passed as custom values
				if(isset($postdata['custom']))
				{
					parse_str($postdata['custom'],$_CUSTOMPOST);
					$name=$_CUSTOMPOST['name'];
					$contact= $_CUSTOMPOST['contact'];
					$message= $_CUSTOMPOST['message'];
					$email= $_CUSTOMPOST['email'];
					$itemcount=$_CUSTOMPOST['items'];
				}
				
				$customeremail=$email;//customer Email ID
				$currency=$postdata['mc_currency'];//Currency from paypal
				
				//array containing order details for order table
				$orderArr['customer_details']=$name."<br>".$email."<br>".$contact."<br><b>Message</b><br>".strip_tags($message)."<br>";
				$orderArr['customer_email']=$email;
				$orderArr['subtotal']=$currencysymbol.number_format($postdata['discount']+$postdata['payment_gross'],2);
				$orderArr['discount']=$currencysymbol.$postdata['discount'];
				$orderArr['total']=$currencysymbol.$postdata['payment_gross'];
				$orderArr['orderType']="paypal";
				$orderArr['payment_status']="completed";
				$orderArr['txn_id']=$postdata['txn_id'];
				$orderArr['Items']="";
				$discount= isset($postdata['discount'])?$currencysymbol.$postdata['discount']:0;
				
				//cart details in a table
				if($show_price==1){
				$items='<table width="80%" border="1" cellspacing="0"><tr><td>Sl No.</td><td>Item name</td><td>Quantity</td><td><strong>Unit Price</strong></td><td><strong>Total Price</strong></td></tr>';
				for($cnt=1;$cnt<=$itemcount;$cnt++)
				{
					if(isset($postdata['item_name'.$cnt]))
					{
						if($cnt!=1){$orderArr['Items'].="+";}
						$orderArr['Items'].=$postdata['item_name'.$cnt]."[".$currencysymbol.($postdata['mc_gross_'.$cnt])."]";
					$items.='<tr><td>'.$cnt.'</td><td>'.$postdata['item_name'.$cnt].'</td><td>'.$postdata['quantity'.$cnt].'</td><td>'.$currencysymbol.($postdata['mc_gross_'.$cnt]/$postdata['quantity'.$cnt]).'</td><td>'.$currencysymbol.$postdata['mc_gross_'.$cnt].'</td></tr>';			
					
					}
				}
				
				 $items.='<tr>
			  <td colspan="3" rowspan="3">&nbsp;</td>
			  <td><b>Subtotal</b></td>
			  <td>'.$currencysymbol.number_format($postdata['discount']+$postdata['payment_gross'],2).' '.$currency.'</td>
			</tr>
			<tr>
			  <td><b>Discount</b></td>
			  <td>'.$discount.'</td>
			</tr>
			<tr>
			  <td><b>Total</b></td>
			  <td>'.$currencysymbol.$postdata['payment_gross']." ".$currency.'</td>
			</tr></table>';
				}
				//dont show price
				else
				{
					$items='<table width="80%" border="1" cellspacing="0"><tr><td>Sl No.</td><td>Item name</td><td>Quantity</td></tr>';
				for($cnt=1;$cnt<=$itemcount;$cnt++)
				{
					if(isset($postdata['item_name'.$cnt]))
					{
						if($cnt!=1){$orderArr['Items'].="+";}
						$orderArr['Items'].=$postdata['item_name'.$cnt]."[".$currencysymbol.($postdata['mc_gross_'.$cnt])."]";
					$items.='<tr><td>'.$cnt.'</td><td>'.$postdata['item_name'.$cnt].'</td><td>'.$postdata['quantity'.$cnt].'</td></tr>';			
					
					}
				}
				
				 $items.='</table>';
				}
				$orderArr['cart']=$items;
				//----- email to customer start ----
				$message=nl2br($customermail);
				$message=str_replace('{name}',$name,$message);
				$message=str_replace('{items}',$items,$message);
				$subject= $customermailsubject;
				$sent=$this->sendMailtoCustomer($sellerfrom, $customeremail, $subject, $message);
				//----- email to customer end ----
				
				//----- email to us start ------------------------------
				$message_team=nl2br($adminmail);
				$message_team=str_replace('{items}',$items,$message_team);
				$message_team=str_replace('{customer}',$orderArr['customer_details'],$message_team);
				$subject2 = $adminmailsubject;
				$sent=$this->sendMailtoAdmin($sellerfrom, $ordermailto, $subject2, $message_team);
				//----- email to us end ----
				
				if($sent==1){$orderArr['mailStatus']="sent";}else{$orderArr['mailStatus']="Not sent";}
				
				//insert order details into order table
				$ins=$this->insertorder($orderArr);
				}
				return $sent;
		}
		//Order through e mail
		else if(isset($postdata['customer_name']))
		{
				//get user data
				$name=$postdata['customer_name'];
				$contact= $postdata['customer_contact'];
				$message= $postdata['customer_message'];
				$email= $postdata['customer_email'];
				$sent=0;
				
				$customeremail=$email;//customer Email Id
				$currency=$currencycode;//currency code
				$orderArr['customer_details']=$name."<br>".$email."<br>".$contact."<br><b>Message</b><br>".$message."<br>";
				
				if($postdata['product']=="")
				{
					//----- email to us start ----
					$message_requst=nl2br($userRequestTemplate[0]['mailContent']);
					$message_requst=str_replace('{customer}',$orderArr['customer_details'],$message_requst);
					$subject3 = $userRequestTemplate[0]['subject'];
		    		$sent=$this->sendMailtoAdmin($sellerfrom, $ordermailto, $subject3, $message_requst);
					
				}
				else
				{
				//array containing order details for order table
				$itemcount=$postdata['count'];
				$orderArr['customer_email']=$email;
				$orderArr['subtotal']=$currencysymbol.number_format($postdata['discount']+$postdata['total_cost'],2);
				$orderArr['discount']=$currencysymbol.$postdata['discount'];
				$orderArr['total']=$currencysymbol.$postdata['total_cost'];
				$orderArr['orderType']="mail";
				$orderArr['payment_status']="NA";
				$orderArr['txn_id']="NA";
				$orderArr['Items']="";
				$discount= isset($postdata['discount'])?$currencysymbol.$postdata['discount']:0;
				
				if($show_price==1){
					 if($itemcount>0){
			//cart details in a table
			 $items='<table width="80%" border="1" cellspacing="0"><tr><td>Sl No.</td><td>Item name</td><td>Quantity</td><td><strong>Unit Price</strong></td><td><strong>Total Price</strong></td></tr>';
			
			for($cnt=1;$cnt<=$itemcount;$cnt++)
			{
				if(isset($postdata['item_name_'.$cnt]))
				{
				if($cnt!=1){$orderArr['Items'].="+";}
				$orderArr['Items'].=($postdata['item_name_'.$cnt]).("[".$currencysymbol.($postdata['amount_'.$cnt]*$postdata['quantity_'.$cnt])."]");
				$items.='<tr><td>'.$cnt.'</td><td>'.$postdata['item_name_'.$cnt].'</td><td>'.$postdata['quantity_'.$cnt].'</td><td>'.$currencysymbol.$postdata['amount_'.$cnt].'</td><td>'.$currencysymbol.($postdata['amount_'.$cnt]*$postdata['quantity_'.$cnt]).'</td></tr>';
				
				}
			}
			
		  $items.='<tr>
		  <td colspan="3" rowspan="3">&nbsp;</td>
		  <td><b>Subtotal</b></td>
		  <td>'.$currencysymbol.number_format($postdata['discount']+$postdata['total_cost'],2)." ".$currencycode.'</td>
		</tr>
		<tr>
		  <td><b>Discount</b></td>
		  <td>'.$discount.'</td>
		</tr>
		<tr>
		  <td><b>Total</b></td>
		  <td><b>'.$currencysymbol.$postdata['total_cost'].' '.$currencycode.'</b></td>
		</tr></table>';
			 }
				}
				//dont show price
				else
				{
					$orderArr['subtotal']="NA";
					$orderArr['discount']="NA";
					$orderArr['total']="NA";
					 if($itemcount>0){
					$items='<table width="80%" border="1" cellspacing="0"><tr><td>Sl No.</td><td>Item name</td><td>Quantity</td></tr>';
			for($cnt=1;$cnt<=$itemcount;$cnt++)
			{
				if(isset($postdata['item_name_'.$cnt]))
				{
				if($cnt!=1){$orderArr['Items'].="+";}
				$orderArr['Items'].=($postdata['item_name_'.$cnt]).("[".$currencysymbol.($postdata['amount_'.$cnt]*$postdata['quantity_'.$cnt])."]");
				$items.='<tr><td>'.$cnt.'</td><td>'.$postdata['item_name_'.$cnt].'</td><td>'.$postdata['quantity_'.$cnt].'</td></tr>';
				
				}
			}
			$items.='</table>';
					 }
				}
			$orderArr['cart']=$items;
			
			//----- email to user start ----
			$message=nl2br($customermail);
			$message=str_replace('{name}',$name,$message);
			$message=str_replace('{items}',$items,$message);
			$subject= $customermailsubject;
			$sent=$this->sendMailtoCustomer($sellerfrom, $customeremail, $subject, $message);
			//----- email to user end ----
			
			//----- email to us start ----
			 $message_team=nl2br($adminmail);
			 $message_team=str_replace('{items}',$items,$message_team);
			 $message_team=str_replace('{customer}',$orderArr['customer_details'],$message_team);
			 $subject2 = $adminmailsubject;
		     $sent=$this->sendMailtoAdmin($sellerfrom, $ordermailto, $subject2, $message_team);
			
			
			//----- email to us end ----
			 
			if($sent==1){$orderArr['mailStatus']="sent";}else{$orderArr['mailStatus']="Not sent";}
			
			 $ins=$this->insertorder($orderArr);
			
		}
			return $sent;
		}
		else
		{
			return "err";
		}
	}
		public function sendMailtoCustomer($from, $to="", $subject, $message) {
			
		$admindata=$this->getAdminData();
		$is_smtp=$admindata[0]['is_smtp'];
		$smtphost=$admindata[0]['smtp_host'];
		$smtpuser=$admindata[0]['smtp_user'];
		$smtppass=$admindata[0]['smtp_password'];
		$smtpport=$admindata[0]['smtp_port'];
		
		$mailObj1 = new PHPMailer(true);
        $fromNameArray = explode('@', $from);
        $fromName = $fromNameArray[0];
		$toArray=array();
        try {
            if($is_smtp==1){$mailObj1->IsSMTP();    // set mailer to use SMTP
            $mailObj1->Host        = $smtphost;    // specify main and backup server
            $mailObj1->SMTPAuth    = true;    // turn on SMTP authentication
            $mailObj1->Username    = $smtpuser;    // SMTP username -- CHANGE --
            $mailObj1->Password    = $smtppass;   // SMTP password -- CHANGE --
            $mailObj1->Port        = $smtpport;}    // SMTP Port
            
            $toArray = explode(',', $to);
            for($i=0;$i<count($toArray);$i++){
                $toMail = $toArray[$i];
                if ($toMail != '') { 
                    $toNameArray = explode('@', $toMail);
                    $toName = $toNameArray[0];
                    $mailObj1->AddAddress($toMail, $toName);
                }
            }
			
            $mailObj1->SetFrom($from, $fromName);
            $mailObj1->AddReplyTo($from, $fromName);
            $mailObj1->Subject = $subject;
            $mailObj1->AltBody = $message;
            $mailObj1->MsgHTML($message);
            $mailObj1->Send();
            return 1;
        } catch (Exception $e) {
            return 0;
          
        }
    }
	public function sendMailtoAdmin($from, $to="", $subject, $message) {
		$admindata=$this->getAdminData();
		$is_smtp=$admindata[0]['is_smtp'];
		$smtphost=$admindata[0]['smtp_host'];
		$smtpuser=$admindata[0]['smtp_user'];
		$smtppass=$admindata[0]['smtp_password'];
		$smtpport=$admindata[0]['smtp_port'];
		
		$mailObj2 = new PHPMailer(true);
        $fromNameArray = explode('@', $from);
        $fromName = $fromNameArray[0];
		$toArray=array();
        try {
            if($is_smtp==1){$mailObj2->IsSMTP();    // set mailer to use SMTP
            $mailObj2->Host        = $smtphost;    // specify main and backup server
            $mailObj2->SMTPAuth    = true;  
			  // turn on SMTP authentication
            $mailObj2->Username    = $smtpuser;    // SMTP username -- CHANGE --
            $mailObj2->Password    = $smtppass;   // SMTP password -- CHANGE --
            $mailObj2->Port        = $smtpport; }    // SMTP Port
            
            $toArray = explode(',', $to);
            for($i=0;$i<count($toArray);$i++){
                $toMail = $toArray[$i];
                if ($toMail != '') { 
                    $toNameArray = explode('@', $toMail);
                    $toName = $toNameArray[0];
                    $mailObj2->AddAddress($toMail, $toName);
                }
            }
						 
            $mailObj2->SetFrom($from, $fromName);
            $mailObj2->AddReplyTo($from, $fromName);
            $mailObj2->Subject = $subject;
            $mailObj2->AltBody = $message;
            $mailObj2->MsgHTML($message);
            $mailObj2->Send();
            return 1;
        } catch (Exception $e) {
            return 0;
          
        }
    }
	////
}

?>