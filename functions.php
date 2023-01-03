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