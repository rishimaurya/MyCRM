<html> 
	<head>
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
	<script type = "text/javascript" >
 $(document).ready(function(){
	var req = null;
	$('#searchlead').on('keyup', function(){
		var key = $('#searchlead').val();
		if (key && key.length > 1)
		{
			$('#loading').css('display', 'block');
			if (req)
				req.abort();
			req = $.ajax({
				url : '<?php echo base_url(); ?>Leads/searchlead',
				type : 'POST',
				cache : false,
				data : {
					searchlead : key,
				},
				success : function(data)
				{
					console.log(data)
					if (data)
					{
						$('#loading').css('display', 'none');
						$("#result1").html(data).show();
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
</head>
</body>
<div class="container">
	<h3 class="student">Assign Lead</h3>
	<?php
	/*echo '<form action="" method="POST">
				 <div class="form-group">
      <label class="control-label col-sm-4 ">Employee</label>
      <div class="col-sm-6">          
        <input type="text" name="employee" id="employee" class="form-control" value=""  >
        <div id="result">
      </div>
    </div>';
				
				echo '</div>';
				echo '
				<input name="keysearch1" autocomplete="off" placeholder="Tutor Name/Id" id="keysearch1" type="text" class="text1" required>
				<div id="result1">';
				echo '</div>';
				echo '
				<input name="keysearch2" autocomplete="off" placeholder="Subject" id="keysearch2" type="text" class="text1" required>
				<div id="result2"></div></td>';
				echo '<input type="submit" value="Assign">
				</form>';*/
	?>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/massign_lead');?>"   onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
	<div class="form-group">
      <label class="control-label col-sm-4 required">Employee</label>
      <div class="col-sm-2">
        <input type="text" name="employee" id="employee" class="form-control" placeholder="Employee" value="<?php if(!empty($employee))foreach($employee as $e) { echo $e->username ."/".$e->mobile;}?>" autocomplete="off" required>
                <div id="result">
      </div>
      </div>
       <label class="control-label col-sm-4 required">Lead</label>
	  <div class="col-sm-2">
        <input type="text" name="lead" id="searchlead" class="form-control" value="<?php if(!empty($lead)) echo $lead;?>" autocomplete="off" required>
        <input type="hidden" value="<?php if(!empty($client_id)) echo $client_id;?>" name="client">
      </div>
      </div>
    </div>
    
	   <!-- <div class="form-group">
      <label class="control-label col-sm-4 ">Employee</label>
      <div class="col-sm-3">          
        <input type="text" name="employee" id="employee" class="form-control" value=""  >
        <div id="result">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-4 ">Leads</label>
      <div class="col-sm-3">          
        <input type="text" name="lead" class="form-control" id="lead" value=""  >
        <div id="result">
      </div>
    </div>-->
		
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Assign Lead</button>
      </div>
    </div>
	
</div>   
</form>
</div> 
</body>
<script>
function selectemployee(val) 
{
$(employee).val(val);	
document.getElementById("country-list").style.display = "none";
}
</script>
<script>
function selectlead(val) 
{
$(searchlead).val(val);	
document.getElementById("country-list1").style.display = "none";
}
</script>
</html>
