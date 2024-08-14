<html>
<head>
	<title>Enquiry</title>
</head>
<body> 


<?php

error_reporting(0);
$header = getallheaders();
$ref    = $header['Referer'];
include("mailer/class.phpmailer.php");
include("mailer/class.pop3.php");
include("mailer/class.smtp.php");

if(isset($_POST['careerdata'])!='') {
	
	$honeypot = $_POST['checkvalue']; 
	$name = trim($_POST['name']);	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');	
	$mobile = htmlspecialchars($_POST['mobile'], ENT_QUOTES, 'UTF-8');
	$city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
	$gender = $_POST['gender'];
	$experience = htmlspecialchars($_POST['experience'], ENT_QUOTES, 'UTF-8');	
	$position = htmlspecialchars($_POST['position'], ENT_QUOTES, 'UTF-8');	
	$qualification = htmlspecialchars($_POST['qualification'], ENT_QUOTES, 'UTF-8');	
	$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
	$attachmentFile=$_FILES['attachmentFile']['name'];
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

    if(($useragent=='')&&($enquiry_date=='') && ($_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) ){
		
    }else{
       	if(($honeypot == "")&&($differenceInSeconds > 20)&&(strlen($mobile)=='10')&&($emailexte!='outlook.com')){
			
			if(!preg_match ("/^[a-zA-Z ]*$/", $name) ) {  
		
				$ErrName = "Only alphabets are allowed in name field.";  
				echo "<script type='text/javascript'>alert('$ErrName');
				window.location.href = '/careers.php';</script>";
			
			}elseif(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $email)) { 
			
                echo "<script type=\"text/javascript\">window.alert('Please Enter a Valid Email.');</script>";
                echo "<script>location.href = '/careers.php'</script>";
				
            }elseif(!preg_match ("/^\d{10}$/", $mobile) ){ 
			
				$ErrMob = "The mobile number is invalid. It should be exactly 10 digits and contain only numbers..";  
				echo "<script type='text/javascript'>alert('$ErrMob');
				window.location.href = '/careers.php';</script>"; 
		
			}elseif(!preg_match ("/^[a-zA-Z ]*$/", $city) ) {  
		
				$ErrCity = "Only alphabets are allowed in City field.";  
				echo "<script type='text/javascript'>alert('$ErrCity');
				window.location.href = '/careers.php';</script>";
			
			}elseif(!preg_match ("/^[a-zA-Z ]*$/", $position) ) {  
		
				$ErrCompany = "Only alphabets are allowed in Position field.";  
				echo "<script type='text/javascript'>alert('$ErrCompany');
				window.location.href = '/careers.php';</script>";
			
			}elseif(preg_match("/\b(?:(?:https?|ftp|http):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $message)) { 
			
                echo "<script type=\"text/javascript\">window.alert('Your Message Contains hyper link or url, dont enter the link in message.');</script>";
                echo "<script>location.href = '/careers.php'</script>";
				
            }else{
	
		
				//Validating file is there
				if ($attachmentFile = '') {
					
					echo "<script type=\"text/javascript\">window.alert('File was not uploaded.');</script>";
					echo "<script>location.href = '/careers.php'</script>";
					
				}else{
				
				//Validating file extentions
				$allowedExtensions = array("pdf", "doc", "docx");
				$fileExtension = strtolower(pathinfo($_FILES['attachmentFile']['name'], PATHINFO_EXTENSION));

				if (!in_array($fileExtension, $allowedExtensions)) {
					
					echo "<script type=\"text/javascript\">window.alert('Invalid file format. Only PDF, DOC, and DOCX files are allowed.');</script>";
					echo "<script>location.href = '/careers.php'</script>";					
				
				}else{
				
				//Validating file size
				$maxFileSize = 2 * 1024 * 1024; 
				if ($_FILES['attachmentFile']['size'] > $maxFileSize) {
					
					echo "<script type=\"text/javascript\">window.alert('File is too large. Maximum file size allowed is 2 MB.');</script>";
					echo "<script>location.href = '/careers.php'</script>";					
					
				}else{								
			
					date_default_timezone_set('Asia/Kolkata');
					$submit_date = date('Y-m-d');	
					$combined_date=date("m-Y");
					$htmlContent = '<html><body><table style="background:#066cb5" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%"cellpadding="0" cellspacing="0" border="0"><td style="border-top:5px solid #066cb5;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center"><img src="#"><br></p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hello Sir/Madam, </strong><br></p></td></tr><tr><td style="margin:0;padding:0px 0px 10px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0px"></b>Career Details from Saifoods </b></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Name</td><td style="font-weight:normal">'.$name.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Mobile Number</td><td style="font-weight:normal">'.$mobile.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">City</td><td style="font-weight:normal">'.$city.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Email Id</td><td style="font-weight:normal">'.$email.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Position</td><td style="font-weight:normal">'.$position.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Experience</td><td style="font-weight:normal">'.$experience.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Qualification</td><td style="font-weight:normal">'.$qualification.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Message</td><td style="font-weight:normal">'.$message.'</td></tr><tr style="background-color: rgb(232, 232, 232);"><td style="width:200px;padding:4px 0">Gender</td><td style="font-weight:normal">'.$gender.'</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:5px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

					$subject = "Career Details";
					$mail = new PHPMailer();
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
					//$mail->addAddress($tocc);
					$mail->addBCc($tobcc);
					$mail->isHTML(true);
					$mail->Subject = $subject;
					$mail->Body    = $htmlContent;
					$mail->AddAttachment($_FILES['attachmentFile']['tmp_name'],$_FILES['attachmentFile']['name']);    
					$sendResult = $mail->Send();
	
							
					if($sendResult) 
					{
						echo "<script>location.href = 'thanks.php'</script>";
					}
					else{
						//echo "<script>location.href = '/'</script>";
						echo "<script type=\"text/javascript\">window.alert('Sorry, Your Application was not sent.');</script>";
						echo "<script>location.href = '/'</script>";						
					}	
				} 
		
			}
		
		}
		
		}
		
		}
		
	}
}
		
 
?>
	
	
</body>
</html>









