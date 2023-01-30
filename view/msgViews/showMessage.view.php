<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => htmlspecialchars($msg["msgTitle"])
]);
//dumpAndDie($msg);
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <pre><p class="mt-4 break-words"><?= htmlspecialchars($msg["msgContent"]); ?></p></pre>
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
        </div>
        <!-- /End replace -->
        <br>
        <a href="/myMessage" class="px-4 text-blue-500 hover:underline">Back...</a>
    </div>
</main>

<?php
view_path("partials/footer.php");
?>
