<?php
include "./config.php";
include "./configtable.php";
if($db==''){
    header("Location: createDatabase.php");
    exit();
}
include "./header.php";



$result = $baza->query("select * from $tablename");
$db = $result->fetch_fields()[0]->db;

if ($result){
$fetch_fields = $result->fetch_fields();
$cols_count = count($fetch_fields);


?>

          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">

                  <a href="create.php" class="btn mb-3 btn-primary">Create new <?php echo $tablename ?></a>

                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo strtoupper($tablename) ?> TABLE</h4>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                              <?php
                              $count=-1;
                              for ($i=0; $i<$cols_count; $i++){

                                  if ($fetch_fields[$i]->orgname == 'password'){
                                      $count =$i;
                                      continue;
                                  }
                                  echo "<th>". $fetch_fields[$i]->orgname ."</th>";
                              }
                              ?>
                              <th>
                                  Action
                              </th>
                          </tr>

                        </thead>
                        <tbody>
                        <?php

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            echo "<tr>";

                            for ($i = 0; $i < $cols_count; $i++) {
                                if ($i == $count && $count != -1){
                                    continue;
                                }
                                if ($fetch_fields[$i]->orgname == 'image'){
                                    $img = $row[$fetch_fields[$i]->orgname];
                                    echo "<td><img width='50' src='images/$db/$tablename/$img' alt=''></td>";
                                }else{

                                echo "<td>" .  $row[$fetch_fields[$i]->orgname] . "</td>";
                                }
                            }
                            echo '<td style="font-size: 20px;">';
                                echo '<a class="" href="show.php?id='.$id.'"><i class="mdi mdi-eye"> </i></a>';
                                echo '<a class="px-1" href="update.php?id='.$id.'"><i class="mdi mdi-border-color">  </i></a>';
                                echo '<a class="" href="delete.php?id='.$id.'"> <i class="mdi mdi-delete"> </i></a>';
                            echo '</td>';
                            echo "</tr>";
                        }
                        ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php
}
include "./footer.php";
?>