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
        <th>Target Assign</th>
        <th>Target Achieve</th>
		 <th>achieve_date</th>
		
        
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
			<td><?php echo $r->target_assign;?>
			</td>
			
			<td><?php echo $r->target_achieve;?>
			</td>
			<td><?php echo $r->achieve_date;?>
			</td>
			
			
			
			
			
		</tr>
	<?php endforeach; ?>
	 <tr>
		 <!---<td align="center" colspan="12"> 
			  <h5><?php if(isset($links)) //echo $links; ?> </h5>
		 </td>-->
	 </tr>
	 
    </tbody>
  </table>
  </div>
</div>
</div>
