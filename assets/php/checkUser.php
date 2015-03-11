<?php
session_start();
require_once('connect.php');
if( isset( $_GET["sUname"] ) ){
	$username=htmlspecialchars($_GET['sUname'],ENT_QUOTES);
	$password=md5($_GET['sPass']);
	$query = "SELECT role, UserPass, UserName FROM users WHERE UserName = '$username' LIMIT 1";
	$result_set = mysql_query($query);
	$row = mysql_fetch_array($result_set);
	if(mysql_num_rows($result_set)>0){
		if(strcmp($row['UserPass'],$password)==0){
			echo "yes";
			$_SESSION['UserName']=$username; 
			$_SESSION['role']=$row['role'];
			session_write_close();
		}else{
			echo "no";
		}
	}
	else{
		echo "no";
	}
}
?>