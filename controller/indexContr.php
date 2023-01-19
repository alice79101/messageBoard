<?php
session_start();
//dumpAndDie(SESSION_id()); // 印出使用者瀏覽器 session_id 的值
//if (!empty($_SESSION)) {
//    dumpAndDie($_SESSION);
//}
view_path("index.view.php");