<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" href="<?php echo base_url('images/ico/favicon.ico'); ?>">
        <link rel="icon" href="<?php echo base_url('images/ico/favicon.ico'); ?>" type="image/x-icon">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets1/css/bootstrap.min.css');?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets1/font-awesome/4.5.0/css/font-awesome.min.css');?>" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets1/css/fonts.googleapis.com.css');?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets1/css/ace.min.css');?>" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url('assets1/css/ace-part2.min.css');?>" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets1/css/ace-skins.min.css');?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets1/css/ace-rtl.min.css');?>" />
		<link href="<?php echo base_url('css1/custom.css'); ?>" rel="stylesheet">
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url('assets1/css/ace-ie.min.css');?>" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url('assets1/js/ace-extra.min.js');?>"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url('assets1/js/html5shiv.min.js');?>"></script>
		<script src="<?php echo base_url('assets1/js/respond.min.js');?>"></script>
		<![endif]-->
		<script src="<?php echo base_url('js/myjs.js');?>" type="text/javascript"></script>
	    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
	    	    <script>
	        
	       $(document).ready(function(){
   setInterval('updateClock()', 1000);
});

function updateClock (){
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  	
  	
   	$("#clock").html(currentTimeString);	  	
 }
	    </script>
	</head>
	<body class="no-skin" style="min-height:750px">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							CRM
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>-->

						<!--<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>-->

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php echo $count_msg;?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									<?php echo $count_msg;?> Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<?php foreach($timeline_message as $m) {?>
										<li>
											<a href="#" class="clearfix">
												<img src="<?php echo base_url('assets1/images/avatars/avatar.png');?>" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue"><?php echo $m->sender_name; ?></span>
														<?php echo $m->message_text; ?>
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span><?php echo date('g:i A',strtotime($m->msg_time)); ?></span>
													</span>
												</span>
											</a>
										</li>	
	                     <?php }  ?> 
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?php echo base_url('Employee/inbox');?>">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url('assets1/images/avatars/user.jpg');?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php $row=$this->session->userdata('my_session'); echo $row['first_name']; echo "  "; echo $row['last_name']; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="<?php echo base_url("Employee/update");?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>
								
								<li>
									<a href="<?php echo base_url("Employee/change_password");?>">
										<i class="ace-icon fa fa-random"></i>
										Change Password
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url('Login/logout');?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
		
		
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					         <span style="display:inline;color:black;font-weight: bold;"><?php echo date("Y-m-d") ; ?></span> <span id="clock" style="padding-left:5px;color:black;font-weight: bold;"></span>
					<!--	<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>-->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="<?php echo base_url('Employee/employee_dashboard');?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Leads
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
									<a href="<?php echo base_url('Employee/register_leads');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add New Leads
									
									</a>	

										<a href="<?php echo base_url('Leads/active_freetrial');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Active Free Trials
									
								</a>
								</a>
								<a href="<?php echo base_url('Leads/past_freetrial');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Past Free Trials
									
								</a>
							
							<!--       <a href="<?php echo base_url('Leads/assignlead');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Take Leads
									
								</a> -->
<!-- 
								<a href="<?php echo base_url('Employee/todays_followup');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Todays Follow up
									
								</a>
																
								<!--<a href="<?php echo base_url('UploadCSV');?>" >
									<i class="menu-icon fa fa-caret-right"></i>
									Auto Fetch Leads									
								</a>	-->							
								
								<a href="<?php echo base_url('Employee/view_todays_leads');?>" >
									<i class="menu-icon fa fa-caret-right"></i>
									New Leads									
								</a>
															
								<a href="<?php echo base_url('Employee/viewLeads');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									View Leads
									<b class="arrow"></b>
								</a>														
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-plus"></i>
							<span class="menu-text"> Clients </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('Clients/view_active_clients');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Paid clients
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo base_url('Clients/view_expired_clients');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Expired clients
								</a>

								<b class="arrow"></b>
							</li>																	
							<li class="">
								<a href="<?php echo base_url('Clients/view_all_clients');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									All clients
								</a>
								<b class="arrow"></b>
							</li>						
						<!--	<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Clients communication
								</a>
								<b class="arrow"></b>
							</li>-->
							
						</ul>
					</li>
					
					
				<!--	<li class="">
						<a href="#">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Messenger </span>
						</a>
						<b class="arrow"></b>
					</li>-->
					
