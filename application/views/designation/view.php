<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('update'));?></h4></p>
</div>
<div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('delete'));?></h4></p>
</div>
<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		
        <th>#</th>
        <th>Designation</th>
        <TH></TH>	
		<th></th>
		
		 </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($designation  as $r): ?>
		<tr>
			
			
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->designation;?>
			</td>
			
		   
			<td><form name="edit" style= "position:relative; left:400px; display:inline-block; margin:0 auto;" class="form-horizontal" action="<?php echo base_url('Designation/edit');?>"  method="POST">
			<input type="hidden" name="designation_id" value="<?php echo $r->id;?>">
					<input type="submit" name="edit" class="btn btn-primary" value="Edit">
					
				</form>
			</td>
			<td><form name="delete" style= "display:inline-block; margin:0 auto; position:relative; left:190px;" class="form-horizontal" action="<?php echo base_url('Designation/delete');?>"  method="POST">
			<input type="hidden" name="designation_id" value="<?php echo $r->id;?>">
					<input type="submit" name="delete" class="btn btn-danger" value="Delete">
					<div>
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
	 
    </tbody>
  </table>
  </div>
</div>