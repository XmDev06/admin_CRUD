<?php
include "config.php";


if (isset($_POST['table']) && $baza) {
    $table = $_POST['table'];

    $data = $_POST;

    $count_columns = (count($data) - 1) / 3;
    $col_names = [];
    $col_types = [];
    $col_sizes = [];

    for ($i = 1; $i <= $count_columns; $i++) {

        if ($_POST['type' . $i] == 'image') {
            $_POST['type' . $i] = 'varchar';
        }


        $col_names[$i] = str_replace(' ', '', $_POST['column_name' . $i]);
        $col_types[$i] = str_replace(' ', '', $_POST['type' . $i]);
        $col_sizes[$i] = str_replace(' ', '', $_POST['size' . $i]);
    }


    if ($baza) {
        $add_col = "ALTER TABLE $table ADD ";
        $sql = "CREATE TABLE $table (id int auto_increment primary key)";
        $baza->query($sql);

        for ($f = 1; $f <= count($col_names); $f++) {

            $sql = $add_col . $col_names[$f] . " " . $col_types[$f] . "(" . $col_sizes[$f] . ")";
            $conn = $baza->query($sql);

        }


        $tablename = '<?php $tablename = "' . $table . '";';

        file_put_contents('configtable.php', '');
        file_put_contents('configtable.php', $tablename);

        header('Location: ../index.php');

    }


} else {

    header("Location: error.php");

}
