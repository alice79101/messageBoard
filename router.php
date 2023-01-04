<?php

function abort($code = 404) {
    // 在開發人員選項中顯示錯誤代碼，並帶入不同錯誤頁面
    http_response_code($code);
    require "view/{$code}.php";
}

