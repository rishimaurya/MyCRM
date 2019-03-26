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





<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div>

<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>
<?php  if(!empty($past)){ 
   if($past == "past") {?>
<h2>Past Free Trial</h2>
<?php }  if ($past == "active"){ ?>
<h2>Active Free Trial</h2>
<?php } }?>
	   </br>
<div style="overflow-x:auto;">
  <table id="tab">
    <tr style="background-color:#f2f2f2;">
        <th></th>
        <th>ID</th>
        <th>Client Name</th>

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
				    
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name." ".$r->last_name;?>
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
 </form>   
