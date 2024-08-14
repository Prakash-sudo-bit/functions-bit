<div class="modal right fade" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Fill Out the Form Below</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" class="bform" id="myform">
				<input type="text" name="checkvalue" placeholder="Your name" class="noreason">
				<input type="hidden" class="form-control" name="downid" id="downid" readonly>            
                <input type="text" class="form-control" placeholder="Name*" pattern="[A-Za-z ]{1,32}" name="custname" required="">
                <input type="email" class="form-control" id="emailid" placeholder="E-mail*" name="cemail" required="">
				<input id="phone"  class="form-control" type="text" name="cphone" onkeypress="return isNumberKey(event);"  required="">
				<span id="valid-msg" class="hide cg">Valid</span>
				<span id="error-msg" class="hide cr">Invalid number</span>
			    <input type="hidden" id="fullNumber" name="fullNumber" />
				<input type="text" class="form-control" name="location" pattern="[A-Za-z ]{1,32}" placeholder="Location*" required="">				
                <input type="text" class="form-control" placeholder="Comany Name/Company URL" pattern="[A-Za-z ]{1,32}" name="companyname" required="">
				
				<?php
					$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
					date_default_timezone_set('Asia/Kolkata');
					$enquiry_date = $date->format('d-m-Y');
					$enquiry_time = date("g:i A");
					$starttime = date('Y-m-d H:i:s');
				 ?>	  

				<input type="hidden" name="website" value="<?php echo $_SERVER['SERVER_NAME']; ?>">
				<input type="hidden" name="subject" value=" Website Enquiry">
				<input type="hidden" name="useragent" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>">
				<input type="hidden" name="starttime" value="<?php echo $starttime; ?>"> 
				<input type="hidden" name="enquiry_date" value="<?php echo $enquiry_date; ?>"> 
				<input type="hidden" name="enquiry_month" value="<?php echo date("m-Y", strtotime($enquiry_date)); ?>">
				<input type="hidden" name="enquiry_time" value="<?php echo $enquiry_time; ?>">
				<input type="hidden" name="ipaddress" value="<?php echo $_SERVER['HTTP_X_FORWARDED_FOR']; ?>">
                <p class="tr"><input type="submit" name="sudmitbrou" class="cbtn" value="Download Brochure"></p>
						
			</form>
        </div>
          </div>
      </div>
      
    </div>
	
	
	
	
	
		 
<?php 
 $con    = mysqli_connect("");
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
include("mailer/class.phpmailer.php");
include("mailer/class.pop3.php");
include("mailer/class.smtp.php");

