<h3 class="student">View Sell Order</h3>
	<p class="para">Note: (*) fields are mandatory</p>

<?php $a=1; if(!empty($data2))foreach($data2 as $d) {?>
<div>
	</br></br><h3>Bill <?php echo $a;?></h3></br>
<div class="form-group">
      <label class="control-label col-sm-4">Client Name:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->first_name. " ".$data[0]->last_name; ?> </label>
		</p>
		</div>   
  <br><br>
<div class="form-group">
      <label class="control-label col-sm-4">Client Mobile:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->mobile; ?> </label>
		</p>
		</div>      
		<br><br>
	<div class="form-group">
      <label class="control-label col-sm-4">Follow Up Date:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->follow_up_date; ?> </label>
		</p>
		</div>      
		<br><br>	
     <div class="form-group">
      <label class="control-label col-sm-4">Services:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data1[0]->service_name; ?> </label>
		</p>
		</div>      
		<br><br>
	     <div class="form-group">
      <label class="control-label col-sm-4">Services Amount:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->service_amount; ?> </label>
		</p>
		</div>      
		<br><br>
			     <div class="form-group">
      <label class="control-label col-sm-4">Discount:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->discount; ?> </label>
		</p>
		</div>      
		<br><br>
			     <div class="form-group">
      <label class="control-label col-sm-4">Payable Amount:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->total_amount; ?> </label>
		</p>
		</div>      
		<br><br>
			     <div class="form-group">
      <label class="control-label col-sm-4">Mode of Payment:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->payment_mode; ?> </label>
		</p>
		</div>      
		<br><br>
		 <div class="form-group">
      <label class="control-label col-sm-4">Payment Date:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->date; ?> </label>
		</p>
		</div>      
		<br><br>	
		<div class="form-group">
      <label class="control-label col-sm-4">start Date:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->start_date; ?> </label>
		</p>
		</div>      
		<br><br>	
    <div class="form-group">
      <label class="control-label col-sm-4">End Date:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->end_date; ?> </label>
		</p>
		</div>      
		<br><br>	
    
</div>
<?php $a++;}?>
