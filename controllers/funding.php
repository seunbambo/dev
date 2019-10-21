<?php
locked();
//include_once('models/report.php');
error_reporting(E_ERROR | E_PARSE);

//show users list
if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add'])) {


    include('views/view_funding.php');
}