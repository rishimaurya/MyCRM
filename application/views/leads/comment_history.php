
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/comment.css');?>">
<div class="container">
    <div class="row">
        <?php foreach($result  as $r): ?>
        <div class="col-sm-8">
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left image">
                        <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
                    </div>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b>Client<?php echo '  '.$r->first_name.' '.$r->middle_name.' '.$r->last_name;?></b></a>
                            followup by <?php echo '  '.$r->fname.' '.$r->mname.' '.$r->lname;?>
                        </div>
                        <h6 class="text-muted time"><?php echo $r->date;?></h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p><?php echo $r->comment;?></p>
                    
                </div>
            </div>
        </div>
		<?php endforeach; ?>
		</div><tr>
		 <td align="center" colspan="12"> 
			  <h5><?php echo $links; ?> </h5>
		 </td>
	 </tr>
   
