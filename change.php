<?php
include "config.php";
include "configtable.php";
$id = $_POST['id'];
$result = $baza->query("select * from $tablename");
$db = $result->fetch_fields()[0]->db;


unset($_POST['id']);

if (in_array('created_at', array_keys($_POST))){
    $_POST['created_at']=  date('Y-m-d H:i:s');
}
if (in_array('updated_at', array_keys($_POST))){
    $_POST['updated_at']=  date('Y-m-d H:i:s');
}
if (in_array('deleted_at', array_keys($_POST))){
    $_POST['deleted_at']=  null;
}

if (isset($_FILES['image'])){
    $image_name = $baza->query("select image from $tablename where id= $id")->fetch_row()[0];
    unlink("images/$db/$tablename/$image_name");

    $imagetmp = ($_FILES['image']['tmp_name']);
    $image = ($_FILES['image']['name']);
    $imagename = time()."_"."$image";

    if (!file_exists("images/$db/$tablename")){
        mkdir("images/$db/$tablename", 0777, true);
    }
    move_uploaded_file($imagetmp, "images/$db/$tablename/$imagename");
    $col_image = array_keys($_FILES)[0];

}



$str= "";
$col_names = array_keys($_POST);
$col_values =array_map(function ($item){
    return '"'.$item.'"';
}, array_values($_POST));


if (isset($_FILES['image'])){
    $col_names[] = $col_image;
    $col_values[] = '"'.$imagename.'"';
}


$vergul = ",";
foreach ($col_names as $key =>$col_name) {
    if ($key == (count($col_values)-1)){
        $vergul = "";
    }
    $str .= $col_name ." = ".$col_values[$key]."$vergul ";
}

    $sql = "update $tablename set $str where id = $id";
    $test = $baza->query($sql);

if ($test){
    header("Location: index.php");
}else{
    header("Location: error.php");
}