<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "My Message"
]);
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <?php
//            dumpAndDie($_SESSION["memberID"]);
            if (!isset($_SESSION["memberID"])) { ?>
                <a href="/login" class="text-blue-500 inline-block hover:border-b border-blue-900">請先登入</a>
            <?php } else { ?>
                <p>
                    click to read content or manage it.
                </p>
                <ul>
                    <?php foreach ($myMsg as $k => $value) : ?>
                    <div>
                        <a href="/msg?msgIndex=<?= $value['msgIndex'] ?>"
                           class="text-gray-500 inline-block hover:border-b border-gray-900">
                            <?= htmlspecialchars($value['msgTitle']) //顯示的文字為訊息標題
                            // 透過 htmlspecialchars() 將使用者輸入的訊息轉譯，不會讓他造成對網站的危害
                            ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="px-4 py-6 sm:px-0">
                        <a href="/createMessage" class="text-blue-500 hover:underline">留個言吧！</a>
                    </div>
                </ul>
                <?php
            }
            ?>
        </div>
        <!-- /End replace -->

    </div>
</main>

<?php
view_path("partials/footer.php");
?>
