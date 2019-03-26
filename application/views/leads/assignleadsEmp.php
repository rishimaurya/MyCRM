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
		
	<script type = "text/javascript" >
 $(document).ready(function(){

$('#checkLength').submit(function(){
			if($('#employee').val().length > 10){
				
			}
                        else {  alert('Please Select Employee Name');return false; }
		});

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
<h3 class="student">Assign Lead</h3>
	<?php $csv="";$sesVal=$this->session->userdata('my_session');
		       $rolecheck=$sesVal['role'];
		        if(!empty(get_cookie('csv_source')))
	{
	   	$csv = get_cookie('csv_source');
	   	
	}
	 ?>
	 <div class="myjumbo">
	 <form name="csv_type" class="form-horizontal" action="<?php echo base_url('Leads/set_filter_csv');?>"  method="POST">

	<label class="control-label col-sm-1">Lead Source</label>
      <div class="col-sm-2">          
         <select class="form-control state" name="csv_source">
			 <option value="all">All</option> 
			<?php foreach($type as $t){?>
			 <option value="<?php echo $t->csv_source;?>" <?php if($csv==$t->csv_source) echo "selected"; ?>><?php echo ucfirst($t->csv_source);?></option>
			<?php }?>
		   </select>
      </div>
    
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  value="GO" >
    
 </form><br/><br/><br/>
 <form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/show_assign_leads');?>" id="checkLength" method="POST">
       
      
     <div class="col-sm-2">
        <button type="submit" class="btn btn-success">Assign Lead</button>
      </div><br/><br/><br/>
<li style="background-color:#f2f2f2 !important;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);"><label>Select All</label></li>
<div class="table-responsive">
<table class="table table-hover">
      <thead class="thead-inverse">
      <tr>
		<th>#</th>
        <th>ID</th>
        <th>Client Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>CSV Source</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
    </thead>
    <tbody>
    <?php $i=1;?>
      <?php foreach($result  as $r){ ?>
		<tr>
			<td>
				<input type="checkbox"  name="checkbox[]" id="chkAll" class="all" value="<?php echo $r->client_id; ?>">
			</td>
			<td><?php echo $i; $i++;?>
			</td>
			<td><?php echo $r->first_name ." ". $r->last_name;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			<td><?php echo ucfirst($r->csv_source);?>
			</td>
			<td><a href="<?php echo base_url('Services/view_client_services?client='.base64_encode($r->client_id));?>">
					<input type="button" name="submit" class="btn btn-default btn-sm" value="Services">
			    </a>
			</td>
			<td><form name="edit" class="form-horizontal" action="<?php echo base_url('Leads/edit');?>"  method="POST">
					<input type="hidden" name="client" value="<?php echo $r->client_id;?>"/>
				</form>
			</td>
			<?php 
			
		       if($rolecheck!="employee"){?>
			<td><form name="delete" class="form-horizontal" action="<?php echo base_url('Leads/delete_leads');?>"  method="POST">
			<input type="hidden" name="client" value="<?php echo $r->client_id;?>">
					<input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
				</form>
			</td><?php }?>
		</tr>
	<?php } ?>
	<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(!empty($result)) echo $links; ?> </h5>
		 </td>
	 </tr>
    </tbody>
</table>         
</div>
      <input type="hidden" name="employee" value="<?php echo $sesVal['username']."/".$sesVal['mobile']; ?>">
 </form>
	 </div>
</div>
<script>
function selectemployee(val) 
{
$(employee).val(val);	
document.getElementById("country-list").style.display = "none";
}
</script>