<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>
<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>
<?php
 if(isset($_COOKIE['status'])) $status=$_COOKIE['status'];
 if(isset($_COOKIE['follow_up_date'])) $follow_date=$_COOKIE['follow_up_date'];
?>
 <div class="form-group">
 <form action="<?php echo base_url('Leads/set_filter_data');?>" method="POST">
      <label class="control-label col-sm-1">Filter By:  status </label>
      <div class="col-sm-2">          
        <select class="form-control branch" name="status">
     <option value="all">All</option>
     <option value="no status" <?php if(isset($status)) if($status=='no status') echo "selected";?>>no status</option>
     <option value="pending" <?php if(isset($status)) if($status=='pending') echo "selected";?>>pending</option>
     <option value="converted" <?php if(isset($status)) if($status=='converted') echo "selected";?>>converted</option>
     <option value="rejected" <?php if(isset($status)) if($status=='rejected') echo "selected";?>>rejected</option>
     
    </select>
	
      </div>
	  <label class="control-label col-sm-1">Follow up on date: </label>
	   <div class="col-sm-3">          
        <input type="date" name="follow_up_date" placeholder="YYYY-MM-DD" value="<?php if(isset($follow_date)) echo $follow_date ?>">
      </div>
	  
	  <input type="submit" value="GO" >
	  
	  </form>
    </div>
	
	<br><br><br>

<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
      <tr>
		<th></th>
        <th>#</th>
        
        <th>Name</th>
        
        
        <th>Mobile</th>
		
		
		<th>FollowUpDate</th>
		<th>Status</th>
		<th></th>
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
			<td><?php echo $r->first_name.' '.$r->middle_name.' '.$r->last_name;?>
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
			  <h5><?php if(!empty($result)) echo $links; ?> </h5>
		 </td>
	 </tr>
    </tbody>
  </table>
  </div>
</div>
