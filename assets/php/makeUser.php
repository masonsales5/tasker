<?php
session_start();
require_once('connect.php');
$username=htmlspecialchars($_POST['sUname'],ENT_QUOTES);
$password=md5($_POST['sPass']);


$query = "SELECT UserName FROM users WHERE UserName = '$username' LIMIT 1";
$result_set = mysql_query($query);
$row = mysql_fetch_array($result_set);
if(mysql_num_rows($result_set)>0){
	echo "exists";
}
else{
	$result = mysql_query("INSERT INTO users (UserName, UserPass, role) VALUES ('$username', '$password', 'user')");
	if (!$result) {
		echo "no";
	}
	else{	
		echo "yes";
		$_SESSION['UserName']=$username; 
		$_SESSION['role']='user';
		session_write_close();
	}
}
?>