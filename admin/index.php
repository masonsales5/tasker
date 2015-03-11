<?php 
session_start();
if(empty($_SESSION['UserName'])){
	header("Location:http://zephyrworks.com/tasker/");
}else{
	if($_SESSION['role']=='admin'){
	require_once('../assets/php/connect.php');
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Task Manager</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php 
if(!empty($_SESSION['UserName'])){ 
	$sql = "SELECT * FROM users";
	$users = mysql_query($sql) or die('error');
?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Task Manager</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	<li><a href="?logout"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-list-alt"></span> Another Page</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-edit"></span> Yet Another</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User Management
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                
				<div class="row clearfix">
                    <div class="col-lg-12 table-responsive">
                        <h2>Adjust settings and roles for users</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sortable" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Tasks</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php while($rows = mysql_fetch_array($users)){?>
                                    <tr id='addr0' data-id="0" class="hidden">
                                        <td data-name="name">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            <input class="form-control" name='name0' type="text" placeholder="<? echo $row['UserName'];?>">
                                        </div>
                                        </td>
                                        <td data-name="mail">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                            <input class="form-control" name='mail0' type="text" placeholder="<? echo $row['UserPass'];?>">
                                        </div>
                                        </td>
                                        <td data-name="sel">
                                        	<div class="form-group">
                                					<select name="sel0" class="form-control">
                                                		<option <? if ($row['role']='admin') echo 'selected="selected" ';?>value"admin">Administrator</option>
                                                		<option <? if ($row['role']='user') echo 'selected="selected" ';?>value"user">User</option>
                                					</select>
                            				</div>
                                        </td>
                                        <td data-name="desc">
                                            <button nam"del0" class='btn btn-primary'>View</button>
                                        </td>

                                        <td data-name="del">
                                            <button nam"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
                                        </td>
                                    </tr>
<? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <a id="add_row" class="btn btn-default pull-right">Add User</a>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="../assets/js/custom.js"></script>
  </body>
</html>