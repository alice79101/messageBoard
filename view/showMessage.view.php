<?php
view_path("partials/head.php");
view_path("partials/nav.php");
if (!isset($msg)) {
    $msg["msgTitle"] = "請先登入";
}
view_path("partials/banner.php", [
    'heading' => htmlspecialchars($msg["msgTitle"])
]);
//dumpAndDie($msg);
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p class="mt-4 break-words"><?php
                if (!isset($_SESSION["memberID"])) { ?>
                    <a href="/login" class="text-blue-500 inline-block hover:border-b border-blue-900">請先登入</a>
                <?php } else {
                echo "<pre>";
                echo htmlspecialchars($msg["msgContent"]);
                echo "</pre>";
                ?></p>
            <br>
            <div class="">
                <a href="/updateMessage?msgIndex=<?= $msg['msgIndex'] ?>"
                   class="text-gray-500 inline-block hover:border-b border-gray-900">
                    修改留言
                </a>
                <a href="/deleteMessage?msgIndex=<?= $msg['msgIndex'] ?>"
                   class="text-red-500 inline-block hover:border-b border-gray-900">
                    刪除留言
                </a>
            </div>
            <?php } ?>

        </div>


        <!-- /End replace -->
        <br>
        <a href="/myMessage" class="px-4 text-blue-500 hover:underline">Back...</a>
    </div>
</main>

<?php
view_path("partials/footer.php");
?>
