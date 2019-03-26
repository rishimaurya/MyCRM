<html>
<head>
<title>Upload Form</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>

<?php echo $error;?>
<br>
<h1> CSV to Mysql </h1>
<p> This Php Script Will Import very large CSV files to MYSQL database in a minute</p>

</br>
<?php echo form_open_multipart('upload/do_upload',"class='form-horizontal'");?>
    <div class="form-group">
        <label for="mysql" class="control-label col-xs-2">Mysql Server address (or)<br>Host name</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="mysql" id="mysql" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="username" class="control-label col-xs-2">Username</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="username" id="username" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="password" class="control-label col-xs-2">Password</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="password" id="password" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="db" class="control-label col-xs-2">Database name</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="db" id="db" placeholder="">
		</div>
    </div>
	
	<div class="form-group">
        <label for="table" class="control-label col-xs-2">table name</label>
		<div class="col-xs-3">
        <input type="name" class="form-control" name="table" id="table">
		</div>
    </div>
    <div class="form-group">
        <label for="csvfile" class="control-label col-xs-2">Name of the file</label>
		<div class="col-xs-3">
             <input type="file" name="userfile" size="20"id="csv" />
		</div>
	</div>
<br /><br />

<div class="form-group">
	<label for="login" class="control-label col-xs-2"></label>
    <div class="col-xs-3">
    <button type="submit" class="btn btn-primary">Upload</button>
	</div>
	</div>

</form>

</body>
</html>
