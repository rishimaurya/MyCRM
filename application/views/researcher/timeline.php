<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>
<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
   </script>


<div class="container">
	<h3 class="student">Compose Message</h3>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Researcher/sendMessage'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
		<div class="form-group">
			<label for="Services">Services</label><br>
			<li style="list-style-type: none; padding-left:12px;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);" value="allselect"><label>Select All</label></li>
			<?php foreach($result  as $r){ ?><div class="col-sm-3"><input type="checkbox" name="services[]" value="<?php echo $r->service_id;?>" ><?php echo $r->service_name;?></div><?php } ?>
			
		</div>
		<div class="form-group">
			<label for="TextMessage">Text Message</label><br>
			<div class="col-sm-3">
				<textarea name="message" rows="4" cols="50"></textarea>
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

