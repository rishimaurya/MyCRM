<div class="container">
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>

 
<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		<th></th>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Mobile</th>
		<th>FollowUpDate</th>
		<th>Status</th>
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result  as $r): ?>
		<tr>
			<td>
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name;?>
			</td>
			<td><?php echo $r->last_name;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			<td><?php echo $r->follow_up_date;?>
			</td>
			<td><?php echo $r->status;?>
			</td>
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Services/view_client_services');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="submit" class="btn btn-default btn-sm" value="Services">
				</form>
			</td>
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Leads/edit');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="submit" class="btn btn-primary  btn-sm" value="Edit">
				</form>
			</td>
			<td><form name="delete" class="form-horizontal" action="<?php echo base_url('Leads/delete_leads');?>"  method="POST">
			<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
				</form>
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
