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
 if(isset($_COOKIE['status']))  $status=$_COOKIE['status'];
 if(isset($_COOKIE['services'])) $service=$_COOKIE['services'];
 if(isset($_COOKIE['follow_up_date'])) $follow_date=$_COOKIE['follow_up_date'];
 if(isset($_COOKIE['sdate'])) $sdate=$_COOKIE['sdate'];
 if(isset($_COOKIE['end_date'])) $end_date=$_COOKIE['end_date'];
 if(isset($_COOKIE['called'])) $called=$_COOKIE['called'];
?>
 <div class="form-group">
 <form action="<?php echo base_url('Leads/set_filter_data');?>" method="POST">
      <label class="control-label col-sm-1">Filter By:  status </label>
      <div class="col-sm-3">          
        <select class="form-control branch" name="status">
     <option value="all">All</option>
     <option value="no status" <?php if(isset($status)) if($status==='no status') echo "selected";?>>No Status</option>
     <option value="freetrial" <?php if(isset($status)) if($status=='freetrial') echo "selected";?>>Free Trial</option>
     <option value="busy" <?php if(isset($status)) if($status=='busy') echo "selected";?>>Busy</option>
     <option value="switchoff" <?php if(isset($status)) if($status=='switchoff') echo "selected";?>>Switch Off</option>
     <option value="notinterested" <?php if(isset($status)) if($status=='notinterested') echo "selected";?>>Not Interested</option>
     <option value="interested" <?php if(isset($status)) if($status=='interested') echo "selected";?>>Interested</option>
     <option value="npc" <?php if(isset($status)) if($status=='npc') echo "selected";?>>NPC</option>
     <option value="does not trade" <?php if(isset($status)) if($status=='does not trade') echo "selected";?>>Does not Trade</option>
     <option value="callback" <?php if(isset($status)) if($status=='callback') echo "selected";?>>Callback</option>
     <option value="junk" <?php if(isset($status)) if($status=='junk') echo "selected";?>>Junk</option>
    </select>
	
      </div>
	  <label class="control-label col-sm-1">Services : </label>
	   <div class="col-sm-3">          
        <select class="form-control branch" name="services">
     <option value="all">All</option>
     <?php
          if(!empty($services)){
			  foreach($services as $s)
			  {
		 ?>
		        <option value="<?php echo $s->service_id;?>" <?php if(isset($service)) if($service===$s->service_id) echo "selected";?>><?php echo $s->service_name;?></option>
		 <?php
			  }
		  }
     ?>
     
    </select>
      </div>
      <label class="control-label col-sm-1">Follow up on date: </label>
	   <div class="col-sm-3">          
        <input type="date" name="follow_up_date" placeholder="YYYY-MM-DD" value="<?php if(isset($follow_date)) echo $follow_date ?>">
      </div><br/><br/><br/><br/>
      <label class="control-label col-sm-1">Start Date: </label>
	   <div class="col-sm-3">          
        <input type="date" name="sdate" placeholder="YYYY-MM-DD" value="<?php if(isset($sdate)) echo $sdate ?>">
      </div>
      <label class="control-label col-sm-1">End Date: </label>
	   <div class="col-sm-3">          
        <input type="date" name="end_date" placeholder="YYYY-MM-DD" value="<?php if(isset($end_date)) echo $end_date ?>">
      </div>
      <label class="control-label col-sm-1">Calling : </label>
	   <div class="col-sm-3">          
        <select class="form-control branch" name="called">
     <option value="all">All</option>
     <option value="1" <?php if(isset($called)) if($called=='1') echo "selected";?> >Called</option>
     <option value="0" <?php if(isset($called)) if($called=='0') echo "selected";?> >Not Called</option>
     </select>
	</div><br/><br/><br/><br/>
	<div class="form-group">        
					<div class="col-sm-offset-8 col-sm-2">
						<button type="submit" class="btn btn-success">Search Leads</button>
					</div>
				  </div>   
	  </form>
    </div>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/multiDisposing');?>" method="POST">	
	<br/><br/><br/>
<li style="background-color:#f2f2f2 !important;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label>Select All</label></li>

<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
      <tr>

        <th>#</th>
        <th></th>
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
		<?php if(isset($count)) $i=$count+1;?>
      <?php foreach($result  as $r): ?>
		<tr style="background-color:<?php if($r->color_bit==1) { echo " #d1e0e0"; }?> ">
			<td>
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>">
			</td>
			<td ><?php echo $i; $i++;?>
			</td>
			<td ><?php echo $r->first_name.' '.$r->middle_name.' '.$r->last_name;?>
			</td>
			
			
			
			<td ><?php echo $r->mobile;?>
			</td>
			
			
			<td><?php echo $r->follow_up_date;?>
			</td>
			<td ><?php echo ucfirst($r->status);?>
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
    <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-danger">Disposed Lead</button>
      </div>
    </div>

</form><br/><br/><br/>
<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
