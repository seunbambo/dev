<?php
//locked();
//error_reporting(E_ERROR | E_PARSE);

//show users list
if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add'])) {
    //include('models/confirmpassword.php');

    include('views/confirmpassword.php');
}
