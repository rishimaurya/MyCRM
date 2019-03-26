 <?php include('login_header.php');?>
        <!-- Top content -->
        <div class="top-content">
        	
            <div style="padding-top:10px;  padding-bottom:30px;">
			
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
						    <div style="color:red;"><?php echo $this->session->flashdata('error'); ?></div>
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form name="loginForm" action="<?php echo base_url('Login/check_login');?>"  onsubmit="return validateLoginForm()" method="POST" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
									<div class="form-group">
										 <select class="form-control" name="mylist" style="height:40px;">
										 <option value="0">--Sign in as--</option>
										 <option value="manager">Manager</option>
										 <option value="employee">Employee</option>
										 <option value="admin">Admin</option>
										 <option value="researcher">Researcher</option>
										</select>    
									</div>
			                        <button type="submit" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>

<?php include('login_footer.php');?>
