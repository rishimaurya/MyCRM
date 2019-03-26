		<style type="text/css">
#a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list,#country-list1,#country-list2{list-style: none; margin-top:1px;padding-left: 114px;width: 35%;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;border-radius: 4px; margin-left:-40px;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#country-list1 li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;border-radius: 4px;margin-left:-40px;}
#country-list1 li:hover{background:#ece3d2;cursor: pointer;}
#country-list2 li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;border-radius: 4px;margin-left:-40px;}
#country-list2 li:hover{background:#ece3d2;cursor: pointer;}
#keysearch,#keysearch1,#keysearch2{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;border-radius:4px;}
#addButton{z-index: 0!important;}
      
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

		


<div class="container">
	<h3 class="student">Approve Free Trail</h3>
	<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/approve_freetrail');?>"   onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
	<br><br><br>
     
		              <li style="background-color:#f2f2f2 !important;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label>Select All</label></li>
		
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
        <th>ID</th>
        <th>Client Name</th>
        <th>Employee Name</th>
        <th>Client Email</th>
        <th> Client Mobile</th>
		
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php if(!empty($freetrail))foreach($freetrail  as $r): ?>
		<tr>
			<td>
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>"></li>
			</td>
			<td><?php  echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name." ".$r->last_name; ?>
			</td>
			<td><?php echo  $r->fname." ".$r->lname;?>
			</td>
			
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			
			<td>
				<a href="<?php echo base_url('Leads/view_free_detials?client='.base64_encode($r->client_id));?>"  >
					<input type="button" name="submit" class="btn btn-danger btn-sm" value="View">
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(!empty($result)) //echo $links; ?> </h5>
		 </td>
	 </tr>
	 
    </tbody>
  </table>
  </div>

</div>

	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Approve FreeTrail</button>
      </div>
    </div>
	
</div>   
</form>
</div> 


