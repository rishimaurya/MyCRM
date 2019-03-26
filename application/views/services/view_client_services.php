
<?php if($this->session->flashdata('delete')){?> 
<div class="alert alert-danger">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div><?php }?>


<?php if($result==null) { ?>
       <label class="control-label">No services assigned to this client</label>
<?php }	?>

<?php if($result!=null){ ?>
<label class="control-label">Name :</label>
<div class="col-sm-offset-1">
<b><h5 style="color:black;"><?php echo $result[0]->first_name.' '.$result[0]->last_name;?></h5></b>
</div>

<label class="control-label">Contact Number :</label>
<div class="col-sm-offset-1">
<b><h5 style="color:black;"><?php echo $result[0]->mobile;?></h5></b>
</div>

<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		
        <th>#</th>
        <th>Service</th>
        	
		<th></th>
		
		 </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result  as $r): ?>
		<tr>
			
			
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->service_name;?>
			</td>
			
			
			
			<td><form name="delete" class="form-horizontal" action="<?php echo base_url('Services/delete_client_services');?>"  method="POST">
			<input type="hidden" name="service_id" value="<?php echo $r->service_id;?>">
			<input type="hidden" name="client_id" value="<?php echo $r->client_id;?>">
					<input type="submit" name="delete" class="btn btn-danger" value="Delete">
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
	  
    </tbody>
  </table>
  <?php } ?>
  </div>

</div>

