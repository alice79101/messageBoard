<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "All Messages"
]);
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p>
                Here are latest messages.
            </p>
            <ul>
                <?php foreach ($allMsg as $k => $value) : ?>
                <div class="h-20 rounded-lg border-2 border-dashed border-gray-200">
                    <li class="mt-4">
                        <!--                        --><?php //var_dump($value); ?>
                    <li class="ml-4 text-gray-500 hover:underline">
                        <a href="/msg?msgIndex=<?= $value['msgIndex'] ?>" class="text-gray-500 hover:underline">
                            <?= htmlspecialchars($value['msgTitle']) //顯示的文字為訊息標題
                            // 透過 htmlspecialchars() 將使用者輸入的訊息轉譯，不會讓他造成對網站的危害
                            ?>
                        </a>
                    </li>
                    <li class="text-right mr-4">
                        <?= $value["nickname"] . "｜ 更新於：" . substr($value["msgTime"], 0, 10); ?>
                    </li>
                    <br>
                    <?php endforeach; ?>
                    </li>
                </div>
            </ul>
        </div>
        <!-- /End replace -->

    </div>
</main>

<?php
view_path("partials/footer.php");
?>