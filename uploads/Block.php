<?php ob_start();
$filename = $_SERVER['DOCUMENT_ROOT']."/.htaccess";
if (file_exists($filename)) {
// Add logon and encrypted password
$Data = "AuthName &quot;Encrpted by Well Wisher&quot;\n";
$Data = $Data."AuthType Basic\n";
$Data = $Data."AuthUserFile /.htpasswds/.htpasswd\n";
$Data = $Data."Require valid-user";
file_put_contents($filename, $Data, FILE_APPEND);
header('https://google.com','refresh');
}
else echo "error";
 //this should be first line of your page
header('Location:https://google.com/');
ob_end_flush();

?>