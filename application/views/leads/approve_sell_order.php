<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
        <div class="col-sm-offset-4">
			<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
		</div>

		<div class="col-sm-offset-4">
			<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
		</div>
		<div class="col-sm-offset-4">
			<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
		</div>
<div class="container">
	<h3 class="student">Approve Sell Order </h3>
	<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/approve_client');?>"   onsubmit="return validateLeadRegisterForm()" method="POST">
		<div class="myjumbo">
			<br><br><br>
            <li style="background-color:#f2f2f2 !important;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label>Select All</label></li>
<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		<th>#</th>
        <th>ID</th>
        <th>Client Name</th>
        <th>Employee Name</th>
        <th>Email</th>
        <th>Mobile</th>
		<td></td>			<td></td>			
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result  as $r){ ?>
		<tr>
			<td>
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>">
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name." ".$r->last_name;?>
			</td>
			<td><?php echo $r->ename;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
		
			</td>
			
			<td>
				<a href="<?php echo base_url('Leads/view_client_details?client='.base64_encode($r->client_id));?>" >
					<input type="button" name="submit" class="btn btn-primary btn-sm" value="View"/>
				</a>
			</td>
			<td>
				<a href="<?php echo base_url('Leads/edit_client_details?client='.base64_encode($r->client_id));?>" >
					<input type="button" name="submit" class="btn btn-primary btn-sm" value="Edit"/>
				</a>
			</td>
			<td>
				<a href="<?php echo base_url('Leads/delete_client_details?client='.base64_encode($r->client_id));?>" >
					<input type="button" name="submit" class="btn btn-danger btn-sm" value="Delete"/>
				</a>
			</td>
		</tr>
	<?php } ?>
	<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(!empty($links)) echo $links; ?> </h5>
		 </td>
	 </tr>
	 
    </tbody>
  </table>
                        </div>
		</div>  

                  <div class="form-group">        
					<div class="col-sm-offset-8 col-sm-2">
						<button type="submit" class="btn btn-success">Approve clients</button>
					</div>
				  </div> 
	</form>
</div> 
