
<?php
    include "config.php";
    $a = substr($db, 0, 1);
        $scroll1 = "";
        if(strlen($db) >= 18){
            $scroll1 = "scroll-text";
        }else{
            $scroll1="";
        };
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" style="text-decoration: none" href="index.php">
            <p class="text-white ms-2" style="color: white; font-size: 30px; text-decoration: none; " id="<?= $scroll1?>"><?= strtoupper($db) ?></p>
        </a>
        <a class="sidebar-brand brand-logo-mini" style="text-decoration: none" href="index.php">
            <p class="text-white" style="color: white; font-size: 40px; text-decoration: none"><?php echo strtoupper($a) ?></p>
        </a>
    </div>
    <ul class="nav">

        <a href="add_table.php" class="btn btn-outline-info py-3">ADD TABLE</a href="add_table.php">


        <?php
        include "conf_sidebar.php";
        ?>
    </ul>
</nav>