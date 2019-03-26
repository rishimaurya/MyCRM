<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<script>
 var checkbox;
  $(document).ready(function(){
    checkbox = function(id)
    {
      if($('#'+id).is(':checked'))
       {
          var e_id=$('#'+id).val();
          $('#fake').load("<?php echo base_url().'Login/blockUser?e_id=';?>"+e_id);
       }
       else {
          var e_id=$('#'+id).val();
          $('#fake').load("<?php echo base_url().'Login/removeblockUser?e_id=';?>"+e_id);
           }
    }
   });
</script>
<?php if($this->session->flashdata('update')){?> 
 <div align="center" class="alert alert-success"> 
<p style="color:green;"><?php print_r($this->session->flashdata('update'));?></p>
</div><?php }?>
<?php if($this->session->flashdata('delete')){?> 
<div class="alert alert-danger">
<p style="color:red;"><?php print_r($this->session->flashdata('delete'));?></p>
</div><?php }?>
<div class="col-sm-offset-4">
<p style="color:green;"><?php print_r($this->session->flashdata('insert'));?></p>
</div>
   <div class="form-group"> 
   <form name="employeeUpdateForm" class="form-horizontal" action="<?php echo base_url().'Login/blockAllUsers'; ?>"  method="POST">
      <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-danger">Block All Users</button>
      </div>
    </div>
    </form>
<form name="employeeUpdateForm" class="form-horizontal" action="<?php echo base_url().'Login/unBlockAllUsers'; ?>"  method="POST">
      <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Un-Block All Users</button>
      </div>
    </div>
    </form></div>
<div class="table-responsive">          
  <table class="table table-hover">
     <thead class="thead-inverse">
      <tr>
		
        <th>#</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Sub Designation</th>
        <th>Email</th>
        <th>Mobile</th>
		
		<th></th>
		<th></th>
		
			<th></th>
		<th></th>
		
		
		
		
      </tr>
    </thead>
    <tbody>
		<?php $i=1;?>
      <?php foreach($result  as $r): ?>
		<tr>
			
			
			<td><?php echo $i; ?>
			</td>
			<td><?php echo $r->first_name.' '.$r->middle_name.' '.$r->last_name;?>
			</td>
			<td><?php echo $r->role;?>
			</td>
			<td><?php echo $r->subpost;?>
			</td>
			<td><?php echo $r->email;?>
			</td>
			<td><?php echo $r->mobile;?>
			</td>
			
			
			<td>
					<!-- Rounded switch -->
                                        <label class="switch">
                                           <input type="checkbox" id="<?php echo $i;?>" value="<?php echo $r->employee_id; ?>" <?php if($r->is_blocked=="1") echo "checked";?> onclick="checkbox(<?php echo $i++;?>);" <?php if($r->role=="admin") echo "disabled"; ?> >
                                           <span class="slider round"></span>
                                        </label>
				</td>
		</tr>
	<?php endforeach; ?>
	<tr>
		 <td align="center" colspan="12"> 
			  <h5><?php if(isset($links)) echo $links; ?> </h5>
		 </td>
	 </tr>
	 
    </tbody>
  </table>
  </div>
</div>
<div id="fake"></div>