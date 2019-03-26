<div class="container">
<form action="<?php echo base_url(); ?>" 
method="post" >
<div class="form-group">
<div class="col-md-4">
<?php $i=1;?>
<?php foreach($result  as $r): ?>
<input type="checkbox"> <?php echo $r->service_name;?><br>
 <?php endforeach; ?>
</div>
  </div>
 
<div class="form-group">
	<div class="col-md-4"> 
		<div class="table-responsive">          
 
    
      <tr>
		
       
        <th>Message</th>
        	

		
		 </tr>
    </thead>
    <tbody>
<td>    
<textarea  rows="5" cols="60" ></textarea
</textarea>
</div>
<div class="form-group">
<button type="submit" id="submit" class="btn btn-primary" align="center">Send</button>
</div></td>
</div>
</form>
</div>

