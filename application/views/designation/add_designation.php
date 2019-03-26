<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>


<div class="container">
	<h3 class="student">Add New Designation</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="insertForm" class="form-horizontal" action="<?php echo base_url('Designation/insertDesignation'); ?>"  onsubmit="return validateInsertForm()" method="POST">
<div class="myjumbo" >
  <div class="form-group">
      <label class="control-label col-sm-4 required"> Designation Name</label>
      <div class="col-sm-6">          
        <input type="input" name="designation" class="form-control" placeholder="Designation" required>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Add Designation</button>
      </div>
    </div>
    
 </div>
</form>    
</div>
