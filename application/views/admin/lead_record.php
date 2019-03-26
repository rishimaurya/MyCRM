<!--This is for password change-->
	
	
	<div class="col-sm-offset-4">	
		<p style="color:green;"><?php print_r($this->session->flashdata('registered'));?>	</p>
	</div>
	
<!--This is for profile update-->	
	<div class="col-sm-offset-4">	
		<p style="color:green;"><?php print_r($this->session->flashdata('profile'));?>	</p>
	</div>
	
<!--page started-->
						<div class="page-header">
							<h1>
								Employee Record
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									
								</small>
							</h1>
						</div><!-- /.page-header 
	


						<div class="col-sm-4">
						<h1 >
							leads<br>
							<?php echo $result1;?>
						</h1>
						</div>
						<div class="col-sm-4">
						<h1>
							Free Trial<br>
							<?php echo $result2; ?>
						</h1>
						</div>
						<div class="col-sm-4">
						<h1>
							Active Client<br> 
							<?php echo $result3;?>
						</h1>
						</div>
						-->

<h1><?php echo ucfirst($data[0]->username) ; ?></h1>
					<div class="container">
							<div class="col-sm-3">
						<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
         
      <tr>
        <th  style="text-align:center;"> Leads</th>
         
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td  style="text-align:center;">
		    	<?php echo "<h1>".$result4."</h1><br>".$result1." available leads"; ?>
		    	</td>
		    	 		</tr>
    </tbody>
  </table>
		</div>
		</div>		
		
			<div class="col-sm-3">
						<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
         
      <tr>
        <th  style="text-align:center;">Free Trial</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td style="text-align:center;">
		    	<?php echo "<h1>".$result2."</h1><br>".$result7." Unapprove-free-trial"; ?>
		    	</td>
		</tr>
    </tbody>
  </table>
  
  
			
		</div>
		</div>			
			<div class="col-sm-3">
						<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
         
      <tr>
        <th  style="text-align:center;">Active Client</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td style="text-align:center;">
		    	<?php echo "<h1>".$result3."</h1><br>".$result6." Unapprove-client"; ?>
		    	</td>
		</tr>
    </tbody>
  </table>
		</div>
		</div>
		</br></br></br></br></br></br></br></br></br></br></br>
			<div class="col-sm-3">
						<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
         
      <tr>
     
         <th  style="text-align:center;">Revenue</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    	    <td  style="text-align:center;">
		<?php if($result5 =="") echo "<h1>0</h1><br>"."current-month"; else echo "<h1>".$result5."</h1><br>"."current-month"; ?>
		    	
		    	</td>
		</tr>
    </tbody>
  </table>
		</div>
		</div>
			
		
		
		
		
									<div class="col-sm-3" >
						<div class="table-responsive">          
  <table class="table table-hover table-striped">
     <thead class="thead-inverse">
         
      <tr>
        <th  style="text-align:center;">Target</th>
      </tr>
    </thead>
    <tbody>
		<tr>
		    <td  style="text-align:center;">
		    	
						<h1><?php if($target == "") echo "<h1>0</h1><br>"."current-month"; else echo "<h1>".$target."</h1></br>current-month";?></h1>
					
		    	</td>
		    		
		</tr>
    </tbody>
  </table>
		</div>
		</div>
