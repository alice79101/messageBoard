<?php

//namespace messageBoard\controller;

require __DIR__ . "/../partials/head.php";
require __DIR__ . "/../partials/nav.php";
$heading = "My Message";
require __DIR__ . "/../partials/banner.php";
require __DIR__ . "/../core/Dbh.php";

$db = new Dbh();
$myMsg = $db->myMsgs(1);
//dumpAndDie($latestMsg);



require __DIR__ . "/../view/myMessage.view.php";
require __DIR__ . "/../partials/footer.php";