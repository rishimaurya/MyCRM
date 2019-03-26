<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('Update'));?></h4></p>
</div>
<div class="container">
	<h3 class="student">Update Website details</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="insertForm" class="form-horizontal" action="<?php echo base_url('Admin/updateGeneral'); ?>"  onsubmit="return validateInsertForm()" method="POST">
<div class="myjumbo" >
    <div class="form-group">

      <div class="form-group">
       <label class="control-label col-sm-4 required">Website Details</label>
         <div class="col-sm-3">
        <input type="text" name="websitedetails" class="form-control" value="<?php foreach($detail as $d){echo $d->website_detail;}?>" required>
      </div>
    </div>
     <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </div>
   </form>
  </div>   
      
