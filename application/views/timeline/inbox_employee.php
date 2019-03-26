
   
<style>
	
	.messages {
   max-width:100%;
   min-width:150px;
   background: #ffffee;
   padding:2px;
   margin:3px;
   border-radius: 2px;
   border:1px solid #b3b3b3;
   
}
nav {
    display: inline-block;
    vertical-align: baseline;
}

</style>	
</head>
<body>
    <h3 class="student">News Feeds</h3></br>
<!-- Start your code here -->
<div class="myjumbo" >
<?php if(empty($message)) {?>
	<div class="messages" >
 <nav>
    <a href="#"><b></b></a> 
    <span class="right"></span>
    </nav>
    
                            </br> No Message Available</br>
                         
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div>
	
<?php }else {foreach($message  as $r) {?>
  <div class="messages" >
 <nav>
    <a href="#"><b><?php echo $r->sender_name ;?></b></a> 
    <span class="right"><?php echo date('d-m-Y g:i A',strtotime($r->msg_time)) ;?></span>
    </nav>
    
                            </br> <?php echo $r->message_text;?></br>
                            <li data-toggle="modal" data-target="#myModal" style="list-style-type: none;"><a href="#">Reply</a></li>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
	  <form name="loginForm" action="<?php echo base_url('Employee/reply');?>" method="post" onsubmit="return validateLoginForm()">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reply</h4>
        </div>
        <div class="modal-body">
          
			<div class="container">
			<div class="row">
			<div class=" col-sm-3">
            <div class="form-login">
            <input type="hidden" name="message_id" value="<?php echo $r->message_id; ?>">
            <input type="hidden" name="sender_id" value="<?php echo $r->reciever_id; ?>">
            <input type="hidden" name="reciever_id" value="<?php echo $r->sender_id; ?>">
            <textarea name="message" type="text" rows="5" cols="500" id="userName" class="form-control input-sm chat-input" placeholder="Message" required></textarea>
            
            </br>
			
            <div class="wrapper">
            <span class="group-btn">     
                <button class="btn btn-primary btn-md">Send <i class="fa fa-sign-in"></i></button>
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




<?php } }?>
<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(!empty($links)) echo $links; ?> </h5>
		 </td>
	 </tr>
<!-- End your code here -->
</div>
</body>
</html>
