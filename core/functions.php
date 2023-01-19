<?php

function dumpAndDie($value) {
    // 網站建構過程中各種檢驗使用
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function isUrl($value) {
    // 檢查從瀏覽器取得的網址 跟 導覽列預設的值($value)是否相同
    if($_SERVER["REQUEST_URI"] === $value) {
        return $_SERVER["REQUEST_URI"];
    }
}

function base_path($rootToPath){
    return BASE_PATH . $rootToPath;
}

function view_path($path, $attributes = []){
    //var_dump($path);
    extract($attributes);
    require BASE_PATH . "view/" . $path;
}

function changeWords($string) {
    // 輸入訊息時，為了保留使用者輸入的換行及空白，因此才做這個function
    $keepLine = "\n";
    $replaceLine = "%b%r%"; //換行被轉換成這個
    $keepSpace = " ";
    $replaceSpace = "%s%p%"; // 空格被轉換成這個
    $string = str_replace($keepLine, $replaceLine, $string);
    $string = str_replace($keepSpace, $replaceSpace, $string);
    return $string;
}

function changeWordsBack($string) {
    // 顯示訊息時，為了呈現使用者輸入的換行及空白，因此才做這個function
    $replaceLine = "%b%r%"; //這個要被換回換行
    $turnLine = "<br>";
    $replaceSpace = "%s%p%"; // 這個要被換回空格
    $turnSpace = "&nbsp;";
    $string = str_replace($replaceLine, $turnLine, $string);
    $string = str_replace($replaceSpace, $turnSpace, $string);
    return $string;
}