<?php
/*
		{ Advanced Hash Cracker }
	@author : FilthyRoot
	@github : soracyberteam
	@date   : 15 May 2019

	Copyright (c) 2019 Sora Cyber Team
	INDONESIAN PEOPLE
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
		echo "[+] FOUND -> $auth = $pwnd | Type : $type\n";
		exit();
	}else{
		#echo ".";
	}
}
if($auth && $type && $min && $max && $charset){
	echo "Hash : $auth | Type : $type\n[+] Craking ...\n";
	for($x=$min;$x<$max+1;$x++){
		crunch("$x","0","");
	}
}else{
	echo "{ Advanced Hash Cracker }
Usage : php ".$_SERVER['PHP_SELF']." '<hash>' <type> <min> <max> <charset>
Type  : -md5
        -bcrypt (CMS Sekolahku) (SLOWER)
        -sha1

Example : php ".$_SERVER['PHP_SELF']." '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz'
Copyright (c) 2019 Sora Cyber Team 
";
}
?>