
<div class="container">
	<h3 class="student">Add Bank details</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="insertForm" class="form-horizontal" action="<?php echo base_url('Admin/insertBank'); ?>"  onsubmit="return validateInsertForm()" method="POST">
<div class="myjumbo" >
    <div class="form-group">

      <div class="form-group">
          <label class="control-label col-sm-4 required">Bank Name</label>
         <div class="col-sm-2">
        <input type="text" name="bank_name" class="form-control"  placeholder="Bank Name" required>
      </div>
    </div>
          <div class="form-group" style="">
       <label class="control-label col-sm-4 required">Account Number</label>
         <div class="col-sm-2">
        <input type="text" name="account_no" class="form-control" placeholder="Account Number" required>
      </div>
    </div>
    
     <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Add</button>
      </div>
    </div>
   </form>
  </div>   

