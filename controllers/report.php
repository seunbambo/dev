<?php
locked();
//include_once('models/report.php');
error_reporting(E_ERROR | E_PARSE);

//show users list
if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add'])) {


    include('views/view_report.php');
}
//deleted action
elseif (isset($_GET['del'])) {
    $where = array("id" => $_GET['del']);
    del_user($conn, $where);
    header("Location: index.php?controller=report");
    exit();
}

//edit action
elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    //if form is submitted.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $where_condition = array("id" => $_GET['edit']);
        $msg = "";
        $class_stat = 'class="alert alert-info"';
        if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
            $msg = "Your password does not match your confirmed password.";
            $class_stat = 'class="alert alert-warning"';
        } else {
            $_POST['password'] = md5($_POST['password']);
            unset($_POST['confirm_password']);
            $data = $_POST;
            $is_updated = update_user($conn, $data, $where_condition);
            if ($is_updated) {
                $msg = "Data is updated.";
                $class_stat = 'class="alert alert-info"';
            } else {
                $msg = "Error input.";
                $class_stat = 'class="alert alert-warning"';
            }
        }
    }
    // get user record informaation.
    $user = get_user($conn, $_GET['edit']);
    include('views/view_report.php');
} elseif (isset($_GET['add'])) {
    //if form is submitted.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $msg = "";
        $class_stat = 'class="alert alert-info"';
        if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
            $msg = "Your password does not match your confirmed password.";
            $class_stat = 'class="alert alert-warning"';
        } else {
            $_POST['password'] = md5($_POST['password']);
            unset($_POST['confirm_password']);
            $data[] = $_POST;
            //print_r($data);exit;		
            $is_inserted = insert_user($conn, $data);
            if ($is_inserted) {
                $msg = "Data is inserted.";
                $class_stat = 'class="alert alert-info"';
            } else {
                $msg = "Error input.";
                $class_stat = 'class="alert alert-warning"';
            }
        }

        //redirect to user list
        //header("Location: index.php?controller=users"); 
        //exit();
    }

    //include('views/add_individual.php');
}

 