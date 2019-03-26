  <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  --><style type="text/css">
.ab:after
{
    content: "▼";
    padding: 12px 8px;
    position: absolute;
    right: 10px;
    top: 0;
    z-index: 1;
    text-align: center;
    width: 10%;
    height: 100%;
    pointer-events: none;    
    color:white;
}
#cssmenu,
#cssmenu ul,
#cssmenu li,
#cssmenu a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  font-weight: normal;
  text-decoration: none;
  line-height: 1;
  font-family: Arial;
  font-size: 12px;
  position: relative;
}
#cssmenu a {
  line-height: 1.3;
  padding: 6px 0px 6px 16px;
}
#cssmenu > ul > li {
  cursor: pointer;
  background: #000;
}
#cssmenu > ul > li > a {
  font-size: 12px;
  display: block;
  color: #555;
  background: url(images/Expand.png) no-repeat 0px 12px #FFF;
  line-height:20px;
}
#cssmenu > ul > li > a:hover {
  text-decoration: none;
}
#cssmenu > ul > li.active {
  /*border-bottom: none;*/
}
#cssmenu > ul > li.active > a {
  background: url(images/collapsed.png) no-repeat 0px 12px #FFF;
  color: #2771ba;
  text-shadow: 0 1px 1px #e6e6e6;
}
#cssmenu > ul > li.has-sub > a:after {
  content: '';
  position: absolute;
  top: 10px;
  right: 10px;
}
#cssmenu > ul > li.has-sub a span{
	color:#2771ba;
	}
#cssmenu > ul > li.has-sub.active > a:after {
  right: 14px;
  top: 12px;
}
/* Sub menu */
#cssmenu ul ul {
  padding: 0;
  display: none;
}
#cssmenu ul ul a {
  background: #fff !important;
  display: block;
  color: #797979;
  font-size: 12px;
  padding-left:30px;
}
#cssmenu ul li ul li a span{color:#fff !important;}
#cssmenu ul li ul li a span:hover{color:#7293b4 !important; text-decoration:underline;}
#cssmenu ul ul li:last-child {
  border: none;
}
.addSubSec{list-style:none; padding:10px 0 0 20px; margin:0; background:url(add.png) no-repeat 0 10px; color:#989898;}
.addSub{padding-left:0; border-left:1px solid #d9d9d9;}
.addSub h3{font-size:19px; color:#929292;}

</style>

<script>
function validate()
    {
	
    if($("#s input:checkbox:checked").length == 0)
    {
	   alert('Select Atleast one user');
	}
	 }	
	   	
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
   </script>

   
   <script>
	$(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
    });
});
	</script>
   
   
   <!--   ###########################    -->
   <div class="col-sm-offset-4">
<p style="color:green;"><h4><?php print_r($this->session->flashdata('insert'));?></h4></p>
</div>


<div class="container">
	<h3 class="student">Compose Message</h3></br></br>
<form action="<?php echo base_url('Researcher/TimelineMessage'); ?>" id="s" onsubmit="validate()"  method="post" > 
<div class="form-group">
<textarea  rows="5" cols="60" name="message" id="firstname"></textarea>
</div>


<div class="form-group" style="left:450px !important; position:absolute !important;">
<button type="submit" id="submit" class="btn btn-primary" align="center">Send</button>
</div>

<!--   ###########################    -->

  <div style="position:absolute !important; left: 600px; top: 15px;"class="w3-sidebar w3-light-grey w3-bar-block" style="width:16%">
     <div id="cssmenu" style="width:250px;">
		 <h3 class="student" style="align:center;">Select User</h3></br></br>
		              <li style="background-color:#005D95 !important; padding-left:20px;"><input type="checkbox" name="all" id="chkAll" class="all" onchange="toggle(this);" value="allselect"><label style="color:white;padding-left:10px">Select All</label></li>
		              <?php 
		                   
                        foreach($userpost as $r){
						 						
                         ?>
                         <ul>							                            
                          <li class="has-sub ab" style="background-color:<?php if($r->role=="admin") echo "#002A57";else if($r->role=="manager") echo "#002A57"; else if($r->role=="employee") echo "#006AC7"; else echo "#027CFF"; ?> !important;padding-left:20px;"><input type="checkbox" name="all" id="chkAll" class="all"  value="allselect"><label style="padding-left:10px;color:white;"><?php echo ucfirst($r->role);?></label>
                              <ul style="background-color:<?php if($r->role=="admin") echo "#002A57";else if($r->role=="manager") echo "#002A57"; else if($r->role=="employee") echo "#006AC7"; else echo "#027CFF"; ?> !important;">
                                 <!--<li class="even"> Select All</br></br></li>-->
                                 <?php foreach($user as $s){
									 if($r->role == $s->role){?>									 
                                      <li class="odd" style="padding-left:40px !important;"><input type="checkbox" name="array[]" value="<?php echo $s->employee_id;?>"><label style="padding-left:10px;color:white;"><?php echo ucfirst($s->first_name) ." ". ucfirst($s->last_name);?></label></li>
                                  <?php }} ?>
                              </ul>
                           </li>
					     </ul>
					     
					   
                           <?php
                           }
                          ?>
                        
                    </div>


<!--   ###########################    -->

</div>
</form>
</div>

<script type="text/javascript">
$( document ).ready(function() {
$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');
$('#cssmenu > ul > li > label').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});
</script>