<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Compose Message </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('Employee/timeline');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Send Message
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo base_url('Details');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Send Details
								</a>

								<b class="arrow"></b>
							</li>
						<!--	<li class="">
								<a href="<?php echo base_url('Researcher/options');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Send Calls
								</a>

								<b class="arrow"></b>
							</li>-->
                       </ul>

		            <li class="">
						<a href="<?php echo base_url('Employee/inbox');?>">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> News Feeds </span>
						</a>
						<b class="arrow"></b>
					</li>
					
					<li class="">
						<a href="<?php echo base_url('TipArchive');?>">
							<i class="menu-icon fa fa-print"></i>
							<span class="menu-text"> Tip Archive </span>
						</a>

						<b class="arrow"></b>
					</li>
       				
       				<li class="">
						<a href="<?php echo base_url("Employee/comment_history"); ?>">
							<i class="menu-icon fa fa-check"></i>

							<span class="menu-text">
							    Comments history
							</span>
						</a>
						<b class="arrow"></b>
					</li>
				<!--<li class="">
						<a href="#">
							<i class="menu-icon fa fa-print"></i>
							<span class="menu-text"> Report </span>
						</a>

						<b class="arrow"></b>
					</li>					
					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> Configuration </span>
						</a>
						<b class="arrow"></b>
					</li>	-->				
					<li class="">
						<a href="<?php echo base_url("TipArchive"); ?>">
							<i class="menu-icon fa fa-paperclip"></i>
							<span class="menu-text">
								Tip Archive
							</span>
						</a>
						<b class="arrow"></b>
					</li>			
					<li class="">
						<a href="<?php echo base_url("Employee/target_emp"); ?>">
							<i class="menu-icon fa fa-paperclip"></i>
							<span class="menu-text">
								Target 
							</span>
						</a>
						<b class="arrow"></b>
					</li>		
					<li class="">
						<a href="<?php echo base_url("Leads/generate_sells_order"); ?>">
							<i class="menu-icon fa fa-paperclip"></i>
							<span class="menu-text">
								Generate Sales Order 
							</span>
						</a>
						<b class="arrow"></b>
					</li>		
										
					<li class="">			
						<b class="arrow"></b>
						<ul class="submenu">
							
				</ul><!-- /.nav-list -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url('Employee/employee_dashboard');?>">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->
							
						<div class="nav-search" id="nav-search">
							
							<form  action="<?php echo base_url('Leads/mobile_track');?>" class="form-search" method="POST">
								<label >Mobile Tracker</label>&nbsp;&nbsp;
								<span class="input-icon">
									<input type="text" placeholder="track anyone....." class="nav-search-input" name="mobile" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

			
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>
									<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
								</div><!-- /.pull-left -->
								
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

			   <!--###########################    timeline msg -->	
<div id="wrap"></div>			
<style> width:380px;
  min-height:180px;
  background:#005D95;
  top: 370px;
  right: 20px !important;
  z-index:100;
  position:fixed !important;
  border-radius:5px;
  box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.05);
  transition: 0.5s;
</style>	 
                   <script type="text/javascript">
				 $(document).ready(function(){
$('#close').click(function(){
 $('.popup').hide();
  });
  
 setInterval(function(){
  load_last_notification();
 }, 15000);

 function load_last_notification()
 {
  $.ajax({
   url:"<?php echo base_url()."Admin/fetch_msg"; ?>" ,
   method:"POST",
   success:function(data)
   { 
      if(data!='')
       { 
          $('#wrap').html(data);
          $('#wrap').css('right','20px');
          $('#wrap').show();
       }
   }
  })
 }
});
			</script>         <!--###########################-->

			
	
			
