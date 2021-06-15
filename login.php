<?php  include('config.php'); ?>

<?php  include('include/registration_login.php'); ?>

<?php include('include/header_section.php'); ?>

<?php include('include/navbar.php')?>


    <div class="popup-con">
    <h2>Login</h2>
    <form method="post" action="login.php">
    <?php include(ROOT_PATH . '/include/errors.php') ?>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button name="login" type="submit" class="btn">Login</button>
    </form>
    <p style="margin-top: 15px; text-align:center;">
            Not yet a member? <a href="signup.php">Sign up</a>
        </p>
    </div>

<?php include( ROOT_PATH . '/include/footer.php'); ?>