<?php

function abort($code = 404) {
    // 在開發人員選項中顯示錯誤代碼，並帶入不同錯誤頁面
    http_response_code($code);

    //dumpAndDie($code);
    $code = (string)$code;
    //var_dump($code);
    view_path($code.".php");
}