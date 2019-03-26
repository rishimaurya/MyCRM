<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>
<div>
<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
      <tr>
		<th></th>
        <th>#</th>
        
        <th>Bank Name</th>
        
        <th>Account No</th>
		<th></th>
		<th></th>
		
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($bank  as $r): ?>
		<tr>
			<td>
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->bank_name;?>
			</td>
			
			
			
			<td><?php echo $r->account_no;?>
			</td>
			
			
			
			
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Admin/editBank');?>"  method="POST">
					<input type="hidden" name="bank_id" value="<?php echo $r->id;?>">
					<input type="submit" name="submit" class="btn btn-primary  btn-sm" value="Edit">
				</form>
			</td>
			<td><form name="delete" class="form-horizontal" action="<?php echo base_url('Admin/deleteBank');?>"  method="POST">
			<input type="hidden" name="bank_id" value="<?php echo $r->id;?>">
					<input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
