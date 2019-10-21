<!DOCTYPE html>
<html lang="en">

<?php

include 'head2.php';
?>

<body>

    <div class="main">

        <!-- Sign in  Form -->
        <section class="">
            <div class="container">
                <div class="signin-content">

                    <form action="models/login-status.php" method="POST" class="register-form" id="login-form">
                        <?php
                        if (isset($_GET['login']) == 'fail') {
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Credentials.</div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-phone material-icons-phone"></i></label>
                            <input type="text" name="msisdn" id="phone" placeholder="Phone" required />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="Password" required />
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="submit" id="signin" class="form-submit form-center" value="LOGIN" />
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>

    <?php
    include 'footer2.php';
    ?>