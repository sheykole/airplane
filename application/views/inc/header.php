<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">
<title><?=appName?> | Home page</title>

<!-- Bootstrap Core CSS -->
<link href="<?=base_url();?>public/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
<link href="<?=base_url();?>public/css/style.css" rel="stylesheet">
<link href="<?=base_url();?>public/css/responsive.css" rel="stylesheet">
<link href="fonts/flaticon.css" rel="stylesheet">

<!-- JavaScripts -->
<script src="<?=base_url();?>public/js/modernizr.js"></script>

<!-- Online Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.8/<?=base_url();?>public/css/all.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>



<!-- Wrap -->
<div id="wrap"> 
  
  <!-- header -->
  <header class="sticky">
    <div class="container"> 
      
      <!-- Logo -->
      <div class="logo"> <a href="index.html"><img class="img-responsive" src="<?=base_url();?>public/images/logo.png" alt="" ></a> </div>
      <nav class="navbar ownmenu navbar-expand-lg ">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav">
            <li class="scroll active"><a href="<?=site_url('app');?>">Home</a></li>
            <li class="scroll "><a href="<?=site_url('login');?>">Login</a></li>
            <li class="scroll"><a href="<?=site_url('registration');?>">Sign Up</a></li>
            <li class="scroll"> <a href="#contact">Contact</a> </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="clearfix"></div>
  </header>