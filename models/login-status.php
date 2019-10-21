<?php
error_reporting(E_ERROR | E_PARSE);
require 'submit.php';

if ($status == "1") {
    // echo "<br> Login Successful";
    header("Location: ../index.php?controller=dashboard");
} else {
    header("Location: ../index.php?login=fail");
    //echo '<script>window.location="index.php?login=fail"</script>';
}
