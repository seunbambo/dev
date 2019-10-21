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
                        if (isset($_POST['msisdn'])) {
                            include_once('models/forgotpassword.php');
                        }
                        ?>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                            <input type="text" name="msisdn" id="phone" placeholder="Enter Phone Number" required />
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="forgotPass" id="signin" class="form-submit form-center" value="Request Password" />
                        </div>
                    </form>


                </div>
            </div>
        </section>

    </div>

    <?php

    include 'footer2.php';
    ?>