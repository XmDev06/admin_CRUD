<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
<!--    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">-->
<!--    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">-->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        #scroll-container {
            border-radius: 5px;
            overflow: hidden;
        }

        #scroll-text {
            /* animation properties */
            -moz-transform: translateX(100%);
            -webkit-transform: translateX(100%);
            transform: translateX(100%);

            -moz-animation: my-animation 6s linear infinite;
            -webkit-animation: my-animation 6s linear infinite;
            animation: my-animation 6s linear infinite;

        }

        /* for Firefox */
        @-moz-keyframes my-animation {
            from { -moz-transform: translateX(  100%); }
            to { -moz-transform: translateX(-100%); }
        }

        /* for Chrome */
        @-webkit-keyframes my-animation {
            from { -webkit-transform: translateX(100%); }
            to { -webkit-transform: translateX(-100%); }
        }

        @keyframes my-animation {
            from {
                -moz-transform: translateX(20%);
                -webkit-transform: translateX(20%);
                transform: translateX(20%);
            }
            to {
                -moz-transform: translateX(-100%);
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }
    </style>
</head>
<body>
<div class="container-scroller">
    <?php

    include "./sidebar.php";

    ?>
    <div class="container-fluid page-body-wrapper">

        <?php

        include "./navbar.php";

        ?>


        <div class="main-panel">