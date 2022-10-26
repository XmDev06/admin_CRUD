
<?php $baza = mysqli_connect("localhost", "newuser", "password", "");
$tables =$baza->query( "SHOW TABLES IN ");
$db="";