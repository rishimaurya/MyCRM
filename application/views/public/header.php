<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CRM</title>
	
	<!-- core CSS -->
    <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/prettyPhoto.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/custom.css'); ?>" rel="stylesheet">
	

    <link href="<?php echo base_url('css/responsive.css'); ?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('js/html5shiv.js'); ?>"></script>
    <script src="<?php echo base_url('js/respond.min.js'); ?>"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url('assets/ico/favicon.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('images/ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('images/ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('images/ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('images/ico/apple-touch-icon-57-precomposed.png'); ?>">
	
	
	<!--javascript-->
	<script src="<?php echo base_url('js/myjs.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery.prettyPhoto.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery.isotope.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/main.js'); ?>"></script>
    <script src="<?php echo base_url('js/wow.min.js'); ?>"></script>
    
	
</head><!--/head-->
<body class="homepage">

    <header id="header">
      

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url();?>">CRM</a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
                        <li><a href="#bottom">About Us</a></li>
                        <li><a href="#services">Services</a></li>
						
						<li data-toggle="modal" data-target="#myModal" ><a href="#">Login</a></li>						
<!-- login popup started....................-->	
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
	  <form name="loginForm" action="<?php echo base_url('Login/check_login');?>" method="post" onsubmit="return validateLoginForm()">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter Credentials</h4>
        </div>
        <div class="modal-body">
          
			<div class="container">
			<div class="row">
			<div class=" col-sm-3">
            <div class="form-login">
            
            <input name="username" type="text" id="userName" class="form-control input-sm chat-input" placeholder="Username" required/>
            </br>
            <input name="password" type="password" id="userPassword" class="form-control input-sm chat-input" placeholder="Password" required />
            </br>
			<div class="form-group">
			 <select class="form-control" name="mylist" style="height:40px;">
			 <option value="0">--Sign in as--</option>
			 <option value="manager">Manager</option>
			 <option value="employee">Employee</option>
			 <option value="admin">Admin</option>
			 <option value="researcher">Researcher</option>
			</select>    
		  </div>

            <div class="wrapper">
            <span class="group-btn">     
                <button class="btn btn-primary btn-md">Login <i class="fa fa-sign-in"></i></button>
            </span>
            </div>
            </div>
			</div>
			</div>
			</div>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
	  </form>
    </div>
  </div>
<!-- login popup ended....................-->									
                                                
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
