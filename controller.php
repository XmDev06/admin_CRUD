<?php

if (isset($_POST['host'])) {

    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = $_POST['db'];

    $connect = mysqli_connect("$host", "$username", "$password", "$db");

    if ($connect){
        $listdbtables = array_column($connect->query('SHOW TABLES')->fetch_all(),0);


        $data = '
<?php $baza = mysqli_connect("'.$host.'", "'.$username.'", "'.$password.'", "'.$db.'");
$tables =$baza->query( "SHOW TABLES IN '.$db.'");
$db="'.$db.'";';

        $tablename= '<?php $tablename = "'.$listdbtables[0].'";';

        file_put_contents('config.php', '');
        file_put_contents('config.php', $data);

        file_put_contents('configtable.php', '');
        file_put_contents('configtable.php', $tablename);


        header("Location: index.php");
    }else{
        header("Location: error.php");
    }
}

if (isset($_GET['table'])){

    $table= $_GET['table'];
    $tablename= '<?php $tablename = "'.$table.'";';
    file_put_contents('configtable.php', '');
    file_put_contents('configtable.php', $tablename);
    header("Location: index.php");
}


if (isset($_POST['newusername'])){

    $data = $_POST;

    $username = str_replace(' ', '', $_POST['newusername']);
    $password = str_replace(' ', '', $_POST['newpassword']);
    $database_name = str_replace(' ', '', $_POST['newdatabase']);
    $table_name = str_replace(' ', '', $_POST['newtable']);

    $connaction = mysqli_connect('localhost', $username, $password, $database_name);


    $_SESSION['connaction'] = $connaction;

    $count_columns = (count($data) - 4) / 3;


    $col_names = [];
    $col_types = [];
    $col_sizes = [];

    for ($i = 1; $i <= $count_columns; $i++) {

        if ($_POST['type'. $i] == 'image'){
            $_POST['type'. $i] = 'varchar';
        }


        $col_names[$i] = str_replace(' ', '', $_POST['column_name' . $i]);
        $col_types[$i] = str_replace(' ', '', $_POST['type' . $i]);
        $col_sizes[$i] = str_replace(' ', '', $_POST['size' . $i]);
    }


    if ($connaction) {
        $add_col = "ALTER TABLE $table_name ADD ";
        $sql = "CREATE TABLE $table_name (id int auto_increment primary key)";
        $connaction->query($sql);

        for ($f = 1; $f <= count($col_names); $f++) {

            $sql =$add_col . $col_names[$f] . " " . $col_types[$f] . "(" . $col_sizes[$f] . ")";
            $conn = $connaction->query($sql);

        }



        $data = '
<?php $baza = mysqli_connect("localhost", "'.$username.'", "'.$password.'", "'.$database_name.'");
$tables =$baza->query( "SHOW TABLES IN '.$database_name.'");
$db="'.$database_name.'";';

        $tablename= '<?php $tablename = "'.$table_name.'";';

        file_put_contents('config.php', '');
        file_put_contents('config.php', $data);


        file_put_contents('configtable.php', '');
        file_put_contents('configtable.php', $tablename);

        header('Location: ../index.php');
    }else{

        $conn = new mysqli("localhost", $username, $password);
// Check connection
        if ($conn->connect_error) {
            header("Location: error.php");
        }

// Create database
        $sql = "CREATE DATABASE ".$database_name;
        $true = $conn->query($sql);
        $test = mysqli_connect('localhost', $username, $password, $database_name);

        if ($true) {
            $sql = "CREATE TABLE $table_name (id int auto_increment primary key)";
            $test->query($sql);
            $add_col = "ALTER TABLE $table_name ADD ";

            for ($f = 1; $f <= count($col_names); $f++) {
                $test->query($add_col . $col_names[$f] . " " . $col_types[$f] . "(" . $col_sizes[$f] . ")");
            }


            $data = '
<?php $baza = mysqli_connect("localhost", "'.$username.'", "'.$password.'", "'.$database_name.'");
$tables =$baza->query( "SHOW TABLES IN '.$database_name.'");
$db="'.$database_name.'";';

            $tablename= '<?php $tablename = "'.$table_name.'";';

            file_put_contents('config.php', '');
            file_put_contents('config.php', $data);


            file_put_contents('configtable.php', '');
            file_put_contents('configtable.php', $tablename);


        } else {
            header("Location: error.php");
        }

        $conn->close();


        header("Location: index.php");
    }
}