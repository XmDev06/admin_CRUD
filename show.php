<?php
include "config.php";
include "configtable.php";
include "header.php";
$id = $_GET['id'];

$result = $baza->query("Select * from $tablename where id = $id");
$db = $result->fetch_fields()[0]->db;

$count = 0;
while ($row = $result->fetch_assoc()) {

    $image = $row['image'];
    $name = array_keys($row);
    $values = array_values($row);
    $count_columns = count($row);

    if (isset($row['image'])) {
        ?>
        <div class="row ms-4 mt-4">
            <div class="col-md-8 ">
                <ul class="list-group ">
                    <?php
                    for ($i = 0; $i < $count_columns; $i++):
                        if ($name[$i] == 'image') {
                            continue;
                        };
                        ?>

                        <li class="list-group-item bg-info px-3 pt-2 d-flex justify-content-between align-items-center">
                            <p
                                    class="d-inline-block fs-5 m-0 p-0"><?= strtoupper($name[$i]) ?>:</p>
                            <p class="m-0 p-0"><?= $values[$i] ?></p>
                        </li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </div>

            <div class="col-md-4">
                <p class="d-inline-block fs-5"><?= strtoupper('image') ?>:</p><br>
                <img src='<?= "images/$db/$tablename/$image" ?>' alt="Fileda ushbu image mavjud emas">
            </div>

        </div>
        <?php
    } else {
        ?>
        <div class="row m-4">
            <div class="col-md-12">
                <ul class="list-group">
                    <?php
                    for ($i = 0; $i < $count_columns; $i++):
                        ?>

                        <li class="list-group-item bg-info px-3 pt-2 d-flex justify-content-between align-items-center">
                            <p
                                    class="d-inline-block fs-5 m-0 p-0"><?= strtoupper($name[$i]) ?>:</p>
                            <p class="m-0 p-0"><?= $values[$i] ?></p>
                        </li>

                    <?php
                    endfor;
                    ?>
                </ul>
            </div>
        </div>
        <?php


    }

}

include "footer.php";
?>
