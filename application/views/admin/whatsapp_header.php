<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - CRM Admin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

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
		
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url('assets1/css/ace-ie.min.css');?>" />
		<![endif]-->
		<link href="<?php echo base_url('css1/custom.css'); ?>" rel="stylesheet">
		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url('assets1/js/ace-extra.min.js');?>"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url('assets1/js/html5shiv.min.js');?>"></script>
		<script src="<?php echo base_url('assets1/js/respond.min.js');?>"></script>
		<![endif]-->
		<script src="<?php echo base_url('js/myjs.js');?>" type="text/javascript"></script>
	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body class="no-skin">
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
						<li class="grey dropdown-modal">
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
						</li>

						<li class="purple dropdown-modal">
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
						</li>

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
														<span class="blue"><?php echo $m->sender_id; ?></span>
														<?php echo $m->message_text; ?>
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span><?php echo $m->msg_date; ?></span>
													</span>
												</span>
											</a>
										</li>	
	                     <?php }  ?>     
										
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?php echo base_url('Admin/inbox');?>">
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
									<a href="<?php echo base_url("Admin/update");?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>
								
								<li>
									<a href="<?php echo base_url("Admin/change_password");?>">
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
						<button class="btn btn-success">
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
						</button>
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
						<a href="<?php echo base_url('Admin/admin_dashboard');?>">
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
									<a href="<?php echo base_url('Admin/register_leads');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add New Leads
									
									</a>	

								<a href="<?php echo base_url('Leads/show_distributed_leads');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Distribute Leads
									
								</a>	
                                <a href="<?php echo base_url('Leads/assignlead');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Assign Lead
									
								</a>	

								<a href="<?php echo base_url('Leads/todays_followup');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Todays Follow up
									
								</a>
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
																
								<a href="<?php echo base_url('UploadCSV');?>" >
									<i class="menu-icon fa fa-caret-right"></i>
									Auto Fetch Leads									
								</a>								
								<a href="<?php echo base_url('Leads/view_disposed_leads');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Disposed Leads
									
								</a>							
								<a href="<?php echo base_url('Admin/viewLeads');?>">
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
									Active clients
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
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Clients communication
								</a>
								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>
					<li class="">
						<a href="<?php echo base_url('RegisterUser');?>">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Add New User </span>

						</a>
						
						
					</li>
				<!--	<li class="">
						<a href="<?php echo base_url('Admin/message');?>"">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Messenger </span>
						</a>
						<b class="arrow"></b>
					</li>-->
					<li class="">
						<a href="<?php echo base_url('Admin/timeline');?>"">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Timeline </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="<?php echo base_url('Admin/comment_history');?>">
							<i class="menu-icon fa fa-check"></i>

							<span class="menu-text">
								Comment History
							</span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-print"></i>
							<span class="menu-text"> Report </span>
						</a>

						<b class="arrow"></b>
					</li>					
					<li class="">
						<a href="<?php echo base_url('ViewEmployee/get_employee_list');?>">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> Employees </span>
						</a>
						<b class="arrow"></b>
					</li>					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Services </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('Services');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add New Service
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo base_url('Services/view');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									View Services
								</a>

								<b class="arrow"></b>
							</li>											
							
						</ul>
					</li>
					
					<!-- #######3 -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Designation </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('Designation/addDesignation');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add New Designation
								</a>
								<b class="arrow"></b>
							</li>
																		
							<li class="">
								<a href="<?php echo base_url('Designation/viewDesignation');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									View Designation
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				</ul>	
					<!-- /.nav-list -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
			
	


			<div class="main-content">
				<div class="main-content-inner">
					
					
				            <!--###########################    timeline msg -->				
			<div style="background-color:#737373 !important;" id="alert_popover">
             <div style="background-color:#737373 !important;" class="wrapper">
               <div style="background-color:#737373 !important ; color:#fff ;float:left; clear:left;" id="content" class="content">
				   
               </div>
             </div>
            </div>
          

               
             <script type="text/javascript">
				 $(document).ready(function(){

 setInterval(function(){
  load_last_notification();
 }, 20000);

 function load_last_notification()
 {
  $.ajax({
   url:"fetch_msg",
   method:"POST",
   success:function(data)
   {
    $('.content').html(data);
   }
  })
 }
});
			</script>         <!--###########################-->

			
