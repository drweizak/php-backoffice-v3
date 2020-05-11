<?php 
if($page == 'dashboard'){ 
	$path = '';
}
else{
	$path = '../';
}
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Control Panel">
    <meta name="author" content="Shape Web Solutions">

    <title>Ninpo Toronto Admin Control Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= $path;?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="<?= $path;?>css/sb-admin.css" rel="stylesheet" />

    <!-- Morris Charts CSS -->
    <link href="<?= $path;?>css/plugins/morris.css" rel="stylesheet" />

    <link href="<?= $path;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    
	<link href="<?= $path;?>css/jquery.classyedit.css" rel="stylesheet" />
    
	<link href="<?= $path;?>css/calendar.css" rel="stylesheet" />
    
    <link href="<?= $path;?>css/fileinput.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?= $path;?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $path;?>js/bootstrap.min.js"></script>
    
    <!-- Morris Charts JavaScript -->
    
    <script src="<?= $path;?>js/jquery.fastLiveFilter.js"></script>
    <script src="<?= $path;?>js/jquery.classyedit.js"></script>
    <script src="<?= $path;?>js/fileinput.min.js"></script>
</head>