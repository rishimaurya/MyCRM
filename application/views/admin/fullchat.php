<style>
  .hide {
  display: none;
}
	.messages {
   max-width:100%;
   min-width:150px;
   background: #fff;
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
<script>
	  $(document).on('change', '.div-toggle', function() {
  var target = $(this).data('target');
  var show = $("option:selected", this).data('show');
  $(target).children().addClass('hide');
  $(show).removeClass('hide');
});
$(document).ready(function(){
	$('.div-toggle').trigger('change');
});
  </script>

</head>
<body>
    <h3 class="student">Full Chat</h3></br>
<!-- Start your code here -->
<div class="myjumbo" >

	<br>

<?php if(!empty($all_message)) foreach($all_message as $a) {?>
  
  <div class="messages" >
 <nav>
    <a href="#"><b><?php echo $a->sender_name ;?></b></a> 
    <span class="right"><?php echo date('d-m-Y g:i A',strtotime($a->msg_time)) ;?></span>
    </nav>
    
                        </br> <?php echo $a->message_text;?></br>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
<?php } ?>
<tr>
		 <td align="center" style="padding-left:250px;"colspan="12"> 
			  <h5><?php if(isset($all_message))echo $links; ?> </h5>
		 </td>
	 </tr></div>
<!-- End your code here -->
</body>
</html>
