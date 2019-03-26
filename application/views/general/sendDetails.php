<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>
<div class="container">
	<h3 class="student">Send Details</h3></br></br>
<form action="<?php echo base_url('Details/send_details'); ?>" method="post" > 
<div class="form-group">
	<label class="control-label col-sm-3 required">Select Details</label>
        <div class="col-sm-3">
        <select class="form-control branch" name="name" id="name" onchange="document.getElementById('msg').innerHTML = this.value;">
          <option value=""> -- Select -- </option>
          <option value="<?php foreach($website_details as $w){ echo "Website Details :- ".$w->website_detail; }?> ">Website Details</option>
          <?php foreach($details as $d){?>         
          <option value="<?php echo "Bank Name :- ". $d->bank_name ." Account No :- ".$d->account_no; ?>"><?php echo $d->bank_name; ?></option><?php }?>
    </select>
   </div> </div></br></br></br>
 <div class="form-group">
       <label class="control-label col-sm-3 required">Mobile Number</label>
         <div class="col-sm-2">
        <input type="text" name="mobile_no" class="form-control" placeholder="Mobile Number" required>
      </div>
    </div></br></br></br>
<div class="form-group">
<textarea  rows="5" cols="60" name="message" id="msg" <?php $row=$this->session->userdata('my_session'); if($row['role']!="admin") echo "readonly"; ?> ></textarea>
</div>


<div class="form-group" style="left:450px !important; position:absolute !important;">
<button type="submit" id="submit" class="btn btn-primary" align="center">Send</button>
</div>
</form>
</div>
