<div class="container">
	<h3 class="student">Select user</h3>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Researcher/all_user'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
		<div class="form-group">
			<label for="TextMessage">Text Message</label><br>
			<div class="col-sm-3">
				<textarea name="TextMessage" rows="4" cols="50">
				</textarea>
			</div>
		</div>
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Send</button>
      </div>
    </div>
	
</div>   
</form>
</div> 
