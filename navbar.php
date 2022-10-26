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
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.php">
            <p class="text-white" style="color: white; font-size: 40px; text-decoration: none"><?php echo strtoupper($a) ?></p>
        </a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-left">


            <li class="nav-item ">
                <a class="nav-link btn btn-sm btn-outline-success px-4"  href="download.php">Download project</a>
            </li>

            </ul>
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item">
                <a class="nav-link btn btn-success create-new-button" data-bs-toggle="modal" data-bs-target="#addTable" >+Connect to database</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-warning create-new-button"  href="createDatabase.php">Create new database</a>
            </li>



        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>