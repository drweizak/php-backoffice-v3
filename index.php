<?php
	session_start();
	if(isset($_SESSION['user_id'])){
		header('location: dashboard');
	}
	if(isset($_POST['email'])){
		
		require_once('controller/users.php');
		require_once('model/login.php');	
		
        if (!$errors){
            $password = md5($password);

			$users = new users();
			$_SESSION['msg'] = $users->login($email, $password);
        }		
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Control Panel">
    <meta name="author" content="Shape Web Solutions">

    <title>Ninpo Toronto Ninjutsu Admin Control Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #dedede;">
	<div class="container" style="margin-top: 10%;">
    	<div="row">
        	<div class="col-md-4 col-md-offset-4">
            	<div class="panel panel-default">
                    <div class="panel-body">
						<form action="" method="POST" role="form">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email" requirred>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password" requirred>
                            </div>
                            <input class="btn btn-lg btn-block btn-primary" type="submit" value="Login">
                    	</form>
                    </div>
                </div>
                <?php if(!empty($_SESSION['msg'])){?>
                <div id="message" class="alert alert-danger" style="display:none;">
                <a id="close-button" class="pull-right alert-danger" href="#">X</a>
                    <?php if(is_array($_SESSION['msg'])){
                        foreach($_SESSION['msg'] as $imgmsg){
                            echo '<p>'.$imgmsg.'</p>';
                        }
                    }
                    else{echo $_SESSION['msg'];}?>
                </div>
				<script>
                $(document).ready(function(){
                    $("#message").fadeIn("slow");
                });
                $(document).ready(function(){
                    $("#close-button").click(function(){
                        $("#message").fadeOut("slow");
                    });
                });
                </script>
                <?php }?>
            </div>
        </div>
    </div>
</body>
</html>
