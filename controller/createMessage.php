<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "Create Message"
]);

require base_path("core/Dbh.php");


$db = new Dbh();
$errMsg = "";
$createStatus = "NO";
// 使用 POST 方法取得資訊的才視同使用者送出表單
if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    // 空白輸入驗證
    if (empty($_POST["Title"]) || empty($_POST["content"])) {
        $errMsg = "留言失敗：訊息主旨及內容皆為必填";
    }

    // 內容過多驗證
    if (strlen($_POST["Title"]) >= 100 || strlen($_POST["content"]) >= 1000) {
        $errMsg = "留言失敗：訊息主旨至多100字元、內容至多1,000字元";
    }

//    dumpAndDie($_POST); // 驗證表單傳出來的內容是什麼
//    dumpAndDie($errMsg); // 驗證錯誤訊息有被啟動

    // 輸入資料庫
    if (empty($errMsg)) {
        $db->query('INSERT INTO msgList(msgTitle, msgContent, memberID) VALUES (:msgTitle , :msgContent, :memberID)', [
            'msgTitle' => $_POST["Title"],
            'msgContent' => $_POST["content"],
            'memberID' => "1"
        ]);
        $createStatus = "YES";
    }
}

view_path("createMessage.view.php", [
    'createStatus' => $createStatus,
    'errMsg' => $errMsg
]);
view_path("partials/footer.php");
