<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 8px;
}
#tab tr:nth-child(even){background-color: #f2f2f2;}
</style>

<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>




<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>

<h2>Active Free Trial</h2>
	<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/stop_service');?>"   onsubmit="return validateLeadRegisterForm()" method="post">
	</br></br>
     <li style="background-color:#f2f2f2 !important;list-style: none;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label> Select All</label></li>
   </br>
<div style="overflow-x:auto;">
  <table id="tab">
    <tr style="background-color:#f2f2f2;">
        <th></th>
        <th>ID</th>
        <th>Client Name</th>
        <th>Employee Name</th>
        <th>Client Email</th>
        <th>Client Mobile</th>
		<th>FollowUpDate</th>
		<th>Status</th>
		<th></th>
		<th></th>
		<th></th>
        <input type="hidden" value="free" name="t">
    </tr>
    <tr>
     <?php $i=1;?>
      <?php foreach($result  as $r) { ?>
		<tr>
            
			<td>
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>"></li>
			    
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name." ".$r->last_name;?>
			</td>
			<td><?php echo $r->fname." ".$r->lname;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			<td><?php echo $r->follow_up_date;?>
			</td>
			<td><?php echo $r->status;?>
			</td>
            
           
               

			
			<td><a href="<?php echo base_url('Services/view_client_services?client='.base64_encode($r->client_id));?>">
					<input type="button" name="submit" class="btn btn-default btn-sm" value="Services">
			    </a>
			</td>
			
			<td><a href="<?php echo base_url('Leads/edit?client='.base64_encode($r->client_id));?>">
					<input type="button" name="submit" class="btn btn-primary  btn-sm" value="Edit">
			   </a>
			</td>
			
			<td><a href="<?php echo base_url('Leads/delete_leads?client='.base64_encode($r->client_id));?>" >
			   <input type="button" name="delete" class="btn btn-danger btn-sm" value="Delete">
				</a>
			</td>
			   </tr><?php } ?>
			   <tr>
		 <td align="center" colspan="12"> 
			  <h5><?php echo $links; ?> </h5>
		 </td>
	 </tr>
  </table>
</div>
</br>
</br>
<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <input type="submit" name="stop" class="btn btn-danger btn-sm" value="Stop Service">
      </div>
    </div>
 </form>   