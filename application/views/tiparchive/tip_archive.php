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
<?php
if(!empty(get_cookie('researcher')) or !empty(get_cookie('service')))
 		{
			$researcher=get_cookie('researcher');
			$services=get_cookie('service');
			$cdate=get_cookie('cdate');
		}
?>
<body>
    <h3 class="student">Tip Archive</h3></br>
<!-- Start your code here -->
<div class="myjumbo" >
<div class="form-group">
 <form action="<?php echo base_url('TipArchive/set_filter_data');?>" method="POST">
      <label class="control-label col-sm-1">Service : </label>
      <div class="col-sm-2">          
        <select class="form-control branch" name="service">
     <option value="all">All</option>
     <?php foreach($service as $s)  {  ?>
     <option value="<?php echo $s->service_id;?>" <?php if(!empty($services)) {if($s->service_id==$services) echo "selected"; } ?> ><?php echo $s->service_name;?></option>
     <?php }?>
    </select>
	
      </div>
	  <label class="control-label col-sm-1">Researcher: </label>
      <div class="col-sm-2">          
        <select class="form-control branch" name="researcher">
     <option value="all">All</option>
      
     <?php foreach($researchers as $r)  {  ?>
     <option value="<?php echo $r->employee_id; ?>" <?php if(!empty($researcher)) { if($r->employee_id==$researcher) echo "selected"; } ?> > <?php echo ucfirst($r->first_name)." ".ucfirst($r->last_name); ?> </option>
     <?php }?>     
    </select>
	
      </div>
       <label class="control-label col-sm-1">Calling Date: </label>
	   <div class="col-sm-3">          
        <input type="date" name="cdate" placeholder="YYYY-MM-DD" value="<?php if(isset($cdate)) echo $cdate ?>">
      </div>
	  
	  <input type="submit" value="GO" >
	  
	  </form>
    </div>
	
	<br><br><br>

<?php if(empty($message)) {?>
     <div class="messages" >
 <nav>
    <a href="#"><b></b></a> 
    <span class="right"></span>
    </nav>
    
                            </br> No Message to Show</br>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
<?php }

  else{
 foreach($message as $a) {?>
  
  <div class="messages" >
 <nav>
    <a href="#"><b><?php echo $a->sender_name ;?></b></a> 
    <span class="right"><?php echo date('d-m-Y',strtotime($a->msg_date))." ".date('h:i:s',strtotime($a->msg_time)) ;?></span>
    </nav>
    
                            </br> <?php echo $a->message_text;?></br>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
<?php } }?>
<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(isset($message))echo $links; ?> </h5>
		 </td>
	 </tr></div>
<!-- End your code here -->
</body>
</html>
