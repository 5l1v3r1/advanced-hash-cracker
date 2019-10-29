<?php
/*
		{ Advanced Hash Cracker v2 }
	@author : FilthyRoot | Muhammad Khidhir Ibrahim
	@github : soracyberteam
	@date   : 16 May 2019 | Updated 29 Oct 2019

	Copyright (c) 2019 Sora Cyber Team

*/

$username = "youremail@gmail.com";// SMTP Credential.
$password = "yourpassword";// SMTP Credential.

/*
Readme!!

   Check : https://support.google.com/mail/?p=BadCredentials#cantsignin
   Then :
   	1. Turn off 2-Step Verification
   	2. Enable less secure apps
   	3. Enable display unlock captcha

   	I think, u need to make new google account for this.
*/
$youremail = "mainemail@gmail.com"; // This email will receive the cracked result.

//Code Start
include 'classes/class.phpmailer.php';
error_reporting(0);
set_time_limit(0);
#$charset="aiueobcdfghjklmnpqrstvwxyzAIUEO1234567890#@!";
$charset=$argv['5'];
$p=strlen($charset);
$min=$argv['3'];
$max=$argv['4'];
$type=$argv['2'];
$auth=$argv['1'];
function hasher($pass,$auth,$type){
	if($type=="md5"){
		$x=md5($pass);
		if($x == $auth){
			$x="TRUE";
		}else{
			$x="";
		}
	}elseif($type=="sha1"){
		$x=sha1($pass);
		if($x == $auth){
			$x="TRUE";
		}else{
			$x="";
		}
	}elseif($type=="bcrypt"){
		if(password_verify($pass, $auth)){
			$x="TRUE";
		}else{
			$x="";
		}
	}
	return $x;
}
function crunch($a,$b,$c){
	global $charset,$p;
	for($i=0;$i < $p;$i++){
		if($a > $b-1){
			crunch($a, $b+1, $c.$charset[$i]);
		}
		check($c.$charset[$i]);
	}
}
function mailer($content,$youremail){
	global $username,$password;

	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->SMTPSecure = 'ssl';
	$mail->Host 	 = 'smtp.gmail.com';
	$mail->Port 	 = 465;
	#$mail->SMTPDebug = 2; //Remove # comment to debug SMTP connection
	$mail->SMTPAuth  = True;
	$mail->Username  = "$username";
	$mail->Password  = "$password";
	$mail->SetFrom("root@jogjakartahackerlink.or.id","Advanced Hash Cracker");
	$mail->Subject 	 = "Hash Cracked!";
	$mail->AddAddress("$youremail","Hash Cracker Client");
	$mail->MsgHTML("<b>Result : </b><br>$content<br><br><b>Advanced Hash Cracker By Sora Cyber Team</b>");
	return $mail->Send();
}
function check($pwnd){
	global $type,$auth,$youremail;
	if(hasher($pwnd,$auth,$type)=="TRUE"){
		echo "[*] Done.\n\n{\n\t$auth = $pwnd\n}\n\n";
		$fh=fopen("h_crack.txt",w);
		if(fwrite($fh,"$auth = $pwnd | Type : $type\n")){
			echo "[*] Saved to h_crack.txt\n";
		}else{
			echo "[*] Failed to save.\n";
		}
		fclose($fh);
		$ip1=$_SERVER['REMOTE_ADDR'];
		$ip2=$_SERVER['SERVER_ADDR'];
		$content=file_get_contents('h_crack.txt');
		if(mailer($content,$youremail)){
			echo "[*] Sent to $youremail\n";
		}else{
			echo "[*] Failed to send SMTP. Check at line 80\n";
		}
		exit();
	}else{
		#echo "$pwnd\n";
	}
}
if($auth && $type && $min && $max && $charset){
	echo "[*] Cracking $auth :: $type\n";
	for($x=$min;$x<$max+1;$x++){
		crunch("$x","0","");
	}
}else{
	echo "{ Advanced Hash Cracker V2 }
Usage : php ".$_SERVER['PHP_SELF']." '<hash>' <type> <min> <max> <charset>
Type  : -md5
        -bcrypt (CMS Sekolahku) (SLOWER)
        -sha1

Example : 

Background Process : 
php ".$_SERVER['PHP_SELF']." '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz' &>/dev/null &

Foreground Process : 
php ".$_SERVER['PHP_SELF']." '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz'

Copyright (c) 2019 Sora Cyber Team 
";
}
?>
