<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>

<div class="container">
	<h3 class="student">Calls</h3>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Researcher/sendMessage'); ?>" id="s" onsubmit="validate()" method="POST">
<div class="myjumbo">
		<div class="form-group">
			<label for="Services">Services</label><br>
			<?php foreach($result  as $r){ ?><div class="col-sm-3"><input type="checkbox" name="services[]" value="<?php echo $r->service_id;?>" ><?php echo $r->service_name;?></div><?php } ?>
			
		</div>
		<div class="form-group">
			<label for="TextMessage">Text Message</label><br>
			<div class="col-sm-3">
				<textarea name="message" rows="4" cols="50" required ></textarea>
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
