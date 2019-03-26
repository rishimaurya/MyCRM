<div class="container">
<p style="color:red;"><?php print_r($this->session->flashdata('unassign'));?></p>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>
<!--	<div class="form-group">
	
    	<form name="delete" class="form-horizontal" action="<?php echo base_url('Leads/distribute_leads');?>"  method="POST">
				
			<input type="submit" name="delete" class="btn btn-success" value="Auto-Assign Leads">
		</form>
			</div>
		-->	<div class="form-group">
	
    	<a href="<?php echo base_url('Leads/assignlead');?>" >
				
			<input type="button" name="delete" class="btn btn-success" value="Manual-Assign Leads">
		</a>
			</div>
			
				<!--<div class="form-group">
	
    	<form name="delete" class="form-horizontal" action="<?php echo base_url('Leads/manualassign_lead');?>"  method="POST">
				
			<input type="submit" name="delete" class="btn btn-success" value="Select-to-Assign Leads">
		</form>
			</div>-->

	
<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		<th>SNo.</th>
        <th>Username</th>
        <th>Employee name</th>
		<th>Client name</th>
		 <th>Client Contact</th>
		<th>Status</th>
		<th>Disposed</th>
		<th></th>
		
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result  as $r): ?>
		<tr>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->username;?>
			</td>
			<td><?php echo $r->fname.' '.$r->mname.' '.$r->lname;?>
			</td>
			<td><?php echo $r->first_name.' '.$r->middle_name.' '.$r->last_name;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			<td><?php echo $r->status;?>
			</td>
			<td><?php echo $r->disposed;?>
			</td>
			
					
			
		</tr>
	<?php endforeach; ?>
	 <tr>
		 <td align="center" colspan="12"> 
			  <h5><?php echo $links; ?> </h5>
		 </td>
	 </tr>
	 
    </tbody>
  </table>
  </div>
</div>
</div>
