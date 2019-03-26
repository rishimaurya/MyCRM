<div class="container">
<?php if($this->session->flashdata('message')){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>

<br><br>
<h2>Upload CSV</h2>
<div align="center">
	
<form action="<?php echo base_url(); ?>/UploadCSV/import" 
method="post" name="upload_excel" enctype="multipart/form-data">
<div class="myjumbo">
<div class="form-group">
      <label class="control-label col-sm-4 ">CSV Source</label>
      <div class="col-sm-6">          
        <input type="text" name="csv_source" class="form-control" value="" required>
      </div>
    </div>	
	</br></br></br>
<div class="form-group">
<input type="file" name="file" id="file">
</div>
<div class="form-group">
<button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>
</div>
</div>
</form>

</div>
</div>
