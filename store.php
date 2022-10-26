<?php
include "config.php";
include "configtable.php";
$result = $baza->query("select * from $tablename");
$db = $result->fetch_fields()[0]->db;

if (isset($_FILES['image'])){
    $imagetmp = ($_FILES['image']['tmp_name']);
    $image = ($_FILES['image']['name']);
    $imagename = time()."_"."$image";

    if (!file_exists("images/$db/$tablename")){
        mkdir("images/$db/$tablename", 0777, true);
    }
    move_uploaded_file($imagetmp, "images/$db/$tablename/$imagename");
    $col_image = array_keys($_FILES)[0];

}




if (in_array('created_at', array_keys($_POST))){
    $_POST['created_at']=  date('Y-m-d H:i:s');
}
if (in_array('updated_at', array_keys($_POST))){
    $_POST['updated_at']=  date('Y-m-d H:i:s');
}
if (in_array('deleted_at', array_keys($_POST))){
    $_POST['deleted_at']=  null;
}


$col_names = implode(', ', array_keys($_POST));
$col_values = implode(', ', array_map(function ($item){
    if ($item == null){
        return 'null';
    }
    return "'$item'";
}, array_values($_POST)));



if (isset($_FILES['image'])){


    if ($col_names == ''){
        $values = $col_values .= "'".$imagename."'";
        $cols = $col_names.= $col_image;
    }else{
        $cols = $col_names.= ", ".$col_image;
        $values = $col_values .= " ,'".$imagename."'";
    }

    $sql1 = "insert into $tablename ($cols) values ($values)";

    $test = $baza->query($sql1);
}else{
    $sql = "insert into $tablename ($col_names) values ($col_values)";
    $test = $baza->query($sql);
}

if ($test){
    header("Location: index.php");
}else{
    header("Location: error.php");
}