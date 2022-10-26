<?php
include "header.php";
include "config.php";
include "configtable.php";

$id = $_GET['id'];
$result = $baza->query("select * from $tablename where id = '$id'");

$fetch_fields = $result->fetch_fields();


$cols_count = count($fetch_fields);

$cols_array = [];
for ($i = 0; $i < $cols_count; $i++) {
    $cols_array[] = $fetch_fields[$i]->orgname;
}
if (in_array('id', $cols_array)) {
    $index_of_id = array_search('id', $cols_array);
    unset($cols_array[$index_of_id]);
}
if (in_array('password', $cols_array)) {
    $index_of_id = array_search('password', $cols_array);
    unset($cols_array[$index_of_id]);
}

?>


<form action="change.php" method="post" enctype="multipart/form-data" class="m-5">
    <input type="hidden" value="<?= $id ?>" name="id">
    <?php
    $dd = $baza->query("DESCRIBE $tablename");
    while ($row = $result->fetch_array()) {



        foreach ($cols_array as $key => $cols):

            $type1 = '';
            $type = $dd->fetch_array()['Type'];

            if ($cols == "image" || $cols == "file" || $cols == "images" || $cols == "files") {
                $type1 = "file";
            }
            ?>

            <div class="form-group ">
                <label class="form-label"><?= ucfirst($cols) ?></label>
                <input class="text-white form-control" type="<?= $type1 ?>" name="<?= $cols ?>" value="<?= $row[$cols] ?>" "  <?= strpos($cols, '_at')!==false? '': ''?>
                placeholder="Enter <?= $cols ?>" required>
            </div>


        <?php
        endforeach;
    }
    ?>

    <a type="submit" class="btn btn-warning" href="index.php">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
include "footer.php";
?>

