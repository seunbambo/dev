<!DOCTYPE html>
<html lang="en">

<?php

include 'head2.php';

?>

<body>

    <div class="main">

        <!-- Sign in  Form -->
        <section class="">
            <figure><img src="img/nownow-logo.png" id="logo" alt="nownow-image"></figure>
            <div class="container">
                <div class="signin-content">

                    <form action="" method="POST" class="register-form" id="login-form">
                        <?php
                        include 'models/confirmpassword.php';
                        ?>


                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="currentpassword" id="your_pass" placeholder="Input Current Password" required />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="newpassword" id="your_pass" placeholder="Input New Password" required />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="confirmpassword" id="your_pass" placeholder="Confirm New Password" required />
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="forgotPass" id="signin" class="form-submit form-center" value="Change Password" />
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>

    <?php
    include 'footer2.php';
    ?>