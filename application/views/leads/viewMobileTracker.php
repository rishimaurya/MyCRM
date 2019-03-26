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
        <th>#</th>
        <th>Client Name</th>		
       
        <th> Client Mobile</th>
		
		 <th>Employee name</th>
		  <th>Employee Mobile</th>
		  <th></th>
		<?php $sesVal=$this->session->userdata('my_session'); if($sesVal['role']!="employee") {?>
			 <th></th>
			 <?php } ?> 
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result as $r): ?>
		<tr>
			
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name.' '.$r->middle_name.' '.$r->last_name;?>
			</td>
		
			<td><?php echo $r->mobile;?>
			</td>
		
			<td><?php if(!empty($r->fname)  && !empty($r->lname)) echo $r->fname.'  '.$r->lname;?>
			</td>
			<td><?php if(!empty($r->mob) ) echo $r->mob;?>
			</td>
		
		    
			<?php if($sesVal['role'] == "employee") { if($r->fname == $sesVal['first_name']) {?>
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Leads/edit');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="submit" class="btn btn-primary" value="Edit">
				</form>
			</td><?php }} else {?>
			
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Leads/edit');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="submit" class="btn btn-primary" value="Edit">
				</form>
			</td>
			<?php } ?>
			<?php if($sesVal['role']!="employee") {?>
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Leads/assign_tracker_lead');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="hidden" name="mobile" value="<?php echo $r->mobile;?>">
					<input type="submit" name="submit" class="btn btn-primary" value="Assign Lead">
				</form>
			</td>
			<?php } ?>
		</tr>
	<?php endforeach; ?>
	 
    </tbody>
  </table>
  </div>
</div>
