<?php

const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "core/functions.php";
require base_path("core/router.php");


$routes = require base_path("core/routes.php");
    // routes 是自己創建的網站地圖
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    // uri 是 server 透過瀏覽器取得的網址，使用者直接輸入網址會在這邊
    //利用 parse_url 解析使用者輸入的網址，避免使用者惡意輸入被當成 html 執行
if (array_key_exists($uri, $routes)) {
    // 使用者輸入的網址若與網站地圖有對應，則回饋對應網頁
    require BASE_PATH . $routes[$uri];
} else {
    abort(404);
    // 若使用者輸入網址無對應到，則回覆錯誤代碼 page
}



