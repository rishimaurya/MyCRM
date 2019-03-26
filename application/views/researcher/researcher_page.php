<!--This is for password change-->
	
	
	<div class="col-sm-offset-4">	
		<p style="color:green;"><?php print_r($this->session->flashdata('registered'));?>	</p>
	</div>
	
<!--This is for profile update-->	
	<div class="col-sm-offset-4">	
		<p style="color:green;"><?php print_r($this->session->flashdata('profile'));?>	</p>
	</div>
	
<!--page started-->
           <style>
	  #mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
  border-radius: 15px;
  text-align: center;
}
#boxes #dialog {
  width:450px; 
  height:auto;
  padding:10px;
  background-color:#ffffff;
  font-family: 'Segoe UI Light', sans-serif;
  font-size: 15pt;
}
.maintext{
    text-align: center;
  font-family: "Segoe UI", sans-serif;
  text-decoration: none;
}

#lorem{
	font-family: "Segoe UI", sans-serif;
	font-size: 12pt;
  text-align: left;
}
#popupfoot{
	font-family: "Segoe UI", sans-serif;
	font-size: 16pt;
  padding: 10px 20px;
}
#popupfoot a{
	text-decoration: none;
}
.agree:hover{
  background-color: #D1D1D1;
}
.popupoption:hover{
	background-color:#D1D1D1;
	color: green;
}
.popupoption2:hover{
	
	color: red;
}
	</style>
	<script>
	  
$(document).ready(function() {    

		var id = '#dialog';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(500);	
		$('#mask').fadeTo("slow",0.9);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});		
	
});


 </script>
 
<!--This was for password change-->
   <?php if($status=="0") {?>
                <!--  ##### welcome popup up , don't touch it    ######    -->
                <div id="boxes">
  <div style="position:absolute !important; top: 50.5px; left: 251.5px; display: none;" id="dialog" class="window">Welcome
    <div id="lorem">
        </br></br>
      <p style="text-align:center;"> Welcome to CRM <?php echo $welcome_employee; ?> ... </p>
         </br></br>
    </div>
    <div id="popupfoot"> <a href="#" class="close agree">Close</a>  </div>
  </div>
  <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
</div>        <?php }?>

						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->
	
				<div class="container">
							
									
					
									 <br><br><br><br>

									 <div class="col-sm-6">
									 <div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
          <tr>
        <th>Todays Calls</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td>
									<?php if(!empty($message['0']))foreach($message as $m) {?>
										<li style="list-style-type: none;">
											<a href="#" class="clearfix" style="text-decoration:none !important;>
												<img src="" class="msg-photo"  />
												<!--<span class="msg-body">
													<span class="msg-title">-->
														<span class="blue" style="font-weight: bold;color:#0000e6 !important;"><?php echo $m['0']->sender_name; ?></span><span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span><?php echo date('g:i A',strtotime($m['0']->msg_time)); ?></span>
													</span></br>
														<?php echo $m['0']->message_text; ?>
													</span></br>

													
												</span>
											</a>
										</li></br></br>	
	                     <?php }  ?>      
										
									</ul>
								</li>
                              <?php if(empty($message)) {?>
								<li class="dropdown-footer" style="list-style-type: none;">
									<a href="#">
										No Calls Available
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
								  <?php } else {?>
								<li class="dropdown-footer" style="list-style-type: none;">
									<a href="<?php echo base_url('TipArchive');?>">
										See all Calls
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li><?php }?>
							</ul>
						</td>
	</tr>
    </tbody>
  </table>
  
		</div>
		</div>
<div class="col-sm-6">
 <div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
          <tr>
        <th>Timeline Message</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td>
									 <?php if(!empty($msg)) foreach($msg as $m) {?>
										<li style="list-style-type: none;">
											<a href="#" class="clearfix" style="text-decoration:none !important;>
												<img src="" class="msg-photo"  />
												<!--<span class="msg-body">
													<span class="msg-title">-->
														<span class="blue" style="font-weight: bold;color:#0000e6 !important;"><?php echo $m->sender_name; ?></span><span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span><?php echo date('g:i A',strtotime($m->msg_time)); ?></span>
													</span></br>
														<?php echo $m->message_text; ?>
													</span></br>

													
												</span>
											</a>
										</li></br></br>	
	                     <?php }  ?>    
										
									</ul>
								</li>

								</li>
                              <?php if(empty($msg)) {?>
								<li class="dropdown-footer" style="list-style-type: none;">
									<a href="#">
										No Message Available
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
								  <?php } else {?>
								<li class="dropdown-footer" style="list-style-type: none;">
									<a href="<?php echo base_url('Researcher/inbox');?>">
										See all Messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li><?php }?>
							</ul>
						</td>
	</tr>
    </tbody>
  </table>	
  </div>

			