if((isset($_POST['sudmitbrou'])!='')&&(is_numeric($_POST['cphone']))){
	
	$honeypot = $_POST['checkvalue'];
	$downid=$_POST['downid'];
	$name=$_POST['custname']; 
	$mobile=$_POST['cphone'];
	$fullNumber=$_POST['fullNumber'];
	$location=$_POST['location']; 
	$email=$_POST['cemail']; 
	$companyname=$_POST['companyname'];
	$ipaddress=$_POST['ipaddress'];
	$useragent = $_POST['useragent'];

	$ar=explode("@",$email);
    $emailexte= $ar[1];

	$enquiry_date  = strtolower($_POST['enquiry_date']);
            
    $starttime          = $_POST['starttime'];
    date_default_timezone_set('Asia/Kolkata');
    $currentDate = date("Y-m-d H:i:s");
    $timeFirst  = strtotime($starttime);
    $timeSecond = strtotime($currentDate);
    $differenceInSeconds = $timeSecond - $timeFirst;

    if(($useragent=='')&&($enquiry_date=='') && ($_POST['cemail'] && filter_var($_POST['cemail'], FILTER_VALIDATE_EMAIL) == false) ){
    
    }else{
        if(($differenceInSeconds > 10)&&($emailexte!='outlook.com')){
			
			if(!preg_match ("/^[a-zA-Z ]*$/", $name) ) {  
		
				$ErrName = "Only alphabets are allowed in name field.";  
				echo "<script type='text/javascript'>alert('$ErrName');
				window.location.href = '/';</script>";
			
			}elseif(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) { 
			
                echo "<script type=\"text/javascript\">window.alert('Please Enter a Valid Email.');</script>";
                echo "<script>location.href = '/'</script>";
				
            }elseif(!preg_match ("/^[a-zA-Z ]*$/", $location) ) {  
		
				$ErrCity = "Only alphabets are allowed in City field.";  
				echo "<script type='text/javascript'>alert('$ErrCity');
				window.location.href = '/';</script>";
			
			}elseif(!preg_match ("/^[a-zA-Z ]*$/", $companyname) ) {  
		
				$ErrCity = "Only alphabets are allowed in Company Name field.";  
				echo "<script type='text/javascript'>alert('$ErrCity');
				window.location.href = '/';</script>";
			
			}else{

				date_default_timezone_set('Asia/Kolkata');
				$submit_date = date('Y-m-d');	
				$combined_date=date("m-Y");
					
				$sql2    = "select * from your table WHERE mobile='" . $fullNumber . "' and email='" . $email . "'and downid='" . $downid . "' and downloaddate='" . $submit_date . "'";
				$result2 = mysqli_query($con, $sql2);
				
				if (mysqli_num_rows($result2) > 3) {
					
					echo "<script type=\"text/javascript\">window.alert('Your Enquiry is already submitted.');</script>";
					echo "<script>location.href = '/'</script>";
					die();
					
				} else {
	
					$query=mysqli_query($con,"INSERT INTO `your table` (`name`,`mobile`,`email`,`companyname`,`downid`,`downloaddate`,`down_month`,`ipaddress`)VALUES('".$name."','".$fullNumber."','".$email."','".$companyname."','".$downid."','".$submit_date."','".$combined_date."','".$ipaddress."')");

					if($downid==''){
						$link="";
						$downname="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}
					if($downid==''){
						$downname='';
						$link="";
					}

					date_default_timezone_set("Asia/Kolkata"); // set time_zone according to your location
					$created = date('Y-m-d H:i'); // time when link is created 
					$expire_date = date('Y-m-d H:i',strtotime('+30 Days',strtotime($created)));


					$params  = 'downid='.$downid.'&downname='.$downname.'&expired='.$expire_date;
		
					$payload		=	base64_encode(urlencode($params));

					echo	$brochureUrl 	= "https://your_domain/brochure-file?payload=".$payload;



					$htmlContent = '<html><title>Application</title><head></head><body><table cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center"><img src="https://www.reldrill.com/images/logo.png" > <br></p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hello Sir/Madam, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0px 0px 10px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0px"></b>Brochure Download Through REL Website </b></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color: rgb(229 30 36);color: rgb(255 255 255);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Contact Details: </p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Name</td><td style="font-weight:normal">'.$name.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Mobile Number</td><td style="font-weight:normal">'.$fullNumber.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Email Id</td><td style="font-weight:normal">'.$email.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Company Name</td><td style="font-weight:normal">'.$companyname.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Brochure</td><td style="font-weight:normal">'.$downname.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Location</td><td style="font-weight:normal">'.$location.'</td></tr></tr></tbody></table></td></tr></tbody></table>
					</td></tr><tr><td style="margin:0;padding:6px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';



					$htmlContentone = '<html><title>Application</title><head></head><body style="background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
					<table align="center" border="0" cellpadding="0"  bgcolor="#EFEDED" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #ffffff;color: #000000;width: 680px;" width="680"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td style="border:5px solid #e51e24;background:#fff;margin:0;padding:20px;border-spacing:0"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0 0 15px 0;border-spacing:0"><p style="font-size:14px;color:#000;font-family:Arial,Helvetica,sans-serif;font-weight:700;line-height:1.5em;margin:0;padding:.4em;text-align:center"><img src="https://www.reldrill.com/images/logo.png"><br></p></td></tr><tr><td style="margin:0;padding:0 0 15px 0;border-spacing:0"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"><strong>Dear ' . $name . ',</strong><br></p></td></tr><tr><td style="margin:0;padding:0 0 10px 0;border-spacing:0"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0">Greetings from Revathi Equipments!</p></td></tr><tr><td style="margin:0;padding:0 0 10px 0;border-spacing:0"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0">Your Download is ready. <a href="'.$brochureUrl.'"><b>Click here</b> </a> to download your Brochure copy. For further assistance, please contact us at <a href="mailto:support@reldrill.com">support@reldrill.com</a> </p></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:5px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

					$mail2 = new PHPMailer();
					$mail2->IsSMTP();
					$mail2->SMTPDebug  = 0;
					$mail2->SMTPAuth   = true;
					$mail2->SMTPSecure = 'ssl';
					$mail2->Host       = "smtp.sendgrid.net";
					$mail2->Port       = 465;
					$mail2->IsHTML(true);
					$mail2->Username =('apikey');
					$mail2->Password ='';
					$mail2->setFrom('');
					$mail2->addReplyTo('');
					$mail2->addAddress($email);
					$mail2->isHTML(true);
					$mail2->Subject = 'Brochure Download';
					$mail2->Body    = $htmlContentone;
					$sendResult = $mail2->Send();


					$mail           = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPDebug  = 0;
					$mail->SMTPAuth   = true; 
					$mail->SMTPSecure = 'ssl';
					$mail->Host       = "smtp.sendgrid.net";
					$mail->Port       = 465;
					$mail->IsHTML(true);
					$mail->Username =('apikey');
					$mail->Password ='';
					$mail->setFrom('');
					$mail->addReplyTo($email,  '');
					$toid  = '';
					$tobcc = "";
					$mail->addAddress($toid);
					$mail->addBCc($tobcc);
					$mail->isHTML(true);
					$mail->Subject = 'EBrochure Download Details';
					$mail->Body    = $htmlContent;
					$sendResult = $mail->Send();
							
							
					if($sendResult){
	
						echo "<script>window.alert('Thank you!...Please check your mail to download the Brochure.');</script>";
						echo "<script>location.href = '#'</script>";

					}else{
						
						echo "<script>window.alert('Error....');</script>";
						echo "<script>location.href = '#'</script>";
						die();	
						
					}
				}
			}
		}
	}	
}

?>		
	
	
	
	

