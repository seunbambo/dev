<?php
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="#">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dashboard Portal
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pontano+Sans|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="stylesheet" href="assets/css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script src="assets/js/core/functions.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">

            <div class="logo">
                <a href="#" class="simple-text logo-normal">
                </a>
            </div>
            <br>
            <div class="sidebar-wrapper">
                <ul class="">
                    <li class="item">
                        <a class="nav-link" href="index.php?controller=dashboard">
                            <p><i class="fa fa-dashboard" style="margin-right: 10px;"></i><span>Dashboard</span></p>
                        </a>
                    </li>
                    <li class="item">
                        <a class="nav-link" href="index.php?controller=subscribed_services">
                            <p><i class="fa fa-briefcase" style="margin-right: 10px;"></i><span>Subscribed Services</span></p>
                        </a>
                    </li>
                    <li class="item">
                        <a class="nav-link" href="index.php?controller=transactions&count=10">
                            <p><i class="fa fa-credit-card" style="margin-right: 10px;"></i><span>Transactions</span></p>
                        </a>
                    </li>
                    <li class="item">
                        <a class="nav-link" href="index.php?controller=funding&count=10">
                            <p><i class="fa fa-folder" style="margin-right: 10px;"></i><span>Funding History</span></p>
                        </a>
                    </li>

                    <li class="item" id="logout">
                        <hr>
                        <a class="nav-link" href="index.php?controller=logout">
                            <p><i class="fa fa-sign-out" style="margin-right: 10px;"></i><span>Log Out</span></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
                <div class="container-fluid">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">

                        <div> Welcome,
                        </div>
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <p class="d-lg-none d-md-block">

                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#">
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?controller=logout">Log out</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>