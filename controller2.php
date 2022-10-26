<?php

include "config.php";
$table = $_GET['table'];
$d = file_get_contents("config.php");

$cut_index = strpos($d,'$tablaname');

$head = substr($d, 0 ,$cut_index);
$tablename = '$tablaname';
$writer = $head .= "$tablename = "."'$table';";

file_put_contents('config.php', '');
file_put_contents('config.php', $writer);


header("Location: index.php");