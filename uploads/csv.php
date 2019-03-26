<?php 
$sqlname="localhost";
$username="rishimau";
$table="client";
$password= '@Rishi17';
$db="rishimau_crm";
$file="csv.csv";

$cons= mysqli_connect("$sqlname", "$username","$password","$db") or die(mysql_error());
$result1=mysqli_query($cons,"select count(*) count from $table");
$r1=mysqli_fetch_array($result1);
echo $count1=(int)$r1['count'];

mysqli_query($cons, '
     LOAD DATA  INFILE "'.$file.'"
        INTO TABLE '.$table.'
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
')or die(mysql_error());

$result2=mysqli_query($cons,"select count(*) count from $table");
$r2=mysqli_fetch_array($result2);
echo" ".$count2=(int)$r2['count'];
$count=$count2-$count1;
if($count>0){
//echo "Success";
//echo "<b> total $count records have been added to the table $table </b> ";
header("location:/Upload/");
}
else echo "Failed";
?>
