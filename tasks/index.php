<?php 
session_start();
if(empty($_SESSION['UserName'])){
	header("Location:http://zephyrworks.com/tasker/");
}else{
	if($_SESSION['role']=='admin'){
		header("Location:http://zephyrworks.com/tasker/admin/");
	}
	if($_SESSION['role']=='user'){
		
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
<?php if(!empty($_SESSION['UserName'])){ ?>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand" href="#">Task Manager</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
			<li><a href="?logout"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
<?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="todolist not-done">
                 <h1>Tasks</h1>
                        <hr>
                        <ul id="sortable" class="list-unstyled">
                        <li class="ui-state-default">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" />Take out the trash</label>
                            </div>
                        </li>
                        <li class="ui-state-default">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" />Buy bread</label>
                            </div>
                        </li>
                        <li class="ui-state-default">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" />Teach penguins to fly</label>
                            </div>
                        </li>
                    </ul>
                    <div class="todo-footer">
                        <strong><span class="count-todos"></span></strong> Items Left
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="todolist">
                 <h1>Completed</h1>
                    <ul id="done-items" class="list-unstyled">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="../assets/js/custom.js"></script>
  </body>
</html>