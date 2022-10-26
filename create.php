<?php
include "header.php";
include "config.php";
include "configtable.php";

function dump($data, $m = false)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    if ($m) {
        exit();
    }
}


$result = $baza->query("select * from $tablename");


$fetch_fieldlar = $result->fetch_fields();
$cols_count = count($fetch_fieldlar);


$cols_array = [];
for ($i = 0; $i < $cols_count; $i++) {
    $cols_array[] = $fetch_fieldlar[$i]->orgname;
}


if (in_array('id', $cols_array)) {
    $index_of_id = array_search('id', $cols_array);
    unset($cols_array[$index_of_id]);
}
?>


<form action="store.php" method="post" enctype="multipart/form-data" class="m-5">
    <?php
    foreach ($cols_array as $cols):

        $dd = $baza->query("DESCRIBE $tablename");


        $type1 = 'text';
        $enumcols = '';
        $enum_massiv = [];
        while ($row = $dd->fetch_array()) {

            $colstype = $row['Type'];
            $colsname = $row['Field'];

            if ($cols == "image" || $cols == "file" || $cols == "images" || $cols == "files" && $cols == $colsname) {
                $type1 = "file";
            }
            if ($cols == "email") {
                $type1 = "email";
            }
            if ($cols == "password") {
                $type1 = "password";
            }
            if ($colstype == "timestamp" && $cols == $colsname) {
                $type1 = "datetime-local";
            }
            if (strpos($colstype, 'enum') !== false && $cols == $colsname) {
                $type1 = "hidden";
                $enumcols = $cols;
                $index = strpos($colstype, '(');
                $str = substr($colstype, $index + 1);
                $clean_str = str_replace([')', "'"], '', $str);
                $mas = explode(',', $clean_str);
                $enum_massiv = $mas;
            }
            if (strpos($cols, '_id') !== false || (strpos($colstype, 'int') !== false) && $cols == $colsname) {
                $type1 = "number";
            }
        }
        if ($type1 == "hidden") {


            ?>
            <label class="form-label "><?= ucfirst($cols) ?></label>
            <select class="form-control text-white" name="<?= $enumcols?>" id="">
                <?php
                foreach ($enum_massiv as $key=>$item){ ?>
                    <option value='<?php echo  "$item" ?>'><?= $item ?></option>
                    <?php  }  ?>
            </select>
            <?php
        }
        ?>

        <div class="form-group <?= $type1 == 'hidden' ? 'd-none': ''?>">
            <label class="form-label"><?= ucfirst($cols) ?></label>
            <input class="text-white form-control" type="<?= $type1 ?>" name="<?= $cols ?>""
                   placeholder="Enter <?= $cols ?>" required>
        </div>


    <?php
    endforeach;
    ?>

    <a type="submit" class="btn btn-warning" href="index.php">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
include "footer.php";
?>

