<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>

<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>

<script type = "text/javascript" >
 $(document).ready(function(){
	var req = null;
	$('#employee').on('keyup', function(){
		var key = $('#employee').val();
		if (key && key.length > 0)
		{
			$('#loading').css('display', 'block');
			if (req)
				req.abort();
			req = $.ajax({
				url : '<?php echo base_url(); ?>Leads/searchemployee',
				type : 'POST',
				cache : false,
				data : {
					employee : key,
				},
				success : function(data)
				{
					console.log(data)
					if (data)
					{
						$('#loading').css('display', 'none');
						$("#result").html(data).show();
					}
				}
			});
		}
		else
		{
			$('#loading').css('display', 'none');
			$('#result').css('display', 'none');
		}
 
	});
});

</script>

 <form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/show_assign_leads');?>" method="POST">
 <?php $sesVal=$this->session->userdata('my_session');  if($sesVal['role']!="employee") {?>
 
	<div class="form-group">
      <label class="control-label col-sm-1 required">Employee</label>
      <div class="col-sm-2">
        <input type="text" name="employee" id="employee" class="form-control" placeholder="Enter first name" autocomplete="off" required>
                <div id="result"></div>
      </div>
      </div><br><br><br>
     <?php } 
     if($sesVal['role']=="employee") {     ?>

        <input type="hidden" name="employee" value="<?php echo $sesVal['username']."/".$sesVal['mobile']; ?>">

<?php }?>
<li style="background-color:#f2f2f2 !important;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label>Select All</label></li>
 

<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		<th></th>
        <th>ID</th>
        <th>Firstname</th>
		 <th>Middlename</th>
        <th>Lastname</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Mobile</th>
		<th>Address</th>
		<th>Professoin</th>
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
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>"></li>
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name;?>
			</td>
			<td><?php echo $r->middle_name;?>
			</td>
			<td><?php echo $r->last_name;?>
			</td>
			<td><?php echo $r->gender;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			<td><?php echo $r->address;?>
			</td>
			<td><?php echo $r->profession;?>
			</td>
			<td><?php echo $r->follow_up_date;?>
			</td>
			<td><?php echo $r->status;?>
			</td>
			
			<td><a href="<?php echo base_url('leads/edit_disposed_leads?client='.base64_encode($r->client_id));?>">
					<input type="button" name="submit" class="btn btn-primary" value="Edit">
				</a>
			</td>
			<td><a href="<?php echo base_url('leads/delete_disposed_leads?client='.base64_encode($r->client_id));?>" >
					<input type="button" name="delete" class="btn btn-danger" value="Delete">
				</a>
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
  <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Assign Lead</button>
      </div>
    </div>
</div>
<script>
function selectemployee(val) 
{
$(employee).val(val);	
document.getElementById("country-list").style.display = "none";
}
</script>