<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <style>

.popup{
  width:380px;
  min-height:180px;
  background:#005D95;
  top: 370px;
  right: 20px;
  z-index:100;
  position:fixed !important;
  border-radius:5px;
  box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.05);
  transition: 0.5s;
}

.close{
  position:absolute;
  top: 5px;
  right: 5px;
  width: 30px;
  height: 30px;
  cursor:pointer;
  z-index:500;
}

.ns-close {
    width:30px;
    height: 30px;
    position: absolute;
    right: 6px;
    top: 6px;
    overflow: hidden;
    text-indent: 100%;
    cursor: pointer;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

.ns-close:hover, 
.ns-close:focus {
    outline: none;
}

.ns-close::before,
.ns-close::after {
    content: '';
    position: absolute;
    width: 3px;
    height: 60%;
    top: 50%;
    left: 50%;
    background: #ffffff;
}

.ns-close:hover::before,
.ns-close:hover::after {
    background: #fff;
}

.ns-close::before {
    -webkit-transform: translate(-50%,-50%) rotate(45deg);
    transform: translate(-50%,-50%) rotate(45deg);
}

.ns-close::after {
    -webkit-transform: translate(-50%,-50%) rotate(-45deg);
    transform: translate(-50%,-50%) rotate(-45deg);
}

 </style> 
 <script>
 
$(document).ready(function() {
  $('.close').click(function(){
    $('.popup').hide();
  });
  
});
 </script>
 <?php
if(!empty($message))
{
    $output = '';
      ?>
       <div class="popup">
       <div class="close ns-close" id="close"></div><br/>
       <div id="msg" style="color:#ffffff;padding:20px;">
     <?php          
    foreach($message as $row)
     {
       echo '<p><strong>'.$row->sender_name.'</strong></br>';
       echo '<small><em>'.$row->message_text.'</em></small>';
       echo '</p><hr/>';
     }
      ?>
      </div></div></div>
      <?php
}if(!empty($output)) echo $output;
?>
 
