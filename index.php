<?php 
session_start();
if(empty($_SESSION['UserName'])){

}else{
	if($_SESSION['role']=='admin'){
		header("Location:http://zephyrworks.com/tasker/admin/");
	}
	if($_SESSION['role']=='user'){
		header("Location:http://zephyrworks.com/tasker/tasks/");
	}
}
	
if(isset($_GET['logout']))
{
	session_destroy();
	header("Location:http://zephyrworks.com/tasker/");
}	

if( isset( $_GET["login"] ) ){
	$balls = '';
	require_once('assets/php/connect.php');
	$config = $_SERVER[DOCUMENT_ROOT] . '/test/hybrid/hybridauth/config.php';
	include $_SERVER[DOCUMENT_ROOT] . '/test/hybrid/hybridauth/Hybrid/Auth.php';
	try{
		$hybridauth = new Hybrid_Auth( $config );
		$adapter = $hybridauth->authenticate( $_GET["login"] );
		$user_profile = $adapter->getUserProfile();
	}
	catch( Exception $e ){
		die( $balls = $e->getMessage() );
	} 
	if( ! isset( $user_profile ) ){	
	}else{
		$usernamea=mysql_real_escape_string($user_profile->email);
		$password=md5('changeme');
		$sql = "SELECT UserName, role FROM users WHERE UserName ='".$usernamea."' LIMIT 1";
		$db = mysql_query($sql) or die('error');
		$row = mysql_fetch_array($db);
		if(mysql_num_rows($db)) {
      		$_SESSION['UserName']=$usernamea; 
			$_SESSION['role']=$row['role'];
			session_write_close();
			header("Location:http://zephyrworks.com/tasker/");
			
    	}else{			$result = mysql_query("INSERT INTO users (UserName, UserPass, role) VALUES ('$usernamea', '$password', 'user')");
			if (!$result) {
				$balls= "Error, Contact Us";
			}
			else{	
				$_SESSION['UserName']=$usernamea; 
				$_SESSION['role']='user';
				session_write_close();
				header("Location:http://zephyrworks.com/tasker/");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Task Manager</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Task Manager</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
    
        <div class="main">
    
          <h3>Please Log In, or <a class="register" href="#">Sign Up</a></h3>
          <h3 style="display: none">Please <a class="login" href="#">Log In</a>, or Sign Up</h3>
          <div id="loginform">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <a href="?login=facebook" id="facebook" class="btn btn-lg btn-primary btn-block">Facebook</a>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <a href="?login=google" id="google" class="btn btn-lg btn-info btn-block">Google</a>
            </div>
          </div>
          <div class="login-or">
            <hr class="hr-or">
            <span class="span-or">or</span>
          </div>
    
          <form role="form">
            <div class="form-group">
              <label for="inputUsernameEmail">Username or email</label>
              <input type="text" class="form-control" id="inputUsernameEmail">
            </div>
            <div class="form-group">
            
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword">
            </div>
            <div class="pull-right" id="errorMsg"><?php echo $balls; ?></div>
            <button id="mybtn" type="submit" class="btn btn btn-primary">
              Log In
            </button>
          </form>
          </div>
          <form style="display: none" role="form" id="registerform">
            <div class="form-group">
              <label for="inputUsernameEmail">Username or email</label>
              <input type="text" class="form-control" id="inputUsernameEmail2">
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword2">
            </div>
            <div class="form-group">
              <label for="inputPassword">Password Again</label>
              <input type="password" class="form-control" id="inputPasswordVal">
            </div>
            <div class="pull-right" id="errorMsg2"></div>
            <button id="signupbtn" type="submit" class="btn btn btn-primary">
              Sign Up
            </button>
          </form>
        </div>
        
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>