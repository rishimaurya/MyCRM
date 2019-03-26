<div class="container">
	<form name="updateForm" class="form-horizontal" action="<?php echo base_url('exceldatainsert/ExcelDataAdd'); ?>"  onsubmit="return validateInsertForm()" method="POST">
		<div class="myjumbo" >
			<div class="form-group">									
				<label class="control-label col-sm-4">Upload Excel File:</label>                        
				<input type="file" name="userfile" class="form-control"/>
			</div>		
				        
			<div class="form-group">        
				<div class="col-sm-offset-4 col-sm-2">
					<button type="submit" class="btn btn-success">Change Password</button>
				</div>
			</div>
				
			
		</div>
	</form>
</div>
