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

</head>
<body>
    <h3 class="student">Tip Archive</h3></br>
<!-- Start your code here -->
<div class="myjumbo" >
<div class="form-group">
 <form action="<?php echo base_url('TipArchive/set_filter_data');?>" method="POST">
      <label class="control-label col-sm-1">Service </label>
      <div class="col-sm-2">          
        <select class="form-control branch" name="service">
     <option value="all">All</option>
     <?php foreach($service as $s)  {  ?>
     <option value="<?php echo $s->service_name;?>"><?php echo $s->service_name;?></option>
     <?php }?>
    </select>
	
      </div>
	  <label class="control-label col-sm-1">Researcher </label>
      <div class="col-sm-2">          
        <select class="form-control branch" name="researcher">
     <option value="all">All</option>
      
     <?php foreach($researcher as $r)  {  ?>
     <option value="<?php echo $r->employee_id;?>" <?php ?>><?php echo $r->first_name." ".$r->last_name ;?></option>
     <?php }?>     
    </select>
	
      </div>
	  
	  <input type="submit" value="GO" >
	  
	  </form>
    </div>
	
	<br><br><br>

<?php if(!empty($message)) foreach($message as $a) {
    if($a['0']->message_text=="")
    {
?>
      <div class="messages" >
 <nav>
    <a href="#"><b><?php ?></b></a> 
    <span class="right"><?php ?></span>
    </nav>
    
                            </br>No Calls available</br>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
  <?php } else {?>
  
  
  <div class="messages" >
 <nav>
    <a href="#"><b><?php echo $a['0']->sender_name ;?></b></a> 
    <span class="right"><?php echo date('d-m-Y g:i A',strtotime($a['0']->msg_time)) ;?></span>
    </nav>
    
                            </br> <?php echo $a['0']->message_text;?></br>
                            <!--<h6 class="text-muted time">--><!--</h6> <a style="padding-left:350px;display: inline-block;" href="#">Reply...</a>-->
  </div></br>
<?php } }?>
<!-- End your code here --></div>
</body>
</html>
