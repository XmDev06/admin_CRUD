<?php
include "config.php";
include "configtable.php";
$result = $baza->query("select * from $tablename");
$db = $result->fetch_fields()[0]->db;
$id = $_GET['id'];


$fetch_fields = $result->fetch_fields();
$cols_count = count($fetch_fields);
$massiv_col = [];
for ($i = 0; $i < $cols_count; $i++) {
    $massiv_col[] = $fetch_fields[$i]->orgname;
}


if (in_array("image", $massiv_col)) {
    $image_name = $baza->query("select image from $tablename where id= $id")->fetch_row()[0];


    $del = unlink("images/$db/$tablename/$image_name");

    if (!$del) {
        header("Location: notimage.php");
        exit();
    }
}
$sql = "delete from $tablename where  id = $id";
$test = $baza->query($sql);
header("Location: index.php");