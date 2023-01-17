<?php
session_start();
session_unset();
session_destroy();

view_path("login.view.php");
