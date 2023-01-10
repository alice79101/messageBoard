<?php
use core\Dbh;
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("signupAndLogin.view.php", [
    'heading' => 'Sign Up or Login'
]);
view_path("partials/footer.php");